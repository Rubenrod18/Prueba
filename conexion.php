<?php
function conectaDb()
{
	try{
<<<<<<< HEAD
		$db = new PDO("mysql:host=localhost;dbname=SabioGC", "usuarios", "us_161213");
		$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
=======
		$db = new PDO("mysql:host=localhost;dbname=SabioGC", "root", "root");
>>>>>>> 36f9dd9b89f14f469c0fba2f3fe49dd19f99aa5d
		return($db);
	}catch(PDOException $e){
		echo "No se ha podido conectar a la BD";
	}
}
?>
