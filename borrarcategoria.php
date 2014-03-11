<?php
	include "funciones.php";
	$idcategoria = $_GET['idcategoria'];

	$db = conectaDb();

	$consulta = "DELETE FROM Categorias WHERE id=" . $idcategoria;
	$resultdelete=$db->query($consulta);

	if($resultdelete){
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