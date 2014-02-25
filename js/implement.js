$(function(){
	$('#tabs').tabs();

	$('#newCateg').click(function(e){
		e.preventDefault();
		$.get("bdcategorias.php", {nombre : $('#categoria').val()}, function(respuesta){
			$("#listaCateg").html(respuesta);
		});
	});

	$('.close').click(function(){
		$.get("borrarcategoria.php", {idcategoria : $(this).prop('id')}, function(respuesta){
			$("#listaCateg").html(respuesta);
		});
	});
});	
