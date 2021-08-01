<?php  
	include("../interactDB.php");
	include("../minuta.php");
	include("../../includes/cleanText.php");

	$idAcuerdo = (int) $_GET["idAcuerdo"];

	$minuta = new Minuta();
	$minuta->eliminaAcuerdo($idAcuerdo);
	$minuta->cierraBaseDatos();
	
	echo $idAcuerdo;
?>