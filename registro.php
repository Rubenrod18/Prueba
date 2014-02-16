<?php
	include "funciones.php";
	include "conexion.php";

	function lanzarRegistro(){
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
			$consulta="INSERT INTO Usuarios (id,nombre,apellidos,email,nick,pass,perfil,activo) values(NULL, :nombre, :apellidos, :email, :nick, :pass1,
			'experto',
			0)";
			$result=$db->prepare($consulta);
			$result->execute(array(":nombre"=>$datos['nombre'], ":apellidos"=>$datos['apellidos'], ":email"=>$datos['email'], ":nick"=>$datos['nick'], ":pass1"=>$datos['pass1']));
			
			if($result){
				guardarFotoPerfil($datos["nick"]);
				echo "<h3>Se ha registrado correctamente. Por favor póngase en contacto con el administrador para recibir permisos de edición.</h3>";
			}else{
				echo "<h3 class='error'>Error: No ha podido registrarse. Revise los datos.".print_r($db->errorInfo())."</h3><a class='boton' href='registro.php' target='_self'>Volver</a>";
			}
			//cierre
			$db=null;
		}else{
			echo "<h3 class='error'>Las contraseñas deben coincidir</h3><a class='boton' href='registro.php' target='_self'>Volver</a>";
		}
	}
	
	function guardarFotoPerfil($nick){
		$directorio="./img/uploads/";

		//añadir el nombre original con la extensión
		$directorio=$directorio.basename($_FILES['foto']['name']);

		if(move_uploaded_file($_FILES['foto']['tmp_name'], $directorio)) {
			$db=conectaDb();
			$consulta = "UPDATE Usuarios SET 'foto' = '".$directorio."' WHERE 'nick'='".$nick."'";
			$result=$db->prepare($consulta);
			$result->execute();
			$db=null;
		}else{
			echo "Hubo un error al subir la imagen, por favor inténtelo de nuevo.";
		}
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
			if(!isset($_POST["registro"])){
				crearFormularioRegistro();
			}else{
				lanzarRegistro();
			}
			echo "</div>";
			crearFooter();
		?>
	</body>
</html>
