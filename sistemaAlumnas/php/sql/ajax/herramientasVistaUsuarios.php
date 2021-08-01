<?php  
	include("../interactDB.php");
	include("../usuario.php");
	include("../../includes/cleanText.php");

	$idUsuario = (int) $_GET["idUsuario"];

	$usuario = new Usuario();
	$vistaUsuario = (int) $usuario->editaVistaUsuario($idUsuario);
	$usuario->cierraBaseDatos();

	echo $vistaUsuario;
?>