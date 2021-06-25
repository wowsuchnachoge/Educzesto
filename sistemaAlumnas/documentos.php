<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Subir documentos</title>
</head>
<body>
	<header class="bg-primary text-white p-3">
		<div class="container">
			<div class="d-flex text-dark">
				<a class="nav-link text-dark" href="inicio.php" role="button" style="margin-top: -5px;">
					<i class="icon-left-open-big text-dark mr-2"></i>
				</a>
				<h4 class="font-weight-bold">Documentos del servicio</h4>
			</div>
		</div>
	</header>
	<main>
		<div class="container mt-3">
			<section value="informacion">				
				<div class="alert alert-light">
				  <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
				</div>
				<hr>
			</section>
			<section value="cargarDocumentos">
				<div class="row">
					<div class="col-4">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-attach text-dark mr-2"></i>Acuerdo Tripartita</div>
							<div class="card-body">
								<small class="text-success"><i class="icon-upload-cloud text-success"></i> Archivo subido <strong>correctamente</strong>.</small>
								<div class="custom-file mt-1">
									<input type="file" class="custom-file-input" id="inputAcuerdoTripartita" disabled>
									<label class="custom-file-label" for="inputAcuerdoTripartita">Seleccionar</label>
								</div>
								<hr>
								<div class="btn-group mt-3 d-flex justify-content-center" role="group">
								  <button type="button" class="btn btn-light"><i class="icon-info-circled text-dark"></i> Información</button>
								  <button type="button" class="btn btn-danger"><i class="icon-trash text-light"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-attach text-dark mr-2"></i>Convenio de confidencialidad</div>
							<div class="card-body">
								<small class="text-danger"><strong>Error</strong> al subir archivo.</small>
								<div class="custom-file mt-1">
									<input type="file" class="custom-file-input" id="inputConvenioConfidencialidad">
									<label class="custom-file-label" for="inputConvenioConfidencialidad">Seleccionar</label>
								</div>
								<hr>
								<div class="btn-group mt-3 d-flex justify-content-center" role="group">
								  <button type="button" class="btn btn-light"><i class="icon-info-circled text-dark"></i> Información</button>
								  <button type="button" class="btn btn-danger disabled"><i class="icon-trash text-light"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-attach text-dark mr-2"></i>Currículum Vitae</div>
							<div class="card-body">
								<small>Sube un archivo en formato <strong>PDF</strong>.</small>
								<div class="custom-file mt-1">
									<input type="file" class="custom-file-input" id="inputCurriculumVitae">
									<label class="custom-file-label" for="inputCurriculumVitae">Seleccionar</label>
								</div>
								<hr>
								<div class="btn-group mt-3 d-flex justify-content-center" role="group">
								  <button type="button" class="btn btn-light"><i class="icon-info-circled text-dark"></i> Información</button>
								  <button type="button" class="btn btn-danger disabled"><i class="icon-trash text-light"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-attach text-dark mr-2"></i>INE</div>
							<div class="card-body">
								<small>Sube un archivo en formato <strong>PDF</strong>.</small>
								<div class="custom-file mt-1">
									<input type="file" class="custom-file-input" id="inputIne">
									<label class="custom-file-label" for="inputIne">Seleccionar</label>
								</div>
								<hr>
								<div class="btn-group mt-3 d-flex justify-content-center" role="group">
								  <button type="button" class="btn btn-light"><i class="icon-info-circled text-dark"></i> Información</button>
								  <button type="button" class="btn btn-danger disabled"><i class="icon-trash text-light"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="card mb-3">
							<div class="card-header font-weight-bold"><i class="icon-attach text-dark mr-2"></i>Plan de trabajo</div>
							<div class="card-body">
								<small>Sube un archivo en formato <strong>PDF</strong>.</small>
								<div class="custom-file mt-1">
									<input type="file" class="custom-file-input" id="inputPlanTrabajo">
									<label class="custom-file-label" for="inputPlanTrabajo">Seleccionar</label>
								</div>
								<hr>
								<div class="btn-group mt-3 d-flex justify-content-center" role="group">
								  <button type="button" class="btn btn-light"><i class="icon-info-circled text-dark"></i> Información</button>
								  <button type="button" class="btn btn-danger disabled"><i class="icon-trash text-light"></i></button>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</main>
</body>
</html>