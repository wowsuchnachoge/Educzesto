<?php  

	include("../interactDB.php");

	$baseDatos = new InteractDB();

	$inptNombre     			= clean_text($_POST["inptNombre"]);
	$inptApellidoPaterno    = clean_text($_POST["inptApellidoPaterno"]);
	$inptApellidoMaterno    = clean_text($_POST["inptApellidoMaterno"]);
	$inptFechaNacimiento    = clean_text($_POST["inptFechaNacimiento"]);
	$generoUsuario     		= clean_text($_POST["generoUsuario"]);
	$inptEmail     			= clean_text($_POST["inptEmail"]);
	$inptTel    	 			= clean_text($_POST["inptTel"]);
	$idUsuario    	 			= clean_text($_POST["id"]);

	$flagRes = $baseDatos->actualizaDatosUsr($inptNombre, $inptApellidoPaterno, $inptApellidoMaterno, $inptFechaNacimiento, $generoUsuario, $inptEmail, $inptTel, $idUsuario);

	$baseDatos->cierraDB();

	header("Location: ../../inicio.php");
	/* Limpia los caracteres con acentos para DB
	–––––––––––––––––––––––––––––––––––––––––––––––––*/
	function clean_text($string){
		$string = trim($string);

		$string = str_replace(
		  array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		  array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		  $string
		);

		$string = str_replace(
		  array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		  array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		  $string
		);

		$string = str_replace(
		  array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		  array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		  $string
		);

		$string = str_replace(
		  array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		  array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		  $string
		);

		$string = str_replace(
		  array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		  array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		  $string
		);

		$string = str_replace(
		  array('ñ', 'Ñ', 'ç', 'Ç'),
		  array('n', 'N', 'c', 'C',),
		  $string
		);

		return $string;
	}

?>