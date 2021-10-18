<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/bitacora.php");
	include("php/sql/periodo.php");

	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "bitacoraTutores.php";

	$usuario = new Usuario();
	$bitacora = new Bitacora();
	$periodo = new Periodo();

	$idPeriodoActual = (int) $periodo->consultaPeriodoActual();
	$usuariosPeriodo = $usuario->consultaUsuariosPorPeriodo($idPeriodoActual-1);

	$arregloUsuariosPeriodo = array();
	$arregloIdUsuariosPeriodo = array();

	foreach ($usuariosPeriodo as $valor) {

		$nombreCompleto = $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];
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
			<h1><i class="icon-book text-dark mr-2"></i> Mi bitácora</h1>
			<br>
		</div>
		<div class="row">
			<div class="col-8">
				<ul id="listPostit">
					<?php foreach($arregloBitacora as $valor){?>				
					<li id="postit">
						<a>
							<h6 class="no-margin text-left"><b><?php  echo date('F j', strtotime($valor["fecha"]));?></b></h6>							
<!-- 							<label class="no-margin text-left" style="font-size: x-small;">Realizado:</label>	
							<form action="php/sql/controladores/cntRegistroAcuerdoRealizado.php" method="POST">
								<select name="realizado" class="form-control text-center" style="background: transparent; border: none;">
									<option selected="selected" value="<?php echo $valor["realizado"]?>"><b><?php if ($valor["realizado"] == '0') {echo "No";} else { echo "Si";}?></b></option>	
									<option value="<?php if ($valor["realizado"] == '0') {echo "1";} else { echo "0";}?>"><b><?php if ($valor["realizado"] == '0') {echo "Si";} else { echo "No";}?></b></option>													
								</select>
								<input type="text" name="idAcuerdo" value="<?php echo $idAcuerdo;?>" hidden>
								<button type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-floppy text-light"></i>Guardar estado</button>
							</form>	-->	
							<p class="text-danger buttonEliminaBitacora no-margin text-left" data-id_bitacora="<?php  echo $valor['idBitacora'];?>" style="font-size: xx-small;">Eliminar <i class="icon-trash text-danger"></i></p>
							<!-- <button class="btn btn-danger btn-sm buttonEliminaBitacora" data-id_bitacora="<?php  echo $valor['idBitacora'];?>" style="font-size: xx-small;">Eliminar<i class="icon-trash text-light"></i></button> -->
							<hr class="no-margin">
							<p style="color: gray; font-size: xx-small;"><?php  echo $valor["desglose"];?></p>														
							<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>							
							<p class="no-margin text-right text-dark" style="font-size: xx-small;">Fecha de entrega:<br> <?php  echo date('F j', strtotime($valor["fecha"]));?></p>
						</a>					
					</li>
					<?}?>				
				</ul>
  			</div>
  			<div class="col-4">
				<div class="row d-flex justify-content-center align-items-center">
					<div class="col-md-8">
						<form action="historico.php" method="POST" style="display: inline;"></form>
						<form id="regForm" action="php/sql/controladores/cntNuevoElementoBitacoraTutores.php" method="POST">
							<h3 id="register"><i class="bi bi-plus-circle mr-2"></i> Agregar a tu bitacora</h3>
							<div class="all-steps" id="all-steps"><span class="step"><i class="bi bi-pencil"></i></span> <span class="step"><i class="bi bi-calendar-check"></i></span> </div>
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
								<a href="bitacoraTutores.php">
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

