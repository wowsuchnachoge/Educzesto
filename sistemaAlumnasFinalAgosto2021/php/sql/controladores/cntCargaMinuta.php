<?php  

	$idMinuta = (int) $_POST["fechaMinuta"];
	header("Location: ../../../minutas.php?idMinuta=$idMinuta");
?>