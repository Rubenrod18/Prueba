<?php
	/*
	aquí se procesarán los datos del usuario que intenta entrar en la web
	*/

	//iniciarlizar sesión
	session_start();
	//importaciones de ficheros
	include("funciones.php");
	
	$results = 0;

	//recoger datos del formulario de login
	$user = $_POST["user"];
	$pass = $_POST["pass"];

	//conexión
	$db = conectaDb();
	//consulta para verificar usuario
	$consulta = "SELECT * FROM Usuarios WHERE nick=:nick AND pass=:pass";
	$result = $db->prepare($consulta);
	$result->execute(array(":nick" => $user, ":pass" => $pass));
	//la respuesta
	if($result){
		foreach ($result as $value) {
			$_SESSION['id'] = $value['id'];
			$_SESSION['user'] = $value['nick'];
			$_SESSION['perfil'] = $value['perfil'];
			$_SESSION['nombre'] = $value['nombre'];
			$_SESSION['apellidos'] = $value['apellidos'];
			$_SESSION['email'] = $value['email'];
			$_SESSION['foto'] = $value['foto'];
			$_SESSION['activo'] = $value['activo'];
			$results++;
		}
	}else{
		echo "Error al conectar con la base de datos";
	}

	if($results < 1){
		header('Location: index.php?err=1');
	}else{
		header('Location: gestion.php');
	}

	//cerrar la conexión
	$db=null;
?>
