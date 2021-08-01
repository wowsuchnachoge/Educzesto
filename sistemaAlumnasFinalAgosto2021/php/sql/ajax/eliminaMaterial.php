<?php  
	include("../interactDB.php");
	include("../material.php");

	$idMaterial = (int) $_GET["idMaterial"];

	$material = new Material();

	$material->eliminaMaterial($idMaterial);
	$material->cierraBaseDatos();
	
	echo $idMaterial;
?>