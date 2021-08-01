<?php 
	include("php/sql/interactDB.php");
	include("php/sql/documento.php");

	$documento = new Documento();

	$inputSelectorDocumento = $_POST["inputSelectorDocumento"];
	$idUsuario              = $_POST["idUsuario"];
	$tituloArchivo          = $_POST["tituloArchivo"];

	$directorioActual = getcwd();
	$directorioCargaArchivo = "/documentos/";

	$arregloErrores = [];
	$extensionesArchivoPermitidas = ['pdf'];

	$flagError = 0;

	if (!empty($_FILES['archivo']["name"])) {

		// Si existe un problema: hacer drop a la tabla
		$idDocumento = (int) $documento->consultaUltimoDocumentoAgregadoId();
		$idDocumento +=1;
		$nombreArchivo = (string) $idDocumento.".pdf";

		$tamanioArchivo = $_FILES['archivo']['size'];
		$fileTmpName  = $_FILES['archivo']['tmp_name'];
		$tipoArchivo = $_FILES['archivo']['type'];
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

	if((!empty($_FILES['archivo']["name"]))&&($flagError == 0)){
		$documento->registroDocumentoNuevo($inputSelectorDocumento, $idUsuario);
	}

	$documento->cierraBaseDatos();
	header("Location: documentos.php?tituloArchivo=".$tituloArchivo);
?>

