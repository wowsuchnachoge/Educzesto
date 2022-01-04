<?php  

	include("../interactDB.php");
	include("../bitacora.php");
	include("../../includes/cleanText.php");

	$bitacora = new Bitacora();	

	$realizado     = $_POST["realizado"];
	$idBitacora      = $_POST["idBitacora"];

    $bitacora->registroBitacoraRealizado($idBitacora, $realizado);

	$bitacora->cierraBaseDatos();
	header("Location: ../../../herramientasBitacora.php");
?>