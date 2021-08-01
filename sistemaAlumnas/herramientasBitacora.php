<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/bitacora.php");
	include("php/includes/cleanText.php");
	
	$idUsuario = (int) $_POST["idUsuario"];
	$bitacora = new Bitacora();
	$usuario = new Usuario();

	$usuario->consultaUsuarioId($idUsuario);

	$arregloBitacora = $bitacora->consultaBitacoraId($idUsuario);
	$bitacora->cierraBaseDatos();
	$usuario->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Herramientas</title>
	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="js/herramientas.js"></script>
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
			<section value="bitacora">
				<div class="row">
					<div class="col-12">
						<div class="card mb-3">
							<div class="card-header font-weight-bold">
								<span><i class="icon-book text-dark mr-2"></i>Bitácora</span>
								<span class="float-right"><span class="badge bg-warning"><?php  echo $usuario->datosUsuario["nombreCompleto"];?></span></span>
							</div>
							<div class="card-body">
								<section value="listaBitacoras" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col" style="width: 20%">Fecha</th>
												<th scope="col" style="width: 80%">Nota</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($arregloBitacora as $valor){?>
											<tr>
												<td><span class="badge rounded-pill bg-dark text-light"><?php  echo $valor["fecha"];?></span></td>
												<td>
													<p class="text-justify mr-4"><?php  echo $valor["desglose"];?></p>
												</td>
											</tr>
											<?}?>
										</tbody>
									</table>
								</section>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>