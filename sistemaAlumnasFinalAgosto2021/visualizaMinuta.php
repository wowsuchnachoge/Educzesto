<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/minuta.php");
	include("php/sql/periodo.php");
	include("php/includes/cleanText.php");

	$minuta = new Minuta();
	$usuario = new Usuario();
	$periodo = new Periodo();

	$idMinuta = $_POST["idMinuta"];
	$minutaDatos = $minuta->consultaMinutaId($idMinuta);

	$idPeriodoActual = $minutaDatos["idPeriodo"];

	$usuariosPeriodo = $usuario->consultaUsuariosPorPeriodo($idPeriodoActual);

	$arregloUsuariosPeriodo = array();
	$arregloIdUsuariosPeriodo = array();

	$minutaAcuerdosTodos = $minuta->consultaMinutaAcuerdoTodos($idMinuta);

	foreach ($usuariosPeriodo as $valor) {

		$nombreCompleto = $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];
		array_push($arregloUsuariosPeriodo, $nombreCompleto);
		array_push($arregloIdUsuariosPeriodo, $valor["idUsuario"]);
	}


	$minuta->cierraBaseDatos();
	$usuario->cierraBaseDatos();
	$periodo->cierraBaseDatos();
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
					<div class="card-header font-weight-bold"><i class="icon-doc-text text-dark mr-2"></i>Minuta
					<div class="btn btn-warning btn-sm text-dark font-weight-bold ml-2" id="spanFechaMinuta"><?php echo $minutaDatos["fecha"];?></div></div>
					<div class="card-body">
							<section value="participantesMinuta">
								<p class="font-weight-bold" style="margin-bottom: 4px;"><u>Participantes</u></p>
								<div class="bg-light w-75 p-1 rounded">
									<?php foreach($arregloUsuariosPeriodo as $valor){?>
									<span class="badge rounded-pill bg-warning text-dark my-1"><?php echo $valor;?></span>
									<?php }?>
								</div>
							</section>
							<section value="desglosesMinuta">
									<p class="font-weight-bold mt-2" style="margin-bottom: 4px;"><u>Desglose</u></p>
									<p class="text-justify"><?php echo $minutaDatos["desglose"];?></p>
							</section>
							<section value="acuerdosMinuta" class="d-none d-lg-inline d-xl-none d-none d-xl-inline">
								<p class="font-weight-bold mt-2" style="margin-bottom: 4px;"><u>Acuerdos</u></p>
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col" style="width: 25%">Responsable</th>
											<th scope="col" style="width: 60%">Acuerdo</th>
											<th scope="col">Fecha límite</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($minutaAcuerdosTodos as $valor){?>
										<tr>
											<td><p class="text-justify mr-4">
												<?php if(is_null($valor["responsable"])) echo "Todos";
												for($i=0; $i<count($arregloIdUsuariosPeriodo);$i++){ 
													if($valor["responsable"] == $arregloIdUsuariosPeriodo[$i]) echo $arregloUsuariosPeriodo[$i];

											}?></p></td>	

											<td>
												<p class="text-justify mr-4"><?php  echo $valor["acuerdo"];?></p>
											</td>
											<td>
												<p class="text-justify mr-4"><?php  echo $valor["fechaLimite"];?></p>

											</td>
										</tr>
										<?}?>
									</tbody>
								</table>
							</section>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>