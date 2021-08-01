<?php 
	include("php/sql/interactDB.php");
	include("php/sql/documento.php");

	$documento = new Documento();

	$idUsuario = $_POST["idUsuario"];

	$listaDocumentos = $documento->consultaDocumentoUsuarioId($idUsuario);

	$documento->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Herramientas</title>
	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="js/documentos.js"></script>
</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="<?php echo $_POST["tituloArchivo"];?>" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
					Volver
				</a>
			</div>
		</div>
	</header>
	<main>
		<div class="container mt-3">
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
								if($valor["tipoDocumento"] == 6) echo "Plan de trabajo final";
								if($valor["tipoDocumento"] == 7) echo "Otro";

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