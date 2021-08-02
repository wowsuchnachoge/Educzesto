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
				</div>
        </section>
		</div>
	</main>
	<?php include("php/includes/modals.php");?>
</body>
</html>