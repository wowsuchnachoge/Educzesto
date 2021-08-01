<?php  
	// Si no existe el usuario en SESSION
	if(!isset($_SESSION["datosUsuarioActivo"])){
		header("Location: login.php?login=3");
	}
?>