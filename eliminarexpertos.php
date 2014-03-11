<?php
	include "funciones.php";

	$id = $_GET['id'];

	$db = conectaDb();
	$consulta = "DELETE FROM Usuarios WHERE id=".$id."";
	$result = $db->query($consulta);

	if($result){
		$consulta2 = "SELECT * FROM Usuarios WHERE perfil='experto'";
		$result2 = $db->query($consulta2);

		if($result2){
			foreach($result2 as $value){
				echo "<li><img id='" . $value['id'] . "' class='close' src='./img/close.png'>" . $value['nick'] . "</li>";
			}
		}
	}

	$db=null;
?>
<script type="text/javascript">
//¡¡¡¡PROBLEMON: HAY QUE HACER UNA SEGUNDA LLAMADA A LA OPERACIÓN PORQUE SINO SOLO FUNCIONA UNA VEZ!!
	$('#eliminarExpertos .close').click(function(){
		$.get("eliminarexpertos.php", {id : $(this).prop('id')}, function(respuesta){
			$("#eliminarExpertos ul").html(respuesta);
		});

		$.get("activaexpertos.php", {id : $(this).prop('id')}, function(respuesta){
			$("#activarExpertos ul").html(respuesta);
		});
	});
</script>