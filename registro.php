<?php
	include "funciones.php";
?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Sabio GC - base de conocimiento</title>
		<link rel="shortcut icon" href="./img/favicon.ico" />
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
