<?php  

	if(isset($_REQUEST["idPeriodo"])){

		include("../interactDB.php");

		$baseDatos = new InteractDB();
		$baseDatos->consultaFechasPeriodo($_REQUEST["idPeriodo"]);


		echo '<pre>'; print_r($baseDatos->idMinutas); echo '</pre>';
		echo '<pre>'; print_r($baseDatos->fechas); echo '</pre>';

		for ($i = 0; $i < count($baseDatos->idMinutas); $i++){

			$options = sprintf('<option value="%s">%s</option>', $baseDatos->idMinutas[$i], $baseDatos->fechas[$i]);
			echo $options;
		}
	
	}
?>