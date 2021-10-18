<?php  

	include("../interactDB.php");
	include("../minuta.php");
	include("../../includes/cleanText.php");

	$minuta = new Minuta();	

	$inputContenidoAcuerdo 	= ucfirst(clean_text($_POST["inputContenidoAcuerdo"]));
	$realizado     = $_POST["realizado"];
	$idMinuta      = $_POST["idAcuerdo"];

    $minuta->registroAcuerdoRealizado($idAcuerdo, $realizado);

	$minuta->cierraBaseDatos();
	header("Location: ../../../minutas.php");
?>