<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/includes/cleanText.php");

	$usuario = new Usuario();

	$tituloArchivo = "herramientasEditar.php";
	$idUsuario = (int) $_REQUEST['idUsuario'];
	$datosPerfil = $usuario->consultaUsuariosAlumno($idUsuario);

	$usuario->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Herramientas</title>
</head>
<body>
	<header class="bg-warning text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="herramientas.php" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
					Volver
				</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container mt-3">
			<section value="visualizacion">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-tools text-dark mr-2"></i>Editar

						<form action="php/sql/controladores/cntEditaDatosUsuarioAlumno.php" method="POST" style="display: inline;">
							<button type="submit" class="btn btn-success btn-sm float-right mr-2">
								<i class="icon-floppy text-light"></i> Guardar
							</button>

					</div>
					<div class="card-body">
	<!-- Registro
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="container">
		<div class="row mx-2 my-4">
			<div class="col">
					<div class="form-group alumno tutor">
						<label for="inputNombre" class="font-weight-bold">Nombre</label>
						<input type="text" class="form-control" id="inputNombre" name="inputNombre" maxlength="40" value="<?php echo $datosPerfil['nombre'];?>">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor">
						<label for="inputApellidoPaterno" class="font-weight-bold">Apellido paterno</label>
						<input type="text" class="form-control" id="inputApellidoPaterno" name="inputApellidoPaterno" maxlength="40" value="<?php echo $datosPerfil['apellidoPaterno'];?>">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor">
						<label for="inputApellidoMaterno" class="font-weight-bold">Apellido materno</label>
						<input type="text" class="form-control" id="inputApellidoMaterno" name="inputApellidoMaterno" maxlength="40" value="<?php echo $datosPerfil['apellidoMaterno'];?>">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputFechaNacimiento" class="font-weight-bold">Fecha de nacimiento</label>
						<input type="date" class="form-control" id="inputFechaNacimiento" name="inputFechaNacimiento" value="<?php echo $datosPerfil['fechaNacimiento'];?>">
						<div class="invalid-feedback">Campo sin modificar.</div>
						<small id="FechaNacimientoInfo" class="form-text text-muted">Esta será su contraseña para acceder al sistema.</small>
					</div>
					<div data-gen="<?php echo $datosPerfil['genero'];?>" style="display: none;" id="genDB"></div>
					<div class="form-group alumno tutor">
						<label for="generoUsuario" class="font-weight-bold">Género</label>
						<select class="form-control genUsuario" id="generoUsuario" name="generoUsuario">
							<option value="1">Femenino</option>
							<option value="2">Masculino</option>
						</select>
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputEmail" class="font-weight-bold">Email</label>
						<input type="mail" class="form-control" id="inputEmail" name="inputEmail" maxlength="40" value="<?php echo $datosPerfil['email'];?>">
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputPhone" class="font-weight-bold">Celular</label>
						<input type="tel" class="form-control" id="inputPhone" name="inputPhone" maxlength="20" value="<?php echo $datosPerfil['telefono'];?>">
						<div class="invalid-feedback">Campo vacío.</div>
					</div>
					<div class="form-group alumno tutor mt-4">
						<label for="inputContacto" class="font-weight-bold">Contacto</label>
						<input type="text" class="form-control" id="inputContacto" name="inputContacto" maxlength="80" value="<?php echo $datosPerfil['infoContacto'];?>">
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
						<input type="text" class="form-control" id="inputZonaTrabajo" name="inputZonaTrabajo" maxlength="80" value="<?php echo $datosPerfil['zonaTrabajo'];?>">
					</div>
					<div data-nivelestudios="<?php echo $datosPerfil['nivelEstudiosCompletados'];?>" style="display: none;" id="nivelestudios"></div>
					<div class="form-group alumno">
						<label for="inputNivelEstudios" class="font-weight-bold">Nivel de estudios</label>
						<select class="form-control inputNivelEstudios" id="inputNivelEstudios" name="inputNivelEstudios">
							<option value="1">Primaria</option>
							<option value="2">Secundaria</option>
							<option value="3">Preparatoria</option>
						</select>
					</div>
					<div data-nivelestudiosdiag="<?php echo $datosPerfil['nivelDiagnosticado'];?>" style="display: none;" id="nivelestudiosdiag"></div>
					<div class="form-group alumno">
						<label for="inputNivelEstudiosDiagnostico" class="font-weight-bold">Nivel de estudios <span class="badge bg-primary">diagnosticado</span></label>
						<select class="form-control inputNivelEstudiosDiag" id="inputNivelEstudiosDiagnostico" name="inputNivelEstudiosDiagnostico">
							<option value="1">Primaria</option>
							<option value="2">Secundaria</option>
							<option value="3">Preparatoria</option>
						</select>
						<small class="form-text text-muted" id="guiasHelp">Consulta las guías de diagnóstico en <a href="materialesConsulta.php">Biblioteca/Diagnósticos</a></small>
					</div>
					<div class="form-group alumno mt-4">
						<label for="inputMotivo" class="font-weight-bold">¿Tienes alguna motivación que te gustaría compartirnos?</label>
						<input type="text" class="form-control" id="inputMotivo" name="inputMotivo" maxlength="280" value="<?php echo $datosPerfil['motivador'];?>">
					</div>
					<div class="form-group alumno mt-4">
						<label for="inputIntereses" class="font-weight-bold">¿Cuáles son tus intereses?</label>
						<input type="text" class="form-control" id="inputIntereses" name="inputIntereses" maxlength="280" value="<?php echo $datosPerfil['intereses'];?>">
					</div>
					<div class="form-group mt-4 alumno">
						<label for="inputIncentivos" class="font-weight-bold">¿Cómo podríamos incentivarte a realizar las actividades?</label>
						<input type="text" class="form-control" id="inputIncentivos" name="inputIncentivos" maxlength="280" value="<?php echo $datosPerfil['tecnicasContacto'];?>">
					</div>
					<div data-nivelcomunicacion="<?php echo $datosPerfil['nivelComunicacion'];?>" style="display: none;" id="nivelcomunicacion"></div>
					<details class="alumno">
						<summary>Comunicación y conciencia</summary>
						<div class="form-group alumno mt-4">
							<label for="inputNivelComunication" class="font-weight-bold">Nivel de comunicación</label>
							<select class="form-control inputNivelComunication" id="inputNivelComunication" name="inputNivelComunication">
								<option value="1">Alta</option>
								<option value="2">Media</option>
								<option value="3">Baja</option>
							</select>
						</div>
						<div data-nivelconciencia="<?php echo $datosPerfil['nivelConciencia'];?>" style="display: none;" id="nivelconciencia"></div>
						<div class="form-group alumno">
							<label for="inputNivelConciencia" class="font-weight-bold">Nivel de conciencia</label>
							<select class="form-control inputNivelConciencia" id="inputNivelConciencia" name="inputNivelConciencia">
								<option value="1">Alta</option>
								<option value="2">Media</option>
								<option value="3">Baja</option>
							</select>
						</div>
					</details>
					<div data-personalidad="<?php echo $datosPerfil['personalidad'];?>" style="display: none;" id="personalidad"></div>
					<div class="form-group alumno">
						<label for="inputSelectorPersonalidad" class="form-label mt-4 font-weight-bold">¿Cómo definirías tu personalidad?</label>
						<select id="inputSelectorPersonalidad" name="inputSelectorPersonalidad[]" size="18" multiple="MULTIPLE" class="form-select w-100" style="height: 300px;">
							<option id="op1" value="1"> Reservada </option>
							<option id="op2" value="2"> Sumisa </option>
							<option id="op3" value="3"> Seria </option>
							<option id="op4" value="4"> Introvertida </option>
							<option id="op5" value="5"> Confiada </option>
							<option id="op6" value="6"> Metódica </option>
							<option id="op7" value="7"> Conservadora </option>
							<option id="op8" value="8"> Dependiente </option>
							<option id="op9" value="9"> Relajada </option>
							<option id="op10" value="10"> Extrovertida </option>
							<option id="op11" value="11"> Dominante </option>
							<option id="op12" value="12"> Entusiasta </option>
							<option id="op13" value="13"> Extrovertida </option>
							<option id="op14" value="14"> Suspicaz </option>
							<option id="op15" value="15"> Creativa </option>
							<option id="op16" value="16"> Curiosa </option>
							<option id="op17" value="17"> Autosuficiente </option>
							<option id="op18" value="18"> Tensa </option>
						</select>
						<small class="form-text text-muted">Puedes seleccionar varios atributos manteniendo presionada la tecla <strong>CTRL</strong>.</small>
					</div>
					<div class="form-group alumno">
						<label for="inputNotas" class="form-label mt-4">Notas adicionales</label>
						<textarea class="form-control" id="inputNotas" name="inputNotas" rows="4"><?php echo $datosPerfil['notas'];?></textarea>
					</div>
					<hr>
					<!-- <span class="badge bg-danger text-light mb-2" id="alertRegistro">Favor de completar los campos vacíos</span><br> -->
					<input type="text" name="idUsuario" value="<?php echo $idUsuario;?>" style="display: none;">
					<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
				</form>
			</div>
		</div>
	</div>
	<!-- Registro
	––––––––––––––––––––––––––––––––––––––––––––––––– -->

