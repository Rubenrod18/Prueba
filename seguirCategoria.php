<?php
/**
* ARCHIVO NUEVO
*/
	session_start();
	include "funciones.php";
	$idcategoria = $_GET['value'];

	$db = conectaDb();

	$consulta = "insert into RCU (idCategoria,idUsuario) values ('".$idcategoria."','".$_SESSION['id']."')";
	$resultdelete = $db->query($consulta);

	$categorias = "select c.nombre as nombre
					from Categorias c, Usuarios u, RCU
					where c.id = RCU.idCategoria
					and u.id = RCU.idUsuario
					and u.id = '" . $_SESSION['id'] . "' ";
	$resultCateg = $db->query($categorias);

	foreach($resultCateg as $categoria){
		echo "<li>" . $categoria['nombre'] . "</li>";
	}			

	$db = null;
?>
<script type="text/javascript">
	$('#categoria_seguir').on('click', function(){
		$.get("seguirCategoria.php", {value : $(this).prop('value')}, function(respuesta){
			$("#mostrarCategorias").html(respuesta);
		});
	});
</script>	