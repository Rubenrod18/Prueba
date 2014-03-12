<?php
	/**
	 * @author Jesús Chicano, David Moreno, Rubén Rodríguez
	 */
	 
	function conectaDb()
	{
		$params = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		try{
			$db = new PDO("mysql:host=localhost;dbname=SabioGC", "usuarios", "us_161213", $params);
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
		echo "<form id='formReg' action='registro.php' method='post' enctype='multipart/form-data'>
					<h3 id='tformReg'>Registro</h3>
					<div id='divformReg'>
						<div id='divReg1'>
							<label for='nickname'><h5>Nombre de usuario*</h5></label>
							<input type='text' name='nickname' id='nickname' required/>
							<label for='nombre'><h5>Nombre</h5></label>
							<input type='text' name='nombre' id='nombre'/>
							<label for='apellidos'><h5>Apellidos</h5></label>
							<input type='text' name='apellidos' id='apellidos' />
							<label for='email'><h5>E-mail</h5></label>
							<input type='email' name='email' id='email'>
						</div>
						<div id='divReg2'>
							<label for='password'><h5>Contraseña*</h5></label>
							<input type='password' name='password' id='password' required/>
							<label for='password2'><h5>Confirmar contraseña</h5></label>
							<input type='password' name='password2' id='password2' required/>
							<label for='foto'><h5>Foto</h5></label>
							<input type='file' name='foto'/>
							<input class='botones' type='submit' name='registro' value='Registrar'/>
							<input class='botones' type='reset' name='limpiar' value='Limpiar'/>
						</div>
					</div>
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
					<li><strong>" . $_SESSION['user'] . "</strong></li>
					<li>" . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . "</li>
					<li>" . $_SESSION['email'] . "</li>
					<li>Perfil: " . $_SESSION['perfil'] . "</li>
				</ul>
			</div>
			<div id='categperfil'>
				<h3>Categorías</h3>
				<ul id='mostrarCategorias'>";
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
				 // AQUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
                echo "</ul>";
                mostrarCategorias();
                echo "<br/><a id='enlaceCerrar' href='cerrarsesion.php'>Cerrar sesión</a>";
            echo "</div>
            
        </div>";
            // ----------------------------------------------------------------
    }
 
    // AQUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
    function mostrarCategorias(){
 
        $db = conectaDb();
        // Sacamos las consulta para la categoria asociada al usuario
        $consultaCategoria = 'select id,nombre from Categorias';
        $resultadoCategorias = $db->query($consultaCategoria);
 
        echo '¿Eres experto en alguna de estas materias?<select class="select" id="categoria_seguir">';
        foreach($resultadoCategorias as $value){
            echo "<option value='" . $value['id'] . "'>" . $value['nombre'] . "</option>";
        }
        echo '</select>';
 
    }
    // ----------------------------------------

	function editarUsuario(){
		echo "<form id='formedituser' name='formedituser' enctype='multipart/form-data' method='post' action='modificaexperto.php'>
				<h4>¿Quiere modificar algún dato?</h4>
					<br/><label for='nombre'>Nombre</label><br/>
					<input type='text' name='nombre' id='editnombre' />
					<br/><label for='apellidos'>Apellidos</label><br/>
					<input type='text' name='apellidos' id='editapellidos' />
					<br/><label for='email'>E-mail</label><br/>
					<input type='email' name='email' id='editemail'><br/>
					<label for='password'>Contraseña*</label><br/>
					<input type='password' name='password' id='editpassword'/>
					<br/><label for='password2'>Confirmar contraseña</label><br/>
					<input type='password' name='password2' id='editpassword2'/>
					<br/><label for='editfoto'>Foto</label><br/>
					<input id='editfoto' type='file' name='editfoto'/>
					<br/>
					<input type='submit' id='confirmod' class='botones' value='Confirmar'>
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
					<ul id='listIn'></ul>
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

	function gestionExpertos(){
		$db = conectaDb();
		
		//recoger los expertos inactivos
		$expertosInactivos = "SELECT * FROM Usuarios WHERE activo=0 AND perfil='experto'";
		$resultExpertos = $db->query($expertosInactivos);
		
		//recoger los expertos para eliminarlos
		$expertosEliminar = "SELECT * FROM Usuarios WHERE perfil='experto'";
		$resultExpertos2 = $db->query($expertosEliminar);

		echo "<div id='activarExpertos'>
				<h4>Expertos pendientes activación</h4>
				<ul>";
				if($resultExpertos){
					foreach ($resultExpertos as $value) {
						echo "<li>" . $value['nick'] . "<a id='" . $value['id'] . "' class='icon-tick'></a></li>";
					}
				}
				echo "</ul>
			</div>
			<div id='eliminarExpertos'>
				<h4>Expertos a eliminar</h4>
				<ul>";
				if($resultExpertos2){
					foreach ($resultExpertos2 as $value) {
						echo "<li><img id='" . $value['id'] . "' class='close' src='./img/close.png'>" . $value['nick'] . "</li>";
					}
				}
			echo "</ul>
			</div>";
	}

	function mostrarUltimas(){
		$db = conectaDb();

		$consulta = "SELECT * FROM Preguntas ORDER BY fcreacion DESC LIMIT 5";
		$result = $db->query($consulta);

		if($result){
			foreach ($result as $value) {
				$consultaV = "SELECT * FROM Respuestas WHERE id='" . $value['idRespuesta'] . "'";
				$resultV = $db->query($consultaV);
				if($resultV){
					foreach ($resultV as $valueV) {
						echo "<div class='divPregunta'>
							<h4>" . $value['enunciado'] . " <strong>(" . $value['fcreacion'] . ")</strong></h4>
							<ul>
								<li class='respV'>" . $valueV['texto'] . "</li>";
								$consultaRPRF = "SELECT * FROM RPRF WHERE idPregunta='" . $value['id'] . "'";
								$resultRPRF = $db->query($consultaRPRF);
								if($resultRPRF){
									foreach ($resultRPRF as $valueRPRF) {
										$consultaF = "SELECT * FROM Respuestas WHERE id='" . $valueRPRF['idRespuesta'] . "'";
										$resultF = $db->query($consultaF);
										if($resultF){
											foreach ($resultF as $valueF) {
												echo "<li>" . $valueF['texto'] . "</li>";
											}
										}
									}
								}
							echo "</ul>
						</div>";
					}	
				}
			}

		}

		$db = null;
	}

	function gestionPregunta(){
		echo "<h4>Preguntas</h4>";

		//if( $_SESSION['activo'] == 1 ){
			$db = conectaDb();
			// Sacamos las consulta para las preguntas
			$consultaPreguntas = 'select id, enunciado from Preguntas';
			$resultadoPreguntas = $db->query($consultaPreguntas);
			echo '<ul id="listaPre">';
			foreach($resultadoPreguntas as $value){
				echo "<li><a id='". $value['id'] ."' class='close2'><img src='./img/close.png' class='close'></a>" . $value['enunciado'] . "</li>";
			}
			echo '</ul>';
			
		//}
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
						<h4>Búsqueda filtrada</h4>
					<input type='text' placeholder='Búsqueda por enunciado' id='buscaenunciado'>
					<div id='preguntas'>";
						mostrarUltimas();
					echo "</div></div>
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
					<h4>Búsqueda filtrada</h4>
					<input type='text' placeholder='Búsqueda por enunciado' id='buscaenunciado'>";
					$db = conectaDb();
					// Sacamos las consulta para las preguntas
					$consultaCateg = 'select * from Categorias';
					$resultadoCateg = $db->query($consultaCateg);
					echo "<select class='select' id='filtroCateg'>";
					foreach($resultadoCateg as $value){
						echo "<option>" . $value['nombre'] . "</option>";
					}
					echo "</select>
					<div id='preguntas'>";
						mostrarUltimas();
					echo "</div></div>
					<div id='tabs-2'>";
						agregarPregunta();
					echo "</div>
					<div id='tabs-3'>";
						gestionPregunta();
					echo "</div>
					<div id='tabs-4'>";
						gestionExpertos();
					echo "</div>
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
