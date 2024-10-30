<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Carousel / Slider con Glider.js</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div class="contenedor">
		<main class="contenido-principal">
			<img src="img/1.png" alt="Dome of the German Bundestag" class="contenido-principal__imagen">
			<div class="contenido-principal__contenedor">
				<h1 class="contenido-principal__titulo">Dome of the German Bundestag</h1>
				<p class="contenido-principal__resumen">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras a commodo orci. Nulla ipsum ante, auctor a odio id, bibendum accumsan mauris.
				</p>
				<p class="contenido-principal__resumen">
					Fusce malesuada mollis ante, at elementum mi maximus nec. Praesent volutpat, tortor sed condimentum sagittis, mi diam fringilla nibh.
				</p>
			</div>
		</main>

		<div class="carousel">
			<div class="carousel__contenedor">
				<button aria-label="Anterior" class="carousel__anterior">
					<i class="fas fa-chevron-left"></i>
				</button>

				<div class="carousel__lista">
					<div class="carousel__elemento">
						<img src="img/2.png" alt="Rock and Roll Hall of Fame">
						<p>Rock and Roll Hall of Fame</p>
					</div>
					<div class="carousel__elemento">
						<img src="img/3.png" alt="Constitution Square - Tower I">
						<p>Constitution Square - Tower I</p>
					</div>
					<div class="carousel__elemento">
						<img src="img/4.png" alt="Empire State Building">
						<p>Empire State Building</p>
					</div>
					<div class="carousel__elemento">
						<img src="img/5.png" alt="Harmony Tower">
						<p>Harmony Tower</p>
					</div>
	
					<div class="carousel__elemento">
						<img src="img/6.png" alt="Empire State Building">
						<p>Empire State Building</p>
					</div>
					<div class="carousel__elemento">
						<img src="img/7.png" alt="Harmony Tower">
						<p>Harmony Tower</p>
					</div>
					<div class="carousel__elemento">
						<img src="img/8.png" alt="Empire State Building">
						<p>Empire State Building</p>
					</div>
					<div class="carousel__elemento">
						<img src="img/9.png" alt="Harmony Tower">
						<p>Harmony Tower</p>
					</div>
				</div>

				<button aria-label="Siguiente" class="carousel__siguiente">
					<i class="fas fa-chevron-right"></i>
				</button>
			</div>

			<div role="tablist" class="carousel__indicadores"></div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="js/app.js"></script>
</body>
</html>