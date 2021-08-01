<?php 
	include("php/sql/interactDB.php");
	include("php/sql/calendario.php");

	$idUsuario = $_POST["idUsuario"];

	$calendario = new Calendario();
	$arregloFilasCalendario = $calendario->consultaCalendario();
	// var_dump($arregloFilasCalendario);

?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Histórico</title>
</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<!-- Undefined index: tituloArchivo in /home/vlm0dijktjmb/public_html/login/visualizaMinuta.php on line 46 -->
				<a class="nav-link text-dark" href="<?php echo $_POST["tituloArchivo"];?>" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
					Volver
				</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container mt-3">
			<section value="visualizacion">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-calendar text-dark mr-2"></i>Calendario de minutas
				</div>
					<div class="card-body">
						<table class="table table-hover">
							<?php for($i=0; $i<count($arregloFilasCalendario);$i++){?>
							<tr>
								<th><?php echo $arregloFilasCalendario[$i]["fecha"];?></th>
								<td><?php echo $arregloFilasCalendario[$i]["nombre"];?></td>
							</tr>
							<?php }?>
						</table>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>