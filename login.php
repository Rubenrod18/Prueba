<?php
/*
aquí se procesarán los datos del usuario que intenta entrar en la web
*/

//iniciarlizar sesión
session_start();
//importaciones de ficheros
include("conexion.php");

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
if(!$result){
	echo "No es un usuario/contraseña correctos";
}else{
	foreach ($result as $value) {
		echo $value["nick"];
	}
}

//cerrar la conexión
$db=null;
?>