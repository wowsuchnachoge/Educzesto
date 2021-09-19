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
	</header>
	<br>
				<div class="row">			
				<div class="col-sm col-lg-2" style="margin-left: 32px;">
					<div class="jumbotron btn-warning" style="margin-right: 20px;">
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
				</div>
				<!-- <div class="jumbotron col-sm mr-5">
					<h1><i class="icon-plus text-dark mr-1"></i> Agregar a bitácora de alumno</h1>
					<p class="lead">Agrega una nueva entrada para el seguimiento de tu alumno.</p>
					<div class="card-body">
						<form action="php/sql/controladores/cntNuevoElementoBitacoraAlumnos.php" method="POST">
							<textarea class="form-control" name="inputContenidoBitacora" id="inputContenidoBitacora" rows="2" maxlength="300" placeholder="Ingresa aquí la entrada a su bitácora, por ejemplo: Realizó 2 hojas de la guía."></textarea>
							<input type="text" name="idUsuario" value="<?php echo $idUsuario;?>" style="display: none;">
							<p class="ml-1 mt-1" id="contadorCaracteres"><small><span id="caracteresRestantes">300</span>/300</small></p>
						<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseMaximoCaracteres" style="display: none;">Has alcanzado el limite máximo de caracteres.</span>
							<div class="col-sm-12 col-lg-4 border-right">
							<div class="card mb-3">
								<div class="card-header font-weight-bold"><i class="icon-users text-dark mr-2"></i>Asignar a alumno:</div>
								<select class="form-control w-40 float-right mr-1" id="idUsuario" name="idUsuario" style="margin-top: -2px; font-size: xx-small;">
								<option value="0">Seleccionar alumno</option>
								<optgroup label="Tus alumnos">
									<?php for($i=0; $i<count($arregloUsuariosPeriodo);$i++){ ?>
										<option value="<?php echo $arregloIdUsuariosPeriodo[$i];?>"><?php echo $arregloUsuariosPeriodo[$i];?></option>
									<?php }?>
								</optgroup>
							</select>
								</div>
							</div>
							<button type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-plus text-light"></i> Agregar a su bitácora</button>
						</form>
					</div>
        		</div> -->
				<div class="jumbotron col-sm mr-5">
					<h1><i class="icon-plus text-dark mr-1"></i> Agregar a bitácora de alumno</h1>
					
        		</div>
				<p class="lead">Agrega una nueva entrada para el seguimiento de tu alumno.</p>
					<div class="container mt-5">
						<div class="row d-flex justify-content-center align-items-center">
							<div class="col-md-8">
								<form id="regForm">
									<div class="all-steps" id="all-steps"> <span class="step"><i class="fa fa-user"></i></span> <span class="step"><i class="fa fa-map-marker"></i></span> <span class="step"><i class="fa fa-shopping-bag"></i></span> <span class="step"><i class="fa fa-car"></i></span> <span class="step"><i class="fa fa-spotify"></i></span> <span class="step"><i class="fa fa-mobile-phone"></i></span> </div>
									<div class="tab">
										<h6>Ingresar a tu bitácora:</h6>
										<p> <inpu	t placeholder="Name..." oninput="this.className = ''" name="fname"></p>
									</div>
									<div class="tab">
										<h6>Asignar a alumno:</h6>
										<p><input placeholder="City" oninput="this.className = ''" name="dd"></p>
									</div>
								</form>
							</div>
						</div>
					</div>
				
				<!-- <div class="col-sm col-lg-2">
					<div class="jumbotron btn-warning" style="margin-right: 20px;">
						<h3><i class="icon-clock text-dark mr-2"></i> Historial</h3>
						<p class="lead" style="font-size: small;">Consulta las bitácoras de tutores anteriores.</p>						
						<form action="historico.php" method="POST" style="display: inline;">
							<select class="form-control w-40 float-right mr-1" id="idUsuario" name="idUsuario" style="margin-top: -2px; font-size: xx-small;">
								<option value="0">Seleccionar</option>
								<optgroup label="Alumnos del periodo anterior">
									<?php for($i=0; $i<count($arregloUsuariosPeriodo);$i++){ ?>
										<option value="<?php echo $arregloIdUsuariosPeriodo[$i];?>"><?php echo $arregloUsuariosPeriodo[$i];?></option>
									<?php }?>
								</optgroup>
							</select>
							<button type="submit" class="btn btn-success btn-sm float-right mr-1" style="margin-top: 5px; font-size: xx-small;"><i class="icon-eye text-light"></i> Ver bitácora</button>
							<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
						</form>
						<br>
						<br>
					</div>
				</div> -->

	<main>
	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>