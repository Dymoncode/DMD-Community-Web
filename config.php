<?php
function loadEnv($filePath = __DIR__ . '/.env') {
    if (!file_exists($filePath)) {
        throw new Exception("Archivo .env no encontrado en la ruta: $filePath");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignora líneas que son comentarios
        if (strpos(trim($line), '#') === 0) continue;

        // Asegúrate de que haya un signo de igual en la línea
        if (strpos($line, '=') === false) {
            continue; // O puedes lanzar una excepción
        }
        // Divide la línea en clave y valor
        list($key, $value) = explode('=', $line, 2);
        // Asigna cada variable a $_ENV
        $_ENV[trim($key)] = trim($value);
    }
}

// Carga las variables de entorno
loadEnv();
$clientID = $_ENV['CLIENT_ID'] ?? ''; // Verifica que las variables están disponibles
$clientSecret = $_ENV['CLIENT_SECRET'] ?? '';
$redirectURI = $_ENV['REDIRECT_URI'] ?? '';



