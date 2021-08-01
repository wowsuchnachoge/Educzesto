<!DOCTYPE html>
<html>
<head>
	<?php include("php/includes/head.html");?>
	<title>Plataforma Educzesto</title>

	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="js/login.js"></script>

</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex">
				<h4 class="text-dark font-weight-bold mx-auto">Plataforma Educzesto</h4>
			</div>
		</div>
	</header>
	<main>
		<div class="container">
			<div class="row mx-2 mt-4 d-flex justify-content-center">
				<div class="col-lg-5">
					<!-- Formulario de acceso  -->
					<form action="php/sql/controladores/cntLogin.php" method="POST" class="w-lg-50 p-3">
						<?php include("php/includes/loginErrors.php");?>
						<span class="badge bg-danger text-light mb-2" id="alertCamposVacios">Favor de completar los campos vacíos</span>
						<!-- Formulario de acceso -->
						<div class="form-group">
							<label for="inputUsuario" class="font-weight-bold">Usuario</label>
							<input type="text" class="form-control" id="inputUsuario" name="inputUsuario" placeholder="Usuario" data-toggle="tooltip" title="Ejemplo: sboleaga">
							<div class="invalid-feedback">Campo vacío.</div>
							<small class="form-text text-muted">La primera letra de tu nombre, seguida de tu apellido.</small>
						</div>
						<div class="form-group mb-4">
							<label for="inputPassword" class="font-weight-bold">Contraseña</label>
							<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Contraseña">
							<div class="invalid-feedback">Campo vacío.</div>
							<small class="form-text text-muted"><b>Ejemplo: </b>1997-05-07</small>
						</div>
						<button type="submit" class="btn btn-primary btn-block text-dark" id="buttonLogin">Entrar</button>
						<a class="btn btn-dark btn-block" id="buttonRegistro" href="registro.php">Registrarse</a>
						<a target="_blank" class="btn btn-info btn-block" href="https://apps.google.com/meet/">Google Meets</a>
						<small class="form-text text-muted text-center" id="linkManual">Consulta el manual de uso <a href="#">aquí</a></small>
					</form>
				</div>
			</div>
		</div>
	</main>
	<!-- Funcionalidad de tooltip -->
	<script type="text/javascript">
		$('[data-toggle="tooltip"]').tooltip();
	</script>
</body>
</html>