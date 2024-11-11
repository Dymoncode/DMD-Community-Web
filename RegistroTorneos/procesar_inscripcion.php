<?php
session_start(); // Iniciar sesión antes de procesar
include '../sql/conexionsql_user.php'; // Incluir el archivo de conexión a la base de datos

// Verificar si el formulario se ha enviado correctamente
if (isset($_POST['tournamentName'], $_POST['participantName'], $_POST['participantNameDiscord'], $_POST['participantNick'], $_POST['registrationType'], $_POST['id_torneo'])) {

    // Verificar si el usuario está registrado
    if (isset($_SESSION['user'])) {
        // Si el usuario está registrado, utilizar su ID de sesión
        $id_usuario = $_SESSION['user_id'];
        $correo_electronico = null; // No se necesita si está registrado
        $telefono = null; // No se necesita si está registrado
    } else {
        // Si el usuario no está registrado, verificar los campos de correo y teléfono
        if (!isset($_POST['playerEmail']) || !isset($_POST['playerPhone'])) {
            die('Por favor complete los campos de correo electrónico y teléfono.');
        }
        $id_usuario = null; // No tiene ID de usuario registrado
        $correo_electronico = $_POST['playerEmail'];
        $telefono = $_POST['playerPhone'];
    }

    // Asignar los datos del formulario a variables
    $nombre_torneo = $_POST['tournamentName'];
    $nombre_participante = $_POST['participantName'];
    $discord_participante = $_POST['participantNameDiscord'];
    $nick_participante = $_POST['participantNick'];
    $tipo_inscripcion = $_POST['registrationType'];
    $id_torneo = $_POST['id_torneo'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO FormularioTorneo (nombre_torneo, participantName, participantNameDiscord, participantNick, registrationType, playerEmail, playerPhone, id_torneo, id_usuario) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    // Verificar si la preparación fue exitosa
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . htmlspecialchars($conexion->error));
    }

    // Vincular los parámetros
    $stmt->bind_param("sssssssii", $nombre_torneo, $nombre_participante, $discord_participante, $nick_participante, $tipo_inscripcion, $id_torneo, $id_usuario, $correo_electronico, $telefono);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso. Aquí están los datos ingresados:<br>";
        echo "Nombre del Torneo: " . htmlspecialchars($nombre_torneo) . "<br>";
        echo "Nombre del Participante: " . htmlspecialchars($nombre_participante) . "<br>";
        echo "Nombre en Discord del Participante: " . htmlspecialchars($discord_participante) . "<br>";
        echo "Nick del Participante: " . htmlspecialchars($nick_participante) . "<br>";
        echo "Tipo de Inscripción: " . htmlspecialchars($tipo_inscripcion) . "<br>";
        echo "ID del Torneo: " . htmlspecialchars($id_torneo) . "<br>";
        
        if (!isset($_SESSION['user'])) {
            // Mostrar correo y teléfono solo si el usuario no está registrado
            echo "Correo Electrónico: " . htmlspecialchars($correo_electronico) . "<br>";
            echo "Teléfono: " . htmlspecialchars($telefono) . "<br>";
        }
    } else {
        die('Error al insertar en la base de datos: ' . htmlspecialchars($stmt->error));
    }

    // Cerrar la consulta
    $stmt->close();
} else {
    echo 'Por favor complete todos los campos requeridos.';
}
?>
