<?php
// Verifica si el ID del torneo está en la URL
if (isset($_GET['id'])) {
    var_dump($_GET); // Esto imprimirá el array con los parámetros enviados
    $id = $_GET['id']; // Obtener el id del torneo desde la URL
    // Continúa con la consulta si el ID está presente
} else {
    echo "ID de torneo no proporcionado."; // Si no hay ID en la URL
    exit; // Detener la ejecución si no se recibe el id
}
?>