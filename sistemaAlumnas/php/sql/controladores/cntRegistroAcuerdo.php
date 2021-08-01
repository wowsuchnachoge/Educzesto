<?php  

	include("../interactDB.php");
	include("../minuta.php");
	include("../../includes/cleanText.php");

	$minuta = new Minuta();	

	$inputContenidoAcuerdo 	= ucfirst(clean_text($_POST["inputContenidoAcuerdo"]));
	$responsableAcuerdo     = $_POST["responsableAcuerdo"];
	$inputFechaLimite       = $_POST["inputFechaLimite"];
	$idMinuta               = $_POST["idMinuta"];

	if($responsableAcuerdo == 0) $minuta->registroMinutaAcuerdoSinResponsable($idMinuta, $inputContenidoAcuerdo, $inputFechaLimite);
	else $minuta->registroMinutaAcuerdo($idMinuta, $inputContenidoAcuerdo, $responsableAcuerdo, $inputFechaLimite);

	$minuta->cierraBaseDatos();
	header("Location: ../../../minutas.php");
?>