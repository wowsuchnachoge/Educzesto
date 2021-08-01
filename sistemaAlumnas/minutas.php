<?php  

	session_start();
	// Si no existe el usuario en SESSION
	// if(!isset($_SESSION["usuarioActual"])){
	// 	header("Location: login.php?login=3");
	// }

	$tituloArchivo = "minutas.php";
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
	</header>
	<main>
		<br>
		<h2 style="font-weight:bold;">&nbsp;&nbsp;&nbsp;Minutas</h2>
		<div class="jumbotron" style="margin-left: 20px; margin-right: 20px;">
        	<h1>Nueva minuta</h1>
        	<p class="lead">Crear una nueva minuta que podrán consultar todos los tutores.</p>
        	<a class="btn btn-lg btn-primary" role="button">Nueva minuta <i class="icon-plus text-dark"></i></a>
      	</div>
		  <div class="jumbotron" style="margin-left: 20px; margin-right: 20px;">
        	<h1>Ver minutas</h1>
        	<p class="lead">Consulta las minutas de juntas anteriores.</p>
        	<a class="btn btn-lg btn-primary" role="button">Ver minutas »</a>
      	</div>
		<div class="container-fluid mt-3 px-4">
			<div class="row d-flex justify-content-center">
				<div class="col-sm-6 col-lg-2 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block d-lg-inline d-xl-none d-xl-inline mb-3 p-2 rounded bg-light">
				  <button class="btn btn-success btn-block" type="button"><i class="icon-plus text-light"></i>Nueva minuta</button>
				  <hr>
				  <button style="display:none;" class="btn btn-secondary btn-block disabled" type="button"><i class="icon-calendar text-light mr-1"></i>Calendario</button>
				  <button style="display:none;" class="btn btn-secondary btn-block disabled" type="button"><i class="icon-doc-text text-light mr-1"></i>Vista</button>
				  <!-- <hr> -->
				  <p><i class="icon-search text-dark mr-1"></i><strong>Buscar minuta</strong></p>
					<select class="form-control" id="periodoMinuta" name="periodoMinuta">
						<option value="0">Periodo</option>
					</select>
					<select class="form-control my-2" id="fechaMinuta" name="fechaMinuta">
						<option value="0">Fecha</option>
					</select>
				  <button class="btn btn-dark btn-block" type="button"><i class="icon-level-down text-light mr-1"></i>Cargar minuta</button>
				</div>
				<div class="col-sm-12 col-lg-10">
					<div class="card">
						<div class="card-header font-weight-bold">
							<i class="icon-doc-text-inv text-dark"></i>
							<span>Minuta</span>
							<span class="badge rounded-pill bg-dark text-light ml-3">2021-06-15</span>
							<span class="badge rounded-pill bg-warning text-dark">PRI-2021</span>
							<div class="btn btn-dark btn-sm float-right"><i class="icon-trash text-light"></i></div>
							<div class="btn btn-dark btn-sm float-right mr-1"><i class="icon-minus text-light"></i></div>
						</div>
						<div class="card-body">
							<section value="participantesMinuta">
								<details open class="mb-3">
									<summary>Participantes</summary>
									<div class="bg-light w-50 p-2 mt-1 rounded">
										<span class="badge rounded-pill bg-warning text-dark">Benjamin Menchaca</span>
									</div>
								</details>
							</section>
							<section value="desglocesMinuta">
								<details open class="mb-3">
									<summary>Desgloce</summary>
									<div class="form-group">
										<textarea class="form-control mt-2" id="inputDesgloce" rows="2"></textarea>
										<div class="btn btn-success btn-sm float-right mt-2">Guardar</div>
										<p class="ml-1 mt-1"><small><span>0</span>/3000</small></p>
									</div>
								</details>
							</section>
							<section value="acuerdosMinuta" class="d-none d-lg-inline d-xl-none d-none d-xl-inline">
								<details open class="mb-3">
									<summary>Acuerdos</summary>
									<div class="bg-light p-2 mt-1 rounded">
										<span class="badge rounded-pill bg-dark text-light mb-2">Acuerdo #1</span>
										<textarea class="form-control" id="inputContenidoAcuerdo" rows="1"></textarea>
										<p class="ml-1 mt-1"><small><span>0</span>/300</small></p>
										<table class="table table-hover">
											<thead>
												<tr>
													<th scope="col" style="width: 30%">Responsable</th>
													<th scope="col" style="width: 20%">Fecha límite</th>
													<th scope="col">Acciones</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<select class="form-control" id="responsableAcuerdo" name="responsableAcuerdo">
															<option value="0">Seleccionar</option>
														</select>
													</td>
													<td>
														<input type="date" class="form-control" id="inputFechaLimite" name="inputFechaLimite">
													</td>
													<td>
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-success"><i class="icon-floppy text-light"></i></button>
															<button type="button" class="btn btn-secondary"><i class="icon-docs text-light mr-2"></i>Duplicar</button>
															<button type="button" class="btn btn-danger"><i class="icon-trash text-light"></i></button>
														</div>
														<button type="button" class="btn btn-success disabled float-right"><i class="icon-plus text-light"></i></button>
													</td>
												</tr>
											</tbody>
										</table>	
									</div>
								</details>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>