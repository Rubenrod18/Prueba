<?php
	include "funciones.php";

	$db = conectaDb();

	$consulta = "SELECT * FROM Preguntas ORDER BY fcreacion DESC LIMIT 5";
	$result = $db->query($consulta);

	if($result){
		foreach ($result as $value) {
			$consultaV = "SELECT * FROM Respuestas WHERE id='" . $value['idRespuesta'] . "'";
			$resultV = $db->query($consultaV);
			if($resultV){
				foreach ($resultV as $valueV) {
					echo "<div class='divPregunta'>
						<h4>" . $value['enunciado'] . " <strong>(" . $value['fcreacion'] . ")</strong></h4>
						<ul>
							<li class='respV'>" . $valueV['texto'] . "</li>";
							$consultaRPRF = "SELECT * FROM RPRF WHERE idPregunta='" . $value['id'] . "'";
							$resultRPRF = $db->query($consultaRPRF);
							if($resultRPRF){
								foreach ($resultRPRF as $valueRPRF) {
									$consultaF = "SELECT * FROM Respuestas WHERE id='" . $valueRPRF['idRespuesta'] . "'";
									$resultF = $db->query($consultaF);
									if($resultF){
										foreach ($resultF as $valueF) {
											echo "<li>" . $valueF['texto'] . "</li>";
										}
									}
								}
							}
						echo "</ul>
					</div>";
				}	
			}
		}

	}

	$db = null;