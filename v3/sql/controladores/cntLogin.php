<?php  
	include("../interactDB.php");

	$baseDatos = new InteractDB();

	$inptUser     = clean_text($_POST["inptUser"]);
	$inptPassword = clean_text($_POST["inptPassword"]);
	$flagRes = $baseDatos->consultaLogin($inptUser, $inptPassword);

	if(($flagRes == 1)&&($baseDatos->vistaUsuario == 1)){

		session_start();
    	$_SESSION["idUsuario"] = $baseDatos->idUsuario;

		header("Location: ../../inicio.php");
	}
	else{
		header("Location: ../../index.php?login=2");
	}

	$baseDatos->cierraDB();
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