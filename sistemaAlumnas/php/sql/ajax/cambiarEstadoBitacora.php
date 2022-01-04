<?php  
	include("../interactDB.php");
	include("../bitacora.php");
	include("../../includes/cleanText.php");

	$idBitacora = (int) $_GET["idBitacora"];
	$estado = (int) $_GET["estadoBitacora"];
	if ($estado == 0) {
		$estado = 1;
	} else {
		$estado = 0;
	}

	$bitacora = new Bitacora();	
	$bitacora->cambiarEstadoBitacoraAlumnos($estado, $idBitacora);
	$bitacora->cierraBaseDatos();
	
	echo $estado;
?>