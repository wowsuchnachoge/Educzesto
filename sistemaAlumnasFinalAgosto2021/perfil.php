<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/includes/cleanText.php");

	$tituloArchivo = "perfil.php";

	$usuario = new Usuario();

	$idUsuario = (int) $_POST["idUsuario"];
	$tipoUsuario = $usuario->consultaTipoUsuario($idUsuario);

	if($tipoUsuario == 1) $datosPerfil = $usuario->consultaUsuariosAlumno($idUsuario);
	else $datosPerfil = $usuario->consultaUsuariosTutor($idUsuario);
	// echo '<pre>'; print_r($datosPerfil); echo '</pre>';

	// Username
	$letraInicial 		= $datosPerfil["nombre"][0];
	$apellido 	  		= substr($datosPerfil["apellidoPaterno"], 0);
	$nombreUsuario = strtolower($letraInicial.$apellido);

	$usuario->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Perfil</title>
</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="<?php echo $_POST["tituloArchivo"];?>" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
					Volver
				</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container mt-3">
			<?php if($tipoUsuario == 1){?>
			<section value="perfilUsuarioAlumno">
				<div class="row">
					<div class="col">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-vcard text-dark mr-2"></i>Perfil<span class="badge bg-warning ml-2 float-right">Alumna</span></div>
							<div class="card-body">
								<table class="table table-hover">
									<tr>
										<th>Nombre:</th>
										<td><?php echo $datosPerfil["nombre"]." ".$datosPerfil["apellidoPaterno"]." ".$datosPerfil["apellidoMaterno"];?></td>
									</tr>
									<tr>
										<th>Teléfono:</th>
										<td><?php echo $datosPerfil["telefono"];?></td>
									</tr>
									<tr class="bg-primary text-dark">
										<th>Usuario:</th>
										<td><p><strong><?php echo $nombreUsuario;?></strong></p></td>
									</tr>
									<tr class="bg-primary text-dark">
										<th>Fecha de nacimiento:</th>
										<td><p><strong><?php echo $datosPerfil["fechaNacimiento"];?></strong></p></td>
									</tr>
									<tr>
										<th>Correo:</th>
										<td><p><?php echo $datosPerfil["email"];?></p></td>
									</tr>
									<tr>
										<th>Información:</th>
										<td><p><?php echo $datosPerfil["infoContacto"];?></p></td>
									</tr>
									<tr>
										<th>Trabajo actual:</th>
										<td><p><?php if($datosPerfil["trabajoActual"] == 1){echo "Empleada doméstica";}else echo "Otros";?></p></td>
									</tr>
									<tr>
										<th>Zona de trabajo:</th>
										<td><p><?php echo $datosPerfil["zonaTrabajo"];?></p></td>
									</tr>
									<tr>
										<th>Nivel de estudios:</th>
										<td><p><?php 
											if($datosPerfil["nivelEstudiosCompletados"] == 1)echo "Primaria";
											if($datosPerfil["nivelEstudiosCompletados"] == 2)echo "Secundaria";
											if($datosPerfil["nivelEstudiosCompletados"] == 3)echo "Preparatoria";
											?>
										</p></td>
									</tr>
									<tr>
										<th>Nivel de estudios:<br><span class="badge bg-primary">diagnosticado</span></th>
										<td><p><?php 
											if($datosPerfil["nivelDiagnosticado"] == 1)echo "Primaria";
											if($datosPerfil["nivelDiagnosticado"] == 2)echo "Secundaria";
											if($datosPerfil["nivelDiagnosticado"] == 3)echo "Preparatoria";
											?>
										</p></td>
									</tr>
									<tr>
										<th>Motivador:</th>
										<td><p><?php echo $datosPerfil["motivador"];?></p></td>
									</tr>
									<tr>
										<th>Intereses:</th>
										<td><p><?php echo $datosPerfil["intereses"];?></p></td>
									</tr>
									<tr>
										<th>Técnicas de contacto:</th>
										<td><p><?php echo $datosPerfil["tecnicasContacto"];?></p></td>
									</tr>
									<tr>
										<th>Nivel de comunicación:</th>
										<td><p><?php 
											if($datosPerfil["nivelComunicacion"] == 1)echo "Alta";
											if($datosPerfil["nivelComunicacion"] == 2)echo "Media";
											if($datosPerfil["nivelComunicacion"] == 3)echo "Baja";
											?>
										</p></td>
									</tr>
									<tr>
										<th>Nivel de conciencia de su entorno:</th>
										<td><p><?php 
											if($datosPerfil["nivelConciencia"] == 1)echo "Alta";
											if($datosPerfil["nivelConciencia"] == 2)echo "Media";
											if($datosPerfil["nivelConciencia"] == 3)echo "Baja";
											?>
										</p></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-user text-dark mr-2"></i>Personalidad</div>
							<div class="card-body">
								<div class="list-group">
									<?php $personalidad = explode(",",$datosPerfil["personalidad"]); ?>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("1",$personalidad)) echo'bg-secondary text-light';?>">Reservada</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("2",$personalidad)) echo'bg-secondary text-light';?>">Sumisa</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("3",$personalidad)) echo'bg-secondary text-light';?>">Seria</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("4",$personalidad)) echo'bg-secondary text-light';?>">Introvertida</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("5",$personalidad)) echo'bg-secondary text-light';?>">Confiada</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("6",$personalidad)) echo'bg-secondary text-light';?>">Metódica</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("7",$personalidad)) echo'bg-secondary text-light';?>">Conservadora</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("8",$personalidad)) echo'bg-secondary text-light';?>">Dependiente</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("9",$personalidad)) echo'bg-secondary text-light';?>">Relajada</a>

								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("10",$personalidad)) echo'bg-secondary text-light';?>">Extrovertida</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("11",$personalidad)) echo'bg-secondary text-light';?>">Dominante</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("12",$personalidad)) echo'bg-secondary text-light';?>">Entusiasta</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("13",$personalidad)) echo'bg-secondary text-light';?>">Extrovertida</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("14",$personalidad)) echo'bg-secondary text-light';?>">Suspicaz</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("15",$personalidad)) echo'bg-secondary text-light';?>">Creativa</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("16",$personalidad)) echo'bg-secondary text-light';?>">Curiosa</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("17",$personalidad)) echo'bg-secondary text-light';?>">Autosuficiente</a>
								  <a href="#" class="list-group-item list-group-item-action <?php if(in_array("18",$personalidad)) echo'bg-secondary text-light';?>">Tensa</a>
								</div>
							</div>
						</div>
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-feather text-dark mr-2"></i>Notas</div>
							<div class="card-body">
								<p class="text-justify"><?php echo $datosPerfil["notas"];?></p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php  }else{?>
			<section value="perfilUsuarioTutor">
				<div class="row">
					<div class="col">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-vcard text-dark mr-2"></i>Perfil<span class="badge bg-warning ml-2 float-right">Tutor</span></div>
							<div class="card-body">
								<table class="table table-hover">
									<tr>
										<th>Nombre:</th>
										<td><p><?php echo $datosPerfil["nombre"]." ".$datosPerfil["apellidoPaterno"]." ".$datosPerfil["apellidoMaterno"];?></p></td>
									</tr>
									<tr>
										<th>Teléfono:</th>
										<td><p><?php echo $datosPerfil["telefono"];?></p></td>
									</tr>
									<tr>
										<th>Correo:</th>
										<td><p><?php echo $datosPerfil["email"];?></p></td>
									</tr>
									<tr>
										<th>Información:</th>
										<td><p><?php echo $datosPerfil["infoContacto"];?></p></td>
									</tr>
									<tr class="bg-primary text-dark">
										<th>Usuario:</th>
										<td><p><strong><?php echo $nombreUsuario;?></strong></p></td>
									</tr>
									<tr class="bg-primary text-dark">
										<th>Fecha de nacimiento:</th>
										<td><p><strong><?php echo $datosPerfil["fechaNacimiento"];?></strong></p></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php  }?>
<!-- 			<section value="documentosUsuario">			
				<div class="card mt-2">
					<div class="card-header font-weight-bold"><i class="icon-folder text-dark mr-2"></i>Documentos</div>
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col" style="width: 80%">Nombre</th>
									<th scope="col">Acción</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><span class="badge rounded-pill bg-dark text-light">Ejemplo.pdf</span></td>
									<td>
										<button type="button" class="btn btn-secondary"><i class=" icon-download text-light mr-2"></i>Descargar</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</section> -->
		</div>
	</main>
</body>
</html>