<?php  

	include("../interactDB.php");

	$baseDatos = new InteractDB();

	if(isset($_POST["idMinutaCrear"])){

		$inptFechaMinuta = $_POST["inptFechaMinuta"];
		$baseDatos->crearMinuta($inptFechaMinuta);
		header("Location: ../../minutas.php");
	}

	if(isset($_POST["idMinutaCargar"])){

		$idMinuta = $_REQUEST["inptFechaBusqueda"];

		// $baseDatos->cargarMinuta($_REQUEST["inptFechaBusqueda"], $_REQUEST["inptPeriodoBusqueda"]);
		header("Location: ../../minutas.php?idMinuta=$idMinuta");
	}

	if(isset($_POST["idMinutaBorrar"])){
		
		$idMinutaBorrar = $_POST["idMinutaBorrar"];
		$baseDatos->borrarMinuta($idMinutaBorrar);
		header("Location: ../../minutas.php");
	}


	if(isset($_POST["actDesgloseMinuta"])){
		
		$idMinuta = $_REQUEST["idMinutaDesglose"];
		$txtdesgloseMinuta = $_REQUEST["txtdesgloseMinuta"];
		$baseDatos->actualizaDesgloseMinuta($idMinuta, $txtdesgloseMinuta);
		header("Location: ../../minutas.php?idMinuta=$idMinuta");
	}

	if(isset($_POST["idMinutaAcuerdoCrear"])){

		$idMinuta = $_REQUEST["idMinutaAcuerdoCrear"];
		$baseDatos->creaAcuerdoMinuta($idMinuta);
		header("Location: ../../minutas.php?idMinuta=$idMinuta");
	}

	if(isset($_POST["idAcuerdoAct"])){

		$idAcuerdo = $_REQUEST["idAcuerdoAct"];
		$idMin = $_REQUEST["idMin"];

		$contenidoAcuerdo	    = $_REQUEST["contenidoAcuerdo"];
		$responsableAcuerdo	 = $_REQUEST["responsableAcuerdo"];
		$fechasLimiteAcuerdo	 = $_REQUEST["fechaLimiteAcuerdo"];

		$baseDatos->actualizaAcuerdo($contenidoAcuerdo, $responsableAcuerdo, $fechasLimiteAcuerdo, $idAcuerdo);

		header("Location: ../../minutas.php?idMinuta=$idMin");
	}

	if(isset($_POST["idAcuerdoBorrar"])){

		$idAcuerdo = $_REQUEST["idAcuerdoBorrar"];
		$idMin = $_REQUEST["idMin"];

		$baseDatos->borrarAcuerdo($idAcuerdo);
		header("Location: ../../minutas.php?idMinuta=$idMin");
	}

?>