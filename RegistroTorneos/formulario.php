<?php
include '../sql/conexionsql_user.php'; // Incluir el archivo de conexión a la base de datos
session_start();
// Verificar si el id del torneo se ha enviado por POST (cuando el formulario se envía)
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtener el id del torneo desde el formulario
    
    // Usar una consulta preparada para evitar inyección SQL
    $consulta = $conexion->prepare("SELECT * FROM torneos WHERE id = ?");
    $consulta->bind_param("i", $id); // 'i' indica que el parámetro es un entero
    $consulta->execute(); // Ejecutar la consulta
    $resultado = $consulta->get_result(); // Obtener el resultado de la consulta
    
    // Verificar si se encontró el torneo
    if ($resultado->num_rows > 0) {
        $torneo = $resultado->fetch_assoc(); // Obtener los datos del torneo
    } else {
        // Si no se encuentra el torneo, manejar el error
        echo "Torneo no encontrado.";
        exit; // Detener la ejecución si no se encuentra el torneo
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscripción a Torneos</title>
    <link rel="stylesheet" href="/css/estiloformulario.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="form-container">
        <h2>Formulario de Inscripción a Torneos</h2>
        <form id="tournamentForm" action="procesar_inscripcion.php" method="POST">
            <!-- Campo oculto para enviar el id del torneo -->
            <input type="hidden" name="id_torneo" value="<?php echo htmlspecialchars($torneo['id']); ?>">

            <!-- Datos generales -->
            <label for="tournamentName">Nombre del Torneo: 
                <?php echo $torneo['nombre']; ?>    
            </label>

            <label for="participantName">Nombre del Participante o Equipo</label>
            <input type="text" id="participantName" name="participantName" required>

            <label for="participantNameDiscord">Nick de Discord del Participante o Equipo</label>
            <input type="text" id="participantNameDiscord" name="participantNameDiscord" required>

            <label for="participantNick">Nick del Participante o Equipo</label>
            <input type="text" id="participantNick" name="participantNick" required>

            <!-- Selector de tipo de inscripción -->
            <label for="registrationType">Tipo de Inscripción</label>
            <select id="registrationType" name="registrationType" onchange="toggleTeamSection()" required>
                <option value="individual">Individual</option>
                <option value="team">Equipo</option>
            </select>

            <!-- Campos para inscripción individual -->
                <?php
                // si el usuario no está logueado, mostrar los campos de email y teléfono
                // si el usuario está logueado, mostrar los campos de nombre y teléfono
                if (!isset($_SESSION['user']))  { ?>
                    <div id="individualSection">
                        <label for="playerEmail">Correo Electrónico</label>
                        <input type="email" id="playerEmail" name="playerEmail" required>

                        <label for="playerPhone">Teléfono</label>
                        <input type="tel" id="playerPhone" name="playerPhone">
                    </div>
                <?php }?>
                    
             


            <!-- Campos para inscripción en equipo -->
            <div id="teamSection" style="display: none;">
                <label for="teamCaptainEmail">Correo del Capitán</label>
                <input type="email" id="teamCaptainEmail" name="teamCaptainEmail" required>

                <label for="teamCaptainPhone">Teléfono del Capitán</label>
                <input type="tel" id="teamCaptainPhone" name="teamCaptainPhone">

                <label for="teamMembers">Miembros del Equipo (Nombre y Email)</label>
                <div id="teamMembers">
                    <div class="member">
                        <input type="text" name="memberName[]" placeholder="Nombre del miembro">
                        <input type="email" name="memberEmail[]" placeholder="Email del miembro">
                    </div>
                </div>
                <button type="button" onclick="addMember()">Añadir miembro</button>
            </div>

            <!-- Botón de envío -->
            <button type="submit">Enviar Inscripción</button>
        </form>
    </div>
    <script>

        function toggleTeamSection() {
            var registrationType = document.getElementById('registrationType').value;
            var individualSection = document.getElementById('individualSection');
            var teamSection = document.getElementById('teamSection');

            if (registrationType === 'team') {
                individualSection.style.display = 'none';
                teamSection.style.display = 'block';
            } else {
                individualSection.style.display = 'block';
                teamSection.style.display = 'none';
            }
        }

        function addMember() {
            var teamMembersDiv = document.getElementById('teamMembers');

            // Crear un nuevo div para el miembro
            var newMemberDiv = document.createElement('div');
            newMemberDiv.classList.add('member');

            // Campo de nombre
            var nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.name = 'memberName[]';
            nameInput.placeholder = 'Nombre del miembro';
            newMemberDiv.appendChild(nameInput);

            // Campo de email
            var emailInput = document.createElement('input');
            emailInput.type = 'email';
            emailInput.name = 'memberEmail[]';
            emailInput.placeholder = 'Email del miembro';
            newMemberDiv.appendChild(emailInput);

            // Añadir el nuevo miembro al equipo
            teamMembersDiv.appendChild(newMemberDiv);
        }

        // Ejecutar la función al cargar la página
        window.onload = toggleTeamSection;
    </script>
</body>

</html>