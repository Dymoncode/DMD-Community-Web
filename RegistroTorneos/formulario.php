<?php
include '../sql/conexionsql_user.php'; // Incluir el archivo de conexión a la base de datos

// Verificar si el id del torneo se ha pasado por GET
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtener el id del torneo desde la URL
    
    // Usar una consulta preparada para evitar inyección SQL
    $consulta = $conexion->prepare("SELECT * FROM torneos WHERE id = ?");
    $consulta->bind_param("i", $id); // 'i' indica que el parámetro es un entero
    $consulta->execute(); // Ejecutar la consulta
    $resultado = $consulta->get_result(); // Obtener el resultado de la consulta
    
    // Verificar si se encontró el torneo
    if ($resultado->num_rows > 0) {
        $torneo = $resultado->fetch_assoc(); // Obtener los datos del torneo
    } else {
        echo "Torneo no encontrado.";
        exit; // Detener la ejecución si no se encuentra el torneo
    }
} else {
    echo "ID de torneo no proporcionado.";
    exit; // Detener la ejecución si no se recibe el id
}
?>

<!-- Aquí puedes mostrar los detalles del torneo y el formulario de inscripción -->
