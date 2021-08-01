<?php session_start();?>
<?php  
	include("../interactDB.php");
	include("../usuario.php");
	include("../../includes/cleanText.php");

	$usuario = new Usuario();

	// Limpieza de acentos a los valores del formulario
	$inputUsuario  = clean_text($_POST["inputUsuario"]);
	$inputPassword = clean_text($_POST["inputPassword"]);

	// Permite la entrada al sistema
	if($usuario->consultaUsuarioLogin($inputUsuario, $inputPassword) != 0){
		
		// Carga datos del usuario en SESSION
		$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;
		$usuario->cierraBaseDatos();
		header("Location: ../../../inicio.php");
	}else{

		session_unset();
		session_destroy();
		$usuario->cierraBaseDatos();
		// Error al ingresar los datos o inexistencia de datos en DB
		header("Location: ../../../login.php?login=2");
	}
?>