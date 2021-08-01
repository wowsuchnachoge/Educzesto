<?php session_start();?>
<?php 
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/documento.php");
	include("php/includes/validaSesionActiva.php");

	$usuario = new Usuario();
	$documento = new Documento();

	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;
	$tipoUsuario = (int) $_SESSION["datosUsuarioActivo"]["tipoUsuario"];

	$idUsuario = $_SESSION["datosUsuarioActivo"]["idUsuario"];
	$arregloUsuariosAlumnoTodos = $usuario->consultaUsuariosAlumnoTodos();

	$listaDocumentos = $documento->consultaDocumentoUsuarioId($idUsuario);

	$usuario->cierraBaseDatos();
	$documento->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Subir documentos</title>
		<!-- Recursos locales
		––––––––––––––––––––––––––––––––––––––––––––––––– -->
		<script type="text/javascript" src="js/documentos.js"></script>
</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="<?php echo $_GET["tituloArchivo"];?>" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
					Volver
				</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container mt-3 w-50">
			<section value="subirDocumentos">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-folder text-dark mr-2"></i>Subir documentos</div>
					<div class="card-body">
    					<form action="subirDocumentos.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
							  <label class="col-form-label font-weight-bold" for="inputNombreArchivo">Documento</label>
							  <select class="form-control" id="inputSelectorDocumento" name="inputSelectorDocumento">
							  	<option value="0">Seleccionar</option>
							  	<optgroup label="Documentos">
								  	<option value="1">Acuerdo Tripartita</option>
								  	<option value="2">Convenio de confidencialidad</option>
								  	<option value="3">Currículum Vitae</option>
								  	<option value="4">INE</option>
								  	<option value="5">Plan de trabajo</option>
								  	<option value="6">Plan de trabajo final</option>
								  	<option value="7">Otro</option>
								</optgroup>
							  </select>
							</div>
							<hr>
							<div class="custom-file my-3 mb-5">
								<label class="col-form-label font-weight-bold" for="archivo">Cargar archivo <span class="badge rounded-pill bg-warning text-dark">PDF</span></label>
								<input type="file" name="archivo" class="btn btn-light">
							</div>
							<input type="text" name="idUsuario" value="<?php echo $idUsuario;?>" style="display: none;">
							<button type="submit" class="btn btn-success float-right ml-2" id="buttonRegistroDocumento" name="submit">Subir</button>
							<span class="badge bg-danger mb-2 mr-1 text-light" id="adviseGenerarDocumento" style="display: none;">No existe un tipo de documento seleccionado.</span>
							<input type="text" name="tituloArchivo" value="<?php echo $_GET["tituloArchivo"];?>" style="display: none;">
						</form>
					</div>
				</div>
			</section>
		</div>
		<div class="container-fluid mt-3">
			<section value="listaDocumentos" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Documento</th>
							<th scope="col" style="width: 20%">Acción</th>
						</tr>
					</thead>
					<tbody>						
						<?php foreach($listaDocumentos as $valor){?>
						<tr>
							<td><span class="badge rounded-pill bg-dark text-light"><?php 
								if($valor["tipoDocumento"] == 1) echo "Acuerdo Tripartita";
								if($valor["tipoDocumento"] == 2) echo "Convenio de confidencialidad";
								if($valor["tipoDocumento"] == 3) echo "Currículum Vitae";
								if($valor["tipoDocumento"] == 4) echo "INE";
								if($valor["tipoDocumento"] == 5) echo "Plan de trabajo";

							?></span></td>
							<td>
								<button type="button" class="btn btn-dark buttonEliminarDocumento" data-id_documento="<?php echo $valor['idDocumento'];?>"><i class="icon-trash text-light mr-1"></i></button>
								 <a href="<?php echo 'documentos/'.$valor['idDocumento'].'.pdf';?>" type="button" class="btn btn-secondary" target="_blank"><i class="icon-vcard text-light"></i></a>
							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</section>
		</div>
	</main>
</body>
</html>