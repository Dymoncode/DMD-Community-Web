<?php
include './sql/conexionsql_user.php'; // Incluir el archivo de conexión a la base de datos
session_start();    // Verificamos si el usuario ha iniciado sesión

$consulta = "SELECT nombre, fecha_inicio, Premio, Precio_inscripcion, imagen FROM torneos ORDER BY fecha_inicio ASC, nombre ASC";
$resultado = $conexion->query($consulta);

$torneos = [];
while ($row = $resultado->fetch_assoc()) {
    $torneos[] = $row;
}


$consulta2 = "SELECT nombre,enlace,icono FROM redessociales";
$resultado2 = $conexion->query($consulta2);

$redes = [];
while ($row = $resultado2->fetch_assoc()) {
    $redes[] = $row;
}
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
    <link rel="stylesheet" href="./css/styles.css?v=<?php echo time(); ?>">

</head>

<body>
    <?php
    if (isset($_GET['success'])) { ?>
        <div class="alert success">
            <?php echo $_GET['success']; ?>
        </div>
    <?php } ?>

    <!-- Encabezado -->
    <header class="header">
        <div class="header-content">
            <h1>¡Bienvenidos a DMD Community!</h1>
            <p>Compite en torneos de tus juegos favoritos</p>
        </div>
    </header>
    <nav class="navbar">
        <ul class="nav-menu">
            <li><a href="#torneos">Próximos Torneos</a></li>
            <li><a href="#juegos">Juegos</a></li>
            <li><a href="#noticias">Noticias</a></li>
            <?php if (!isset($_SESSION['user'])) { ?>
                <li><a href="./login.php">Registro</a></li>
            <?php } else { ?>
                <li><a href="./handlers/logout.php">Cerrar Sesión</a></li>
            <?php } ?>


        </ul>
    </nav>
    <!-- Próximos Torneos -->
    <section class="section-torneo">
        <div class="container swiper">
            <div class="card-wrapper">
                <ul class="card-list swiper-wrapper">
                    <?php foreach ($torneos as $row) { ?>
                        <li class="card-item swiper-slide">
                            <a href="./RegistroTorneos/formulario.php?id=<?php echo $row['id']; ?>" class="card-link">
                                <img src="<?php echo $row['imagen']; ?>" alt="Card Image" class="card-image">
                                <h2 class="card-title"><?php echo $row['nombre']; ?></h2>
                                <p class="card-text">Fecha de inicio: <?php echo $row['fecha_inicio']; ?></p>
                                <p class="card-text">Premio: <?php echo $row['Premio'] . "€"; ?></p>
                                <p class="card-text">Precio de inscripción: <?php echo $row['Precio_inscripcion'] . "€"; ?></p>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="swiper-pagination"></div>
                <div class="swiper-slide-button swiper-button-prev"></div>
                <div class="swiper-slide-button swiper-button-next"></div>
            </div>
        </div>
    </section>
    <section id="juegos" class="section juegos-section">
        <div class="header-section">
            <h2>Juegos Disponibles</h2>
        </div>
        <div class="juegos-container">
            <?php foreach ($torneos as $row) { ?>
                <div class="juego">
                    <?php echo htmlspecialchars($row['nombre']); ?>
                </div>

            <?php } ?>
        </div>
    </section>
    <section id="noticias" class="section">
        <div class="header-section">
            <h2>Últimas Noticias</h2>
        </div>
        <div class="noticias-container">
            <article class="noticia-card">
                <h3>¡Nuevo Torneo de Total Impact Series I!</h3>
                <p><strong>Fecha:</strong> 10 de noviembre de 2024</p>
                <p>¡Prepárate para la acción! Llega el primer torneo de Total Impact Serie de Fortnite: ¿Te lo vas a
                    perder?</p>
                <button class="read-more">Leer Más</button>
            </article>
            <article class="noticia-card">
                <h3>¡Inaguración Página Web Oficial de la DMD Community!</h3>
                <p><strong>Fecha:</strong> 09 de noviembre de 2024</p>
                <p>¡Nos complace anunciar la inauguración de nuestra nueva página web! Descubre todo lo que tenemos para
                    ofrecerte.</p>
                <button class="read-more">Leer Más</button>
            </article>
            <!-- Aquí más noticias -->
        </div>
    </section>
    <section id="equipo" class="section equipo-section">
        <div class="header-section">
            <h2>Nuestro Equipo</h2>
        </div>
        <!-- Apartado: Staff -->
        <div class="equipo-apartado">
            <h4>Staff</h4>
            <div class="equipo-lista">
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Staff/Logo-Dmondejarm.png" alt="Staff 1">
                    <p class="nombre">Dmondejarm</p>
                    <p class="puesto">Fundador</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Staff/Logo-MondyXz.jpg" alt="Staff 2">
                    <p class="nombre">MondyXz</p>
                    <p class="puesto">Soporte</p>
                </div>
                <!-- Añadir más Staff aquí -->
            </div>
        </div>
        <div class="equipo-apartado">
            <h4>Programadores</h4>
            <div class="equipo-lista">
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Programadores/Logo-Dmondejarm.png" alt="Programador 1">
                    <p class="nombre">Dmondejarm</p>
                    <p class="puesto">Desarrollador Frontend y Discord</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Programadores/Logo-Migui.jpeg" alt="Programador 2">
                    <p class="nombre">Migui</p>
                    <p class="puesto">Desarrollador Frontend</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Programadores/Logo-Yoel.jpg" alt="Programador 3">
                    <p class="nombre">Yoel</p>
                    <p class="puesto">Desarrollador Frontend</p>
                </div>
                <!-- Añadir más programadores aquí -->
            </div>
        </div>
        <div class="equipo-apartado">
            <h4>Patrocinadores</h4>
            <div class="equipo-lista">
                <div class="equipo-card">
                    <img src="Assets/Images/DefaultProfile.png" alt="Patrocinador 1">
                    <p>Patrocinador 1</p>
                </div>
                <!-- Añadir más patrocinadores aquí -->
            </div>
        </div>

        <!-- Apartado: Diseñadores -->
        <div class="equipo-apartado">
            <h4>Diseñadores</h4>
            <div class="equipo-lista">
                <div class="equipo-card">
                    <img src="Assets/Images/DefaultProfile.png" alt="Diseñador 1">
                    <p>Diseñador 1</p>
                </div>
                <!-- Añadir más diseñadores aquí -->
            </div>
        </div>

        <!-- Apartado: Comentaristas -->
        <div class="equipo-apartado">
            <h4>Comentaristas</h4>
            <div class="equipo-lista">
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Comentaristas/Logo-Dmondejarm.png" alt="Comentarista 1">
                    <p>Dmondejarm</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Comentaristas/Logo-S1moscs.png" alt="Comentarista 2">
                    <p>s1moscs</p>
                </div>
                <!-- Añadir más comentaristas aquí -->
            </div>
        </div>

        <!-- Apartado: Creadores de Contenido -->
        <div class="equipo-apartado">
            <h4>Creadores de Contenido</h4>
            <div class="equipo-lista">
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Creadores de Contenido/Logo-Dmondejarm.png"
                        alt="Creador de Contenido 1">
                    <p>Dmondejarm</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Creadores de Contenido/Logo-MondyXz.jpg"
                        alt="Creador de Contenido 2">
                    <p>MondyXz</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/DefaultProfile.png" alt="Creador de Contenido 3">
                    <p>hdanh_074</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Creadores de Contenido/Logo-S1moscs.png" alt="Creador de Contenido 4">
                    <p>s1moscs</p>
                </div>
                <div class="equipo-card">
                    <img src="Assets/Images/Nuestro Equipo/Creadores de Contenido/Logo-Beeleen.webp" alt="Creador de Contenido 5">
                    <p>Beeleen</p>
                </div>
                <!-- Añadir más creadores de contenido aquí -->
            </div>
        </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer class="footer">
        <p>&copy; 2024 DMD Community - Todos los derechos reservados.</p>
        <div class="social-media">
            <?php foreach ($redes as $row) { ?>
                <a href="<?php echo $row['enlace']; ?>" target="_blank" class="social-link">
                    <img src="<?php echo $row['icono']; ?>" alt="<?php echo $row['nombre']; ?>" class="social-icon">
                </a>
            <?php } ?>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="scripts.js?v=<?php echo time(); ?>"></script>

</body>

</html>