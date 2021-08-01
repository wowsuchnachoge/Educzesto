<?php 
	include("../interactDB.php");
	include("../minuta.php");
	include("../periodo.php");

	$minuta = new Minuta();
	$periodo = new Periodo();

	if(isset($_POST["idMinutaUp"])){

		$idMinuta = $_POST["idMinutaUp"];
		$accion = 1;
	}

	if(isset($_POST["idMinutaDown"])){
		
		$idMinuta = $_POST["idMinutaDown"];
		$accion = 0;
	}


	$idPeriodoActual = $periodo->consultaPeriodoActual();
	$listaPeriodosId = $periodo->consultaListaPeriodoId();

	$listaPeriodos = array();

	foreach ($listaPeriodosId as $valor) {
		array_push($listaPeriodos, $valor["idPeriodo"]);
	}

	var_dump($minuta->editaMinutaPeriodo($idMinuta, $accion, $listaPeriodos));

	$minuta->cierraBaseDatos();
	$periodo->cierraBaseDatos();
	header("Location: ../../../minutas.php");
?>