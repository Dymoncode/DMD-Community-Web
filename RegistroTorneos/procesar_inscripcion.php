<?php

if(isset($_POST['participantName'], $_POST['participantNameDiscord'], $_POST['participantNick'], $_POST['registrationType'], $_POST['id_torneo'],$_POST['participantNameLogeado']
,$_POST['tournamentName'])) {
    $nombretorneo = $_POST['tournamentName'];
    $nombre = $_POST['participantName'];
    $discord = $_POST['participantNameDiscord'];
    $nick = $_POST['participantNick'];
    $tipo = $_POST['registrationType'];
    $id_torneo = $_POST['id_torneo'];


    if($tipo == 'individual') {
        $correo = $_POST['playerEmail'];
        $telefono = $_POST['playerPhone'];
    } 
    $sql = "INSERT INTO inscripciones (nombre_torneo, Participante, NickDiscord, NickParticipante, TipodeInscripción, CorreoElectrónico, Teléfono) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) die('Error en la preparacion de la consulta: ' . htmlspecialchars($conexion->error));
    $stmt->bind_param("isssssss", $nombretorneo, $nombre, $discord, $nick, 'ind', $correo, $telefono);
    if(!$stmt->execute()) die('Error en la ejecucion de la consulta: ' . htmlspecialchars($stmt->error));
    $stmt->close();
    $result = $conexion->query($sql);

   
    if($result) {

        echo 'Inscripción realizada con éxito';
    } else {
        echo 'Error al realizar la inscripción';
    }
} else {
    echo 'Por favor complete todos los campos';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola</h1>
</body>
</html>