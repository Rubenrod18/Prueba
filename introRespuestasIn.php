<?php
	session_start();
	include "funciones.php";

	$respuestasIn = $_GET['respuestasIn'];

	$dt = new DateTime("NOW");
	$fechaActual = date('Y-m-d H:i:s');

	$db = conectaDb();

	for($i = 0; $i < sizeof($respuestasIn); $i++){
		$consulta = "INSERT INTO Respuestas(id, texto, idRecurso, fcreacion, fmodificacion) 
					VALUES(NULL, :texto, NULL, '" . $fechaActual . "', '" . $fechaActual . "')";
		$result=$db->prepare($consulta);
		$result->execute(array(":texto"=>$respuestasIn[$i]));

		if($result){
			$consulta = "INSERT INTO RPRF(idPregunta, idRespuesta) VALUES((SELECT MAX(id) FROM Preguntas), (SELECT id FROM Respuestas WHERE texto='" . $respuestasIn[$i] . "'))";

			$result = $db->query($consulta);
		}
	}

?>