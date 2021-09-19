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
		<script type="text/javascript" src="js/plataformas.js"></script>
		<link href="css/plataformas.css" rel="stylesheet" />
	</header>
	<main>
		<div class="container">
            <br>
			<section value="accesos" class="d-lg-inline d-xl-inline">
				<div class="mb-3">
					<div class="card-header font-weight-bold"><i class="icon-globe text-dark mr-2"></i>Plataformas</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col"> </th>
								<th scope="col">Plataforma</th>
								<th scope="col" style="width: 40%">Información sobre esta plataforma</th>
								<th scope="col">Usuario</th>
								<th scope="col">Contraseña</th>
								<th scope="col"> </th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($arregloPlataformas as $valor){?>
							<tr>
								<td><p><i class="icon-facebook text-dark"></i></p></td>
								<td><p><?echo ucfirst($valor["plataforma"]);?></p></td>
								<td><p class="text-justify" style="font-size: xx-small;"><?echo $valor["descripcion"];?></p></td>
								<td><p><?echo $valor["usuario"];?></p></td>
								<td>
								<button class="badge rounded-pill bg-white text-dark" onclick="myFunction()">Ver contraseña</button>
								<div id="myDIV">
								<span class="badge rounded-pill bg-white text-dark" hidden><?echo $valor["passwordPlataforma"];?></span>
								</div>
							    </td>
								<td>
									<a href="https:<?echo $valor["link"];?>" target="_blank" class="btn btn-success btn-sm rounded-pill">Acceder <i class="icon-mouse text-light"></i</a>
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