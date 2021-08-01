<?php  
	echo '<pre>'; print_r($_POST); echo '</pre>';
	include("../interactDB.php");
	include("../usuario.php");
	include("../../includes/cleanText.php");

	$usuario = new Usuario();

	$inputNombre     			= ucwords(clean_text($_POST["inputNombre"]));
	$inputApellidoPaterno   = ucfirst(clean_text($_POST["inputApellidoPaterno"]));
	$inputApellidoMaterno   = ucfirst(clean_text($_POST["inputApellidoMaterno"]));
	$inputFechaNacimiento   = clean_text($_POST["inputFechaNacimiento"]);
	$generoUsuario     		= clean_text($_POST["generoUsuario"]);
	$inputEmail     			= clean_text($_POST["inputEmail"]);
	$inputPhone    	 		= clean_text($_POST["inputPhone"]);
	$inputContacto    	 	= clean_text($_POST["inputContacto"]);
	$idUsuario    	 			= clean_text($_POST["idUsuario"]);
	$tituloArchivo    	 	= clean_text($_POST["tituloArchivo"]);

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
	
	$inputUsuario = strtolower($inputNombre[0].substr($inputApellidoPaterno, 0));

	// Declina el nombre de usuario repetido
	if($usuario->consultaUsuarioDuplicado($inputUsuario, $idUsuario) == 0){

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

		$usuario->editaDatosUsuarioAlumno($arregloDatos, $idUsuario);
	}

	$usuario->cierraBaseDatos();
	header("Location: ../../../".$tituloArchivo."?idUsuario=".$idUsuario);
?>
