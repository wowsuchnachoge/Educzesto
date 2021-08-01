<?php
	include("../interactDB.php");
	include("../minuta.php");
	include("../../includes/cleanText.php");

	$minuta = new Minuta();	

   $inputContenidoDesglose = ucfirst(clean_text($_POST["inputContenidoDesglose"]));
  	$idMinuta = $_POST["idMinuta"];

  	$minuta->registroMinutaDesglose($idMinuta, $inputContenidoDesglose);

	$minuta->cierraBaseDatos();
	header("Location: ../../../minutas.php");
?>