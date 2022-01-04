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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/perfil.css" rel="stylesheet" />
</head>
<body>
	<header class="bg-warning text-white p-3">
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
							<div class="card">
								<img src=<?php if($datosPerfil["genero"] == 1){echo "https://www.w3schools.com/howto/img_avatar2.png";}else echo "https://www.w3schools.com/howto/img_avatar.png";?> style="width:100%"> 
								<h1><?php echo $datosPerfil["nombre"]." ".$datosPerfil["apellidoPaterno"]." ".$datosPerfil["apellidoMaterno"];?></h1>
								<p class="title"><?php echo $datosPerfil["telefono"];?></p>
								<p style="color: #5DD972;"><b style="font-size: xx-small; color: #5DD972;">NOMBRE DE USUARIO:<br></b><?php echo $nombreUsuario;?></p>	
								<p style="color: #5DD972;"><b style="font-size: xx-small; color: #5DD972;">FECHA DE NACIMIENTO:<br></b><?php echo $datosPerfil["fechaNacimiento"];?></p>
								<p><b style="font-size: xx-small;">TRABAJO ACTUAL:<br></b><?php if($datosPerfil["trabajoActual"] == 1){echo "Empleada doméstica";}else echo "Otros";?></p>
								<p><b style="font-size: xx-small;">INFO CONTACTO:<br></b><?php echo $datosPerfil["infoContacto"];?></p>
								<p><b style="font-size: xx-small;">EMAIL:<br></b><?php echo $datosPerfil["email"];?></p>																																						
								<p><b style="font-size: xx-small;">ZONA DE TRABAJO:<br></b><?php echo $datosPerfil["zonaTrabajo"];?></p>
								<p><b style="font-size: xx-small;">NIVEL ESTUDIOS COMPLETADOS:<br></b> 
									<?php 
										if($datosPerfil["nivelEstudiosCompletados"] == 1)echo "Primaria";
										if($datosPerfil["nivelEstudiosCompletados"] == 2)echo "Secundaria";
										if($datosPerfil["nivelEstudiosCompletados"] == 3)echo "Preparatoria";
									?></p>																																						
								<p><b style="font-size: xx-small;">NIVEL DIAGNÓSTICADO:<br></b>
									<?php 
										if($datosPerfil["nivelDiagnosticado"] == 1)echo "Primaria";
										if($datosPerfil["nivelDiagnosticado"] == 2)echo "Secundaria";
										if($datosPerfil["nivelDiagnosticado"] == 3)echo "Preparatoria";
									?></p>
								<p><b style="font-size: xx-small;">NIVEL DE COMUNICACIÓN:<br></b>
									<?php 
										if($datosPerfil["nivelComunicacion"] == 1)echo "Alta";
										if($datosPerfil["nivelComunicacion"] == 2)echo "Media";
										if($datosPerfil["nivelComunicacion"] == 3)echo "Baja";
									?></p>
								<p><b style="font-size: xx-small;">NIVEL DE CONCIENCIA DE SU ENTORNO:<br></b>
									<?php 
										if($datosPerfil["nivelConciencia"] == 1)echo "Alta";
										if($datosPerfil["nivelConciencia"] == 2)echo "Media";
										if($datosPerfil["nivelConciencia"] == 3)echo "Baja";
									?></p>
								<p><button><b class="text-light" style="font-size: xx-small;">MOTIVADOR:<br></b><?php echo $datosPerfil["motivador"];?></button></p>								
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-user text-dark mr-2"></i>Personalidad</div>
							<div class="card-body">
								<div class="list-group">
									<?php $personalidad = explode(",",$datosPerfil["personalidad"]); ?>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("1",$personalidad)) echo'bg-warning text-light';?>">Reservada</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("2",$personalidad)) echo'bg-warning text-light';?>">Sumisa</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("3",$personalidad)) echo'bg-warning text-light';?>">Seria</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("4",$personalidad)) echo'bg-warning text-light';?>">Introvertida</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("5",$personalidad)) echo'bg-warning text-light';?>">Confiada</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("6",$personalidad)) echo'bg-warning text-light';?>">Metódica</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("7",$personalidad)) echo'bg-warning text-light';?>">Conservadora</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("8",$personalidad)) echo'bg-warning text-light';?>">Dependiente</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("9",$personalidad)) echo'bg-warning text-light';?>">Relajada</a>

								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("11",$personalidad)) echo'bg-warning text-light';?>">Dominante</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("12",$personalidad)) echo'bg-warning text-light';?>">Entusiasta</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("13",$personalidad)) echo'bg-warning text-light';?>">Extrovertida</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("14",$personalidad)) echo'bg-warning text-light';?>">Suspicaz</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("15",$personalidad)) echo'bg-warning text-light';?>">Creativa</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("16",$personalidad)) echo'bg-warning text-light';?>">Curiosa</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("17",$personalidad)) echo'bg-warning text-light';?>">Autosuficiente</a>
								  <a href="#" style="font-size: small;" class="list-group-item list-group-item-action <?php if(in_array("18",$personalidad)) echo'bg-warning text-light';?>">Tensa</a>
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
							<div class="card">
								<img src=<?php if($datosPerfil["genero"] == 1){echo "https://www.w3schools.com/howto/img_avatar2.png";}else echo "https://www.w3schools.com/howto/img_avatar.png";?> style="width:100%"> 
								<h1><?php echo $datosPerfil["nombre"]." ".$datosPerfil["apellidoPaterno"]." ".$datosPerfil["apellidoMaterno"];?></h1>
								<p class="title"><?php echo $datosPerfil["telefono"];?></p>
								<p style="color: #5DD972;"><b style="font-size: xx-small; color: #5DD972;">NOMBRE DE USUARIO:<br></b><?php echo $nombreUsuario;?></p>	
								<p style="color: #5DD972;"><b style="font-size: xx-small; color: #5DD972;">FECHA DE NACIMIENTO:<br></b><?php echo $datosPerfil["fechaNacimiento"];?></p>
								<p><b style="font-size: xx-small;">EMAIL:<br></b><?php echo $datosPerfil["email"];?></p>
								<p><b style="font-size: xx-small;">INFORMACIÓN DE CONTACTO:<br></b><?php echo $datosPerfil["infoContacto"];?></p>
								<!-- <p><button><b class="text-light" style="font-size: xx-small;">MOTIVADOR:<br></b><?php echo $datosPerfil["motivador"];?></button></p>								 -->
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