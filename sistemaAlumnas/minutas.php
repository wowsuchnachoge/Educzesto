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

	
	$fechaMinuta = strtotime($minutaDatos["fecha"]);	
	$fechaLimite = strtotime($minutaDatos["fechaLimite"]);	

	$idPeriodoActual = $minutaDatos["idPeriodo"];

	$usuariosPeriodo = $usuario->consultaUsuariosPorPeriodo($idPeriodoActual);

	$arregloUsuariosPeriodo = array();
	$arregloIdUsuariosPeriodo = array();

	$minutaAcuerdosTodos = $minuta->consultaMinutaAcuerdoTodos($idMinuta);

	foreach ($usuariosPeriodo as $valor) {

		$nombreCompleto = $valor["nombre"]." ".$valor["apellidoPaterno"]." ";
		$fff = strtotime($valor["fechaLimite"]);	
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
	<title>EduCzesto</title>
</head>
<body>
	<header>
		<?include("php/includes/dynamicHeader.php");?>
		<!-- Recursos locales
		––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<script type="text/javascript" src="js/minutas.js"></script>
		<script type="text/javascript" src="js/formMinutas.js"></script>
		<link href="css/minutas.css" rel="stylesheet" />
	</header>
	<main>
		<br>
		<br>		
		<div class="row">
			<div class="col-8">				
				<div class="container-fluid mt-3 px-4">											
				<div class="row d-flex justify-content-center">
				<h1><i class="icon-doc-text text-dark mr-2"></i> Minutas</h1>
				<div class="col-sm-6 col-lg-2 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block d-lg-inline d-xl-none d-xl-inline mb-3 p-2 rounded bg-light" style="display: none !important;">
						<button class="btn btn-dark btn-block" type="button" data-toggle="modal" data-target=".modalNuevaMinuta"><i class="icon-plus text-light"></i>Nueva minuta</button>
						<hr>
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
					</div>
					<div class="col-sm-12 col-lg-10" id="minutaMinuta" style="background: #5dd97213;">
						<div>
							<div class="card-header font-weight-bold" style="margin-top: 10px;">									
								<h3 id="register"><i class="icon-doc-text mr-1"></i>  Minuta</h3>
								<div class="btn btn-warning btn-sm text-dark font-weight-bold" id="spanFechaMinuta"><?php echo date('F j, Y', $fechaMinuta);?></div>
								<button class="btn btn-light btn-sm mr-2" id="" name="idMinuta" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-calendar mr-1"></i><?php echo $minutaDatos["periodo"];?></button>								
								<button class="btn btn-danger btn-sm float-right mr-2" data-toggle="modal" data-target=".modalEliminaMinuta" style="font-size: xx-small;">Eliminar minuta <i class="icon-trash text-light"></i></button>												
								<?php  if($vistaCambioPeriodo == 0){?>							
									<form action="php/sql/controladores/cntEditaPeriodoMinuta.php" method="POST" style="display: none;">
										<button class="btn btn-dark btn-sm float-right mr-2" id="" name="idMinutaUp" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-up-bold text-light"></i></button>
									</form>
									<form action="php/sql/controladores/cntEditaPeriodoMinuta.php" method="POST" style="display: none;">
										<button class="btn btn-dark btn-sm float-right mr-2" id="" name="idMinutaDown" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-down-bold text-light"></i></button>
									</form>
								<?php } ?>							
							</div>
							<div class="card-body">
							<?php if(!empty($minutaDatos)){?>
								<section value="participantesMinuta">
									<p class="font-weight-bold" style="margin-bottom: 4px;">Participantes</p>
									<div class="w-75 p-1 rounded" style="background-color: transparent;">
										<?php foreach($arregloUsuariosPeriodo as $valor){?>
										<span class="badge rounded-pill text-dark my-1" style="background-color: transparent;"><i class="icon-user text-dark"></i> <?php echo $valor;?></span>
										<?php }?>
									</div>
								</section>
							<section value="acuerdosMinuta">
								<br>
								<div class="p-2 mt-1 rounded">
								<form id="regForm" action="php/sql/controladores/cntRegistroAcuerdo.php" method="POST" >								
									<h3 id="register"><i class="bi bi-plus-circle mr-2"></i> Crear acuerdo nuevo</h3>
									<input type="text" name="idMinuta" value="<?php echo $idMinuta;?>" style="display: none;">
									<div class="all-steps" id="all-steps"><span class="step"><i class="bi bi-person"></i></span> <span class="step"><i class="bi bi-calendar-check"></i></span><span class="step"><i class="bi bi-pencil"></i></span> </div>
									<div class="tab">
										<h6>Quién es el responsable del acuerdo?</h6>
										<select class="form-control" id="responsableAcuerdo" name="responsableAcuerdo">														
											<option value="0">Todos</option>
											<?php for($i = 0; $i < count($arregloUsuariosPeriodo); ++$i){?>
											<option value="<?php echo $arregloIdUsuariosPeriodo[$i];?>"><?php echo $arregloUsuariosPeriodo[$i];?></option>
											<?php }?>
										</select>
									</div>								 
									<div class="tab">
										<h6>¿Cuál es la fecha de entrega?</h6>
										<input type="date" class="form-control" id="inputFechaLimite" name="inputFechaLimite">
									</div>
									<div class="tab">
										<h6>Ingresa el acuerdo nuevo</h6>
										<textarea class="form-control mt-2" name="inputContenidoAcuerdo" id="inputContenidoAcuerdo" rows="2" maxlength="300" placeholder="Ingresa aquí el acuerdo nuevo"></textarea>
									</div>
									<div style="overflow:auto;">						
										<a href="minutas.php">
											<div class="tab" style="float:right;">
												<button id="agregarAcuerdoButton" type="submit" class="btn btn-sm btn-warning text-dark buttonGenerarAcuerdo"><i class="icon-plus text-dark"></i>Agregar acuerdo</button>	
											</div>
										</a>	
									</div>															
									<div style="overflow:auto;" id="nextprevious">
										<div style="float:right;"> 
										<button class="btn btn-warning" type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="bi bi-chevron-double-left"></i></button> 
										<button class="btn btn-warning" type="button" id="nextBtn" onclick="nextPrev(1)"><i class="bi bi-chevron-double-right"></i></button> </div>
									</div>
								</form>
								<section value="acuerdosMinuta">
									<div class="p-2 mt-1 rounded">
										<div id="regForm">								
											<h3 id="register"><i class="bi bi-blockquote-left mr-2"></i> Resumen y desglose</h3>
											<section value="desglosesMinuta">																
												<form action="php/sql/controladores/cntRegistroMinutaDesglose.php" method="POST">
													<textarea style="background-color: #daffd310;" class="form-control mt-2" name="inputContenidoDesglose" id="inputContenidoDesglose" rows="7" maxlength="3000";><?php echo $minutaDatos["desglose"];?></textarea>
													<input type="text" name="idMinuta" value="<?php echo $idMinuta;?>" style="display: none;">
													<button type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-floppy text-light"></i>Guardar desglose</button>
												</form>
												<p class="ml-1 mt-1" id="contadorCaracteresDesglose"><small><span id="caracteresRestantesDesglose">3000</span>/3000</small></p>
												<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseMaximoCaracteresDesglose">Has alcanzado el limite máximo de caracteres.</span>
											</section>	
										</div>
									</div>
								</section>
								<table class="table table-hover" id="minutasTable" style="background: linear-gradient(0deg, #ECF8EC6E 0%, #5DD9728A 100%);">
									<thead>
										<tr>
											<th id="thTable" class="text-center" scope="col" style="font-size: small; width: 5%">Responsable</th>
											<th id="thTable" class="text-center" scope="col" style="font-size: small; width: 30%">Acuerdo</th>
											<th id="thTable" class="text-center" scope="col" style="font-size: x-small;" >Fecha de entrega</th>											
											<th id="thTable" class="text-center" scope="col" style="font-size: small; width: 20%">Estado</th>
											<th id="thTable" class="text-center" scope="col"><p id="guardado" class="mt-1" style="font-size: xx-small; color: green; display: none;" >Guardado</p>												</th>
											<th id="thTable" class="text-center" scope="col" style="font-size: small;" >Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($minutaAcuerdosTodos as $valor){?>
										<tr>
											<td>
												<b>
													<p class="text-left mr-4" style="font-size: x-small; font-weight: bold;">
														<i class="icon-user text-dark"></i>
														<br>
														<?php if(is_null($valor["responsable"])) echo "Todos";
														for($i=0; $i<count($arregloIdUsuariosPeriodo);$i++){ 
															if($valor["responsable"] == $arregloIdUsuariosPeriodo[$i]) echo $arregloUsuariosPeriodo[$i];
														}?>
													</p>
												</b>	
											</td>	
											<td id="tdTable">
												<p class="text-justify mr-4" style="text-transform: none; font-size: x-small; color: grey;"><?php  echo $valor["acuerdo"];?></p>
											</td>
											<td id="tdTable">												
												<p class="text-center" style="font-size: x-small;"><i class="icon-calendar"></i><?php  echo date('F j', strtotime($valor["fechaLimite"]));?></p>
											</td>	
											<td id="tdTable">																									   
												<form action="php/sql/controladores/cntRegistroAcuerdoRealizado.php" method="POST">												
													<select name="realizado" class="classic mt-2"> <!-- style="color: white; background: #6c757d; border: none; font-size: x-small;" -->
														<option selected="selected" value="<?php echo $valor["realizado"]?>"><b><?php if ($valor["realizado"] == '0') {echo "En proceso";} else { echo "Realizado";}?></b></option>	
														<option value="<?php if ($valor["realizado"] == '0') {echo "Realizado";} else { echo "En proceso";}?>"><b><?php if ($valor["realizado"] == '0') {echo "Realizado";} else { echo "En proceso";}?></b></option>													
													</select>													
													<input type="text" name="idAcuerdo" value="<?php echo $idAcuerdo;?>" hidden>																									
												</form>	
																								
											</td>				
											<td id="tdTable" class="text-left">												
												<button onclick="showGuardado()"type="submit" class="btn btn-light btn-sm float-left mt-2 buttonCambiarEstado" style="font-size: xx-small;" data-id_acuerdo="<?php echo $valor["idAcuerdo"];?>" data-estado_acuerdo="<?php echo $valor["realizado"];?>"><i class="icon-floppy text-dark"></i>Guardar estado</button>												
											</td>
											<td>
												<button type="button" class="btn btn-danger btn-sm mt-3 buttonEliminaAcuerdo" style="font-size: xx-small;" data-id_acuerdo="<?php echo $valor["idAcuerdo"];?>"><i class="icon-trash text-light mr-1"></i>Eliminar</button>
											</td>
										</tr>
										<?}?>
									</tbody>
								</table>								
								</div>
								<br>																						
							</section>
							<?php } else{ ?>
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
  			</div>
			  
  			<div class="col-4">	
				<div class="p-2 mt-1 rounded" style="margin-right: 20px;">
					<div id="regForm">		
						<h3 id="register"><i class="icon-plus"></i> Nueva minuta</h3>
						<p class="lead" style="font-size: small;">Crear una nueva minuta que podrán consultar todos los tutores.</p>
						<button class="btn btn-warning" type="button" data-toggle="modal" data-target=".modalNuevaMinuta"><i class="icon-plus text-dark"></i>Nueva minuta</button>
					</div>
				</div>	
				<div class="p-2 mt-1 rounded" style="margin-right: 20px;">
					<div id="regForm">		
						<h3><i class="icon-doc-text text-dark mr-1"></i> Ver minuta</h3>
						<p class="lead" style="font-size: small;">Consulta las minutas de juntas anteriores.</p>						
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
							<button type="submit" class="btn btn-secondary" type="button" id="cargarMinuta">
							<i class="icon-level-down text-light mr-1"></i>Cargar minuta
							</button>
						</form>
					</div>
				</div>				
					<div class="btn-warning p-2 mt-1 rounded " style="margin-right: 20px;">
						<h3><i class="icon-calendar text-dark mr-1"></i> Ver agenda</h3>
						<p class="lead" style="font-size: small;">Consulta cuándo te toca hacer la minuta semanal.</p>
						<form action="calendarioMinutas.php" method="POST" class="mt-2">
							<button type="submit" class="btn btn-md btn-light" name="idMinuta" value="<?php echo $minutaDatos['idMinuta'];?>"><i class="icon-calendar text-dark mr-1"></i>Calendario</button>
							<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
				</div>			
			</div>
  		</div>		
		

		
			
	</main>
	<?include("php/includes/modals.php");?>
	<br>
</body>
</html>