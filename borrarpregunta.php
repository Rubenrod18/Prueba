<?php
	include "funciones.php";
	$idpregunta = $_GET['idpregunta'];

	$db = conectaDb();

	$consulta = "DELETE FROM Preguntas WHERE id=" . $idpregunta;
	$resultdelete=$db->query($consulta);

	if($resultdelete){
		$preguntas = "select id, enunciado from Preguntas";
		$resultadoPreguntas = $db->query($preguntas);

		foreach($resultadoPreguntas as $value){
			echo "<li><a id='". $value['id'] ."' class='close2'><img src='./img/close.png' class='close'></a>" . $value['enunciado'] . "</li>";
		}
	}

	$db = null;
?>
<script type="text/javascript">
	$('.close2').click(function(){
		$.get("borrarpregunta.php", {idpregunta : $(this).prop('id')}, function(respuesta){
			$("#listaPre").html(respuesta);
		});
	});
</script>