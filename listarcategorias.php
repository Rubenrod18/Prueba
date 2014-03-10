<?php
	include "funciones.php";

	$db = conectaDb();

	$consulta = "SELECT * FROM Categorias";
	$result=$db->query($consulta);

	if($result){
		foreach($result as $categoria){
			echo "<option>" . $categoria['nombre'] . "</option>";
		}	
	}

	$db = null;