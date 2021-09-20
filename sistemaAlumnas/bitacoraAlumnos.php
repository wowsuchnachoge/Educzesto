<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/bitacoraAlumnos.php");
	include("php/sql/periodo.php");

	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "bitacoraAlumnos.php";

	$usuario = new Usuario();
	$bitacora = new Bitacora();
	$periodo = new Periodo();

	$idPeriodoActual = (int) $periodo->consultaPeriodoActual();
	$usuariosPeriodo = $usuario->consultaAlumnosPorPeriodo($idPeriodoActual);

	$arregloUsuariosPeriodo = array();
	$arregloIdUsuariosPeriodo = array();

	foreach ($usuariosPeriodo as $valor) {

		$nombreCompleto = $valor["nombre"]." ".$valor["apellidoPaterno"]." ";
		array_push($arregloUsuariosPeriodo, $nombreCompleto);
		array_push($arregloIdUsuariosPeriodo, $valor["idUsuario"]);
	}


	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;

	
	$idUsuario = $_SESSION["datosUsuarioActivo"]["idUsuario"];

	$arregloBitacora = $bitacora->consultaBitacoraId($idUsuario);

	$usuario->cierraBaseDatos();
	$bitacora->cierraBaseDatos();
	$periodo->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Bitácora</title>
	<link rel="stylesheet" href="./css/bitacoras.css">
</head>
<body>
	<header>
		<?include("php/includes/dynamicHeader.php");?>
		<!-- Recursos locales
		––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<script type="text/javascript" src="js/bitacoras.js"></script>
		<script type="text/javascript" src="js/form.js"></script>
	</header>
	<br>	
	<main>
		<div class="container mt-3">
			<h1><i class="icon-book text-dark mr-2"></i> Bitácora de alumnos</h1>
			<br>
		</div>
		<div class="row">
			<div class="col-8">
				<ul id="listPostit">
					<?php foreach($arregloBitacora as $valor){?>				
					<li id="postit">
						<a>
							<h6><?php  echo date('F j', strtotime($valor["fecha"]));?></h6>
							<p><?php  echo $valor["desglose"];?></p>
							<p><input type="checkbox" checked="unchecked"><b> Realizado?</b></p>							
							<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>							
							<button class="btn btn-danger btn-sm buttonEliminaBitacora" data-id_bitacora="<?php  echo $valor['idBitacora'];?>" style="font-size: xx-small;">Eliminar<i class="icon-trash text-light"></i></button>																			
						</a>					
					</li>
					<?}?>				
				</ul>
  			</div>
			  
  			<div class="col-4">					  			  
				<div class="row d-flex justify-content-center align-items-center">					
					<div class="col-md-8">
						<div class="jumbotron btn-warning">
							<h3><i class="icon-user text-dark mr-2"></i> Elegir alumno</h3>
							<p class="lead" style="font-size: small;">Consulta las bitácoras de los alumnos de este semestre.</p>						
							<form action="historico.php" method="POST" style="display: inline;">
								<select class="form-control w-40 float-right mr-1" id="idUsuario" name="idUsuario" style="margin-top: -2px; font-size: xx-small;">
									<option value="0">Seleccionar</option>
									<optgroup label="Alumnos">
										<?php for($i=0; $i<count($arregloUsuariosPeriodo);$i++){ ?>
											<option value="<?php echo $arregloIdUsuariosPeriodo[$i];?>"><?php echo $arregloUsuariosPeriodo[$i];?></option>
										<?php }?>
									</optgroup>
								</select>
								<button type="submit" class="btn btn-success btn-sm float-right mr-1" style="margin-top: 5px; font-size: xx-small;"><i class="icon-eye text-light"></i> Ver seguimiento y bitácora</button>
								<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
							</form>
							<br>
							<br>
						</div>
						<form id="regForm" action="php/sql/controladores/cntNuevoElementoBitacoraAlumnos.php" method="POST">
							<h3 id="register"><i class="bi bi-plus-circle mr-2"></i> Agregar a tu bitacora</h3>
							<div class="all-steps" id="all-steps"><span class="step"><i class="bi bi-person"></i></span> <span class="step"><i class="bi bi-pencil"></i></span><span class="step"><i class="bi bi-calendar-check"></i></span> </div>
							<div class="tab">
								<h6>Seleccionar:</h6>
								<select class="form-control w-40 mr-1" id="idUsuario" name="idUsuario" style="margin-bottom: 5px; font-size: xx-small;">
									<option value="0">Seleccionar</option>
									<optgroup label="Alumnos">
										<?php for($i=0; $i<count($arregloUsuariosPeriodo);$i++){ ?>
											<option value="<?php echo $arregloIdUsuariosPeriodo[$i];?>"><?php echo $arregloUsuariosPeriodo[$i];?></option>
										<?php }?>
									</optgroup>
								</select>
							</div>
							<div class="tab">
								<h6>Ingresa la entrada a tu bitácora:</h6>
									<p> <input name="inputContenidoBitacora" id="inputContenidoBitacora" rows="2" style="font-size: xx-small;" placeholder="Por ejemplo: Publiqué un post en Instagram." oninput="this.className = ''" name="fname"> </p>			
								<!-- <textarea name="inputContenidoBitacora" id="inputContenidoBitacora" placeholder="Ingresa aquí la entrada a tu bitácora, por ejemplo: Publiqué un post en Instagram." oninput="this.className = ''" name="fname"> </textarea>
								<p class="ml-1 mt-1" id="contadorCaracteres"><small><span id="caracteresRestantes">300</span>/300</small></p> -->
								<!-- <span class="badge bg-danger mb-2 mr-1 text-light" id="adviseMaximoCaracteres" style="display: none;">Has alcanzado el limite máximo de caracteres.</span>																																		 -->
								<p> <input type="text" name="idUsuario" value="<?php echo $idUsuario;?>" style="display: none;"> </p>
								<div style="float:right;"> <button id="agregarBitacoraButton" type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-plus text-light"></i></button> </div>								
							</div>								 
							<div class="tab">
								<h6>¿Cuál es la fecha de entrega?</h6>
								<p><input id="inputContenidoBitacora" type="date" oninput="this.className = ''" name="dd" style="font-size: xx-small;">
							</div>							
							<div style="overflow:auto;">						
								<a href="bitacoraAlumnos.php">
									<div class="tab" style="float:right;">
										<!-- <p id="done"><i class="bi bi-check"></i> Agregado existosamente</p> -->
										<button class="btn btn-success" type="submit"><i class="bi bi-plus"></i> Agregar</button>	
										<!-- <button type="button"><i class="bi bi-arrow-repeat"></i> Agregar otra entrada</button> -->
									</div>
								</a>	
							</div>
							<div style="overflow:auto;" id="nextprevious">
								<div style="float:right;"> <button class="btn btn-warning" type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="bi bi-chevron-double-left"></i></button> <button class="btn btn-warning" type="button" id="nextBtn" onclick="nextPrev(1)"><i class="bi bi-chevron-double-right"></i></button> </div>
								<!-- <div style="float:right;"> <button type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-plus text-light"></i></button> </div> -->
							</div>
						</form>
					</div>					
				</div>
			</div>
  		</div>
	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>