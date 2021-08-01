<!-- Barra superior del sistema -->
<div class="bg-primary text-white p-2">
	<a class="navbar-brand" href="inicio.php"><img src="css/img/logo.png" height="80"></a>
	<div class="btn btn-warning" data-toggle="modal" style="background-color: #EBB244;">
			<a href="#" class="text-dark d-none d-sm-inline" style="text-decoration:none;"><span>Seguimiento tutores</span></a>
	</div>
	<div class="btn btn-warning" data-toggle="modal" style="text-decoration:none; background-color: #EBB244;">
			<a href="#" class="text-dark d-none d-sm-inline"><span>Seguimiento alumnado</span></a>
	</div>
	<div class="btn btn-warning float-right" data-toggle="modal" data-target="#modalEditarDatosUsuarioActivo" style="background-color: #EBB244;">
			<div class="btn btn-warning">
			<?if($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 1){?><span class="badge badge-light"><?if($_SESSION["datosUsuarioActivo"]["genero"] == 1){echo "ALUMNA";}else{echo "ALUMNO";}?></span><?}?>
			<?if($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 2){?><span class="badge badge-light"><?if($_SESSION["datosUsuarioActivo"]["genero"] == 1){echo "TUTORA";}else{echo "TUTOR";}?></span><?}?>
			<?if(($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 3)||($_SESSION["datosUsuarioActivo"]["tipoUsuario"] == 4)){?><span class="badge badge-light"><?if($_SESSION["datosUsuarioActivo"]["genero"] == 1){echo "ADMINISTRADORA";}else{echo "ADMINISTRADOR";}?></span><?}?>
			<i class="icon-user text-dark d-none d-sm-inline"></i>
			<a href="#" class="font-weight-bold text-dark d-none d-sm-inline mr-2" style="text-decoration:none;"><span class="mr-3"><?echo $_SESSION["datosUsuarioActivo"]["nombre"];?></span></a>

		</div>	
	</div>
</div>