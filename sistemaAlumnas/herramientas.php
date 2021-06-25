<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "herramientas.php";

	$usuario = new Usuario();
	$arregloUsuariosTutorTodos = $usuario->consultaUsuariosTutorTodos();
	// echo '<pre>'; print_r($arregloUsuariosTutorTodos); echo '</pre>';
	$usuario->cierraBaseDatos();

?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Herramientas</title>
</head>
<body>
	<header>
		<?include("php/includes/dynamicHeader.php");?>
	</header>
	<main>
		<div class="container-fluid mt-3 px-4">
			<div class="row d-flex justify-content-center">
				<div class="col-sm-6 col-lg-2 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block d-lg-inline d-xl-none d-xl-inline mb-3 p-2 rounded bg-light">
					<button class="btn btn-dark btn-block" type="button"><i class="icon-megaphone text-light mr-1"></i>Mandar aviso</button>
					<hr>
					<button class="btn btn-secondary btn-block" type="button"><i class="icon-calendar text-light mr-1"></i>Editar calendario</button>
					<button class="btn btn-secondary btn-block" type="button"><i class="icon-globe text-light mr-1"></i>Editar plataformas</button>
					<button class="btn btn-secondary btn-block" type="button"><i class="icon-tag text-light mr-1"></i>Editar categorías</button>
				 	<hr>
					<button class="btn btn-dark btn-block" type="button"><i class="icon-mail text-light mr-1"></i>Sistema de correos</button>
					<hr>
					<button class="btn btn-dark btn-block" type="button"><i class="icon-archive text-light mr-1"></i>Archivos</button>

				</div>
				<div class="col-sm-12 col-lg-10 d-none d-lg-inline d-xl-none d-none d-xl-inline">
					<section value="tablaAlumnas" class="my-3">
						<details close>
							<summary>Alumnas</summary>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col" style="width: 30%">Nombre</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Alumna 1</td>
										<td>
											<a href="perfil.php" class="btn btn-success"><i class="icon-user text-light"></i></a>
											<button class="btn btn-dark">Ver documentos</button>
											<button class="btn btn-dark">Ver archivos</button>
											<div class="btn-group float-right d-lg-none d-xl-block d-xl-none" role="group">
												<button type="button" class="btn btn-secondary"><i class="icon-cog text-light"></i></button>
												<button type="button" class="btn btn-dark">Desactivar</button>
											</div>
										</td>
									</tr>
								</tbody>
							</table>	
						</details>
					</section>
					<section value="tablaTutores">
						<details open>
							<summary>Tutores</summary>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col" style="width: 30%">Nombre</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($arregloUsuariosTutorTodos as $valor){?>
									<tr>
										<td><p><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></p></td>
										<td>
											<form action="perfil.php" method="POST" style="display: inline;">
												<button type="submit" class="btn btn-success"><i class="icon-user text-light"></i></button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
											</form>
											<form action="bitacoraHerramientas.php" method="POST" style="display: inline;">
												<button type="submit" class="btn btn-secondary">Ver bitácora</button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
											</form>
											<form action="documentosHerramientas.php" method="POST" style="display: inline;">
												<button type="submit" class="btn btn-dark">Ver documentos</button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
											</form>
											<form action="archivosHerramientas.php" method="POST" style="display: inline;">
												<button class="btn btn-dark">Ver archivos</button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
											</form>
											<div class="btn-group float-right d-lg-none d-xl-block d-xl-none" role="group">
												<button type="button" class="btn btn-success">Asignar</button>
												<button type="button" class="btn btn-secondary"><i class="icon-cog text-light"></i></button>
												<button type="button" class="btn btn-dark">Desactivar</button>
											</div>
										</td>
									</tr>
								<?}?> 
								</tbody>
							</table>	
						</details>
					</section>


					
				</div>
			</div>
		</div>
	</main>
	<?include("php/includes/modals.php");?>

</body>
</html>