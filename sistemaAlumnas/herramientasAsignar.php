<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/asignacion.php");
	include("php/includes/cleanText.php");

	$usuario = new Usuario();
	$asignacion = new Asignacion();

	$idUsuario = (int) $_POST["idUsuario"];
	$usuario->consultaUsuarioId($idUsuario);

	// echo '<pre>'; print_r($usuario->datosUsuario); echo '</pre>';
	$arregloUsuariosAlumnoTodos = $usuario->consultaUsuariosAlumnoTodos();
	$fila = $asignacion->consultaAsignacionTodos($idUsuario);

	$arregloAlumnasAsignadas = array();
	foreach ($fila as $value){
		array_push($arregloAlumnasAsignadas,(int) $value["idUsuarioAlumno"]);
	} 
	// echo '<pre>'; print_r($arregloAlumnasAsignadas); echo '</pre>';
	// echo '<pre>'; var_dump($fila); echo '</pre>';

	$usuario->cierraBaseDatos();
	$asignacion->cierraBaseDatos();

	// var_dump(getcwd());
	// var_dump($_POST["idUsuario"]);
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
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="<?php echo $_GET["tituloArchivo"];?>" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
					Volver
				</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container mt-3">
			<section value="listaAlumnas">
				<div class="row">
					<div class="col-12">
						<div class="card mb-3">
							<div class="card-header font-weight-bold">
								<span><i class="icon-users text-dark mr-2"></i>Alumnas</span>
								<span class="float-right"><span class="badge bg-warning"><?php  echo $usuario->datosUsuario["nombreCompleto"];?></span></span>
							</div>
							<div class="card-body">
								<section value="tablaAlumnas" class="my-3">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col" style="width: 95%">Nombre</th>
												<th scope="col">Acciones</th>
											</tr>
										</thead>
										<tbody>
										<!-- Tabla alumnas -->
										<?php foreach($arregloUsuariosAlumnoTodos as $valor){?>
											<tr>
												<td><p><?echo $valor["nombre"]." ".$valor["apellidoPaterno"]." ".$valor["apellidoMaterno"];?></p></td>
												<td>
													<button type="button" class="btn <?php if(in_array($valor["idUsuario"], $arregloAlumnasAsignadas)){echo 'btn-success';}else{echo 'btn-dark';}?> buttonAsignar" data-id_alumno="<?php echo $valor["idUsuario"];?>" data-id_tutor="<?php echo $idUsuario;?>"><i class="icon-user"></i></button>
												</td>
											</tr>
										<?}?>
										</tbody>
									</table>	
								</section>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>