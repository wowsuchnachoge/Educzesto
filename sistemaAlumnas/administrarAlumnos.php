<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/periodo.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "administrarAlumnos.php";

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
	<link href="css/administrarAlumnos.css" rel="stylesheet" />	
	<script type="text/javascript" src="js/herramientas.js"></script>
</head>
<body>
	<header>
		<?include("php/includes/dynamicHeader.php");?>
	</header>
	<main>
		<div class="container-fluid mt-3 px-4"><br>
			<h1><i class="icon-pencil text-dark mr-2"></i> Administrar alumnos</h1>
			<div class="row d-flex justify-content-center">		
				<div class="col-sm-12 col-lg-10 d-none d-xl-inline">
					<section value="tablaAlumnas" class="my-3">
						<details open>
							<summary>Alumnas</summary>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col" style="width: 30%">Nombre</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
								<!-- Tabla alumnas -->
								<?php foreach($arregloUsuariosAlumnoTodos as $valor){?>
									
									<tr>
										<td>
										<form action="perfil.php" method="POST" class="chip">										
											<img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Person" width="96" height="96"> <!-- para HOMBRE usar https://www.w3schools.com/howto/img_avatar.png -->																			
											<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
											<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
											<button type="submit" class="chip-trans"><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></button>										
										</form>	
										</td>
										<td>											
											<form action="herramientasBitacora.php" method="POST" style="display: inline;">
												<button class="btn btn-light"><i class="icon-book text-dark mr-2"></i> Leer bitácora</button>
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
											</form>
											<div class="btn-group float-center d-lg-none d-xl-block d-xl-none" role="group">
												<form action="herramientasEditar.php" method="POST" style="display: inline;">
													<button type="submit" class="btn btn-danger"><i class="icon-cog text-light"></i></button>
													<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
													<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">

												</form>
											</div>
											<button type="button" class="btn <?php if($valor["vista"] == 1){ echo 'btn-danger';}else{echo 'btn-light';}?> float-right mr-1 buttonVista" data-id_usuario="<?php echo $valor["idUsuario"];?>"><i class="icon-user text-dark mr-2"></i> <?php if($valor["vista"] == 1){ echo 'Desactivar alumna';}else{echo 'Activar alumna';}?></button>
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