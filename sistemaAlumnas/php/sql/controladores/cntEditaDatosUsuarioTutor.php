<?php session_start();?>
<?php  
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
	$idUsuario    	 			= clean_text($_POST["idUsuario"]);
	$tituloArchivo    	 	= clean_text($_POST["tituloArchivo"]);

	// Declina el cambio en nombre de usuario
	if(empty($inputNombre)) $inputNombre = $_SESSION["datosUsuarioActivo"]["nombre"];
	if(empty($inputApellidoPaterno)) $inputApellidoPaterno = $_SESSION["datosUsuarioActivo"]["apellidoPaterno"];

	$inputUsuario = strtolower($inputNombre[0].substr($inputApellidoPaterno, 0));

	if($usuario->consultaUsuarioDuplicado($inputUsuario, $idUsuario) == 0){

		$arregloDatos = array(	"inputNombre" => $inputNombre,
										"inputApellidoPaterno" => $inputApellidoPaterno,
										"inputApellidoMaterno" => $inputApellidoMaterno,
										"inputFechaNacimiento" => $inputFechaNacimiento,
										"generoUsuario" => $generoUsuario,
										"inputEmail" => $inputEmail,
										"inputPhone" => $inputPhone);

		$usuario->editaDatosUsuarioTutor($arregloDatos, $idUsuario);
	}

	$usuario->cierraBaseDatos();
	header("Location: ../../../".$tituloArchivo);
?>