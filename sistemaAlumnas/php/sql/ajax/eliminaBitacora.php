<?php  
	include("../interactDB.php");
	include("../bitacora.php");
	include("../../includes/cleanText.php");

	$idBitacora = (int) $_GET["idBitacora"];

	$bitacora = new Bitacora();
	$bitacora->eliminaBitacora($idBitacora);
	$bitacora->cierraBaseDatos();
	
	echo $idBitacora;
?>