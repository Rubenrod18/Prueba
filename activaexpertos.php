<?php
/*
Aquí se activarán los expertos que están pendiente de activación
*/
include"funciones.php";

$idExpertoActivar = $_GET['idExpertoActivar'];
$db=conectaDB();

/*para actualizar el estado del experto*/
$consulta = "UPDATE Usuarios SET activo=1 WHERE id=:id";
$result=$db->prepare($consulta);
$result->execute(array(":id"=>$idExpertoActivar));

if(!$result){
	return "ha habido un problema en la BD";
}
else{
	//volver a listar a los usuarios inactivos
	$consultaExpertos = "SELECT nick FROM Usuarios WHERE activo=0";
	$resultListar = $db->query($consultaExpertos);
	if($resultListar){
		foreach ($resultListar as $value)
			echo "<li><img id='".$value['id']."' class='close' src='./img/check33.svg'>".$value['nick']."</li>";
	}
}

$db=null;