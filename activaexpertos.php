<?php
	include "funciones.php";

	$id = $_GET['id'];

	$db = conectaDb();
	$consulta = "UPDATE Usuarios SET activo='1' WHERE id=".$id."";
	$result = $db->query($consulta);

	if($result){
		$consulta2 = "SELECT * FROM Usuarios WHERE activo=0 AND perfil='experto'";
		$result2 = $db->query($consulta2);

		if($result2){
			foreach($result2 as $value){
				echo "<li>" . $value['nick'] . "<a id='" . $value['id'] . "' class='icon-tick'></a></li>";
			}
		}
	}

	$db=null;

?>
<script type="text/javascript">
	//¡¡¡¡PROBLEMON: HAY QUE HACER UNA SEGUNDA LLAMADA A LA OPERACIÓN PORQUE SINO SOLO FUNCIONA UNA VEZ!!
	$('#activarExpertos .icon-tick').click(function(){
		$.get("activaexpertos.php", {id : $(this).prop('id')}, function(respuesta){
			$("#activarExpertos ul").html(respuesta);
		});
	});
</script>