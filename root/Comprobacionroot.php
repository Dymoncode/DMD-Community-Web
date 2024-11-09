<?php
include 'conexionroot.php';

// Función para validar entradas
function validar_usuario($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Función para comparar contraseñas
function comparar_contraseñas($contraseña, $contraseña_confirm) {
    return ($contraseña === $contraseña_confirm);
}

// Función para redirigir con mensaje de error
function redirigir_con_error($mensaje) {
    header("Location: Registerroot.php?error=" . urlencode($mensaje));
    exit();
}
// Función para redirigir con mensaje de éxito
function redirigir_con_exito($mensaje) {
    header("Location: Registerroot.php?success=" . urlencode($mensaje));
    exit();
}

// Función para verificar que los campos no están vacíos
function campos_requeridos($usuario, $contraseña, $contraseña_confirm) {
    return !empty($usuario) && !empty($contraseña) && !empty($contraseña_confirm);
}

// Función para verificar si el usuario ya existe en la base de datos
function usuario_existente($conexion, $usuario) {
    // Preparar la consulta SQL
    $sql = "SELECT * FROM users_root WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    // Verificar si la preparación fue exitosa
    if ($stmt === false) die('Error en la preparación de la consulta: ' . htmlspecialchars($conexion->error));
    // Vincular los parámetros
    $stmt->bind_param("s", $usuario);
    // Ejecutar la consulta
    if (!$stmt->execute()) die('Error en la ejecución de la consulta: ' . htmlspecialchars($stmt->error));
    // Retornar el resultado si existe
    return $stmt->get_result()->fetch_assoc(); // Retorna el usuario si existe
    // Cerrar la consulta
    $stmt->close();
}

// Funcion para encritar la contraseña
function encriptar_contraseña($contraseña){
    return password_hash($contraseña, PASSWORD_DEFAULT);
}

// Funcion para registrar un nuevo usuario
function registrar_usuario($conexion,$usuario,$contraseña){
    // Preparar la consulta SQL
    $sql = "INSERT INTO users_root (usuario, contraseña) VALUES (?,?)";
    $stmt = $conexion->prepare($sql);
    // Verificar si la preparación fue exitosa
    if ($stmt === false) die('Error en la preparación de la consulta: ' . htmlspecialchars($conexion->error));
    // Encriptar la contraseña
    $hash = encriptar_contraseña($contraseña);
    // Vincular los parámetros
    $stmt -> bind_param("ss", $usuario, $hash);
    // Ejecutar la consulta
    if (!$stmt->execute()) die('Error en la ejecución de la consulta: ' . htmlspecialchars($stmt->error));
    // Cerrar la consulta
    $stmt->close();
}

// Función para recibir datos POST de un formulario
function recibirdatos($conexion) {
    // Verificar si se han enviado datos
    if (isset($_POST['username'], $_POST['passwd'], $_POST['passwd_confirm'])) {
        // Limpiar y obtener los datos
        $usuario = validar_usuario($_POST['username']);
        $contraseña = validar_usuario($_POST['passwd']);
        $contraseña_confirm = validar_usuario($_POST['passwd_confirm']);

        // Verificar que los campos sean requeridos
        if (!campos_requeridos($usuario, $contraseña, $contraseña_confirm)) {
            redirigir_con_error("Todos los campos son requeridos");
        }

        // Comparar contraseñas usando la función comparar_contraseñas
        if (!comparar_contraseñas($contraseña, $contraseña_confirm)) {
            redirigir_con_error("Las contraseñas no coinciden");
        }

        // Verificar si el usuario ya existe
        if (usuario_existente($conexion, $usuario)) {
            redirigir_con_error("El usuario ya existe");
        }

        // Registrar el nuevo usuario
        registrar_usuario($conexion, $usuario, $contraseña);
        redirigir_con_exito("Usuario registrado con éxito");
        exit();

        // Aquí podrías agregar el código para insertar el nuevo usuario en la base de datos
    } else {
        redirigir_con_error("Formulario incompleto");
    }
}

// Llamar a la función para recibir datos
recibirdatos($conexion);
?>