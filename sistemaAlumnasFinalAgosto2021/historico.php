<?php
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/bitacora.php");
	include("php/sql/material.php");
	include("php/includes/cleanText.php");
	
	$idUsuario = (int) $_POST["idUsuario"];
	$bitacora = new Bitacora();
	$usuario = new Usuario();
	$material = new Material();

	$usuario->consultaUsuarioId($idUsuario);

	$arregloBitacora = $bitacora->consultaBitacoraId($idUsuario);
	$listaMateriales = $material->consultaMaterialUsuarioId($idUsuario);

	$material->cierraBaseDatos();
	$bitacora->cierraBaseDatos();
	$usuario->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Histórico</title>
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
		<div class="container-fluid mt-3">
			<section value="bitacora">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-folder text-dark mr-2"></i>Bitácora</div>
					<div class="card-body">
						<section value="listaBitacoras" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col" style="width: 20%">Fecha</th>
										<th scope="col" style="width: 80%">Nota</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($arregloBitacora as $valor){?>
									<tr>
										<td><span class="badge rounded-pill bg-dark text-light"><?php  echo $valor["fecha"];?></span></td>
										<td>
											<p class="text-justify mr-4"><?php  echo $valor["desglose"];?></p>
										</td>
									</tr>
									<?}?>
								</tbody>
							</table>
						</section>
					</div>
				</div>
			</section>
			<section value="archivos">
				<div class="card mb-3">
					<div class="card-header font-weight-bold"><i class="icon-folder text-dark mr-2"></i>Archivos</div>
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">Material</th>
									<th scope="col">Estado</th>
									<th scope="col" style="width: 20%">Acción</th>
								</tr>
							</thead>
							<tbody>						
								<?php foreach($listaMateriales as $valor){?>
								<tr>
									<td><span class="badge rounded-pill bg-dark text-light"><?php echo $valor["nombre"];?></span></td>
									<td>
										<?php if($valor["estado"] == 0){?><span class="badge bg-warning"><i class="icon-forward text-dark mr-1"></i>Enviado</span><?php }?>
										<?php if($valor["estado"] == 1){?><span class="badge bg-success text-light"><i class="icon-check text-light mr-1"></i>Realizado</span><?php }?>
									</td>
									<td>
										<button type="button" class="btn btn-dark buttonEliminarMaterial" data-id_material="<?php echo $valor['idMaterial'];?>"><i class="icon-trash text-light mr-1"></i></button>
										<?php if($valor["flagLink"] == 1){?>
										<a href="<?php echo "https://".$valor["url"];?>" type="button" class="btn btn-secondary" target="_blank"><i class="icon-link text-light"></i></a><?php }?>
										<?php if($valor["flagMaterial"] == 1){?>
										 <a href="<?php echo 'archivos/'.$valor['idMaterial'].'.pdf';?>" type="button" class="btn btn-secondary"><i class="icon-newspaper text-light"></i></a><?php }?>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>