<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/minuta.php");
	include("php/sql/periodo.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "minutas.php";

	$vistaCambioPeriodo = 0;

	$minuta = new Minuta();
	$usuario = new Usuario();
	$periodo = new Periodo();

// Undefined index: datosUsuarioActivo in /home/vlm0dijktjmb/public_html/login/minutas.php on line 18
	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;

	if(isset($_REQUEST["idMinuta"])){

		$idMinuta = $_REQUEST["idMinuta"];
		$vistaCambioPeriodo = 1;
	}
	else{

		$fila =  $minuta->consultaIdMinutaUltimaAgregada();
		$idMinuta = (int) $fila["idMinuta"];

	}

	$minutaDatos = $minuta->consultaMinutaId($idMinuta);
	$datosPeriodo = $periodo->consultaPeriodoTodos();
	$removed = array_shift($datosPeriodo);


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
	<title>Minutas</title>
</head>
<body>
	<header>
		<?include("php/includes/dynamicHeader.php");?>
		<!-- Recursos locales
		––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<script type="text/javascript" src="js/minutas.js"></script>
	</header>
	<main>
		<div class="container-fluid mt-3 px-4">
			<div class="row d-flex justify-content-center">
				<div class="col-sm-6 col-lg-2 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block d-lg-inline d-xl-none d-xl-inline mb-3 p-2 rounded bg-light">
				  <button class="btn btn-dark btn-block" type="button" data-toggle="modal" data-target=".modalNuevaMinuta"><i class="icon-plus text-light"></i>Nueva minuta</button>
				  <hr>
				  <!-- <button class="btn btn-secondary btn-block disabled" type="button"><i class="icon-calendar text-light mr-1"></i>Calendario</button> -->
				  <form action="visualizaMinuta.php" method="POST">
					  <button type="submit" class="btn btn-secondary btn-block" name="idMinuta" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-doc-text text-light mr-1"></i>Visualización</button>
					  <input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
				  </form>
				  <form action="calendarioMinutas.php" method="POST" class="mt-2">
					  <button type="submit" class="btn btn-secondary btn-block" name="idMinuta" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-calendar text-light mr-1"></i>Calendario minutas</button>
					  <input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
				  </form>
				  <hr>
				  <p><i class="icon-search text-dark mr-1"></i><strong>Buscar minuta</strong></p>
				  <form action="php/sql/controladores/cntCargaMinuta.php" method="POST">
						<select class="form-control" id="periodoMinuta" name="periodoMinuta">
							<option value="0">Periodo</option>
							<?php foreach ($datosPeriodo as $value){?>
							<option value="<?php echo $value["idPeriodo"];?>"><?php echo $value["periodo"];?></option>
							<?php }?>
						</select>
						<select class="form-control my-2" id="fechaMinuta" name="fechaMinuta">
							<option value="0">Fecha</option>
						</select>
					  <button type="submit" class="btn btn-dark btn-block" type="button" id="cargarMinuta" style="display: none;">
					  	<i class="icon-level-down text-light mr-1"></i>Cargar minuta
					  </button>
				  </form>
				</div>
				<div class="col-sm-12 col-lg-10">
					<div class="card">
						<div class="card-header font-weight-bold">
							<i class="icon-pencil text-dark"></i>
							<span>Minuta</span>
							<div class="btn btn-warning btn-sm text-dark font-weight-bold ml-2" id="spanFechaMinuta"><?php echo $minutaDatos["fecha"];?></div>
							<!-- <span class="badge rounded-pill bg-dark text-light ml-3" id="spanFechaMinuta"><?php echo $minutaDatos["fecha"];?></span> -->

							<button class="btn btn-warning btn-sm float-right mr-2" id="" name="idMinuta" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-calendar mr-1"></i><?php echo $minutaDatos["periodo"];?></button>
							<?php  if($vistaCambioPeriodo == 0){?>
							<form action="php/sql/controladores/cntEditaPeriodoMinuta.php" method="POST" style="display: inline;">
								<button class="btn btn-dark btn-sm float-right mr-2" id="" name="idMinutaUp" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-up-bold text-light"></i></button>
							</form>

							<form action="php/sql/controladores/cntEditaPeriodoMinuta.php" method="POST" style="display: inline;">
								<button class="btn btn-dark btn-sm float-right mr-2" id="" name="idMinutaDown" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-down-bold text-light"></i></button>
							</form>
							<?php } ?>
							<!-- <form action="php/sql/controladores/cntEliminaMinuta.php" method="POST" style="display: inline;"> -->
								<button class="btn btn-dark btn-sm float-right mr-2" data-toggle="modal" data-target=".modalEliminaMinuta" ><i class="icon-trash text-light"></i></button>
							<!-- </form> -->

						</div>
						<div class="card-body">
							<?php if(!empty($minutaDatos)){?>
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
									<form action="php/sql/controladores/cntRegistroMinutaDesglose.php" method="POST">
										<textarea class="form-control mt-2" name="inputContenidoDesglose" id="inputContenidoDesglose" rows="2" maxlength="3000"><?php echo $minutaDatos["desglose"];?></textarea>
										<input type="text" name="idMinuta" value="<?php echo $idMinuta;?>" style="display: none;">
										<button type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-floppy text-light"></i></button>
									</form>
									<p class="ml-1 mt-1" id="contadorCaracteresDesglose"><small><span id="caracteresRestantesDesglose">3000</span>/3000</small></p>
									<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseMaximoCaracteresDesglose">Has alcanzado el limite máximo de caracteres.</span>
							</section>
							<section value="acuerdosMinuta" class="d-none d-lg-inline d-xl-none d-none d-xl-inline">
								<p class="font-weight-bold mt-2" style="margin-bottom: 4px;"><u>Acuerdos</u></p>
								<div class="bg-light p-2 mt-1 rounded">
									<form action="php/sql/controladores/cntRegistroAcuerdo.php" method="POST">
										<textarea class="form-control mt-2" name="inputContenidoAcuerdo" id="inputContenidoAcuerdo" rows="1" maxlength="300"></textarea>
										<input type="text" name="idMinuta" value="<?php echo $idMinuta;?>" style="display: none;">
										<p class="ml-1 mt-1" id="contadorCaracteresAcuerdo"><small><span id="caracteresRestantesAcuerdo">300</span>/300</small></p>
										<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseMaximoCaracteresAcuerdo">Has alcanzado el limite máximo de caracteres.</span>
										<table class="table table-hover">
											<thead>
												<tr>
													<th scope="col" style="width: 30%">Responsable</th>
													<th scope="col" style="width: 20%">Fecha límite</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<select class="form-control" id="responsableAcuerdo" name="responsableAcuerdo">
															<option value="0">Todos</option>
															<?php for($i = 0; $i < count($arregloUsuariosPeriodo); ++$i){?>
																<option value="<?php echo $arregloIdUsuariosPeriodo[$i];?>"><?php echo $arregloUsuariosPeriodo[$i];?></option>
															<?php }?>
														</select>
													</td>
													<td>
														<input type="date" class="form-control" id="inputFechaLimite" name="inputFechaLimite">
													</td>
													<td>
														<button type="submit" class="btn btn-success float-right buttonGenerarAcuerdo"><i class="icon-plus text-light"></i></button>
													</td>
												</tr>
											</tbody>
										</table>	
										<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseGenerarAcuerdo">Existen campos sin llenar.</span>
									</form>
								</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col">Responsable</th>
											<th scope="col" style="width: 60%">Acuerdo</th>
											<th scope="col">Fecha límite</th>
											<th scope="col">Acción</th>
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
											<td><button type="button" class="btn btn-dark buttonEliminaAcuerdo" data-id_acuerdo="<?php echo $valor["idAcuerdo"];?>"><i class="icon-trash text-light mr-1"></i></button></td>
										</tr>
										<?}?>
									</tbody>
								</table>
							</section>
							<?php }else{?>
							<div class="alert alert-dismissible alert-warning">
							<h4 class="alert-heading">No existen minutas en este periodo</h4>
							<p class="mb-0">Puedes agregar una nueva minuta dando clic en el botón de <strong>"Nueva minuta"</strong>.</p>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>