<?php
	session_start();
	include "funciones.php";

	$respuestaCo = $_GET['respuestaCo'];

	$dt = new DateTime("NOW");
	$fechaActual = date('Y-m-d H:i:s');

	$db = conectaDb();
	$consulta = "INSERT INTO Respuestas(id, texto, idRecurso, fcreacion, fmodificacion) 
				VALUES(NULL, :texto, NULL, '" . $fechaActual . "', '" . $fechaActual . "')";
	$result=$db->prepare($consulta);
	$result->execute(array(":texto"=>$respuestaCo));

	if($result){
		$consulta = "SELECT * FROM Respuestas WHERE texto='" . $respuestaCo . "'";
		$result = $db->query($consulta);

		if($result){
			foreach ($result as $value) {
				$_SESSION['respuestaCo'] = $value['id'];
				echo "Respuesta introducida correctamente idRespuesta: " . $_SESSION['respuestaCo'];
			}
		}
	}

?>