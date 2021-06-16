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
<?session_start();?>
<?if(isset($_SESSION["idUsuario"])){?>
<?
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
					<a href="#" class="font-weight-bold text-dark d-none d-sm-inline" data-toggle="modal" data-target="#modalEditarInfo" style="text-decoration:none;"> <?echo $baseDatos->nombreUsuario?> </a>
					<?if($baseDatos->tipoUsuario == 1){?><span class="badge badge-light ml-2">ALUMNO</span><?}?>
					<?if($baseDatos->tipoUsuario == 2){?><span class="badge badge-light ml-2">TUTOR</span><?}?>
					<?if($baseDatos->tipoUsuario == 3){?><span class="badge badge-light ml-2">ADMINISTRADOR</span><?}?>
				</p>
				<div class="ml-auto">
					<a href="sql/controladores/cntLogout.php" class="btn btn-dark float-right mr-2">
						<i class="icon-logout text-light"></i>
					</a>
					<!-- <a href="#" class="btnNavBar btn btn-outline-dark float-right mr-2 d-none d-lg-block d-xl-none d-xl-block text-dark">Herramientas</a> -->
					<a href="inicio.php" class="btnNavBar btn btn-outline-dark me-2 float-right mr-2 d-none d-sm-block text-dark">Inicio</a>
					<a href="minutas.php" class="btnNavBar btn btn-outline-dark me-2 float-right mr-2 d-none d-sm-block text-dark">Minutas</a>
					<a href="materiales.php" class="btnNavBar btn btn-light float-right mr-2 d-none d-sm-block text-dark">Materiales</a>
				</div>
			</div>
		</div>
	</header>
	<body>
		<div class="container mt-2">
			<h4>Lecturas</h4>
			<a href="materiales/lecturas/1.pdf" type="button" class="btn btn-link">Balance Anual REDIM 2020</a><br>
			<a href="materiales/lecturas/2.pdf" type="button" class="btn btn-link">BP- El virus de la desigualdad hace necesaria la colaboración y la cooperación</a><br>
			<a href="materiales/lecturas/3.pdf" type="button" class="btn btn-link">La Educación del Mañanapdf</a><br>
			<a href="materiales/lecturas/4.pdf" type="button" class="btn btn-link">PP-ENCOVID-19-Infancia-Jun-Jul-2020</a><br>
			<a href="materiales/lecturas/5.pdf" type="button" class="btn btn-link">Revista RELEE especial COVID</a><br>
			<a href="materiales/lecturas/6.docx" type="button" class="btn btn-link">SEP retrasa cifras sobre deserción escolar 2021</a><br>
			<a href="materiales/lecturas/7.pdf" type="button" class="btn btn-link">Trabajadoras del hogar y discriminación_2018</a><br>
			<a href="materiales/lecturas/8.pdf" type="button" class="btn btn-link">Trabajadoras domésticas_2015</a><br>
			<h4>Diagnósticos</h4>
			<a href="materiales/diagnosticos/1.pdf" type="button" class="btn btn-link">Examen_diagnostico_primer_grado_2020-2021-1</a><br>
			<a href="materiales/diagnosticos/2.pdf" type="button" class="btn btn-link">Examen_diagnostico_segundo_grado_2020-2021-1</a><br>
			<a href="materiales/diagnosticos/3.pdf" type="button" class="btn btn-link">Examen_diagnostico_tercer_grado_2020-2021</a><br>
			<a href="materiales/diagnosticos/4.pdf" type="button" class="btn btn-link">Examen_diagnostico_cuarto_grado_2020-2021</a><br>
			<a href="materiales/diagnosticos/5.pdf" type="button" class="btn btn-link">Examen_diagnostico_quinto_grado_2020-2021</a><br>
			<a href="materiales/diagnosticos/6.pdf" type="button" class="btn btn-link">Examen_diagnostico_sexto_grado_2020-2021</a><br>
			<a href="materiales/diagnosticos/7.pdf" type="button" class="btn btn-link">Matematicas-secu-l1eso-AYUDA-PARA-EL-MAESTRO-BLOG</a><br>
			<a href="materiales/diagnosticos/8.pdf" type="button" class="btn btn-link">Matemticas-secu-2ESO-AYUDA-PARA-EL-MAESTRO-BLOG</a><br>
			<a href="materiales/diagnosticos/9.pdf" type="button" class="btn btn-link">Matemticas-secu-3ESO-AYUDA-PARA-EL-MAESTRO-BLOG</a><br>

		</div>
	</body>

	<!-- Modal: perfil
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div id="modalEditarInfo" class="modal fade" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title"><i class="icon-pencil text-dark mr-1"></i>Editar a <strong><?echo $baseDatos->nombreCompletoUsuario?></strong></p>
					<button type="button" class="close btn_circle btn_sm" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="sql/controladores/cntActUsr.php" method="POST">
						<div class="form-group">
							<label for="inptNombre" class="font-weight-bold">Nombre</label>
							<input type="text" class="form-control campoEditarInfo" id="inptNombre" name="inptNombre" maxlength="40" placeholder="<?echo $baseDatos->nombreUsuario?>">
							<div class="invalid-feedback">Campo vacío.</div>
						</div>
						<details class="mb-4">
							<summary>Apellidos</summary>
							<hr>
							<div class="form-group">
								<label for="inptApellidoPaterno" class="font-weight-bold">Apellido paterno</label>
								<input type="text" class="form-control campoEditarInfo" id="inptApellidoPaterno" name="inptApellidoPaterno" maxlength="40" placeholder="<?echo $baseDatos->apellidoPaternoUsuario?>">
								<div class="invalid-feedback">Campo vacío.</div>
							</div>
							<div class="form-group">
								<label for="inptApellidoMaterno" class="font-weight-bold">Apellido materno</label>
								<input type="text" class="form-control campoEditarInfo" id="inptApellidoMaterno" name="inptApellidoMaterno" maxlength="40" placeholder="<?echo $baseDatos->apellidoMaternoUsuario?>">
								<div class="invalid-feedback">Campo vacío.</div>
							</div>
							<hr>
						</details>
						<div class="form-group">
							<label for="inptFechaNacimiento" class="font-weight-bold">Fecha de nacimiento</label>
							<input type="date" class="form-control campoEditarInfo" id="inptFechaNacimiento" name="inptFechaNacimiento" value="<?echo $baseDatos->fechaNacimientoUsuario?>">
							<div class="invalid-feedback">Campo sin modificar.</div>
						</div>

						<div data-genero="<?echo $baseDatos->generoUsuario?>" style="display: none;" id="generoUsuarioDB"></div>

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
								<input type="mail" class="form-control campoEditarInfo" id="inptEmail" name="inptEmail" maxlength="40" placeholder="<?echo $baseDatos->emailUsuario?>">
							</div>

							<div class="form-group mt-4">
								<label for="inptTel" class="font-weight-bold">Celular</label>
								<input type="tel" class="form-control campoEditarInfo" id="inptTel" name="inptTel" maxlength="20" placeholder="<?echo $baseDatos->telefonoUsuario?>">
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
				<input type="text" name="id" value="<?echo $idUsuario?>" style="display: none;">
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?}else{?>
	<div class="container">
		<div class="d-flex justify-content-center mt-4">	
			<div class="alert alert-dismissible alert-danger">
			  <strong>Lo sentimos</strong>, la página que intentas buscar no existe.
			</div>
		</div>	
	</div>
<?}?>