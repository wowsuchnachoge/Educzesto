<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/plataformas.php");
	include("php/sql/asignacion.php");
	include("php/sql/material.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "inicio.php";

	$usuario = new Usuario();
	$plataformas = new Plataformas();
	$asignacion = new Asignacion();
	$material = new Material();


	// Undefined index: datosUsuarioActivo in /home/vlm0dijktjmb/public_html/login/herramientas.php on line 16
	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;

	$tipoUsuario = $_SESSION["datosUsuarioActivo"]["tipoUsuario"];
	$idUsuario = $_SESSION["datosUsuarioActivo"]["idUsuario"];

	$arregloUsuariosAlumnoTodos = $usuario->consultaUsuariosAlumnoTodos();
	$consultaUsuariosTutorTodos = $usuario->consultaUsuariosTutorTodosInicio();

	$arregloTutoresAsignados = array();
	$arregloAlumnasAsignadas = array();

 	if($tipoUsuario == 1){
 		// Para usuarios alumnos
 		 $fila = $asignacion->consultaAsignacionAlumnas($idUsuario);
		foreach ($fila as $value){
			array_push($arregloTutoresAsignados,(int) $value["idUsuarioTutor"]);
		} 

		$listaMateriales = $material->consultaMaterialUsuarioIdAlumnasInicio($idUsuario);
 	}
	else{
		// Para usuarios tutores
		$fila = $asignacion->consultaAsignacionTodos($idUsuario);
		foreach ($fila as $value){
			array_push($arregloAlumnasAsignadas,(int) $value["idUsuarioAlumno"]);
		} 
		
		$listaMateriales = $material->consultaMaterialUsuarioIdInicio($idUsuario);
	} 


	$arregloPlataformas = $plataformas->consultaPlataformas();

	$usuario->cierraBaseDatos();
	$plataformas->cierraBaseDatos();
	$asignacion->cierraBaseDatos();
	$material->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("php/includes/head.html");?>
	<title>Inicio</title>

	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="js/inicio.js"></script>
</head>
<body>
	<header>
		<?php include("php/includes/dynamicHeader.php");?>
	</header>
	<main>
		<div class="container">
			<?php if($tipoUsuario == 1){?>
			<section value="linksAlumno" class="mt-3">
				<div class="row mb-3">
					<div class="col-sm-12 col-lg-4 border-right">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-users text-dark mr-2"></i>Totores asignados</div>
							<div class="card-body">
								<details>
									<summary>Lista de tutores</summary>
									<br>
									<?php foreach($consultaUsuariosTutorTodos as $valor){?>
										<?php if(in_array($valor["idUsuario"], $arregloTutoresAsignados)){?>
											<form action="perfil.php" method="POST">
												<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
												<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
												<button type="submit" class="btn btn-dark btn-block mb-2"><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></button>
											</form>
										<?}?>
									<?}?>
								</details>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-8">
						<div class="card mb-3">
							<div class="card-header"><i class="icon-folder text-dark mr-2"></i>Material para <strong><?php echo $_SESSION["datosUsuarioActivo"]["nombreCompleto"];?></strong></div>
							<div class="card-body">
								<?php foreach($listaMateriales as $valor){?>
								<div class="row">
									<div class="col"><p><i class="icon-newspaper text-dark"></i><?php echo $valor["nombre"];?></p></div>
									<div class="col mt-2">
										<?php if($valor["flagLink"] == 1){?>
										<a href="<?php echo "https://".$valor["url"];?>" type="button" data-id_material="<?php echo $valor['idMaterial'];?>" class="btn <?php if($valor['estado'] == 0)echo 'btn-secondary'; else echo 'btn-success';?> float-right ml-1 buttonMaterialEstado" target="_blank"><i class="icon-link text-light"></i></a><?php }?>
										<?php if($valor["flagMaterial"] == 1){?>
										 <a href="<?php echo 'archivos/'.$valor['idMaterial'].'.pdf';?>" type="button" data-id_material="<?php echo $valor['idMaterial'];?>" class="btn <?php if($valor['estado'] == 0)echo 'btn-secondary'; else echo 'btn-success';?> float-right buttonMaterialEstado"><i class="icon-newspaper text-light"></i></a><?php }?>
									</div>
								</div>
								<hr>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php }else{ ?>
			<section value="linksTutor" class="mt-3">
				<div class="row mb-3">
					<div class="col-sm-12 col-lg-4 border-right">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-users text-dark mr-2"></i>Alumnas asignadas</div>
							<div class="card-body">
							<?php foreach($arregloUsuariosAlumnoTodos as $valor){?>
								<?php if(in_array($valor["idUsuario"], $arregloAlumnasAsignadas)){?>
									<form action="perfil.php" method="POST">
										<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
										<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
										<button type="submit" class="btn btn-dark btn-block mb-2"><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></button>
									</form>
								<?}?>
							<?}?>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-8">
						<div class="card mb-3">
							<div class="card-header"><i class="icon-folder text-dark mr-2"></i>Material para <strong><?php echo $_SESSION["datosUsuarioActivo"]["nombreCompleto"];?></strong></div>
							<div class="card-body">
							<details>
							<summary>Lista de archivos</summary>
							<br>
								<?php foreach($listaMateriales as $valor){?>
								<div class="row">
									<div class="col"><p><i class="icon-newspaper text-dark"></i><?php echo $valor["nombre"];?></p></div>
									<div class="col mt-2">
										<?php if($valor["flagLink"] == 1){?>
										<a href="<?php echo "https://".$valor["url"];?>" type="button" class="btn btn-secondary float-right ml-1" target="_blank"><i class="icon-link text-light"></i></a><?php }?>
										<?php if($valor["flagMaterial"] == 1){?>
										 <a href="<?php echo 'archivos/'.$valor['idMaterial'].'.pdf';?>" type="button" class="btn btn-secondary float-right" target="_blank"><i class="icon-newspaper text-light"></i></a><?php }?>
									</div>
								</div>
								<hr>
								<?php }?>
							</details>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section value="accesosTutor" class="d-none d-lg-inline d-xl-none d-none d-xl-inline">
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
										<span class="badge rounded-pill bg-warning text-dark" style="font-size: 14px;">Puedes encontrar las guías disponibles en <br><br><a href="materialesConsulta.php">Biblioteca/Manejo de plataformas</a></span>
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
			<?php }?>
		</div>
	</main>
	<?php if($tipoUsuario != 1){?><?php include("php/includes/modals.php");?><?php }?>
</body>
</html>