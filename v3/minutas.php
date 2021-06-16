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

	<script type="text/javascript" src="js/inicio.js"></script>
	<script type="text/javascript" src="js/minutas.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">

	<style type="text/css">
			.active{
				background-color: #FFCD00 !important;
				border: 0px;
				color: #000 !important;
			}
	</style>
</head>
<?session_start();?>
<?if(isset($_SESSION["idUsuario"])){?>
<?
	include("sql/interactDB.php");

	$baseDatos = new InteractDB();
	$idUsuario  = $_SESSION["idUsuario"];

	$baseDatos->consultaPerfil($idUsuario);


	if(isset($_REQUEST["idMinuta"])){

		$idMinuta = $_REQUEST["idMinuta"];
	}
	else{

		$baseDatos->consultaUltimaMinuta();
		$idMinuta = $baseDatos->ultimaMinuta;
	}

	$baseDatos->cargarMinuta($idMinuta);

	$fechaMinutaActual 		= $baseDatos->fechaMinutaActual;
	$periodoMinutaActual 	= $baseDatos->periodoMinutaActual;
	$idPeriodoMinutaActual 	= $baseDatos->idPeriodoMinutaActual;
	$desgloseMinutaActual 	= $baseDatos->desgloseMinutaActual;

	$baseDatos->consultaPeriodos();

	$arregloNombresCompletos = $baseDatos->consultaParticipantes($idPeriodoMinutaActual);

	$baseDatos->cargaAcuerdosMinuta($idMinuta);
	$idAcuerdos = $baseDatos->idAcuerdos;

	$baseDatos->cierraDB();
?>
<body>
	<!-- Nav
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<header class="p-3 bg-primary text-white">
		<div class="container">
			<div class="d-flex">
				<p class="mt-2"><i class="icon-user text-dark d-none d-sm-inline"></i>
					<a href="#" class="font-weight-bold text-dark d-none d-sm-inline" data-toggle="modal" data-target="#modalEditarInfo" style="text-decoration:none;"> <?echo $baseDatos->nombreUsuario?> </a>
					<?if($baseDatos->tipoUsuario == 1){?><span class="badge badge-light ml-2">ALUMNO</span><?}?>
					<?if($baseDatos->tipoUsuario == 2){?><span class="badge badge-light ml-2">TUTOR</span><?}?>
					<?if($baseDatos->tipoUsuario == 3){?><span class="badge badge-light ml-2">ADMINISTRADOR</span><?}?>
				</p>
				<div class="ml-auto">
					<a href="sql/controladores/cntLogout.php" class="btn btn-dark float-right mr-2">
						<i class="icon-logout text-light"></i>
					</a>
					<!-- <a href="#" class="btnNavBar btn btn-outline-dark float-right mr-2 d-none d-lg-block d-xl-none d-xl-block text-dark">Herramientas</a> -->
					<a href="inicio.php" class="btnNavBar btn btn-outline-dark me-2 float-right mr-2 d-none d-sm-block text-dark mr-4">Inicio</a>
					<a href="minutas.php" class="btnNavBar btn btn-light float-right mr-2 d-none d-sm-block text-dark">Minutas</a>
					<a href="materiales.php" class="btnNavBar btn btn-outline-dark me-2 float-right mr-2 d-none d-sm-block text-dark">Materiales</a>
				</div>
			</div>
		</div>
	</header>
	<main>
		<div class="container-fluid mt-4">
			<div class="row">
				<div class="col-2 border-right">
					<form action="sql/controladores/cntMinutas.php" method="POST">
						<div class="btn btn-primary btn-block mb-4" data-toggle="modal" data-target="#modalNuevaMinuta"><i class="icon-plus-circled text-dark d-none d-sm-inline"></i> Nueva minuta</div>
						<div class="form-group">
							<label for="inptPeriodoBusqueda" class="font-weight-bold">Periodo</label>
							<select class="form-control" id="inptPeriodoBusqueda" name="inptPeriodoBusqueda">
								<?for ($i = 0; $i < count($baseDatos->idPeriodos); $i++){?>
									<option value="<?echo $baseDatos->idPeriodos[$i]?>"><?echo $baseDatos->nombrePeriodos[$i]?></option>
								<?}?>
							</select>
						</div>
						<div class="form-group">
							<label for="inptFechaBusqueda" class="font-weight-bold">Fecha</label>
							<select class="form-control" id="inptFechaBusqueda" name="inptFechaBusqueda">
							</select>
						</div>
						<button type="submit" class="btn btn-dark btn-block mt-4" id="btnCargarFecha"><i class="icon-doc-text-inv text-light d-none d-sm-inline"></i> Cargar minuta</button>
						<input type="text" id="idMinutaCargar" name="idMinutaCargar" value="1" style="display: none;">
					</form>
				</div>
				<div class="col-10">
					<section class="border-bottom ml-2">
						<button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#modalBorrarMinuta"><i class="icon-trash text-light d-none d-sm-inline"></i></button>
						<button type="button" class="btn btn-dark disabled float-right mr-2"><?echo $periodoMinutaActual?></button>
						<h2>Minuta <span class="font-weight-bold"><?echo $fechaMinutaActual?></span></h2>
					</section>
					<section class="ml-2 mt-2">
						<div class="font-weight-bold">Participantes</div>
						<?foreach ($arregloNombresCompletos as $value){?>
							<span class="badge rounded-pill bg-primary"><?echo $value?></span>
						<?}?>
					</section>
					<section class="ml-2 mt-4">
						<p class="font-weight-bold">Desgloce</p>
						<div class="form-group">
							<form action="sql/controladores/cntMinutas.php" method="POST">
								<textarea class="form-control" id="inptTextoDesglose" rows="3" name="txtdesgloseMinuta"><?echo $desgloseMinutaActual?></textarea>
								<input type="text" id="actDesgloseMinuta" name="actDesgloseMinuta" value="1" style="display: none;">
								<input type="text" id="idMinutaDesglose" name="idMinutaDesglose" value="<?echo $idMinuta?>" style="display: none;">
								<button type="submit" class="btn btn-success float-right mt-2">Guardar</button>
							</form>
						</div>
					</section>
					<section class="ml-2 mt-2">
						<p class="font-weight-bold">Acuerdos</p>
						<table class="table table-hover">
						  <thead>
						    <tr>
						      <th scope="col">Contenido</th>
						      <th scope="col">Responsable</th>
						      <th scope="col">Fecha Límite</th>
						      <th scope="col">
						      	<form action="sql/controladores/cntMinutas.php" method="POST">	
							      	<button type="submit" class="btn btn-secondary float-right mt-2 ml-2">
							      		<i class="icon-plus text-light"></i>
							      	</button>
							      	<input type="text" id="idMinutaAcuerdoCrear" name="idMinutaAcuerdoCrear" value="<?echo $idMinuta?>" style="display: none;">
						      	</form>
						      </th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?for ($i = 0; $i < count($baseDatos->idAcuerdos); $i++){?>
							      	<form action="sql/controladores/cntMinutas.php" method="POST">	
								 <tr value="<?echo $baseDatos->idAcuerdos[$i]?>">
							      <th scope="row"><textarea class="form-control" rows="1" name="contenidoAcuerdo"><?echo $baseDatos->acuerdos[$i]?></textarea></th>
							      <td>	
										<select class="form-control" name="responsableAcuerdo">
											<!-- <?#echo $baseDatos->acuerdos[$i]?> -->
											<option value="0">Todos</option>
											<?foreach ($arregloNombresCompletos as $value){?>
												<option value="0"><?echo $value?></option>
											<?}?>
										</select>
									</td>
									<td><input type="date" class="form-control" id="fechaAcuerdo" name="fechaLimiteAcuerdo" value="<?echo $baseDatos->fechasLimite[$i]?>"></td>
							      <td>
								      	<button type="submit" class="btn btn-success float-right mt-2 btnAcuerdoAct">
								      		<i class="icon-floppy text-light"></i>
								      	</button>
								      	<input type="text" name="idAcuerdoAct" value="<?echo $baseDatos->idAcuerdos[$i]?>" style="display: none;">
								      	<input type="text" name="idMin" value="<?echo $idMinuta?>" style="display: none;">
								     	</form>
							      	<form action="sql/controladores/cntMinutas.php" method="POST">	
								      	<button type="submit" class="btn btn-secondary  mt-2 ml-2 btnAcuerdoBorrar">
								      		<i class="icon-trash text-light"></i>
								      	</button>
								      	<input type="text" name="idAcuerdoBorrar" value="<?echo $baseDatos->idAcuerdos[$i]?>" style="display: none;">
								      	<input type="text" name="idMin" value="<?echo $idMinuta?>" style="display: none;">
							      	</form>
							      </td>
							    </tr>
							<?}?>
						 </tbody>
						</table>

					</section>
				</div>
			</div>
		</div>
	</main>


	<!-- Modal: perfil
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="modal fade" id="modalEditarInfo" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title"><i class="icon-pencil text-dark mr-1"></i>Editar a <strong><?echo $baseDatos->nombreCompletoUsuario?></strong></p>
					<button type="button" class="close btn_circle btn_sm" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="sql/controladores/cntActUsr.php" method="POST">
						<div class="form-group">
							<label for="inptNombre" class="font-weight-bold">Nombre</label>
							<input type="text" class="form-control campoEditarInfo" id="inptNombre" name="inptNombre" maxlength="40" placeholder="<?echo $baseDatos->nombreUsuario?>">
							<div class="invalid-feedback">Campo vacío.</div>
						</div>
						<details class="mb-4">
							<summary>Apellidos</summary>
							<hr>
							<div class="form-group">
								<label for="inptApellidoPaterno" class="font-weight-bold">Apellido paterno</label>
								<input type="text" class="form-control campoEditarInfo" id="inptApellidoPaterno" name="inptApellidoPaterno" maxlength="40" placeholder="<?echo $baseDatos->apellidoPaternoUsuario?>">
								<div class="invalid-feedback">Campo vacío.</div>
							</div>
							<div class="form-group">
								<label for="inptApellidoMaterno" class="font-weight-bold">Apellido materno</label>
								<input type="text" class="form-control campoEditarInfo" id="inptApellidoMaterno" name="inptApellidoMaterno" maxlength="40" placeholder="<?echo $baseDatos->apellidoMaternoUsuario?>">
								<div class="invalid-feedback">Campo vacío.</div>
							</div>
							<hr>
						</details>
						<div class="form-group">
							<label for="inptFechaNacimiento" class="font-weight-bold">Fecha de nacimiento</label>
							<input type="date" class="form-control campoEditarInfo" id="inptFechaNacimiento" name="inptFechaNacimiento" value="<?echo $baseDatos->fechaNacimientoUsuario?>">
							<div class="invalid-feedback">Campo sin modificar.</div>
						</div>

						<div id="generoUsuarioDB" data-genero="<?echo $baseDatos->generoUsuario?>" style="display: none;"></div>

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
								<input type="mail" class="form-control campoEditarInfo" id="inptEmail" name="inptEmail" maxlength="40" placeholder="<?echo $baseDatos->emailUsuario?>">
							</div>

							<div class="form-group mt-4">
								<label for="inptTel" class="font-weight-bold">Celular</label>
								<input type="tel" class="form-control campoEditarInfo" id="inptTel" name="inptTel" maxlength="20" placeholder="<?echo $baseDatos->telefonoUsuario?>">
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
				<input type="text" name="id" value="<?echo $idUsuario?>" style="display: none;">
				</form>
			</div>
		</div>
	</div>

	<!-- Modal: nueva minuta
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="modal fade" id="modalNuevaMinuta" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title"><i class="icon-doc-text text-dark mr-1"></i>Nueva minuta</p>
					<button type="button" class="close btn_circle btn_sm" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<form action="sql/controladores/cntMinutas.php" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="inptFechaMinuta" class="font-weight-bold">Fecha de la minuta nueva</label>
							<input type="date" class="form-control" id="inptFechaMinuta" name="inptFechaMinuta">
							<div class="invalid-feedback">Campo sin modificar.</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-success" id="btnModalMinutasCrear" disabled>Crear</button>
					</div>
					<input type="text" id="idMinutaCrear" name="idMinutaCrear" value="1" style="display: none;">
				</form>
			</div>
		</div>
	</div>

	<!-- Modal: borrar minuta
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="modal" id="modalBorrarMinuta" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="sql/controladores/cntMinutas.php" method="POST">
					<div class="modal-header">
						<h5 class="modal-title">Borrar minuta</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>¿Estás seguro de borrar esta minuta?</p>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Borrar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
					<input type="text" id="idMinutaBorrar" name="idMinutaBorrar" value="<?echo $idMinuta?>" style="display: none;">
				</form>
			</div>
		</div>
	</div>

</body>
</html>
<?}else{?>
	<div class="container">
		<div class="d-flex justify-content-center mt-4">	
			<div class="alert alert-dismissible alert-danger">
			  <strong>Lo sentimos</strong>, la página que intentas buscar no existe.
			</div>
		</div>	
	</div>
<?}?>