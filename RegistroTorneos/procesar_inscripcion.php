<?php
session_start(); // Iniciar sesión antes de procesar

// Verificar si el formulario se ha enviado correctamente
if (isset($_POST['tournamentName'], $_POST['participantName'], $_POST['participantNameDiscord'], $_POST['participantNick'], $_POST['registrationType'], $_POST['id_torneo'],$_POST['id_usuario'])) {
    
    // Verificar si el usuario no está registrado y validar los campos correspondientes
    if (!isset($_SESSION['user'])) {
        // Validar correo y teléfono solo si el usuario no está registrado
        if (!isset($_POST['playerEmail']) || !isset($_POST['playerPhone'])) {
            die('Por favor complete los campos de correo electrónico y teléfono.');
        }
    }

    // Procesar los datos normalmente
    echo "Nombre del Torneo: " . htmlspecialchars($_POST['tournamentName']) . "<br>";
    echo "Nombre del Participante: " . htmlspecialchars($_POST['participantName']) . "<br>";
    echo "Nombre en Discord del Participante: " . htmlspecialchars($_POST['participantNameDiscord']) . "<br>";
    echo "Nick del Participante: " . htmlspecialchars($_POST['participantNick']) . "<br>";
    echo "Tipo de Inscripción: " . htmlspecialchars($_POST['registrationType']) . "<br>";
    echo "ID del Torneo: " . htmlspecialchars($_POST['id_torneo']) . "<br>";
    echo "ID del Usuario: " . htmlspecialchars($_POST['id_usuario']) . "<br>";


    if (!isset($_SESSION['user'])) {
        // Mostrar correo y teléfono solo si el usuario no está registrado
        echo "Correo Electrónico: " . htmlspecialchars($_POST['playerEmail']) . "<br>";
        echo "Teléfono: " . htmlspecialchars($_POST['playerPhone']) . "<br>";
    }
} else {
    echo 'Por favor complete todos los campos requeridos.';
}
?>
