<?php	
	session_start();
	include "funciones.php";

	$pregunta = $_GET['pregunta'];
	$categoria = $_GET['categoria'];
	$dificultad = $_GET['dificultad'];

	$dt = new DateTime("NOW");
	$fechaActual = date('Y-m-d H:i:s');

	$db = conectaDb();
	$consulta = "INSERT INTO Preguntas(id, enunciado, idRecurso, idUsuario, dificultad, idRespuesta, fcreacion, fmodificacion) 
				VALUES(NULL, :enunciado, NULL, '" . $_SESSION['id'] . "', '" . $dificultad . "', '". $_SESSION['respuestaCo'] . "', '" . $fechaActual . "', '" . $fechaActual . "')";
	$result=$db->prepare($consulta);
	$result->execute(array(":enunciado"=>$pregunta));

	if($result){
		$consulta = "INSERT INTO RPC(idPregunta, idCategoria) VALUES((SELECT id FROM Preguntas WHERE enunciado='" . $pregunta . "'), (SELECT id FROM Categorias WHERE nombre='" . $categoria . "'))";
		$result=$db->query($consulta);
	}else{
		echo "ERROR";
	}

?>