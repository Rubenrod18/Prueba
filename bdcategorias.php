<?php
	include "funciones.php";
	$nombre = $_GET['nombre'];

	$db = conectaDb();

	$consulta = "INSERT INTO Categorias(id, nombre) VALUES(NULL, :nombre)";
	$result=$db->prepare($consulta);
	$result->execute(array(":nombre"=>$nombre));

	if($result){
		$categorias = "SELECT * FROM Categorias";
		$resultCateg = $db->query($categorias);

		if($resultCateg){
			foreach($resultCateg as $categoria){
				echo "<li>" . $categoria['nombre'] . "<img id='" . $categoria['id'] . "' class='close' src='./img/close.png'></li>";
			}
		}	
			
	}

	$db = null;
?>

<script type="text/javascript">
	$('.close').click(function(){
		$.get("borrarcategoria.php", {idcategoria : $(this).prop('id')}, function(respuesta){
			$("#listaCateg").html(respuesta);
		});
	});
</script>	