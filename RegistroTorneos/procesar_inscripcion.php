<?php
if (isset($_POST['tournamentName'], $_POST['participantName'], $_POST['participantNameDiscord'], $_POST['participantNick'], $_POST['registrationType'], $_POST['playerEmail'], $_POST['playerPhone'], $_POST['id_torneo'])) {
    // Mostrar cada dato enviado
    echo "Nombre del Torneo: " . htmlspecialchars($_POST['tournamentName']) . "<br>";
    echo "Nombre del Participante: " . htmlspecialchars($_POST['participantName']) . "<br>";
    echo "Nombre en Discord del Participante: " . htmlspecialchars($_POST['participantNameDiscord']) . "<br>";
    echo "Nick del Participante: " . htmlspecialchars($_POST['participantNick']) . "<br>";
    echo "Tipo de Inscripción: " . htmlspecialchars($_POST['registrationType']) . "<br>";
    echo "Correo Electrónico: " . htmlspecialchars($_POST['playerEmail']) . "<br>";
    echo "Teléfono: " . htmlspecialchars($_POST['playerPhone']) . "<br>";
    echo "ID del Torneo: " . htmlspecialchars($_POST['id_torneo']) . "<br>";
} else {
    echo "Por favor complete todos los campos";
}
?>
