<?php  

	session_start();
	// Si no existe el usuario en SESSION
	// if(!isset($_SESSION["usuarioActual"])){
	// 	header("Location: login.php?login=3");
	// }

	// var_dump($_SESSION["usuarioActual"]["idUsuario"]);
	$tituloArchivo = "bitacora.php";
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
	</header>
	<main>
		<div class="container mt-3">
			<section value="nuevoElementoBitacora">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-book text-dark mr-2"></i>Bitácora</div>
					<div class="card-body">
						<textarea class="form-control" id="inputContenidoAcuerdo" rows="1"></textarea>
						<div class="btn btn-success btn-sm float-right mt-2"><i class="icon-plus text-light"></i></div>
						<p class="ml-1 mt-1"><small><span>0</span>/300</small></p>
					</div>
				</div>
			</section>
			<section value="listaMateriales" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
				<span class="badge bg-primary float-right mb-2" id="adviseGuardarMaterial">No olvides <strong>guardar</strong> los cambios al finalizar la edición.</span>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Fecha</th>
							<th scope="col" style="width: 60%">Nota</th>
							<th scope="col">Acción</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span class="badge rounded-pill bg-dark text-light">2021-06-01</span></td>
							<td>
								<div class="form-group">
									<input type="text" class="form-control" maxlength="40" placeholder="...">
								</div>
							</td>
							<td>
								<div class="btn-group" role="group">
								  <button type="button" class="btn btn-success disabled"><i class="icon-floppy text-light mr-2"></i></button>
								  <button type="button" class="btn btn-dark"><i class="icon-trash text-light mr-1"></i></button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</section>
		</div>


	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>