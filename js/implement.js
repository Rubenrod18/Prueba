$(function(){
	respuestasIn = []; // array donde guardar respuestas incorrectas para asociarlas a la pregunta que se esté creando

	$('#tabs').tabs();// crear menú de pestañas

	/**
	* Petición AJAX para crear nuevas categorias
	*/
	$('#newCateg').click(function(e){
		e.preventDefault();
		$.get("bdcategorias.php", {nombre : $('#categoria').val()}, function(respuesta){
			$("#listaCateg").html(respuesta);
		});
	});

	$('.agrPregunta').on('click', function(){
		$.get("listarcategorias.php", function(respuesta){
			$("#selectCategoria").html(respuesta);
		});
	});

	/**
	* Petición AJAX para eliminar categorías
	*/
	$('.close').click(function(){
		$.get("borrarcategoria.php", {idcategoria : $(this).prop('id')}, function(respuesta){
			$("#listaCateg").html(respuesta);
		});
	});
	
	$('#confirmod').click(function(e){
		var editfoto = $('#editfoto').val();
		/*editfoto = editfoto.split('\\');
		editfoto = editfoto[editfoto.length-1];*/

		if(editfoto == ''){
			e.preventDefault();
			var correcto = true;
			var nombre = $('#editnombre').val();
			var apellidos = $('#editapellidos').val();
			var email = $('#editemail').val();

			if($('#editpassword2').val() != $('#editpassword').val()){
				alert("Las contraseñas deben coincidir");
				correcto = false;
			}else{
				var pass = $('#editpassword').val();
			}

			if(correcto){
				$.post("modificaexperto.php", {nombre : nombre, apellidos : apellidos, email : email, pass : pass}, function(respuesta){
					$("#datosperfil").html(respuesta);
				});
			}
		}
	});

	$('#btnPregRes').on('click', function(e){
		e.preventDefault();
		var pregunta = $('#pregunta').val();

		if(pregunta != ''){
			$('#divBotonesRespuesta').show('slow');
			$(this).css('display', 'none');
			$('#btnHecho').css('display', 'block');
		}else{
			alert('Debe escribir la pregunta');
		}
	});

	$('#btnIn').on('click', function(e){
		e.preventDefault();
		$('#divRespuestaCorrecta').hide('slow', function(){
			$('#divRespuestaIncorrecta').show('slow');
		});
	});

	$('#btnCo').on('click', function(e){
		e.preventDefault();
		$('#divRespuestaIncorrecta').hide('slow', function(){
			$('#divRespuestaCorrecta').show('slow');
		});
	});

	$('#tickCo').on('click', function(){
		var respuestaCo = $('#respuestaCo').val();

		if(respuestaCo != ''){
			$('#btnCo').hide('slow');
			$('#divRespuestaCorrecta').hide('slow');
		}
	});

	$('#tickIn').on('click', function(){
		var respuesta = $('#respuestaIn').val();
		if(respuesta != ''){
			respuestasIn.push(respuesta);
			$('#divRespuestaIncorrecta').hide('slow', function(){
				$('#respuestaIn').val('');
				$(this).show('slow');
			});
		}
	});

	$('#btnHecho').on('click', function(e){
		e.preventDefault();
		var pregunta = $('#pregunta').val();
		var respuestaCo = $('#respuestaCo').val();
		var categoria = $('#selectCategoria').val();
		var dificultad = $('#selectDificultad').val();
		var alerta = '';

		if(pregunta != '' && respuestaCo!= ''){
			$.get("introRespuestaCo.php", {respuestaCo : respuestaCo}, function(){
				$.get("introPregunta.php", {pregunta : pregunta, categoria : categoria, dificultad : dificultad}, function(){
					$.get("introRespuestasIn.php", {respuestasIn : respuestasIn}, function(){
						respuestasIn = [];
					});
				});
			});
			$('#formPregunta').hide('slow').show('slow');
			$('#pregunta').val('');
			$('#respuestaCo').val('');
			$('#btnCo').show('fast');
		}
		if(pregunta == ''){
			alerta += '-Debe escribir la pregunta\n';
		}
		if(respuestaCo == ''){
			alerta += '-Debe agregar al menos la respuesta correcta de la pregunta';
		}
		if(pregunta == '' || respuestaCo == ''){
			alert(alerta);
		}
	});

	$('.ultPreg').on('click', function(e){
		$.get("ultimaspreguntas.php", function(respuesta){
			$("#tabs-1").html(respuesta);
		});
	});
});	
