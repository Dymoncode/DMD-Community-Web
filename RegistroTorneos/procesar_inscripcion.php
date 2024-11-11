<?php
// Mostrar cada dato enviado con valores por defecto si faltan algunos campos
echo "Nombre del Torneo: " . htmlspecialchars($_POST['tournamentName'] ?? 'No proporcionado') . "<br>";
echo "Nombre del Participante: " . htmlspecialchars($_POST['participantName'] ?? 'No proporcionado') . "<br>";
echo "Nombre en Discord del Participante: " . htmlspecialchars($_POST['participantNameDiscord'] ?? 'No proporcionado') . "<br>";
echo "Nick del Participante: " . htmlspecialchars($_POST['participantNick'] ?? 'No proporcionado') . "<br>";
echo "Tipo de Inscripción: " . htmlspecialchars($_POST['registrationType'] ?? 'No proporcionado') . "<br>";
echo "Correo Electrónico: " . htmlspecialchars($_POST['playerEmail'] ?? 'No proporcionado') . "<br>";
echo "Teléfono: " . htmlspecialchars($_POST['playerPhone'] ?? 'No proporcionado') . "<br>";
echo "ID del Torneo: " . htmlspecialchars($_POST['id_torneo'] ?? 'No proporcionado') . "<br>";
?>
