<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	<meta http-equiv="x-ua-compatible" content="ie-edge"> 
	<meta name="google" content="notranslate"/> 
	<meta name="description" content="">
	<link rel="icon" type="image/png" href="img/logo.png"/>
	<title>Plataforma Educzesto</title>

	<!-- Frameworks
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" type="text/css" href="css/libscss/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/libscss/entypo/font/entypo.css">
	<link rel="stylesheet" type="text/css" href="css/libscss/tuesday.css"/>
	<link rel="stylesheet" type="text/css" href="css/libscss/vov.css"/>
	<script type="text/javascript" src="js/libsjs/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/libsjs/popper.js"></script>
	<script type="text/javascript" src="js/libsjs/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/inicio.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">

	<style type="text/css">
			.active{
				background-color: #FFCD00 !important;
				border: 0px;
				color: #000 !important;
			}
	</style>
</head>
<?php session_start();?>
<?php if(isset($_SESSION["idUsuario"])){?>
<?php
	include("sql/interactDB.php");

	$baseDatos = new InteractDB();
	$idUsuario  = $_SESSION["idUsuario"];

	$baseDatos->consultaPerfil($idUsuario);
	$baseDatos->cierraDB();
?>
<body>
	<!-- Nav
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<header class="p-3 bg-primary text-white">
		<div class="container">
			<div class="d-flex">
				<p class="mt-2"><i class="icon-user text-dark d-none d-sm-inline"></i>
					<a href="#" class="font-weight-bold text-dark d-none d-sm-inline" data-toggle="modal" data-target="#modalEditarInfo" style="text-decoration:none;"> <?php echo $baseDatos->nombreUsuario?> </a>
					<?php if($baseDatos->tipoUsuario == 1){?><span class="badge badge-light ml-2">ALUMNO</span><?php }?>
					<?php if($baseDatos->tipoUsuario == 2){?><span class="badge badge-light ml-2">TUTOR</span><?php }?>
					<?php if($baseDatos->tipoUsuario == 3){?><span class="badge badge-light ml-2">ADMINISTRADOR</span><?php }?>
				</p>
				<div class="ml-auto">
					<a href="sql/controladores/cntLogout.php" class="btn btn-dark float-right mr-2">
						<i class="icon-logout text-light"></i>
					</a>
					<!-- <a href="#" class="btnNavBar btn btn-outline-dark float-right mr-2 d-none d-lg-block d-xl-none d-xl-block text-dark">Herramientas</a> -->
					<a href="inicio.php" class="btnNavBar btn btn-light float-right mr-2 d-none d-sm-block text-dark mr-4">Inicio</a>
					<a href="minutas.php" class="btnNavBar btn btn-outline-dark me-2 float-right mr-2 d-none d-sm-block text-dark">Minutas</a>
					<a href="materiales.php" class="btnNavBar btn btn-outline-dark me-2 float-right mr-2 d-none d-sm-block text-dark">Materiales</a>
				</div>
			</div>
		</div>
	</header>
	<main>
		<div class="container-fluid">
			<?php include("accesos_.php");?>
			<div class="container mt-2 ml-4">
				
				<a href="perfilFeliza.html" class="btn btn-primary">Feliza Velazquez</a>
			</div>
		</div>
	</main>


	<!-- Modal: perfil
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div id="modalEditarInfo" class="modal fade" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title"><i class="icon-pencil text-dark mr-1"></i>Editar a <strong><?php echo $baseDatos->nombreCompletoUsuario?></strong></p>
					<button type="button" class="close btn_circle btn_sm" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="sql/controladores/cntActUsr.php" method="POST">
						<div class="form-group">
							<label for="inptNombre" class="font-weight-bold">Nombre</label>
							<input type="text" class="form-control campoEditarInfo" id="inptNombre" name="inptNombre" maxlength="40" placeholder="<?php echo $baseDatos->nombreUsuario?>">
							<div class="invalid-feedback">Campo vacío.</div>
						</div>
						<details class="mb-4">
							<summary>Apellidos</summary>
							<hr>
							<div class="form-group">
								<label for="inptApellidoPaterno" class="font-weight-bold">Apellido paterno</label>
								<input type="text" class="form-control campoEditarInfo" id="inptApellidoPaterno" name="inptApellidoPaterno" maxlength="40" placeholder="<?php echo $baseDatos->apellidoPaternoUsuario?>">
								<div class="invalid-feedback">Campo vacío.</div>
							</div>
							<div class="form-group">
								<label for="inptApellidoMaterno" class="font-weight-bold">Apellido materno</label>
								<input type="text" class="form-control campoEditarInfo" id="inptApellidoMaterno" name="inptApellidoMaterno" maxlength="40" placeholder="<?php echo $baseDatos->apellidoMaternoUsuario?>">
								<div class="invalid-feedback">Campo vacío.</div>
							</div>
							<hr>
						</details>
						<div class="form-group">
							<label for="inptFechaNacimiento" class="font-weight-bold">Fecha de nacimiento</label>
							<input type="date" class="form-control campoEditarInfo" id="inptFechaNacimiento" name="inptFechaNacimiento" value="<?php echo $baseDatos->fechaNacimientoUsuario?>">
							<div class="invalid-feedback">Campo sin modificar.</div>
						</div>

						<div data-genero="<?php echo $baseDatos->generoUsuario?>" style="display: none;" id="generoUsuarioDB"></div>

						<div class="form-group">
							<label for="generoUsuario" class="font-weight-bold">Género</label>
							<select class="form-control campoEditarInfo" id="generoUsuario" name="generoUsuario">
								<option value="1">Femenino</option>
								<option value="2">Masculino</option>
							</select>
						</div>

						<details>
							<summary>Contacto</summary>
							<hr>
							<div class="form-group">
								<label for="inptEmail" class="font-weight-bold">Email</label>
								<input type="mail" class="form-control campoEditarInfo" id="inptEmail" name="inptEmail" maxlength="40" placeholder="<?php echo $baseDatos->emailUsuario?>">
							</div>

							<div class="form-group mt-4">
								<label for="inptTel" class="font-weight-bold">Celular</label>
								<input type="tel" class="form-control campoEditarInfo" id="inptTel" name="inptTel" maxlength="20" placeholder="<?php echo $baseDatos->telefonoUsuario?>">
								<div class="invalid-feedback">Campo vacío.</div>
							</div>
							<hr>
						</details>
					<span class="badge bg-primary float-right">Puedes cambiar tus datos y al finalizar guardarlos.</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-success" id="btnModalPerfilGuardar" disabled>Guardar</button>
				</div>
				<input type="text" name="id" value="<?php echo $idUsuario?>" style="display: none;">
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php }else{?>
	<div class="container">
		<div class="d-flex justify-content-center mt-4">	
			<div class="alert alert-dismissible alert-danger">
				<strong>Lo sentimos</strong>, la página que intentas buscar no existe.
			</div>
		</div>	
	</div>
<?php }?>