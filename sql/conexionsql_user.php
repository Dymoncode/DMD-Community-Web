<?php

// Función para cargar las variables de entorno desde un archivo .env
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception("Archivo .env no encontrado.");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Ignora comentarios
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value); // Asigna a $_ENV
    }
}

// Cargar las variables de entorno desde el archivo .env
loadEnv(__DIR__ . '/../.env'); // Asegúrate de que la ruta sea correcta

// Obtener las credenciales de la base de datos desde $_ENV
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];

// Crear la conexión a la base de datos
$conexion = new mysqli($host, $user, $pass, $dbname);

// Comprobar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
} 