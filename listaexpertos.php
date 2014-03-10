<?php
/*
Aquí se listarán los expertos que están pendiente de activación
*/
include"funciones.php";

$db=conectaDB();


$consulta = "SELECT nick FROM Usuarios WHERE id=0";
$result=$db->query($consulta);

if(!$result){
	return "ha habido un problema en la BD";
}
else{
	foreach ($result as $value)
		echo "<li><img id='".$value['id']."' class='close' src='./img/check33.svg'>".$value['nick']."</li>";
}

$db=null;