<?php
/*
Aquí se activarán los expertos que están pendiente de activación
*/
include"conexion.php";

$user = $_POST['expertosInactivos'];

$db=conectaDB();
$consulta = "UPDATE Usuarios SET activo=1 WHERE nick=:nick";
$result=$db->prepare($consulta);
$result->execute(array(":nick"=>$user));

if(!$result){
	return "ha habido un problema en la BD";
}
else{
	header("Location: gestion.php");
}

$db=null;