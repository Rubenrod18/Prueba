<?php
	/**
	 * @author Jesús Chicano, David Moreno, Rubén Rodríguez
	 */
	 
	function conectaDb()
	{
		try{
			$db = new PDO("mysql:host=localhost;dbname=SabioGC", "usuarios", "us_161213");
			return($db);
		}catch(PDOException $e){
			echo "No se ha podido conectar a la BD";
		}
	} 
	 
	function crearHeader(){
		echo "<header id='cabecera'>
			<figure>
				<a href='cerrarsesion.php'><img src='./img/logo.jpg'></a>
			</figure>
			<h1>Sabio GC</h1>
		</header>";
	}
	
	function crearFormLogin(){
		echo "<div>
			<form id='formLogin' class='formulario' action='login.php' method='post'>
				<input type='text' name='user' placeholder='Usuario' required><br/>
				<input type='password' name='pass' placeholder='Contraseña' required>
				";
				
				if($_GET['err'] == 1){
					echo "<br/><span id='errorlogin'>Usuario o contraseña incorrectos</span>";
				}
				
				echo "<div id='btnLogin'>
					<input class='botones' type='submit' name='login' value='Acceder'>
					<a href='registro.php'>Regístrate</a>
				</div>
			</form>
		</div>";
	}
	
	function crearFormularioRegistro(){
		echo "<form action='registro.php' method='post' enctype='multipart/form-data'>
				<fieldset id='fieldRegistro'>
					<legend>Registro de usuario</legend>
					<div class='rcolumn'>
						<label for='nickname'>Nombre de usuario*</label><br/>
						<input type='text' name='nickname' id='nickname' required/>
						<br/><label for='nombre'>Nombre</label><br/>
						<input type='text' name='nombre' id='nombre' />
						<br/><label for='apellidos'>Apellidos</label><br/>
						<input type='text' name='apellidos' id='apellidos' />
						<br/><label for='email'>E-mail</label><br/>
						<input type='email' name='email' id='email'>
					<div class='rcolumn'>	
						<label for='password'>Contraseña*</label><br/>
						<input type='password' name='password' id='password' required/>
						<br/><label for='password2'>Confirmar contraseña</label><br/>
						<input type='password' name='password2' id='password2' required/>
						<br/><label for='foto'>Foto</label><br/>
						<input type='file' name='foto'/>
						<br/>
						<input type='submit' name='registro' value='Registrar'/>
						<input type='reset' name='limpiar' value='Limpiar'/>
					</div>
				</fieldset>
		</form>";
		/** ------------------------ HACER LISTA DE CATEGORIAS COMO SELECT */
	}
	
	function crearSlider(){
		echo "<div class='pikachoose'>
				<ul id='pikame' >
					<li><img src='img/gcap01.jpg'/></li>
					<li><img src='img/gcap03.jpg'/></li>
					<li><img src='img/blogcapitan.jpg'/></li>
				</ul>
			</div>";
	}
	
	function crearContenedorPerfil(){
		echo "<div id='contenedorPerfil'>
			<h2>Perfil</h2>
			<figure id='fotoperfil'>
				<img src='" . $_SESSION['foto'] . "'></img>
			</figure>
			<div id='datosperfil'>
				<ul>
					<li><strong>Nombre de usuario:</strong> " . $_SESSION['user'] . "</li>
					<li><strong>Nombre:</strong><br/> " . $_SESSION['nombre'] . "</li>
					<li><strong>Apellidos:</strong> " . $_SESSION['apellidos'] . "</li>
					<li><strong>E-mail:</strong> " . $_SESSION['email'] . "</li>
					<li><strong>Perfil:</strong> " . $_SESSION['perfil'] . "</li>
				</ul>
			</div>
			<div id='categperfil'>
				<h3>Categorías</h3>
				<ul>";
					if( $_SESSION['activo'] == 1 ){
						$db = conectaDb();
						// Sacamos las consulta para la categoria asociada al usuario
						$consultaCategoria = 'select idCategoria from RCU where idUsuario = '.$_SESSION['id'];
						$resultadoCategorias = $db->query($consultaCategoria);

						foreach($resultadoCategorias as $value){
							$id = $value['idCategoria']; // Obtengo la categoria
							// Muestro el nombre de la categoria a través de su ID
							$consultaNombreCategoria = "select nombre from Categorias where id = $id";
							$resultadoNombreCategorias = $db->query($consultaNombreCategoria);
							foreach($resultadoNombreCategorias as $value){
								echo "<li>" . $value['nombre'] . "</li>";
							}
						}
					}

		echo "</ul>
			</div>
		</div>";
		
	}

	function editarUsuario(){
		echo "<form enctype='multipart/form-data'>
				<h4>¿Quiere modificar algún dato?</h4>
					<br/><label for='nombre'>Nombre</label><br/>
					<input type='text' name='nombre' id='nombre' />
					<br/><label for='apellidos'>Apellidos</label><br/>
					<input type='text' name='apellidos' id='apellidos' />
					<br/><label for='email'>E-mail</label><br/>
					<input type='email' name='email' id='email'><br/>
					<label for='password'>Contraseña*</label><br/>
					<input type='password' name='password' id='password' required/>
					<br/><label for='password2'>Confirmar contraseña</label><br/>
					<input type='password' name='password2' id='password2' required/>
					<br/><label for='foto'>Foto</label><br/>
					<input type='file' name='foto'/>
					<br/>
					<button id='confirmod' class='botones'>Confirmar</button>
		</form>";
		/** ------------------------ HACER LISTA DE CATEGORIAS COMO SELECT */
	}

	function guardarFotoPerfil($nick){
		$directorio="./img/uploads/";

		//añadir el nombre original con la extensión
		$directorio=$directorio.basename($_FILES['foto']['name']);

		if(move_uploaded_file($_FILES['foto']['tmp_name'], $directorio)) {
			$db=conectaDb();
			$consulta = "update Usuarios set foto = '".$directorio."' where nick='".$nick."' ";
			$result=$db->prepare($consulta);
			$result->execute();
			$db=null;
		}else{
			echo "Hubo un error al subir la imagen, por favor inténtelo de nuevo.";
		}
	}

	function agregarPregunta(){
		echo "<div id='introPregunta'>
			<form method='post' id='formPregunta'>
				<div id='divPregunta'>
					<h4>
						Pregunta
					</h4>
					<input type='text' id='pregunta' name='pregunta' placeholder='Escribir la pregunta'>
					<div id='divcateg'>
						<h4>
							Categoría
						</h4>
						<select id='selectCategoria' class='select'>
						</select>
					</div>
					<div id='divdificultad'>
						<h4>
							Dificultad
						</h4>
						<select id='selectDificultad' class='select'>
							<option>Facil</option>
							<option>Intermedio</option>
							<option>Dificil</option>
						</select>
					</div>
				</div>
				<div id='divBotonesRespuesta'>
					<h4>
						Respuestas
					</h4>
					<button id='btnIn' class='botones'>Agregar incorrecta</button>
					<button id='btnCo' class='botones'>Agregar correcta</button>
				</div>
				<div id='divRespuestaIncorrecta'>
					<input type='text' id='respuestaIn' name='respuestaIn' placeholder='Respuesta incorrecta'><a id='tickIn' class='icon-tick'></a>
				</div>
				<div id='divRespuestaCorrecta'>
					<input type='text' id='respuestaCo' name='respuestaCo' placeholder='Respuesta correcta'><a id='tickCo' class='icon-tick'></a>
					<span id='resCoCreada'></span>
				</div>
				<input type='button' class='botones' value='Agregar respuestas' id='btnPregRes' name='btnPregRes'>
				<input type='button' class='botones' value='Hecho' id='btnHecho' name='btnPregRes'>
			</form>
		</div>";
	}
	
	function crearTabs(){
		$db = conectaDb();
		echo "<div id='tabs'>";
		if($_SESSION['perfil'] == 'experto'){
			$activo = 1;

			$consultaActivo = "SELECT * FROM Usuarios WHERE nick='" . $_SESSION['user'] . "'";
			$resultActivo = $db->query($consultaActivo);
			if($resultActivo){
				foreach($resultActivo as $value){
					$activo = $value['activo'];
				}
			}else{
				echo "No se ha podido conectar con la base de datos.";
			}
			
			if(!$activo){
				echo "<h3>
					Su registro está pendiente de validación por un administrador, disculpe las molestias.
				</h3>";
			}else{
				echo "<ul>
					<li><a class='ultPreg' href='#tabs-1'>Últimas preguntas</a></li>
					<li class='agrPregunta'><a href='#tabs-2'>Agregar pregunta</a></li>
					<li><a href='#tabs-3'>Perfil</a></li>
					</ul>
					<div id='tabs-1'>
						
					</div>
					<div id='tabs-2'>";
						agregarPregunta();
					echo "</div>
					<div id='tabs-3'>";
						editarUsuario();
					echo "</div>";
			}
		}else{
			echo "<ul>
					<li><a class='ultPreg' href='#tabs-1'>Últimas preguntas</a></li>
					<li class='agrPregunta'><a href='#tabs-2'>Agregar pregunta</a></li>
					<li><a href='#tabs-3'>Gestión preguntas</a></li>
					<li><a href='#tabs-4'>Gestión expertos</a></li>
					<li><a href='#tabs-5'>Gestión categorías</a></li>
					<li><a href='#tabs-6'>Perfil</a></li>
					</ul>
					<div id='tabs-1'>
						
					</div>
					<div id='tabs-2'>";
						agregarPregunta();
					echo "</div>
					<div id='tabs-3'>
					<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
						<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
					</div>
					<div id='tabs-4'>
						<fieldset>
							<legend>Expertos pendientes activación</legend>
							<form name='Factivacion' method='POST' action='activaexpertos.php'>
								<div>
									<label>Expertos: </label>
									<select class='botones' name='expertosInactivos'>";
										$consultaExpertosInact = "SELECT nick FROM Usuarios WHERE activo=0 and perfil='experto'";
										$resultExpertosInact = $db->query($consultaExpertosInact);
										foreach ($resultExpertosInact as $value)
											echo "<option>".$value['nick']."</option>";
									echo "</select>
								</div>
								<input class='botones' type='submit' value='Activar' >
							</form>
						</fieldset>
						<fieldset>
							<legend>Eliminar expertos</legend>
							<form name='Feliminacion' method='POST' action='eliminaexpertos.php'>
								<div>
									<label>Expertos: </label>
									<select class='botones' name='todosexpertos'>";
										$consultaExpertos = "SELECT nick FROM Usuarios WHERE perfil='experto'";
										$resultExpertos = $db->query($consultaExpertos);
										foreach ($resultExpertos as $value)
											echo "<option>".$value['nick']."</option>";
									echo "</select>
								</div>
								<input class='botones' type='submit' value='Eliminar' >
							</form>
						</fieldset>
					</div>
					<div id='tabs-5'>";
						$categorias = "SELECT * FROM Categorias";
						$resultCateg = $db->query($categorias);

					echo "<div id='contentListaCateg'>
							<header><h4>Categorías</h4></header>
							<ul id='listaCateg'>";
								if($resultCateg){
									foreach($resultCateg as $categoria){
										echo "<li>" . $categoria['nombre'] . "<img id='" . $categoria['id'] . "' class='close' src='./img/close.png'></li>";
									}
								}
						$db = null;		
						echo "</ul>
						</div>
						<div id='contentCreaCateg'>
							<form id='creaCateg'>
								<label for='categoria'><h4>Crear nueva</h4></label><br/>
								<input id='categoria' placeholder='Nombre de la categoría' type='text'><br/>
								<button class='botones' id='newCateg'>Crear</button>
							</form>
						</div>
					</div>
					<div id='tabs-6'>";
						editarUsuario();
					echo"</div>";
		}
			
		echo "</div>";
	}
	
	function crearFooter(){
		echo "<footer id='pie'>
			<div class='fcolumn'>
				<h3>Sobre nosotros</h3>
				<ul>
					<li><a href=''>Quiénes somos</a></li>
					<li><a href=''>Contacto</a></li>
				</ul>
			</div>
			
			<div class='fcolumn'>
				<h3>Redes sociales</h3>
				<ul>
					<li><a href=''>Twitter</a></li>
					<li><a href=''>Facebook</a></li>
					<li><a href=''>Google +</a></li>
				</ul>
			</div>
			
			<div class='fcolumn'>
				<h3>Términos de uso</h3>
				<ul>
					<li><a href=''>Poner imagen CC</a></li>
				</ul>
			</div>
		</footer>";
	}
