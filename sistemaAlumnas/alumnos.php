<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/plataformas.php");
	include("php/sql/asignacion.php");
	include("php/sql/material.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "alumnos.php";

	$usuario = new Usuario();
	$plataformas = new Plataformas();
	$asignacion = new Asignacion();
	$material = new Material();

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
	<link href="css/alumnos.css" rel="stylesheet" />	
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
							<div class="card-header font-weight-bold"><i class="icon-users text-dark mr-2"></i>Tutores asignados</div>
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
									<form action="perfil.php" method="POST" class="chip mt-3">										
										<img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Person" width="96" height="96"> <!-- para HOMBRE usar https://www.w3schools.com/howto/img_avatar.png -->																			
										<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
										<input type="text" name="idUsuario" value="<?php echo $valor["idUsuario"];?>" style="display: none;">
										<button type="submit" class="chip-trans"><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></button>										
									</form>										
								<?}?>								
							<?}?>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-8">
					</div>
				</div>
			</section>
			<?php }?>
		</div>
	</main>
	<?php if($tipoUsuario != 1){?><?php include("php/includes/modals.php");?><?php }?>
</body>
</html>