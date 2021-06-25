<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	// include("php/sql/usuario.php");
	include("php/sql/plataformas.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "inicio.php";

	$plataformas = new Plataformas();
	$arregloPlataformas = $plataformas->consultaPlataformas();
	$plataformas->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("php/includes/head.html");?>
	<title>Inicio</title>

	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<!-- <script type="text/javascript" src="js/inicio.js"></script> -->
</head>
<body>
	<header>
		<?php include("php/includes/dynamicHeader.php");?>
	</header>
	<main>
		<div class="container">
			<section value="notificaciones" class="mt-3 border-bottom">
				<div class="alert alert-secondary alert-dismissible" role="alert">
				  <span type="button" class="close" data-dismiss="alert"><span>&times;</span></span>
				  <strong>Notificación de Lucía y Jorge:</strong> Still on beta stage.
				</div>
				<details class="mb-3">
					<br>
					<summary>Acuerdos semanales</summary>
					<div class="alert alert-success" role="alert">
					  <strong>Minuta semanal:</strong> Still on beta stage.
					</div>
					<div class="alert alert-success" role="alert">
					  <strong>Minuta semanal:</strong> Still on beta stage.
					</div>
				</details>
			</section>
			<section value="links" class="mt-3">
				<div class="row mb-3">
					<div class="col-sm-12 col-lg-4 border-right">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-users text-dark mr-2"></i>Alumnas asignadas</div>
							<div class="card-body">
								<button type="button" class="btn btn-secondary btn-block">Alumna 1</button>
								<button type="button" class="btn btn-secondary btn-block">Alumna 2</button>
								<button type="button" class="btn btn-secondary btn-block">Alumna 3</button>
								<button type="button" class="btn btn-secondary btn-block">Alumna 4</button>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-8">
						<div class="card mb-3">
							<div class="card-header"><i class="icon-folder text-dark mr-2"></i>Material para <strong><?php echo $_SESSION["datosUsuarioActivo"]["nombreCompleto"];?></strong></div>
							<div class="card-body">
								<details open>
									<summary>Lecturas</summary>
									<!-- <a href="materiales/planTrabajo.docx">planTrabajo.docx</a> -->
									<a href="materiales/planTrabajo.docx" class="btn btn-info btn-sm ml-4 my-2"><i class="icon-newspaper mr-2"></i>planTrabajo.docx</a>
								</details>
								<details>
									<summary>Plantillas</summary>
								</details>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section value="accesos" class="d-none d-lg-inline d-xl-none d-none d-xl-inline">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-globe text-dark mr-2"></i>Plataformas</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Plataforma</th>
								<th scope="col" style="width: 40%">Información</th>
								<th scope="col">Usuario</th>
								<th scope="col">Contraseña</th>
								<th scope="col">Acceso</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($arregloPlataformas as $valor){?>
							<tr>
								<td><p><em><?echo ucfirst($valor["plataforma"]);?></em></p></td>
								<td>
									<details>
										<summary>Datos de la plataforma</summary>
										<hr>
										<p class="text-justify"><?echo $valor["descripcion"];?></p>
									</details>
								</td>
								<td><p><?echo $valor["usuario"];?></p></td>
								<td><span class="badge rounded-pill bg-dark text-light"><?echo $valor["passwordPlataforma"];?></span></td>
								<td>
									<a href="https:<?echo $valor["link"];?>" target="_blank" class="btn btn-dark btn-sm">Acceder</a>
								</td>
							</tr>
						<?}?> 
						</tbody>
					</table>	
				</div>
				
			</section>
		</div>
	</main>
	<?php include("php/includes/modals.php");?>
</body>
</html>