<?php 
	include("php/sql/interactDB.php");
	include("php/sql/calendario.php");

	$idUsuario = $_POST["idUsuario"];

	$calendario = new Calendario();
	$arregloFilasCalendario = $calendario->consultaCalendario();
	// var_dump($arregloFilasCalendario);

	$calendario->cierraBaseDatos();

?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Herramientas</title>
	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="js/calendarios.js"></script>
</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="herramientas.php" role="button" style="margin-top: -5px;">
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
						<form action="php/sql/controladores/cntEditaCalendarioMinutas.php" method="POST" style="display: inline;">
							<button type="submit" class="btn btn-success btn-sm float-right mr-2 disabled" id="buttonGuardarCalendario" value="<?php echo $minutaDatos['idMinuta'];?>">
								<i class="icon-floppy text-light"></i> Guardar
							</button>
					</div>
					<div class="card-body">
						<table class="table table-hover">
							<?php for($i=0; $i<count($arregloFilasCalendario);$i++){?>
							<tr>
								<th>
									<div class="form-group w-75">
										<input type="date" class="form-control campoEditar" value="<?php echo $arregloFilasCalendario[$i]["fecha"];?>" name="fecha<?php echo $arregloFilasCalendario[$i]["idFila"];?>">
									</div>
								</th>
								<td>
									<div class="form-group w-75">
										<input type="text" class="form-control campoEditar" value="<?php echo $arregloFilasCalendario[$i]["nombre"];?>" name="persona<?php echo $arregloFilasCalendario[$i]["idFila"];?>">
									</div>
								</td>
							</tr>
							<?php }?>
						</table>
						</form>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>