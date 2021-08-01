<?php  
	include("../interactDB.php");
	include("../documento.php");

	$idDocumento = (int) $_GET["idDocumento"];

	$documento = new Documento();

	$documento->eliminaDocumento($idDocumento);
	$documento->cierraBaseDatos();
	
	echo $idDocumento;
?>