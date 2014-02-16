<?php
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['perfil']);
	unset($_SESSION['nombre']);
	unset($_SESSION['apellidos']);
	unset($_SESSION['email']);
	unset($_SESSION['foto']);
	session_destroy();
	header("Location: index.php");
