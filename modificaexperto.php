<?php
	session_start();
	include "funciones.php";
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$foto = $_POST['editfoto'];

	function actualizarFotoPerfil($nick){
		$directorio="./img/uploads/";

		//añadir el nombre original con la extensión
		$directorio= $directorio . basename($_FILES['editfoto']['name']);

		if(move_uploaded_file($_FILES['editfoto']['tmp_name'], $directorio)) {
			$db=conectaDB();
			$consulta = "UPDATE Usuarios SET foto=:foto WHERE nick='".$nick."' ";
			$result=$db->prepare($consulta);
			$result->execute(array(":foto"=>$directorio));
			$db = null;
			$_SESSION['fotoedit'] = $directorio;
			header("Location: gestion.php");
		}
	}

	$consulta = "UPDATE Usuarios SET ";

	$ejecutar = array();

	if($nombre != ""){
		$consulta .= "nombre=:nombre, ";
		$_SESSION['nombre'] = $nombre;
		$ejecutar[":nombre"] = $nombre;
	}
	if($apellidos != ""){
		$consulta .= "apellidos=:apellidos, ";
		$_SESSION['apellidos'] = $apellidos;
		$ejecutar[":apellidos"] = $apellidos;
	}
	if($email != ""){
		$consulta .= "email=:email, ";
		$_SESSION['email'] = $email;
		$ejecutar[":email"] = $email;
	}
	if($pass != ""){
		$consulta .= "pass=:pass, ";
		$_SESSION['pass'] = $pass;
		$ejecutar[":pass"] = $pass;
	}

	$consulta .= "WHERE nick='" . $_SESSION['user'] . "';";

	// uso las siguientes 3 líneas para quitar la última coma (",") de la consulta 
	$search = ',';
	$replace = '';
	$consulta = strrev(implode(strrev($replace), explode($search, strrev($consulta), 2)));
	$db=conectaDB();
	$result=$db->prepare($consulta);
	$result->execute($ejecutar);

	if($result){
		actualizarFotoPerfil($_SESSION['user']);
		echo "<ul>
				<li><strong>" . $_SESSION['user'] . "</strong></li>
				<li>" . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . "</li>
				<li>" . $_SESSION['email'] . "</li>
				<li>Perfil: " . $_SESSION['perfil'] . "</li>
			</ul>";
	}

	$db=null;