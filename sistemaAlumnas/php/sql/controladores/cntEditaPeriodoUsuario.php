<?php  
	include("../interactDB.php");
	include("../usuario.php");
	include("../periodo.php");
	include("../../includes/cleanText.php");

	$usuario = new Usuario();
	$periodo = new Periodo();

	$listaPeriodos = array();
	$idUsuario = (int) $_POST["idUsuario"];
	$accion = (int) $_POST["accion"];

	$idPeriodoActual = $periodo->consultaPeriodoActual();
	$listaPeriodosId = $periodo->consultaListaPeriodoId();

	foreach ($listaPeriodosId as $valor) {
		array_push($listaPeriodos, $valor["idPeriodo"]);
	}

	var_dump($usuario->editaUsuarioPeriodo($idUsuario, $accion, $listaPeriodos));

	$usuario->cierraBaseDatos();
	$periodo->cierraBaseDatos();
	header("Location: ../../../herramientas.php");

?>