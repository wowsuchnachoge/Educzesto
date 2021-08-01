<?php 

	include("../interactDB.php");
	include("../calendario.php");

	$arregloFilasCalendario = $_POST;

	$calendario = new Calendario();
	$arregloFilasCalendario = $calendario->editaCalendario($arregloFilasCalendario);

	$calendario->cierraBaseDatos();
	header("Location: ../../../herramientasCalendarios.php");
?>