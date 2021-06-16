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

	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
	<header class="p-3 bg-primary text-white">
		<div class="container">
			<div class="d-flex">
				<h4 class="text-dark font-weight-bold mx-auto">Plataforma Educzesto</h4>
			</div>
		</div>
	</header>
	<main>
		<div class="container">
			<div class="row mx-2 mt-4 d-flex justify-content-center">
					<form action="sql/controladores/cntLogin.php" method="POST" class="w-lg-50 p-3">
						<?if((isset($_GET["login"]))&&($_GET["login"] == 1)){?>
							<br>
							<div class="alert alert-dismissible alert-success">
							  <strong>Muy bien!</strong> El registro se agregó <a href="#" class="alert-link">correctamente</a>.
							</div>
						<?}?>
						<?if((isset($_GET["login"]))&&($_GET["login"] == 2)){?>
							<br>
							<div class="alert alert-dismissible alert-danger">
							  <strong>Lo sentimos!</strong> El usuario o la contraseña <a href="#" class="alert-link">no son válidos</a>.
							</div>
						<?}?>
						<span class="badge bg-danger text-light mb-2" id="alrtLogin">Favor de completar los campos vacíos</span>
						<div class="form-group">
							<label for="inptUser" class="font-weight-bold">Usuario</label>
							<input type="text" class="form-control" id="inptUser" name="inptUser" placeholder="Usuario" data-toggle="tooltip" title="Ejemplo: sboleaga">
							<div class="invalid-feedback">Campo vacío.</div>
							<small class="form-text text-muted" id="emailHelp">La primera letra de tu nombre, seguida de tu apellido.</small>
						</div>
						<div class="form-group mb-4">
							<label for="inptPassword" class="font-weight-bold">Contraseña</label>
							<input type="password" class="form-control" id="inptPassword" name="inptPassword" placeholder="Contraseña">
							<div class="invalid-feedback">Campo vacío.</div>
							<small class="form-text text-muted" id="emailHelp"><b>Ejemplo: </b>1997-05-07</small>
						</div>
						<button type="submit" class="btn btn-primary btn-block" id="btnLogin">Entrar</button>
						<a class="btn btn-dark btn-block" id="btnRegs" href="registro.html">Registrarse</a>
						<small class="form-text text-muted text-center" id="manualHelp">Consulta el manual de uso <a href="#">aquí</a></small>
						<!-- Mapa del desarrollo -->
						<!-- <a class="btn btn-info btn-block mt-4" href="mapaDesarrollo.html" target="_blank">Mapa</a> -->
					</form>
				</div>

			</div>
		</div>
	</main>
	<script type="text/javascript">
		$('[data-toggle="tooltip"]').tooltip();
	</script>
</body>
</html>