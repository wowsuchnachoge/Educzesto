<?php 
	include("../interactDB.php");
	include("../minuta.php");

	$idMinuta = (int) $_POST["idMinuta"];
	$minuta = new Minuta();

	$minuta->eliminaAcuerdosMinuta($idMinuta);
	$minuta->eliminaMinuta($idMinuta);

	$minuta->cierraBaseDatos();
	header("Location: ../../../minutas.php");
?>