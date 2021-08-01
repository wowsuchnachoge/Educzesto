<!-- Barra superior del sistema -->
<div class="bg-primary text-white p-2">
	<div class="container d-flex">
		<div class="btn btn-light" data-toggle="modal" data-target=".modalEditaDatosUsuarioTutor">
			<i class="icon-user text-dark d-none d-sm-inline"></i>
			<a href="#" class="font-weight-bold text-dark d-none d-sm-inline mr-2 border-right" style="text-decoration:none;"><span class="mr-3"><?echo $_SESSION["datosUsuarioActivo"]["nombre"];?></span></a>
			<?if($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 1){?><span class="badge badge-light"><?if($_SESSION["datosUsuarioActivo"]["genero"] == 1){echo "ALUMNA";}else{echo "ALUMNO";}?></span><?}?>
			<?if($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 2){?><span class="badge badge-light"><?if($_SESSION["datosUsuarioActivo"]["genero"] == 1){echo "TUTORA";}else{echo "TUTOR";}?></span><?}?>
			<?if(($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 3)||($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 4)){?><span class="badge badge-light"><?if($_SESSION["datosUsuarioActivo"]["genero"] == 1){echo "ADMINISTRADORA";}else{echo "ADMINISTRADOR";}?></span><?}?>
		</div>
		<div class="ml-auto">
			<!-- Vista general
			––––––––––––––––––––––––––––––––––––––––––––––––– -->
			<a href="php/sql/controladores/cntLogOut.php" class="btn btn-dark float-right mx-1">
				<i class="icon-logout text-light"></i>
			</a>
			<a href="inicio.php" class="btn <?echo ($claseEstiloButton = (strcmp($tituloArchivo, "inicio.php") == 0) ? "btn-light" : "btn-outline-dark");?>">
				<i class="icon-home"></i>
			</a>
			<a href="bitacoras.php" class="btn <?echo ($claseEstiloButton = (strcmp($tituloArchivo, "bitacoras.php") == 0) ? "btn-light" : "btn-outline-dark");?> d-lg-inline d-xl-none d-none d-xl-inline">Bitácora</a>
			<!-- Vista de tutores o administradores
			––––––––––––––––––––––––––––––––––––––––––––––––– -->
			<?if(($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 2)||($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 3)||($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 4)){?>
				<a href="materiales.php" class="btn <?echo ($claseEstiloButton = (strcmp($tituloArchivo, "materiales.php") == 0) ? "btn-light" : "btn-outline-dark");?> d-none d-lg-inline d-xl-none d-none d-xl-inline">Materiales</a>
				<a href="materialesConsulta.php" class="btn <?echo ($claseEstiloButton = (strcmp($tituloArchivo, "materialesConsulta.php") == 0) ? "btn-light" : "btn-outline-dark");?> d-lg-inline d-xl-none d-none d-xl-inline">Biblioteca</a>
				<a href="minutas.php" class="btn <?echo ($claseEstiloButton = (strcmp($tituloArchivo, "minutas.php") == 0) ? "btn-light" : "btn-outline-dark");?> d-lg-inline d-xl-none d-none d-xl-inline">Minutas</a>
			<?}?>
			<!-- Vista de administradores
			––––––––––––––––––––––––––––––––––––––––––––––––– -->
			<?if(($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 3)||($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 4)){?>
				<a href="herramientas.php" class="btn <?echo ($claseEstiloButton = (strcmp($tituloArchivo, "herramientas.php") == 0) ? "btn-light" : "btn-outline-dark");?> d-lg-inline d-xl-none d-none d-xl-inline"><i class="icon-tools d-none d-sm-inline"></i> Herramientas</a>
			<?}?>
		</div>
	</div>
</div>
