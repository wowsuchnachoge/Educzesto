<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/bitacora.php");
	include("php/sql/periodo.php");

	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "bitacoras.php";

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
</head>
<body>
	<header>
		<?include("php/includes/dynamicHeader.php");?>

		<!-- Recursos locales
		––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<script type="text/javascript" src="js/bitacoras.js"></script>
	</header>
	<main>
		<div class="container mt-3">
			<section value="nuevoElementoBitacora">
				<div class="card mb-3">
					<div class="card-header font-weight-bold">
						<i class="icon-book text-dark mr-2"></i>
						<span>Bitácora</span>
						<form action="historico.php" method="POST" style="display: inline;">
							<button type="submit" class="btn btn-success btn-sm float-right mr-1"><i class="icon-eye text-light"></i></button>
							<select class="form-control w-25 float-right mr-2" id="idUsuario" name="idUsuario" style="margin-top: -2px;">
								<option value="0">Seleccionar</option>
								<optgroup label="Alumnos del periodo anterior">
									<?php for($i=0; $i<count($arregloUsuariosPeriodo);$i++){ ?>
										<option value="<?php echo $arregloIdUsuariosPeriodo[$i];?>"><?php echo $arregloUsuariosPeriodo[$i];?></option>
									<?php }?>
								</optgroup>
							</select>
							<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
						</form>
					</div>
					<div class="card-body">
						<form action="php/sql/controladores/cntNuevoElementoBitacora.php" method="POST">
							<textarea class="form-control" name="inputContenidoBitacora" id="inputContenidoBitacora" rows="1" maxlength="300"></textarea>
							<input type="text" name="idUsuario" value="<?php echo $idUsuario;?>" style="display: none;">
							<button type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-plus text-light"></i></button>
						</form>
						<p class="ml-1 mt-1" id="contadorCaracteres"><small><span id="caracteresRestantes">300</span>/300</small></p>
						<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseMaximoCaracteres" style="display: none;">Has alcanzado el limite máximo de caracteres.</span>
					</div>
				</div>
			</section>
			<section value="listaBitacoras" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Fecha</th>
							<th scope="col" style="width: 70%">Nota</th>
							<th scope="col">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($arregloBitacora as $valor){?>
						<tr>
							<td><span class="badge rounded-pill bg-dark text-light"><?php  echo $valor["fecha"];?></span></td>
							<td>
								<p class="text-justify mr-4"><?php  echo $valor["desglose"];?></p>
							</td>
							<td>
								<button type="button" class="btn btn-dark buttonEliminaBitacora" data-id_bitacora="<?php  echo $valor['idBitacora'];?>"><i class="icon-trash text-light mr-1"></i></button>
							</td>
						</tr>
						<?}?>
					</tbody>
				</table>
			</section>
		</div>
	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>