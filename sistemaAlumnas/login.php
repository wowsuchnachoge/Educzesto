<!DOCTYPE html>
<html>

<head>
	<?include("php/includes/head.html");?>
    <title>Login</title>
    <script type="text/javascript" src="js/login.js"></script>
	<link href="../css/login.css" rel="stylesheet" />
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">				
                    <div class="brand_logo_container">
					<a href="http://educzesto.org"><img src="css/img/logo.png" class="brand_logo"></a>
                    </div>            
					<div class="d-flex justify-content-center form_container">
						<!-- Formulario de acceso  -->
						<form action="php/sql/controladores/cntLogin.php" method="POST">
							<?php include("php/includes/loginErrors.php");?>
							<span class="badge bg-danger text-light mb-2" id="alertCamposVacios">Favor de completar los campos vacíos</span>
							<!-- Formulario de acceso -->
							<br>
							<h3 class="font-weight-bold" style="text-align: center;">Plataforma EduCzesto</h3>
							<br>
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
							<button type="submit" class="btn login_btn btn-block text-dark mb-4" id="buttonLogin">Entrar a EduCzesto <i class="icon-login"></i></button>
							<div class="d-flex justify-content-center links">No tienes una cuenta? <a id="buttonRegistro" href="registro.php" class="ml-2">Registrarse</a></div>
							<small class="form-text text-muted text-center " id="linkManual" class="ml-2"><i class="icon-help"></i>Consulta el manual de uso <a href="http://educzesto.org/login/archivos/materialesConsulta/ManualSistemaAlumnas2021.pdf">aquí</a></small>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
</body>

</html>