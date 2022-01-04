<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/sql/bitacora.php");
	include("php/includes/cleanText.php");
	
	$idUsuario = (int) $_POST["idUsuario"];
	$bitacora = new Bitacora();
	$usuario = new Usuario();

	$usuario->consultaUsuarioId($idUsuario);

	$arregloBitacora = $bitacora->consultaBitacoraId($idUsuario);
	$bitacora->cierraBaseDatos();
	$usuario->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?include("php/includes/head.html");?>
	<title>Herramientas</title>
	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="js/herramientas.js"></script>
	<link href="css/herramientasBitacora.css" rel="stylesheet" />
</head>
<body>
	<header class="bg-warning text-white p-3">
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
			<section value="bitacora">
				<div class="row">
					<div class="col-12">
						<div class="card mb-3">
							<div class="card-header font-weight-bold">
								<span><i class="icon-book text-dark mr-2"></i>Bitácora</span>
								<span class="float-right"><span class="badge bg-warning"><?php  echo $usuario->datosUsuario["nombreCompleto"];?></span></span>
							</div>
							<div class="card-body">
								<section value="listaBitacoras" class="d-none d-sm-inline d-sm-none d-md-inline d-md-none d-lg-inline">
									<table class="table table-hover">
										<thead>
											<tr>
												<th scope="col" style="width: 20%">Fecha</th>
												<th scope="col" style="width: 30%">Nota</th>
												<th scope="col" style="width: 25%">Completado?</th>
												<th scope="col" style="width: 25%">Visto bueno coordinadores</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($arregloBitacora as $valor){?>
											<tr>
												<td><span class="badge rounded-pill bg-dark text-light"><?php  echo $valor["fecha"];?></span></td>
												<td>
													<p class="text-justify mr-4"><?php  echo $valor["desglose"];?></p>
												</td>
												<td>
													<form action="php/sql/controladores/cntRegistroBitacoraRealizado.php" method="POST">												
														<select name="realizado" class="classic mt-2"> <!-- style="color: white; background: #6c757d; border: none; font-size: x-small;" -->
															<option selected="selected" value="<?php echo $valor["realizado"]?>"><b><?php if ($valor["realizado"] == '0') {echo "En proceso";} else { echo "Realizado";}?></b></option>	
															<option value="<?php if ($valor["realizado"] == '0') {echo "Realizado";} else { echo "En proceso";}?>"><b><?php if ($valor["realizado"] == '0') {echo "Realizado";} else { echo "En proceso";}?></b></option>													
														</select>													
														<input type="text" name="idBitacora" value="<?php echo $idBitacora;?>" hidden>																									
													</form>	
												</td>
												<td><input type="checkbox"></td>												
											</tr>
											<?}?>
										</tbody>
									</table>
								</section>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
</body>
</html>