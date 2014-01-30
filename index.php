<?php
	include "funciones.php";
?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Sabio GC - base de conocimiento</title>
		<link rel="shortcut icon" href="./img/favicon.ico" />
		<link rel='stylesheet' type='text/css' href='./css/normalize.css'>
		<link rel='stylesheet' type='text/css' href='./css/simple.css'>
		<link rel='stylesheet' type='text/css' href='./css/styles.css'>
		<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js"></script>
		<script type='text/javascript' src='./js/jquery.pikachoose.js'></script>
		<script type='text/javascript'>
			$(document).ready(function(){
				$('#pikame').PikaChoose({
					transition:[3]
				});
			});
		</script>
	</head>
	<body>
		<?php
			crearHeader();
			echo "<div id='wrapper'>";
				echo "<div id='presentacion'>";
					crearFormLogin();
					echo "
					<h3 id=tparrafo>¿De qué se trata?</h3>
					<p>
						Base de conocimiento del I.E.S. Gran Capitán de Córdoba (España).<br/>
						Esta aplicación alberga una gran cantidad de preguntas con sus respectivas respuestas
						para el uso del profesorado y alumnado del centro.
					</p>
				</div>";
				crearSlider();
			echo "</div>";
			crearFooter();
		?>
	</body>
</html>
