<?php 
	include("../interactDB.php");

	// var_dump($_POST);
	$baseDatos = new InteractDB();
	$inptTipoUsuario = $_POST["inptTipoUsuario"];

	// ** Validar si existe el usuario antes de agregarlo

	$baseDatos->agregaPeriodo();
	$baseDatos->consultaUltimoPeriodo();

	// Alumno
	if($inptTipoUsuario == 1){

		$inptNombre          = $_POST["inptNombre"];
		$inptApellidoPaterno = $_POST["inptApellidoPaterno"];
		$inptApellidoMaterno = $_POST["inptApellidoMaterno"];
		$inptFechaNacimiento = $_POST["inptFechaNacimiento"];
		$generoUsuario       = $_POST["generoUsuario"];
		$inptEmail           = $_POST["inptEmail"];
		$inptTel             = $_POST["inptTel"];
		$inptContacto        = $_POST["inptContacto"];

		$inptTrabAct         = $_POST["inptTrabAct"];
		$inptZonaTrab        = $_POST["inptZonaTrab"];
		$inptNvlEstd         = $_POST["inptNvlEstd"];
		$inptNvlEstdDiag     = $_POST["inptNvlEstdDiag"];
		$inptMotiv           = $_POST["inptMotiv"];
		$inptInter           = $_POST["inptInter"];
		$inptIncnt           = $_POST["inptIncnt"];
		$inptNivelCom        = $_POST["inptNivelCom"];
		$inptNivelCon        = $_POST["inptNivelCon"];
		$inptSelPers         = $_POST["inptSelPers"]; //{ [0]=> string(1) "1" [1]=> string(1) "2" [2]=> string(1) "3"}
		$inptNotas           = $_POST["inptNotas"];

		$baseDatos->agregarAlumnos();
	}

	// Tutor
	if($inptTipoUsuario == 2){

		$inptNombre          = ucfirst(strtolower(clean_text($_POST["inptNombre"])));
		$inptApellidoPaterno = ucfirst(strtolower(clean_text($_POST["inptApellidoPaterno"])));
		$inptApellidoMaterno = ucfirst(strtolower(clean_text($_POST["inptApellidoMaterno"])));
		$inptFechaNacimiento = $_POST["inptFechaNacimiento"];
		$generoUsuario       = $_POST["generoUsuario"];
		$inptEmail           = strtolower(clean_text($_POST["inptEmail"]));
		$inptTel             = clean_text($_POST["inptTel"]);
		$inptContacto        = strtolower(clean_text($_POST["inptContacto"]));

		$baseDatos->agregarTutores($inptNombre, $inptApellidoPaterno, $inptApellidoMaterno, $inptFechaNacimiento, $generoUsuario, $inptEmail, $inptTel, $inptContacto);
	}

	$baseDatos->cierraDB();
	header("Location: ../../index.php?login=1");

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