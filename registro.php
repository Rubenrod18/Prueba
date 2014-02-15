<?php
	include "funciones.php";
	include "conexion.php";

	$datos = array(
		"nick"=>$_POST["nickname"],
		"nombre"=>$_POST["nombre"],
		"apellidos"=>$_POST["apellidos"],
		"email"=>$_POST["email"],
		"pass1"=>$_POST["password"],
		"pass2"=>$_POST["password2"],
		"foto"=>$_POST["foto"]
		);

	if(strcmp($datos["pass1"],$datos["pass2"])==0 && $datos["nick"]!=null && $datos["pass1"]!=null){
		$db=conectaDb();
		//lanzar consulta
		$consulta="INSERT INTO Usuarios (id,foto,nombre,apellidos,email,nick,pass,perfil) values(NULL, 
			'".$datos['foto']."','".
			$datos['nombre']."','".
			$datos['apellidos']."','".
			$datos['email']."','".
			$datos['nick']."','".
			$datos['pass1']."',
			'experto')";
		$result=$db->prepare($consulta);
		$result->execute();

		//cierre
		$db=null;
	}else{
		echo "Las contraseñas deben coincidir";
	}
	
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
