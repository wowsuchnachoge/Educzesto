<?php  
	include("../interactDB.php");
	include("../minuta.php");
	include("../periodo.php");

	$minuta = new Minuta();
	$periodo = new Periodo();

	$inputFechaNuevaMinuta = $_POST["inputFechaNuevaMinuta"];
	$idPeriodoActual = $periodo->consultaPeriodoActual();
	$minuta->registroMinutaNueva($inputFechaNuevaMinuta, $idPeriodoActual);

	$minuta->cierraBaseDatos();
	$periodo->cierraBaseDatos();

	header("Location: ../../../minutas.php");
?>