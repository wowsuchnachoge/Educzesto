<?php  
	include("../interactDB.php");
	include("../bitacoraAlumnos.php");
	include("../../includes/cleanText.php");

	$idUsuario = (int) $_POST["idUsuario"];
	$inputContenidoBitacora = clean_text($_POST["inputContenidoBitacora"]);
	$fechaActual = date("Y-m-d");

	$bitacora = new Bitacora();
	$bitacora->registroBitacora($idUsuario, $inputContenidoBitacora, $fechaActual);
	$bitacora->cierraBaseDatos();

	header("Location: ../../../bitacoraAlumnos.php");
?>