<?php  
	include("../interactDB.php");
	include("../minuta.php");
	include("../../includes/cleanText.php");

	$idAcuerdo = (int) $_GET["idAcuerdo"];
	$estado = (int) $_GET["estadoAcuerdo"];
	if ($estado == 0) {
		$estado = 1;
	} else {
		$estado = 0;
	}

	$minuta = new Minuta();	
	$minuta->cambiarEstadoAcuerdo($estado, $idAcuerdo);
	$minuta->cierraBaseDatos();
	
	echo $estado;
?>