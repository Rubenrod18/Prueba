<?php
	/**
	 * @author Jesús Chicano, David Moreno, Rubén Rodríguez
	 */
	 
	function crearHeader(){
		echo "<header>
			<figure>
				<a href='index.php'><img src='./img/logo.jpg'></a>
			</figure>
			<h1>Sabio GC</h1>
		</header>";
	}
	
	function crearFormLogin(){
		echo "<div>
			<form id='formLogin' class='formulario' action='login.php' method='post'>
				<input type='text' name='user' placeholder='Usuario' required><br/>
				<input type='password' name='pass' placeholder='Contraseña' required>
				
				<div id='btnLogin'>
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
