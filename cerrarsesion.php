<?php
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['user']);
	unset($_SESSION['perfil']);
	unset($_SESSION['nombre']);
	unset($_SESSION['apellidos']);
	unset($_SESSION['email']);
	unset($_SESSION['foto']);
	unset($_SESSION['fotoedit']);
	unset($_SESSION['respuestaCo']);
	session_destroy();
	header("Location: index.php");
