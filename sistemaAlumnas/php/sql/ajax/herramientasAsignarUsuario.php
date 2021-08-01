<?php  
	include("../interactDB.php");
	include("../asignacion.php");
	include("../../includes/cleanText.php");

	$idTutor = (int) $_GET["idTutor"];
	$idAlumno = (int) $_GET["idAlumno"];

	$asignacion = new Asignacion();
	$asignacionRegistrada = $asignacion->registroAsignacion($idTutor, $idAlumno);

	if($asignacionRegistrada == 0){
		$asignacion->eliminaAsignacion($idTutor, $idAlumno);
	}

	$asignacion->cierraBaseDatos();

	echo $asignacionRegistrada;
?>