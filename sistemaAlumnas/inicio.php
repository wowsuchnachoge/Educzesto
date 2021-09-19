<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/plataformas.php");
	include("php/sql/asignacion.php");
	include("php/sql/material.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "inicio.php";

	$usuario = new Usuario();
	$plataformas = new Plataformas();
	$asignacion = new Asignacion();
	$material = new Material();


	// Undefined index: datosUsuarioActivo in /home/vlm0dijktjmb/public_html/login/herramientas.php on line 16
	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;

	$tipoUsuario = $_SESSION["datosUsuarioActivo"]["tipoUsuario"];
	$idUsuario = $_SESSION["datosUsuarioActivo"]["idUsuario"];

	$arregloUsuariosAlumnoTodos = $usuario->consultaUsuariosAlumnoTodos();
	$consultaUsuariosTutorTodos = $usuario->consultaUsuariosTutorTodosInicio();

	$arregloTutoresAsignados = array();
	$arregloAlumnasAsignadas = array();

 	if($tipoUsuario == 1){
 		// Para usuarios alumnos
 		 $fila = $asignacion->consultaAsignacionAlumnas($idUsuario);
		foreach ($fila as $value){
			array_push($arregloTutoresAsignados,(int) $value["idUsuarioTutor"]);
		} 

		$listaMateriales = $material->consultaMaterialUsuarioIdAlumnasInicio($idUsuario);
 	}
	else{
		// Para usuarios tutores
		$fila = $asignacion->consultaAsignacionTodos($idUsuario);
		foreach ($fila as $value){
			array_push($arregloAlumnasAsignadas,(int) $value["idUsuarioAlumno"]);
		} 
		
		$listaMateriales = $material->consultaMaterialUsuarioIdInicio($idUsuario);
	} 


	$arregloPlataformas = $plataformas->consultaPlataformas();

	$usuario->cierraBaseDatos();
	$plataformas->cierraBaseDatos();
	$asignacion->cierraBaseDatos();
	$material->cierraBaseDatos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>EduCzesto</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script type="text/javascript" src="js/inicio.js"></script>
</head>
<body>
    <!-- Responsive navbar-->
    <header class="bg-warning py-3" style="background-repeat: no-repeat; background-size: cover;">
        		<?include("php/includes/dynamicHeader.php");?>
		<!-- Recursos locales
		––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<script type="text/javascript" src="js/minutas.js"></script>
        <div class="container px-3">
            <div class="row gx-5 justify-content-center" style="background-image: url(css/img/bienvenido.jpeg); background-repeat: no-repeat; background-size: cover;">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Bienvenido a EduCzesto</h1>
                        <p class="lead text-white sm-4">Aquí podrás manejar todo lo relacionado a <br>tu servicio social
                            con EduCzesto.</p>                       
                    </div>
                    <!-- <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Bienvenido a EduCzesto</h1>
                        <p class="lead text-white-50 sm-4">Aquí podrás manejar todo lo relacionado a <br>tu servicio social
                            con EduCzesto.</p>                       
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <section class="py-0">
        <div class="container px-4 my-4">
            <div class="row gx-5 justify-content-center">
                <!-- Tutores -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-5 mb-xl-0">
                        <div class="card-body p-5">
                            <div class="small text-uppercase fw-bold text-muted">Seguimiento de</div>
                            <div class="mb-3">
                                <span class="display-4 fw-bold">Tutores</span>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Minutas
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Bitacoras
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Cuentas de EduCzesto
                                </li>
                            </ul>
                            <div class="d-grid"><a class="btn btn-outline-primary" href="#!">Ir a tutores</a></div>
                        </div>
                    </div>
                </div>
                <!-- Alumnado -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-5 mb-xl-0">
                        <div class="card-body p-5">
                            <div class="small text-uppercase fw-bold text-muted">Seguimiento de</div>
                            <div class="mb-3">
                                <span class="display-4 fw-bold">Alumnado</span>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Perfiles de alumnos asignados
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Ligas de consulta
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Material para alumnos
                                </li>
                            </ul>
                            <div class="d-grid"><a class="btn btn-outline-primary" href="#!">Ir a alumnos</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Seccion secundaria -->
    <section class="bg-light py-5 border-bottom">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-warning bg-gradient text-white rounded-3 mb-3"><i
                            class="bi bi-collection"></i></div>
                    <h2 class="h4 fw-bolder">Minuta más reciente</h2>
                    <p>Revisa los acuerdos de las juntas semanales, para trabajar con mayor productividad.</p>
                    <a class="text-decoration-none" href="minutas.php">
                        Ir
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-warning bg-gradient text-white rounded-3 mb-3"><i
                            class="bi bi-lightbulb"></i>
                    </div>
                    <h2 class="h4 fw-bolder">Recordatorios</h2>
                    <p>¿Has estado actualizando tu bitácora? No se te olvide que esto debe estar completo para finalizar tu servicio social!</p>
                    <a class="text-decoration-none" href="bitacoraTutores.php">
                        Ir
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-danger bg-gradient text-white rounded-3 mb-3"><i class="bi bi-bell"></i>
                    </div>
                    <h2 class="h4 fw-bolder">Avisos</h2>
                    <p>*Por el momento las actividades presenciales se encuentran suspendidas.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-3 bg-warning">
        <div class="container px-3">
            <p class="m-0 text-center text-white">EduCzesto</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

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
	<?php if($tipoUsuario != 1){?><?php include("php/includes/modals.php");?><?php }?>
</body>
</html>