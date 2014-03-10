<?php
/*
aquí se eliminarán los expertos que el administrador elija
*/
include "funciones.php";

$idExpertoBorrar = $_GET['idExpertoBorrar'];
$db=conectaDB();

/*saca la imagen para borrarla*/
$sacaimagen = "SELECT foto FROM Usuarios WHERE id=:id";
$imagen = $db->prepare($sacaimagen);
$imagen->execute(array(":id"=>$idExpertoBorrar));//corresponderá a la ruta
foreach ($imagen as $value) {
	//si existe en el directorio
	if(is_readable($value['foto'])){
		unlink($value['foto']);
	}
}



$consulta = "DELETE FROM Usuarios WHERE id=:id";
$result=$db->prepare($consulta);
$result->execute(array(":id"=>$idExpertoBorrar));

if(!$result){
	return "Ha habido un problema en la BD";
}
else{
	$consultaExpertos = "SELECT nick FROM Usuarios WHERE perfil='experto'";
	$resultListar = $db->query($consultaExpertos);
	if($resultListar){
		foreach ($resultListar as $value)
			echo "<li><img id='".$value['id']."' class='close' src='./img/close.png'>".$value['nick']."</li>";
	}

}

$db=null;
