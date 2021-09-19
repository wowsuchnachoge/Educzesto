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
					<section value="tablaTutores">
						<details open>
							<summary>Tutores</summary>
							<table class="table table-hover ">
								<thead>
									<tr>
										<th scope="col" style="width: 25%">Nombre</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
								<!-- Tabla tutores -->
								<?php foreach($arregloUsuariosTutorTodos as $valor){?>
									<tr <?php if($valor["idPeriodo"] == $periodoActual){ echo 'class="table-secondary"';}?>">
										<td><p><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></p></td>
										<td>
											<form action="perfil.php" method="POST" style="display: inline;">
												<button type="submit" class="btn btn-success"><i class="icon-user text-light"></i></button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
											</form>
											<form action="herramientasDocumentos.php" method="POST" style="display: inline;">
												<button type="submit" class="btn btn-dark"><i class="icon-folder text-light"></i></button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
											</form>
											<form action="herramientasBitacora.php" method="POST" style="display: inline;">
												<button type="submit" class="btn btn-secondary">Bitácora</button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
											</form>
												<form action="herramientasArchivos.php" method="POST" style="display: inline;">
													<button type="submit" class="btn btn-dark">Archivos</button>
													<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
													<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
												</form>
												<form action="herramientasAsignar.php?tituloArchivo=<?php echo $tituloArchivo;?>" method="POST" style="display: inline;">
													<button type="submit" class="btn btn-success">Asignar</button>
													<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												</form>
											<button type="button" class="btn <?php if($valor["tipoUsuario"] == 2){ echo 'btn-dark';}else{echo 'btn-warning';}?> float-right mx-1 buttonTipoUsuario" data-id_usuario="<?php echo $valor["idUsuario"];?>"><i class="icon-tools"></i></button>

											<form action="php/sql/controladores/cntEditaPeriodoUsuario.php" method="POST" style="display: inline;">
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="accion" value="1" style="display: none;">
												<button type="submit" class="btn btn-secondary float-right ml-1"><i class="icon-up-bold text-light"></i></button>
											</form>
											<form action="php/sql/controladores/cntEditaPeriodoUsuario.php" method="POST" style="display: inline;">
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="accion" value="0" style="display: none;">
												<button type="submit" class="btn btn-secondary float-right"><i class="icon-down-bold text-light"></i></button>
											</form>
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