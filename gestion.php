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
		<link rel='stylesheet' type='text/css' href='./css/jquery-ui-custom.css'>
		<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js"></script>
		<script type="text/javascript" src="./js/jquery-ui-custom.js"></script>
		<script type="text/javascript" src="./js/implement.js"></script>
	</head>
	<body>
		<?php
			crearHeader();
			echo "<div id='wrapper'>";
				crearContenedorPerfil();
				crearTabs();
			echo "</div>"; 
			crearFooter();
		?>
	</body>
</html>
