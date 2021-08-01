<?php  
	include("../interactDB.php");
	include("../minuta.php");
	include("../../includes/cleanText.php");

	$idPeriodo = (int) $_GET["idPeriodo"];

	$minuta = new Minuta();
	$fila = $minuta->consultaPeriodoIdTodos($idPeriodo);
	$minuta->cierraBaseDatos();
	
	for ($i = 0; $i < count($fila); $i++){

		$options = sprintf('<option value="%s">%s</option>', $fila[$i]["idMinuta"], $fila[$i]["fecha"]);
		echo $options;
	}
?>