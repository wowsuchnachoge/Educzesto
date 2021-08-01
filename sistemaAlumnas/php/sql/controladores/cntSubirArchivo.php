<?php  
	include("../interactDB.php");
	include("../material.php");

	$material = new Material();

	$inputNombreArchivo  = $_POST["inputNombreArchivo"];
	$inputSelectorAlumna = $_POST["inputSelectorAlumna"];
	echo '<pre>'; print_r($inputSelectorAlumna); echo '</pre>';
	$archivo       		= $_POST["archivo"];
	$inputLink           = $_POST["inputLink"];
	$idUsuario           = $_POST["idUsuario"];

	$material->registroMaterialNuevo($inputNombreArchivo, $inputSelectorAlumna, $inputMaterial, $inputLink, $idUsuario);
	$material->cierraBaseDatos();

	header("Location: ../../../materiales.php");
?>