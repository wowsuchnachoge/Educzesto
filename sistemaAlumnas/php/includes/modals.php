<!-- Modal: EditaDatosUsuarioTutor
––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="modal fade modalEditaDatosUsuarioTutor" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<p class="modal-title"><i class="icon-pencil text-dark mr-1"></i>Editar a <strong><?php echo $_SESSION["datosUsuarioActivo"]["nombreCompleto"];?></strong></p>
				<button type="button" class="close btn_circle btn_sm" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="php/sql/controladores/cntEditaDatosUsuarioTutor.php" method="POST">
				<section value="nombre">
					<div class="form-group">
						<label for="inputNombre" class="font-weight-bold">Nombre</label>
						<input type="text" class="form-control campoEditar" id="inputNombre" name="inputNombre" maxlength="40" placeholder="<?php echo $_SESSION["datosUsuarioActivo"]['nombre'];?>">
					</div>
				</section>
				<section value="apellidos">
					<details class="mb-2">
						<summary>Apellidos</summary>
						<hr>
						<div class="form-group">
							<label for="inputApellidoPaterno" class="font-weight-bold">Apellido paterno</label>
							<input type="text" class="form-control campoEditar" id="inputApellidoPaterno" name="inputApellidoPaterno" maxlength="40" placeholder="<?php echo $_SESSION["datosUsuarioActivo"]['apellidoPaterno'];?>">
						</div>
						<div class="form-group">
							<label for="inputApellidoMaterno" class="font-weight-bold">Apellido materno</label>
							<input type="text" class="form-control campoEditar" id="inputApellidoMaterno" name="inputApellidoMaterno" maxlength="40" placeholder="<?php echo $_SESSION["datosUsuarioActivo"]['apellidoMaterno'];?>">
						</div>
						<hr>
					</details>
				</section>
				<section value="fechaNacimiento">
					<div class="form-group">
						<label for="inputFechaNacimiento" class="font-weight-bold">Fecha de nacimiento</label>
						<input type="date" class="form-control campoEditar" id="inputFechaNacimiento" name="inputFechaNacimiento" value="<?php echo $_SESSION["datosUsuarioActivo"]['fechaNacimiento'];?>">
					</div>
				</section>
				<section value="genero">
					<div data-genero="<?php echo $_SESSION["datosUsuarioActivo"]['genero'];?>" style="display: none;" id="generoUsuarioDB"></div>
					<div class="form-group">
						<label for="generoUsuario" class="font-weight-bold">Género</label>
						<select class="form-control campoEditar generoUsuario" name="generoUsuario">
							<option value="1">Femenino</option>
							<option value="2">Masculino</option>
						</select>
					</div>
				</section>
				<section value="contacto">
					<details>
						<summary>Contacto</summary>
						<hr>
						<div class="form-group">
							<label for="inputEmail" class="font-weight-bold">Email</label>
							<input type="mail" class="form-control campoEditar" id="inputEmail" name="inputEmail" maxlength="40" placeholder="<?php echo $_SESSION["datosUsuarioActivo"]['email'];?>">
						</div>
						<div class="form-group mt-4">
							<label for="inputPhone" class="font-weight-bold">Celular</label>
							<input type="tel" class="form-control campoEditar" id="inputPhone" name="inputPhone" maxlength="20" placeholder="<?php echo $_SESSION["datosUsuarioActivo"]['telefono'];?>">
						</div>
						<hr>
					</details>
				</section>
				<span class="badge bg-primary float-right d-none" id="adviseGuardarDatos">No olvides <strong>guardar los cambios</strong> al finalizar la edición.</span>
			</div>
			<div class="modal-footer">
				<a href="documentos.php?tituloArchivo=<?php echo $tituloArchivo;?>" class="btn btn-secondary mr-auto"><i class="icon-upload text-light mr-1"></i>Subir documentos</a>
				<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-success disabled" id="buttonGuardarDatosUsuario">Guardar</button>
			</div>
			<input type="text" name="idUsuario" value="<?php echo $_SESSION["datosUsuarioActivo"]['idUsuario'];?>" style="display: none;">
			<input type="text" name="tituloArchivo" value="<?php echo $tituloArchivo;?>" style="display: none;">
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	let generoDB = $("#generoUsuarioDB").attr("data-genero");
	$(".generoUsuario").val(generoDB);

	$(".campoEditar").on("input", function(){
		$("#buttonGuardarDatosUsuario").removeClass("disabled");
		$("#adviseGuardarDatos").removeClass("d-none");
	});
});
</script>

<!-- Modal: NuevaMinuta
––––––––––––––––––––––––––––––––––––––––––––––––– -->

<div class="modal fade modalNuevaMinuta" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title"><i class="icon-doc-text-inv mr-1"></i>Nueva minuta</p>
				<button type="button" class="close btn_circle btn_sm" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="php/sql/controladores/cntCreaNuevaMinuta.php" method="POST">
					<section value="fechaNuevaMinuta">
						<div class="form-group">
							<label for="inputFechaNuevaMinuta" class="font-weight-bold">Seleccione la fecha de la minuta</label>
							<input type="date" class="form-control" id="inputFechaNuevaMinuta" name="inputFechaNuevaMinuta">
							<div class="invalid-feedback">Campo vacío.</div>
							<button class="btn btn-success btn-block mt-3" disabled id="buttonCrearNuevaMinuta">Crear</button>
						</div>
					</section>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#inputFechaNuevaMinuta").on("input", function(){

		$("#buttonCrearNuevaMinuta").prop("disabled", false);
	});

	$("#buttonCrearNuevaMinuta").click(function(evento){

		if($("#inputFechaNuevaMinuta").val() === ""){

			evento.preventDefault();
			$("#inputFechaNuevaMinuta").addClass("is-invalid");
		}
		else $("#inputFechaNuevaMinuta").removeClass("is-invalid");

	});
});
</script>


<!-- Modal: EliminaMinuta
––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="modal modalEliminaMinuta" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="php/sql/controladores/cntEliminaMinuta.php" method="POST">
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
					<button type="submit" class="btn btn-dark">Borrar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
				<input type="text" id="idMinuta" name="idMinuta" value="<?php echo $minutaDatos['idMinuta'];?>" style="display: none;">
			</form>
		</div>
	</div>
</div>