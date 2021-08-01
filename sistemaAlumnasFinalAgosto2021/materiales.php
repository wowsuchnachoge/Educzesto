<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/asignacion.php");
	include("php/sql/material.php");
	include("php/includes/cleanText.php");
	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "materiales.php";

	$usuario = new Usuario();
	$asignacion = new Asignacion();
	$material = new Material();
// Undefined index: datosUsuarioActivo in /home/vlm0dijktjmb/public_html/login/materiales.php on line 15
	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;
	$tipoUsuario = (int) $_SESSION["datosUsuarioActivo"]["tipoUsuario"];

	$idUsuario = $_SESSION["datosUsuarioActivo"]["idUsuario"];
	$arregloUsuariosAlumnoTodos = $usuario->consultaUsuariosAlumnoTodos();
	$fila = $asignacion->consultaAsignacionTodos($idUsuario);

	$arregloAlumnasAsignadas = array();
	foreach ($fila as $value){
		array_push($arregloAlumnasAsignadas,(int) $value["idUsuarioAlumno"]);
	} 

	$listaMateriales = $material->consultaMaterialUsuarioId($idUsuario);
	$usuario->cierraBaseDatos();
	$material->cierraBaseDatos();
	$asignacion->cierraBaseDatos();

?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Materiales</title>
</head>
<body>
	<header>
		<?include("php/includes/dynamicHeader.php");?>
		<!-- Recursos locales
		––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<script type="text/javascript" src="js/materiales.js"></script>
	</header>
	<main>
		<div class="container-fluid mt-3 w-50">
			<section value="subirMaterial">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-upload text-dark mr-2"></i>Subir material</div>
					<div class="card-body">
    					<form action="subirArchivo.php" method="POST" enctype="multipart/form-data">
						<!-- <form action="php/sql/controladores/cntSubirArchivo.php" method="POST"> -->
							<div class="form-group">
							  <label class="col-form-label font-weight-bold" for="inputNombreArchivo">Nombre del material</label>
							  <input type="text" class="form-control" placeholder="Ejercicios de ciencias naturales" id="inputNombreArchivo" name="inputNombreArchivo" maxlength="80">
							</div>
							<div class="form-group">
								<label class="col-form-label font-weight-bold" for="archivo">Enviar a</label>
								<select class="form-control" id="inputSelectorAlumna" name="inputSelectorAlumna">
									<?php if(($tipoUsuario == 3)||($tipoUsuario == 4)){?><option value="0">Todos</option><?php }?>
									<?php if($tipoUsuario == 2){?><option value="0">Mis archivos</option>
									<optgroup label="Alumnas">
							<?php foreach($arregloUsuariosAlumnoTodos as $alumnas){?>
								<?php if(in_array($alumnas["idUsuario"], $arregloAlumnasAsignadas)){?>
										<option value="<?php echo $alumnas["idUsuario"];?>"><?echo $alumnas["nombre"]." ".$alumnas["apellidoPaterno"]." ".$alumnas["apellidoMaterno"];?></option>
								<?php }?>
							<?php }?>
									</optgroup>
							<?php }?>
								</select>
							</div>
							<hr>
							<label class="col-form-label font-weight-bold" for="archivo">
								Subir un archivo 
									<span class="badge rounded-pill bg-warning text-dark">PDF</span>
								o un link
							</label>
							<div class="custom-file mb-3">
								<input type="file" name="archivo" class="btn btn-light">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="icon-link"></i>Link</span>
								</div>
								<input type="text" class="form-control" name="inputLink" maxlength="120" id="inputLink" placeholder="www.khanacademy.org">
								<input type="text" name="idUsuario" value="<?php echo $idUsuario;?>" style="display: none;">
							</div>
							<hr>
							<button type="submit" class="btn btn-success float-right ml-2" id="buttonRegistroArchivo" name="submit">Subir</button>
							<span class="badge rounded-pill bg-dark text-light" id="adviseTamanioArchivo">El tamaño de cada archivo <b>NO</b> debe sobrepasar los 8 MB (8,000 KB)</span>
							<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseGenerarArchivo">Existen campos sin llenar.</span>
							<input type="text" name="tipoUsuario" value="<?php echo $tipoUsuario;?>" style="display: none;">
						</form>
					</div>
				</div>
			</section>

		</div>
		<div class="container-fluid mt-3">
			<section value="listaMateriales" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Material</th>
							<?php if($tipoUsuario == 2){?><th scope="col" style="width: 30%">Enviado a </th><?php }?>
							<th scope="col">Estado</th>
							<th scope="col" style="width: 20%">Acción</th>
						</tr>
					</thead>
					<tbody>						
						<?php foreach($listaMateriales as $valor){?>
						<tr>
							<td><span class="badge rounded-pill bg-dark text-light"><?php echo $valor["nombre"];?></span></td>
							<?php if($tipoUsuario == 2){?><td>
								<?php foreach($arregloUsuariosAlumnoTodos as $alumnas){?>
									<?php if($alumnas["idUsuario"] == $valor["idUsuarioAlumno"]){?>
											<?echo $alumnas["nombre"]." ".$alumnas["apellidoPaterno"]." ".$alumnas["apellidoMaterno"];?>
									<?php }?>
								<?php }?>
							</td><?php }?>
							<td>
								<?php if($valor["estado"] == 0){?><span class="badge bg-warning"><i class="icon-forward text-dark mr-1"></i>Enviado</span><?php }?>
								<?php if($valor["estado"] == 1){?><span class="badge bg-success text-light"><i class="icon-check text-light mr-1"></i>Realizado</span><?php }?>
							</td>
							<td>
								<button type="button" class="btn btn-dark buttonEliminarMaterial" data-id_material="<?php echo $valor['idMaterial'];?>"><i class="icon-trash text-light mr-1"></i></button>
								<?php if($valor["flagLink"] == 1){?>
								<a href="<?php echo "https://".$valor["url"];?>" type="button" class="btn btn-secondary" target="_blank"><i class="icon-link text-light"></i></a><?php }?>
								<?php if($valor["flagMaterial"] == 1){?>
								 <a href="<?php echo 'archivos/'.$valor['idMaterial'].'.pdf';?>" type="button" class="btn btn-secondary" target="_blank"><i class="icon-newspaper text-light"></i></a><?php }?>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</section>
		</div>
	</main>
	<?include("php/includes/modals.php");?>
</body>
</html>