<?php
if(isset($_POST['participantName'], $_POST['participantNameDiscord'], $_POST['participantNick'], $_POST['registrationType'], $_POST['id_torneo'], $_POST['participantNameLogeado'], $_POST['tournamentName'])) {
    
    // Obtener los valores enviados por POST
    $nombretorneo = $_POST['tournamentName'];
    $nombre = $_POST['participantName'];
    $discord = $_POST['participantNameDiscord'];
    $nick = $_POST['participantNick'];
    $tipo = $_POST['registrationType'];
    $id_torneo = $_POST['id_torneo'];

    // Variables para la inscripción individual
    if($tipo == 'individual') {
        $correo = $_POST['playerEmail'];
        $telefono = $_POST['playerPhone'];
    }

    // Consulta SQL con los parámetros adecuados
    $sql = "INSERT INTO FormularioTorneo (nombre_torneo, Participante, NickDiscord, NickParticipante, TipodeInscripción, CorreoElectrónico, Teléfono) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . htmlspecialchars($conexion->error));
    }

    // Determinar si es inscripción individual o equipo
    if ($tipo == 'individual') {
        // Asignamos los parámetros para una inscripción individual
        $stmt->bind_param("sssssss", $nombretorneo, $nombre, $discord, $nick, $tipo, $correo, $telefono);
    } else {
        // Si es inscripción de equipo, no necesitamos correo ni teléfono
        $stmt->bind_param("sssss", $nombretorneo, $nombre, $discord, $nick, $tipo);
    }

    // Ejecutar la consulta
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();

    // Confirmar que la inscripción fue realizada con éxito
    echo 'Inscripción realizada con éxito';
} else {
    echo 'Por favor complete todos los campos';
}
?>
