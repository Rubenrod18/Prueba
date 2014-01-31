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
		<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
		<link rel='stylesheet' type='text/css' href='./css/styles.css'>
	</head>
	<body>
		<?php
			crearHeader();
			echo "<div id='wrapper'>";
				crearFormularioRegistro();
			echo "</div>";
			crearFooter();
		?>
	</body>
</html>
