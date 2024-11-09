<?php
include '../sql/conexionsql_user.php'; // Incluir el archivo de conexión a la base de datos



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMD Community</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_forward" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="./css/estiloformulario.css?v=<?php echo time(); ?>">

</head>

<body>
<div class="form-container">
        <h2>Formulario de Inscripción a Torneos</h2>
        <form id="tournamentForm">
            <!-- Datos generales -->
            <label for="tournamentName">Nombre del Torneo</label>
            <input type="text" id="tournamentName" name="tournamentName" required>

            <label for="participantName">Nombre del Participante o Equipo</label>
            <input type="text" id="participantName" name="participantName" required>

            <!-- Selector de tipo de inscripción -->
            <label for="registrationType">Tipo de Inscripción</label>
            <select id="registrationType" name="registrationType" onchange="toggleTeamSection()" required>
                <option value="individual">Individual</option>
                <option value="team">Equipo</option>
            </select>

            <!-- Campos para inscripción individual -->
            <div id="individualSection">
                <label for="playerEmail">Correo Electrónico</label>
                <input type="email" id="playerEmail" name="playerEmail" required>

                <label for="playerPhone">Teléfono</label>
                <input type="tel" id="playerPhone" name="playerPhone">
            </div>

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

<body>

</html>