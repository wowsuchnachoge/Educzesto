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
    <title>Plataforma EduCzesto</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <a class="navbar-brand" href="inicio.php"><img src="css/img/logo.png" height="80"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="inicio.php">
                        <div class="text-dark"><i class="bi bi-house-fill"></i>
                        </div>
                    </a>
                </li>
				<li class="nav-item dropdown">
					<div class="dropdown nav-link">
					<span>&nbsp;&nbsp;&nbsp;Seguimiento Tutores&nbsp;&nbsp;&nbsp;</span>
					<div class="dropdown-content">
						<p><a href="minutas.php">Minutas</a></p>
						<p><a href="materiales.php">Bitacoras</a></p>
						<p><a href="plataformas.php">Accesos a Plataformas</a></p>
					</div>
					</div>
                </li>
				<li class="nav-item dropdown">
					<div class="dropdown nav-link">
					<span>&nbsp;&nbsp;&nbsp;Seguimiento Alumnado&nbsp;&nbsp;&nbsp;</span>
					<div class="dropdown-content">
						<p><a href="materiales.php">Material de apoyo</a></p>
                        <p><a href="">Ligas de consulta</a></p>
					</div>
					</div>
                </li>
				<!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Minutas</a>
          <a class="dropdown-item" href="#">Bitácoras</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Administrar tutores</a>
        </div>
      </li> -->
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#!"><div class="text-dark"><i class="bi bi-person-fill"></i>
                </div></a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- <nav class="navbar navbar-expand-lg navbar-warning bg-warning">
        <div class="container px-5">
            <a class="navbar-brand" href="#!"><img src="LogoEduczesto.png" height="80"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!"><div class="text-white"><i class="bi bi-house-fill"></i>
                    </div></a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Seguimiento Tutores</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </li>
                    <li class="nav-item"><a class="nav-link" href="#!">Seguimiento Alumnos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> </a></li>
                    <li class="nav-item"><a class="nav-link" href="#!"><div class="text-white"><i class="bi bi-person-fill"></i>
                    </div></a></li>
                </ul>
            </div>
        </div>
    </nav> -->
    <!-- Header-->
    <header class="bg-warning py-3">
        <div class="container px-3">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Bienvenido a la Plataforma de EduCzesto</h1>
                        <p class="lead text-white-50 sm-4">Aquí podrás manejar todo lo relacionado a <br>tu servicio social
                            con EduCzesto.</p>
                        <!--  	                           <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Seguimiento Tutores</a>
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#!">Seguimiento alumnos</a>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features section-->
    <!--   <section class="py-5 border-bottom" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                            class="bi bi-collection"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                        sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i>
                    </div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                        sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Pricing section-->
    <section class="py-0">
        <div class="container px-4 my-4">
            <!-- <div class="text-center mb-5">
                <h2 class="fw-bolder">Pay as you grow</h2>
                <p class="lead mb-0">With our no hassle pricing plans</p>
            </div> -->
            <div class="row gx-5 justify-content-center">
                <!-- Pricing card free-->
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
                <!-- Pricing card pro-->
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
                                    Perfiles y personalidad
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Ligas de consulta
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Material de apoyo
                                </li>
                            </ul>
                            <div class="d-grid"><a class="btn btn-outline-primary" href="#!">Ir a alumnos</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials section-->
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
                    <a class="text-decoration-none" href="bitacora.php">
                        Ir
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-danger bg-gradient text-white rounded-3 mb-3"><i class="bi bi-bell"></i>
                    </div>
                    <h2 class="h4 fw-bolder">Avisos</h2>
                    <p>*Por el momento las actividades presenciales se encuentran suspendidas.</p>
                    <!-- <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-warning">
        <div class="container px-5">
            <p class="m-0 text-center text-white">Plataforma de EduCzesto</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>