<script type="text/javascript">
$(document).ready(function(){
	// Genero
	let gen = $("#genDB").attr("data-gen");
	$(".genUsuario").val(gen);

	// Nivel estudios
	let nivelestudios = $("#nivelestudios").attr("data-nivelestudios");
	$(".inputNivelEstudios").val(nivelestudios);

	// Nivel estudios diagnosticado
	let nivelestudiosdiag = $("#nivelestudiosdiag").attr("data-nivelestudiosdiag");
	$(".inputNivelEstudiosDiag").val(nivelestudiosdiag);

	// Nivel comunicacion
	let nivelcomunicacion = $("#nivelcomunicacion").attr("data-nivelcomunicacion");
	$(".inputNivelComunication").val(nivelcomunicacion);

	// Nivel conciencia
	let nivelconciencia = $("#nivelconciencia").attr("data-nivelconciencia");
	$(".inputNivelConciencia").val(nivelconciencia);

	// Personalidad
	let personalidad = $("#personalidad").attr("data-personalidad");

	console.log("personalidad.includes(1)", personalidad.indexOf(1));

	const arregloPersonalidad = personalidad.split(",");
	console.log("arregloPersonalidad", arregloPersonalidad);


	if(arregloPersonalidad.includes("1")==true){

		$("#op1").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("2")==true){

		$("#op2").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("3")==true){

		$("#op3").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("4")==true){

		$("#op4").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("5")==true){

		$("#op5").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("6")==true){

		$("#op6").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("7")==true){

		$("#op7").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("8")==true){

		$("#op8").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("9")==true){

		$("#op9").prop("selected","selected");
	}  
	if(arregloPersonalidad.includes("10")==true){

		$("#op10").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("11")==true){

		$("#op11").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("12")==true){

		$("#op12").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("13")==true){

		$("#op13").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("14")==true){

		$("#op14").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("15")==true){

		$("#op15").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("16")==true){

		$("#op16").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("17")==true){

		$("#op17").prop("selected","selected");
	} 
	if(arregloPersonalidad.includes("18")==true){

		$("#op18").prop("selected","selected");
	} 

	// $(".genUsuario").val(gen);

});
</script>
					</div>
				</div>
			</section>
		</div>
	</main>

</body>
</html>