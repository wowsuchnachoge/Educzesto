<!DOCTYPE html>
<html>
<head>
	<?php include("php/includes/head.html");?>
	<title>Registro</title>

	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="js/registro.js"></script>

</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="index.php" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
				</a>
				<h4 class="font-weight-bold">Registro</h4>
			</div>
		</div>
	</header>
	<main>
	<div class="container">
		<div class="row mx-2 my-4">
			<div class="col">
				<!-- Formulario de registro  -->
				<form action="php/sql/controladores/cntRegistro.php" method="POST">
					<div class="alert alert-dismissible alert-secondary">
						Si estás realizando tu servicio con nosotros, selecciona <a href="#" class="alert-link">"Tutor"</a>.
					</div>
					<div class="form-group">
						<label for="inputTipoUsuario" class="font-weight-bold">Tipo de usuario</label>
						<select class="form-control" id="inputTipoUsuario" name="inputTipoUsuario">
							<option value="1">Alumno(a)</option>
							<option value="2">Tutor</option>
						</select>
					</div>
					<hr>
					<div class="form-group alumno tutor">
						<label for="inputNombre" class="font-weight-bold">Nombre</label>
						<input type="text" class="form-control" id="inputNombre" name="inputNombre" maxlength="40">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor">
						<label for="inputApellidoPaterno" class="font-weight-bold">Apellido paterno</label>
						<input type="text" class="form-control" id="inputApellidoPaterno" name="inputApellidoPaterno" maxlength="40">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor">
						<label for="inputApellidoMaterno" class="font-weight-bold">Apellido materno</label>
						<input type="text" class="form-control" id="inputApellidoMaterno" name="inputApellidoMaterno" maxlength="40">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputFechaNacimiento" class="font-weight-bold">Fecha de nacimiento</label>
						<input type="date" class="form-control" id="inputFechaNacimiento" name="inputFechaNacimiento">
						<div class="invalid-feedback">Campo sin modificar.</div>
						<small id="FechaNacimientoInfo" class="form-text text-muted">Esta será su contraseña para acceder al sistema.</small>
					</div>
					<div class="form-group alumno tutor">
						<label for="generoUsuario" class="font-weight-bold">Género</label>
						<select class="form-control" id="generoUsuario" name="generoUsuario">
							<option value="1">Femenino</option>
							<option value="2">Masculino</option>
						</select>
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputEmail" class="font-weight-bold">Email</label>
						<input type="mail" class="form-control" id="inputEmail" name="inputEmail" maxlength="40">
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputPhone" class="font-weight-bold">Celular</label>
						<input type="tel" class="form-control" id="inputPhone" name="inputPhone" maxlength="20">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputContacto" class="font-weight-bold">Contacto</label>
						<input type="text" class="form-control" id="inputContacto" name="inputContacto" maxlength="80">
						<small id="contactoInfo" class="form-text text-muted">Por favor proporcionanos un número telefónico o algún correo alternativo en el cual podamos mantener comunicación contigo.</small>
					</div>
					<div class="form-group alumno">
					<label for="inputTrabajoActual" class="font-weight-bold">Trabajo actual</label>
					<select class="form-control" id="inputTrabajoActual" name="inputTrabajoActual">
						<option value="1">Empleada doméstica</option>
						<option value="2">Otro</option>
					</select>
					</div>
					<div class="form-group alumno mt-4">
						<label for="inputZonaTrabajo" class="font-weight-bold">Zona de trabajo</label>
						<input type="text" class="form-control" id="inputZonaTrabajo" name="inputZonaTrabajo" maxlength="80">
					</div>
					<div class="form-group alumno">
						<label for="inputNivelEstudios" class="font-weight-bold">Nivel de estudios</label>
						<select class="form-control" id="inputNivelEstudios" name="inputNivelEstudios">
							<option value="1">Primaria</option>
							<option value="2">Secundaria</option>
							<option value="3">Preparatoria</option>
						</select>
					</div>
					<div class="form-group alumno">
						<label for="inputNivelEstudiosDiagnostico" class="font-weight-bold">Nivel de estudios <span class="badge bg-primary">diagnosticado</span></label>
						<select class="form-control" id="inputNivelEstudiosDiagnostico" name="inputNivelEstudiosDiagnostico">
							<option value="1">Primaria</option>
							<option value="2">Secundaria</option>
							<option value="3">Preparatoria</option>
						</select>
						<small class="form-text text-muted" id="guiasHelp">Consulta las guías de diagnóstico en <span class="font-weight-bold">Biblioteca/Diagnósticos</span></small>
					</div>
					<div class="form-group alumno mt-4">
						<label for="inputMotivo" class="font-weight-bold">¿Tienes alguna motivación que te gustaría compartirnos?</label>
						<input type="text" class="form-control" id="inputMotivo" name="inputMotivo" maxlength="280">
					</div>
					<div class="form-group alumno mt-4">
						<label for="inputIntereses" class="font-weight-bold">¿Cuáles son tus intereses?</label>
						<input type="text" class="form-control" id="inputIntereses" name="inputIntereses" maxlength="280">
					</div>
					<div class="form-group mt-4 alumno">
						<label for="inputIncentivos" class="font-weight-bold">¿Cómo podríamos incentivarte a realizar las actividades?</label>
						<input type="text" class="form-control" id="inputIncentivos" name="inputIncentivos" maxlength="280">
					</div>
					<details class="alumno">
						<summary>Comunicación y conciencia</summary>
						<div class="form-group alumno mt-4">
							<label for="inputNivelComunication" class="font-weight-bold">Nivel de comunicación</label>
							<select class="form-control" id="inputNivelComunication" name="inputNivelComunication">
								<option value="1">Alta</option>
								<option value="2">Media</option>
								<option value="3">Baja</option>
							</select>
						</div>
						<div class="form-group alumno">
							<label for="inputNivelConciencia" class="font-weight-bold">Nivel de conciencia</label>
							<select class="form-control" id="inputNivelConciencia" name="inputNivelConciencia">
								<option value="1">Alta</option>
								<option value="2">Media</option>
								<option value="3">Baja</option>
							</select>
						</div>
					</details>
					<div class="form-group alumno">
						<label for="inputSelectorPersonalidad" class="form-label mt-4 font-weight-bold">¿Cómo definirías tu personalidad?</label>
						<select id="inputSelectorPersonalidad" name="inputSelectorPersonalidad[]" size="18" multiple="MULTIPLE" class="form-select w-100" style="height: 300px;">
							<option value="1"> Reservada </option>
							<option value="2"> Sumisa </option>
							<option value="3"> Seria </option>
							<option value="4"> Introvertida </option>
							<option value="5"> Confiada </option>
							<option value="6"> Metódica </option>
							<option value="7"> Conservadora </option>
							<option value="8"> Dependiente </option>
							<option value="9"> Relajada </option>
							<option value="10"> Extrovertida </option>
							<option value="11"> Dominante </option>
							<option value="12"> Entusiasta </option>
							<option value="13"> Extrovertida </option>
							<option value="14"> Suspicaz </option>
							<option value="15"> Creativa </option>
							<option value="16"> Curiosa </option>
							<option value="17"> Autosuficiente </option>
							<option value="18"> Tensa </option>
						</select>
						<small class="form-text text-muted">Puedes seleccionar varios atributos manteniendo presionada la tecla <strong>CTRL</strong>.</small>
					</div>
					<div class="form-group alumno">
						<label for="inputNotas" class="form-label mt-4">Notas adicionales</label>
						<textarea class="form-control" id="inputNotas" name="inputNotas" rows="4"></textarea>
					</div>
					<hr>
					<span class="badge bg-danger text-light mb-2" id="alertRegistro">Favor de completar los campos vacíos</span><br>
					<button type="submit" class="btn btn-primary text-dark" id="buttonRegistro">Registrarse</button>
					<a class="btn btn-dark" href="login.php">Cancelar</a>
				</form>
			</div>
		</div>
	</div>
	</main>
</body>
</html>