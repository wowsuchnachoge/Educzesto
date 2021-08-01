<?php
	include("php/sql/interactDB.php");
	include("php/sql/material.php");

	$material = new Material();

	// Undefined index: inputNombreArchivo in /home/vlm0dijktjmb/public_html/login/subirArchivo.php on line 7
	$inputNombreArchivo  = $_POST["inputNombreArchivo"];
	// Undefined index: inputSelectorAlumna in /home/vlm0dijktjmb/public_html/login/subirArchivo.php on line 8
	$inputSelectorAlumna = $_POST["inputSelectorAlumna"];
	// Undefined index: inputLink in /home/vlm0dijktjmb/public_html/login/subirArchivo.php on line 9
	$inputLink           = $_POST["inputLink"];
	// Undefined index: idUsuario in /home/vlm0dijktjmb/public_html/login/subirArchivo.php on line 10
	$idUsuario           = $_POST["idUsuario"];
	// Undefined index: tipoUsuario in /home/vlm0dijktjmb/public_html/login/subirArchivo.php on line 11
	$tipoUsuario         = $_POST["tipoUsuario"];

	$directorioActual = getcwd();
	$directorioCargaArchivo = "/archivos/";

	$arregloErrores = [];
	$extensionesArchivoPermitidas = ['pdf'];

	$flagError = 0;
	$flagLink = 0;
	$flagMaterial = 0;

	if(!empty($inputLink)) $flagLink = 1;

	if (!empty($_FILES['archivo']["name"])) {

		// Si existe un problema: hacer drop a la tabla
		$idArchivo = (int) $material->consultaUltimoArchivoAgregadoId();
		$idArchivo +=1;
		$nombreArchivo = (string) $idArchivo.".pdf";
		$flagMaterial = 1;

		$tamanioArchivo = $_FILES['archivo']['size'];
		$fileTmpName  = $_FILES['archivo']['tmp_name'];
		$tipoArchivo = $_FILES['archivo']['type'];
		// Only variables should be passed by reference in /home/vlm0dijktjmb/public_html/login/subirArchivo.php on line 35
		$extensionArchivo = strtolower(end(explode('.',$nombreArchivo)));

		$rutaCargaArchivo = $directorioActual . $directorioCargaArchivo . basename($nombreArchivo); 

		if (! in_array($extensionArchivo,$extensionesArchivoPermitidas)) {
			$arregloErrores[] = "La extensión del archivo no está permitida.Por favor suba un archivo tipo PDF";
		}

		if ($tamanioArchivo > 15000000) {
			$arregloErrores[] = "File exceeds maximum size (15MB)";
		}

		if (empty($arregloErrores)) {
			$didUpload = move_uploaded_file($fileTmpName, $rutaCargaArchivo);

		if ($didUpload) {
			echo "El archivo " . basename($nombreArchivo) . " se cargó exitosamente.";
		} else {
			echo "Ha ocurrido un error. Favor de contactar al administrador.";
		}
		} else {
			foreach ($arregloErrores as $error) {
				echo $error . "Estos son los errores" . " \n";
			}
			$flagError++;
		}
	}

	if(($flagLink == 0)&&($flagMaterial == 0)){
		$material->cierraBaseDatos();
		header("Location: materiales.php");
	}

	if($flagError != 0){
		$material->cierraBaseDatos();
		header("Location: materiales.php");
	}
	
	if($tipoUsuario == 2){

   	$material->registroMaterialNuevo($inputNombreArchivo, $inputSelectorAlumna, $inputMaterial, $inputLink, $idUsuario, 0, $flagLink, $flagMaterial);
	}
	if(($tipoUsuario == 3)||($tipoUsuario == 4)){
		// Undefined variable: inputMaterial in /home/vlm0dijktjmb/public_html/login/subirArchivo.php on line 73
   	$material->registroMaterialNuevo($inputNombreArchivo, $inputSelectorAlumna, $inputMaterial, $inputLink, $idUsuario, 1, $flagLink, $flagMaterial);
	}
	

	$material->cierraBaseDatos();
	header("Location: materiales.php");

?>