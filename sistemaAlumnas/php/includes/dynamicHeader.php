<head>
	<?include("php/includes/head.html");?>
    <link href="css/styles.css" rel="stylesheet" />
	<script type="text/javascript" src="js/inicio.js"></script>
</head><!-- Barra superior del sistema -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <a class="navbar-brand" href="inicio.php"><img src="css/img/logo.png" height="50"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="inicio.php">
                        <div class="text-dark"><i class="icon-home"></i>
                        </div>
                    </a>
                </li>
				<li class="nav-item dropdown">
					<div class="dropdown nav-link">
					<span>&nbsp;&nbsp;&nbsp;Seguimiento Tutores&nbsp;&nbsp;&nbsp;</span>
					<div class="dropdown-content">
						<p><a href="minutas.php" style="color: black; text-decoration: none;">Minutas</a></p>
						<p><a href="bitacoras.php" style="color: black; text-decoration: none;">Bitacoras</a></p>
						<p><a href="plataformas.php" style="color: black; text-decoration: none;">Accesos a Plataformas</a></p>   
                        <p><a href="materialesConsulta.php" style="color: black; text-decoration: none;">Material de consulta</a></p>                 
					</div>
					</div>
                </li>
				<li class="nav-item dropdown">
					<div class="dropdown nav-link">
					<span>&nbsp;&nbsp;&nbsp;Seguimiento Alumnado&nbsp;&nbsp;&nbsp;</span>
					<div class="dropdown-content">
                        <p><a href="alumnos.php" style="color: black; text-decoration: none;">Alumnos asignados</a></p>
                        <p><a href="materiales.php" style="color: black; text-decoration: none;">Enviar material para alumnos</a></p>
                        <p><a href="ligasParaAlumnos.php" style="color: black; text-decoration: none;">Ligas de consulta para alumnos</a></p>
					</div>
					</div>
                </li>
                
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item" data-toggle="modal" data-target="#modalEditarDatosUsuarioActivo" >
                <div data-toggle="modal" data-target=".modalEditaDatosUsuarioTutor">
                    <a class="nav-link" href="#!"><div class="text-dark" >Mi perfil <i class="bi bi-person-fill"></i></div></a>
		        </div>                    <!-- <a href="#" class="font-weight-bold" data-toggle="modal" data-target="#modalEditarInfo" style="text-decoration:none;"> BLA </a> -->
                </li>
                <li class="nav-item"><a class="nav-link" href="#!"><div class="text-dark"> </div></a></li>
                <li class="nav-item">
                    <a href="php/sql/controladores/cntLogOut.php" class="btn btn-danger float-right mx-1" style="font-size: small;">Salir <i class="bi bi-box-arrow-right"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> </a>
                </li>
            </ul>
        </div>
    </nav>
<!-- 	<a class="navbar-brand" href="inicio.php"><img src="css/img/logo.png" height="80"></a>
	<a href="#" class="text-warning d-none d-sm-inline" style="text-decoration:none;"><span>Seguimiento tutores</span></a>
	<a href="#" class="text-warning d-none d-sm-inline"><span>Seguimiento alumnado</span></a>
	<a href="php/sql/controladores/cntLogOut.php" class="btn btn-danger float-right mx-1" style="font-size: small;">Salir <i class="icon-logout text-light"></i></a>
	<div class="float-right" data-toggle="modal" data-target="#modalEditarDatosUsuarioActivo" style="background-color: #EBB244;">
			<i class="icon-user text-warning d-none d-sm-inline"></i>
			<a href="#" class="font-weight-bold text-dark d-none d-sm-inline mr-2" style="text-decoration:none;"><span class="mr-3"><?echo $_SESSION["datosUsuarioActivo"]["nombre"];?></span></a>
	</div>	
	</div> -->