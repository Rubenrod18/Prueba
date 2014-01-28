<?php
	/**
	 * @author Jesús Chicano, David Moreno, Rubén Rodríguez
	 */
	 
	function crearHeader(){
		echo "<header>
			<figure>
				<img src='./img/logo.jpg'>
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
		echo "<form>
				<fieldset>
					<legend>Registro de usuario</legend>
						Nombre de usuario*<br/>
						<input type='text' name='nickname' required/>
						<br/>Nombre<br/>
						<input type='text' name='nombre' />
						<br/>Apellidos<br/>
						<input type='text' name='apellidos' />
						<br/>E-mail<br/>
						<input type='email' name='email'>
						<br/>Contraseña*<br/>
						<input type='password' name='password' required/>
						<br/>Confirmar contraseña<br/>
						<input type='password' name='password2' required/>
						<br/>Foto<br/>
						<input type='file' name='foto'/>
						<br/>
						<input type='submit' name='registro' value='Registrar'/>
						<input type='reset' name='limpiar' value='Limpiar'/>
				<fieldset>
		</form>";
		/** ------------------------ HACER LISTA DE CATEGORIAS COMO SELECT */
	}
	
	function crearFooter(){
		echo "<footer id='pie'>
			<div class='fcolumn'>
				<h3>Sobre nosotros</h3>
				<ul>
					<li>Quiénes somos</li>
					<li>Contacto</li>
				</ul>
			</div>
			
			<div class='fcolumn'>
				<h3>Redes sociales</h3>
				<ul>
					<li>Twitter</li>
					<li>Facebook</li>
					<li>Google +</li>
				</ul>
			</div>
			
			<div class='fcolumn'>
				<h3>Términos de uso</h3>
				<ul>
					<li>Poner imagen CC</li>
				</ul>
			</div>
		</footer>";
	}
