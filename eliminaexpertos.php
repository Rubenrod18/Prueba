<?php
/*
aquí se eliminarán los expertos que el administrador elija
*/
include "conexion.php";

$user = $_POST['todosexpertos'];

$db=conectaDB();

/*saca la imagen para borrarla*/
$sacaimagen = "SELECT foto FROM Usuarios WHERE nick=:nick";
$imagen = $db->prepare($sacaimagen);
$imagen->execute(array(":nick"=>$user));//corresponderá a la ruta
foreach ($imagen as $value) {
	//si existe en el directorio
	if(is_readable($value['foto'])){
		unlink($value['foto']);
	}
}



$consulta = "DELETE FROM Usuarios WHERE nick=:nick";
$result=$db->prepare($consulta);
$result->execute(array(":nick"=>$user));

if(!$result){
	return "ha habido un problema en la BD";
}
else{
	header("Location: gestion.php");
}

$db=null;