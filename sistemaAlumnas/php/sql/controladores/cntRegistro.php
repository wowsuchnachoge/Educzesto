<?php  	
	include("../interactDB.php");
	include("../usuario.php");
	include("../periodo.php");
	include("../../includes/cleanText.php");

	$usuario = new Usuario();
	$periodo = new Periodo();

	// Genera un periodo nuevo en caso de que no exista
	$fechaActual = (int) date("m");

	if($fechaActual < 6) $nombrePeriodo = "PRI-".date("Y");
	else $nombrePeriodo = "OTO-".date("Y");

	if($periodo->buscaPeriodoNombre($nombrePeriodo) == 0){
		$periodo->generaPeriodo($nombrePeriodo);
	}

	// Verifica si ya existe el usuario por agregar
	$inputUsuario = strtolower($_POST["inputNombre"][0].substr($_POST["inputApellidoPaterno"], 0));
	if($usuario->consultaUsuarioDuplicado($inputUsuario, 0) == 1){

		$usuario->cierraBaseDatos();
		$periodo->cierraBaseDatos();
		header("Location: ../../../login.php?login=2");
	} 

	$idPeriodoActual = $periodo->consultaPeriodoActual();

	if($_POST["inputTipoUsuario"] == 1){

		$inputSelectorPersonalidadFormato = "";

		$inputNombre                   = ucwords(clean_text($_POST["inputNombre"]));
		$inputApellidoPaterno          = ucfirst(clean_text($_POST["inputApellidoPaterno"]));
		$inputApellidoMaterno          = ucfirst(clean_text($_POST["inputApellidoMaterno"]));
		$inputFechaNacimiento          = clean_text($_POST["inputFechaNacimiento"]);
		$generoUsuario                 = clean_text($_POST["generoUsuario"]);
		$inputEmail                    = clean_text($_POST["inputEmail"]);
		$inputPhone                    = clean_text($_POST["inputPhone"]);
		$inputContacto                 = clean_text($_POST["inputContacto"]);

		$inputTrabajoActual            = clean_text($_POST["inputTrabajoActual"]);
		$inputZonaTrabajo              = ucwords(clean_text($_POST["inputZonaTrabajo"]));
		$inputNivelEstudios            = clean_text($_POST["inputNivelEstudios"]);
		$inputNivelEstudiosDiagnostico = clean_text($_POST["inputNivelEstudiosDiagnostico"]);
		$inputMotivo                   = ucfirst(clean_text($_POST["inputMotivo"]));
		$inputIntereses                = ucfirst(clean_text($_POST["inputIntereses"]));
		$inputIncentivos               = ucfirst(clean_text($_POST["inputIncentivos"]));
		$inputNivelComunication        = clean_text($_POST["inputNivelComunication"]);
		$inputNivelConciencia          = clean_text($_POST["inputNivelConciencia"]);
		$inputSelectorPersonalidad     = $_POST["inputSelectorPersonalidad"];
		$inputNotas                    = ucfirst(clean_text($_POST["inputNotas"]));

		for($i = 0; $i < sizeof($inputSelectorPersonalidad); $i++){

			$inputSelectorPersonalidadFormato .= $inputSelectorPersonalidad[$i]; 
			if($i != sizeof($inputSelectorPersonalidad)-1) $inputSelectorPersonalidadFormato .= ","; 
		}
		
		$arregloDatos = array(	"inputNombre" => $inputNombre,
										"inputApellidoPaterno" => $inputApellidoPaterno,
										"inputApellidoMaterno" => $inputApellidoMaterno,
										"inputFechaNacimiento" => $inputFechaNacimiento,
										"generoUsuario" => $generoUsuario,
										"inputEmail" => $inputEmail,
										"inputPhone" => $inputPhone,
										"inputContacto" => $inputContacto,
										"inputTrabajoActual" => $inputTrabajoActual,
										"inputZonaTrabajo" => $inputZonaTrabajo,
										"inputNivelEstudios" => $inputNivelEstudios,
										"inputNivelEstudiosDiagnostico" => $inputNivelEstudiosDiagnostico,
										"inputMotivo" => $inputMotivo,
										"inputIntereses" => $inputIntereses,
										"inputIncentivos" => $inputIncentivos,
										"inputNivelComunication" => $inputNivelComunication,
										"inputNivelConciencia" => $inputNivelConciencia,
										"inputSelectorPersonalidad" => $inputSelectorPersonalidadFormato,
										"inputNotas" => $inputNotas);

		$usuario->registroUsuarioAlumno($arregloDatos, 1);
	}
	if($_POST["inputTipoUsuario"] == 2){
		
		$inputNombre                   = ucwords(clean_text($_POST["inputNombre"]));
		$inputApellidoPaterno          = ucfirst(clean_text($_POST["inputApellidoPaterno"]));
		$inputApellidoMaterno          = ucfirst(clean_text($_POST["inputApellidoMaterno"]));
		$inputFechaNacimiento          = clean_text($_POST["inputFechaNacimiento"]);
		$generoUsuario                 = clean_text($_POST["generoUsuario"]);
		$inputEmail                    = clean_text($_POST["inputEmail"]);
		$inputPhone                    = clean_text($_POST["inputPhone"]);
		$inputContacto                 = clean_text($_POST["inputContacto"]);

		$arregloDatos = array(	"inputNombre" => $inputNombre,
										"inputApellidoPaterno" => $inputApellidoPaterno,
										"inputApellidoMaterno" => $inputApellidoMaterno,
										"inputFechaNacimiento" => $inputFechaNacimiento,
										"generoUsuario" => $generoUsuario,
										"inputEmail" => $inputEmail,
										"inputPhone" => $inputPhone,
										"inputContacto" => $inputContacto);

		$usuario->registroUsuarioTutor($arregloDatos, $idPeriodoActual);
	}

	$usuario->cierraBaseDatos();
	$periodo->cierraBaseDatos();
	header("Location: ../../../login.php?login=1");
?>