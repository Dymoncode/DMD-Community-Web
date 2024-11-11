<?php
session_start();

require_once '../vendor/autoload.php';
require_once '../config.php';

use Google_Service_Oauth2;
include '../sql/conexionsql_user.php'; // Incluir el archivo de conexión a la base de datos

// Configuración del cliente de Google
function configurar_cliente_google() {
    global $clientID, $clientSecret, $redirectURI;

    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectURI);
    $client->addScope("email");
    $client->addScope("profile");
    $client->setPrompt('select_account'); // Forzar selección de cuenta

    return $client;
}

// Función para obtener el token de acceso y la información del perfil
function obtener_info_google($client) {
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // Obtener información del perfil
        $google_oauth = new Google_Service_Oauth2($client);
        $userInfo = $google_oauth->userinfo->get();

        return $userInfo;
    }
    return null;
}

// Función para comprobar si el usuario ya existe en la base de datos de usuarios con Google
function usuario_existente_google($conexion, $correo) {
    // Preparar la consulta SQL
    $sql = "SELECT id, usuario, correo FROM users WHERE correo = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . htmlspecialchars($conexion->error));
    }

    // Vincular los parámetros
    $stmt->bind_param("s", $correo);

    // Ejecutar la consulta
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . htmlspecialchars($stmt->error));
    }

    // Retornar el resultado si existe
    return $stmt->get_result()->fetch_assoc(); // Retorna el usuario si existe
}

// Función para registrar un nuevo usuario con Google
function registrar_usuario_google($conexion, $nombre, $correo) {
    $sql = "INSERT INTO users (usuario, correo) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . htmlspecialchars($conexion->error));
    }

    $stmt->bind_param("ss", $nombre, $correo);

    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
}

// Función para manejar el inicio de sesión con Google
function manejar_login_google($client, $conexion) {
    $google_account_info = obtener_info_google($client);
    
    if ($google_account_info) {
        $nombre = $google_account_info->name;
        $correo = $google_account_info->email;

        // Verificar si el usuario ya existe en la base de datos
        $usuario_existente = usuario_existente_google($conexion, $correo);
        
        if (!$usuario_existente) {
            registrar_usuario_google($conexion, $nombre, $correo);
            $usuario_existente = usuario_existente_google($conexion, $correo); // Obtener los datos nuevamente, incluyendo el ID
        }

        // Iniciar sesión con los datos del usuario, incluyendo el ID
        iniciar_sesion($usuario_existente);
    } else {
        redirigir_con_error('Error al obtener la información de la cuenta de Google');
    }
}

// Función para redirigir con mensaje de error
function redirigir_con_error($mensaje) {
    header("Location: login.php?action=login&error=" . urlencode($mensaje));
    exit();
}

// Función para iniciar sesión con Google
function iniciar_sesion($usuario_datos) {
    session_start();

    $_SESSION['user'] = $usuario_datos['usuario'];
    $_SESSION['user_id'] = $usuario_datos['id']; // Almacenar el ID en la sesión

    header('Location: ../index.php');
    exit();
}

// Configurar el cliente de Google
$client = configurar_cliente_google();

// Manejar el inicio de sesión con Google
manejar_login_google($client, $conexion);
?>
