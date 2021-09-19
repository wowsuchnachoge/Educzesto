<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/periodo.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "herramientas.php";

	$usuario = new Usuario();
	$periodo = new Periodo();

	$periodoActual = $periodo->consultaPeriodoActual();

	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;

	$arregloUsuariosTutorTodos = $usuario->consultaUsuariosTutorTodos();
	$arregloUsuariosAlumnoTodos = $usuario->consultaUsuariosAlumnoTodos();

	// echo '<pre>'; print_r($arregloUsuariosTutorTodos); echo '</pre>';
	// echo '<pre>'; print_r($arregloUsuariosAlumnoTodos); echo '</pre>';

	$tipoUsuario = (int) $usuario->datosUsuario["tipoUsuario"];
	if(($tipoUsuario != 3)&&($tipoUsuario != 4)) header("Location: login.php?login=3");

	$usuario->cierraBaseDatos();
	$periodo->cierraBaseDatos();

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
	<header>
		<?include("php/includes/dynamicHeader.php");?>
	</header>
	<main>
		<div class="container-fluid mt-3 px-4">
			<div class="row d-flex justify-content-center">
				<div class="col-sm-6 col-lg-2 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block d-lg-inline d-xl-none d-xl-inline mb-3 p-2 rounded bg-light">
				 	<div class="card border-secondary text-dark mb-3" style="max-width: 20rem;">
					  <div class="card-body">
					    <p class="card-text"><i class="icon-user mr-2 text-success"></i>Perfil</p>
					    <p class="card-text"><i class="icon-folder mr-2 text-secondary"></i>Documentos</p>
					    <hr>
					    <p class="card-text"><i class="icon-db-shape mr-2" style="color: #d6d8db;"></i>Periodo actual</p>
					    <hr>
					    <p class="card-text"><i class="icon-up-bold mr-2" style="color: #d6d8db;"></i>Subir perido</p>
					    <p class="card-text"><i class="icon-down-bold mr-2" style="color: #d6d8db;"></i>Bajar periodo</p>
					    <hr>
					    <p class="card-text"><i class="icon-tools mr-2 text-dark"></i>Administrador</p>
					  </div>
					</div>
					<a target="_blank" href="educzesto-mailer/index.html" class="btn btn-dark btn-block" type="button"><i class="icon-mail text-light mr-1"></i>Sistema de correos</a>
					<a href="herramientasCalendarios.php" class="btn btn-dark btn-block" type="button"><i class="icon-calendar text-light mr-1"></i>Editar calendarios</a>
					<!-- <hr> -->
					<!-- <button class="btn btn-dark btn-block" type="button"><i class="icon-archive text-light mr-1"></i>Archivos</button> -->

				</div>
				<div class="col-sm-12 col-lg-10 d-none d-xl-inline">
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
								<!-- Tabla alumnas -->
								<?php foreach($arregloUsuariosAlumnoTodos as $valor){?>
									<tr>
										<td><p><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></p></td>
										<td>
											<form action="perfil.php" method="POST" style="display: inline;">
												<button type="submit" class="btn btn-success"><i class="icon-user text-light"></i></button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
											</form>
											<form action="herramientasArchivos.php" method="POST" style="display: inline;">
												<button class="btn btn-dark">Archivos</button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
											</form>
											<div class="btn-group float-right d-lg-none d-xl-block d-xl-none" role="group">
												<form action="herramientasEditar.php" method="POST" style="display: inline;">
													<button type="submit" class="btn btn-secondary"><i class="icon-cog text-light"></i></button>
													<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
													<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">

												</form>
											</div>
											<button type="button" class="btn <?php if($valor["vista"] == 1){ echo 'btn-dark';}else{echo 'btn-light';}?> float-right mr-1 buttonVista" data-id_usuario="<?php echo $valor["idUsuario"];?>"><?php if($valor["vista"] == 1){ echo 'Desactivar';}else{echo 'Activar';}?></button>
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