$(document).ready(function(){

	$("#alertRegistro").hide();

	// Al cambio de tipo de usuario
	$("#inputTipoUsuario").change(function(){
		let valorTipoUsuario = $(this).val();

		if(valorTipoUsuario == 1) $(".alumno").show();
		else{
			$(".alumno").hide();
			$(".tutor").show();
		}
	});

	/* Validaciones
	–––––––––––––––––––––––––––––––––––––––––––––––––*/
	// Validar al registrarse
	$("#buttonRegistro").click(function(evento){

		$("#inputNombre").removeClass("is-invalid");
		$("#inputApellidoPaterno").removeClass("is-invalid");
		$("#inputApellidoMaterno").removeClass("is-invalid");
		$("#inputFechaNacimiento").removeClass("is-invalid");
		$("#inputPhone").removeClass("is-invalid");
		$("#alertRegistro").hide();

		if($("#inputPhone").val().length == 0){

			evento.preventDefault();
			$("#inputPhone").addClass("is-invalid");
			$("#inputPhone").focus();
			$("#alertRegistro").show();
		}

		if($("#inputFechaNacimiento").val().length == 0){

			evento.preventDefault();
			$("#inputFechaNacimiento").addClass("is-invalid");
			$("#inputFechaNacimiento").focus();
			$("#alertRegistro").show();
		}

		if($("#inputApellidoMaterno").val().length == 0){

			evento.preventDefault();
			$("#inputApellidoMaterno").addClass("is-invalid");
			$("#inputApellidoMaterno").focus();
			$("#alertRegistro").show();
		}

		if($("#inputApellidoPaterno").val().length == 0){

			evento.preventDefault();
			$("#inputApellidoPaterno").addClass("is-invalid");
			$("#inputApellidoPaterno").focus();
			$("#alertRegistro").show();
		}

		if($("#inputNombre").val().length == 0){

			evento.preventDefault();
			$("#inputNombre").addClass("is-invalid");
			$("#inputNombre").focus();
			$("#alertRegistro").show();
		}
	});
});