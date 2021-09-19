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
	</header>
	<br>
	<div class="container">	
			<div class="row">		
				<div class="jumbotron col-sm" style="margin-left: 32px;">
					<h1><i class="icon-plus text-dark mr-1"></i> Agregar a tu bitácora</h1>
					<div class="row mb-3">
					<p class="lead">Agrega una nueva entrada para tu bitácora.</p>
					<div class="card-body">
						<form action="php/sql/controladores/cntNuevoElementoBitacoraTutores.php" method="POST">
							<textarea class="form-control" name="inputContenidoBitacora" id="inputContenidoBitacora" rows="2" maxlength="300" placeholder="Ingresa aquí la entrada a tu bitácora, por ejemplo: Publiqué un post en Instagram."></textarea>
							<input type="text" name="idUsuario" value="<?php echo $idUsuario;?>" style="display: none;">
							<p class="ml-1 mt-1" id="contadorCaracteres"><small><span id="caracteresRestantes">300</span>/300</small></p>
							<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseMaximoCaracteres" style="display: none;">Has alcanzado el limite máximo de caracteres.</span>							
							<b> Fecha límite de entrega</b>
							<input type="date" class="form-control" id="inputFechaLimite" name="inputFechaLimite">	
							<button type="submit" class="btn btn-success btn-sm float-right mt-2"><i class="icon-plus text-light"></i> Agregar a mi bitácora</button>						
						</form>
					</div>
			</div>
			</div>
			</div>
	
	<main>
		<div class="container mt-3">
		<h1><i class="icon-book text-dark mr-2"></i> Mi bitácora</h1>
		<br>
			<!-- <section value="listaBitacoras" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Fecha de entrada</th>
							<th scope="col" style="width: 70%">Entrada</th>							
							<th scope="col">Fecha de entrega</th>
							<th scope="col"> </th>
							<th scope="col">Realizado?</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($arregloBitacora as $valor){?>
						<tr>
							<td><span class="badge rounded-pill bg-dark text-light"><?php  echo date('F j', strtotime($valor["fecha"]));?></span></td>
							<td>
								<p class="text-justify mr-4"><?php  echo $valor["desglose"];?></p>
							</td>						
							<td>
								<span class="badge rounded-pill bg-secondary text-light"><?php  echo date('F j', strtotime($valor["fecha"]));?></span></td>
							<td>
							<td style="text-align: center;">
												<input type="checkbox" checked="unchecked">
												<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>
												<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>
												<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>
												<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>
												<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>
							</td>
							<td>
								<button class="btn btn-danger btn-sm mr-2 buttonEliminaBitacora" data-id_bitacora="<?php  echo $valor['idBitacora'];?>" style="font-size: xx-small;">Eliminar entrada <i class="icon-trash text-light"></i></button>							
							</td>
						</tr>
						<?}?>
					</tbody>
				</table>
			</section> -->
			<ul id="listPostit">
				<?php foreach($arregloBitacora as $valor){?>				
					<li id="postit">
						<a>
						<!-- <h3>Title #1</h3> -->
						<h5><?php  echo date('F j', strtotime($valor["fecha"]));?></h5>
						<p><?php  echo $valor["desglose"];?></p>
						<p><b>Realizado?</b> <input type="checkbox" checked="unchecked"></p>
						<p class="text-justify mr-4" style="text-transform: none; font-size: small;"><?php  echo $valor["realizado"];?></p>
						<button class="btn btn-danger btn-sm mr-2 buttonEliminaBitacora" data-id_bitacora="<?php  echo $valor['idBitacora'];?>" style="font-size: xx-small;">Eliminar<i class="icon-trash text-light"></i></button>																			
						</a>
					</li>
				<?}?>				
			</ul>
		</div>
	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>