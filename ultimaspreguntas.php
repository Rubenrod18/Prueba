<?php
	include "funciones.php";

	$db = conectaDb();

	$consulta = "SELECT * FROM Preguntas";
	$result = $db->query($consulta);

	if($result){

		foreach ($result as $value) {
			echo "<div class='divPregunta'>
				<h4>" . $value['enunciado'] . "</h4>
				<ul>
					<li></li>
				</ul>
			</div>";
		}

	}