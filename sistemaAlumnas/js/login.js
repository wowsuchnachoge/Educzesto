$(document).ready(function(){
	$("#alertCamposVacios").hide();

    /* Validaciones
	–––––––––––––––––––––––––––––––––––––––––––––––––*/
	// Validación de acceso
	$("#buttonLogin").click(function(evento){

		$("#inputUsuario").removeClass("is-invalid");
		$("#inputPassword").removeClass("is-invalid");
		$("#alertCamposVacios").hide();

		if($("#inputPassword").val().length == 0){
			evento.preventDefault();
			$("#inputPassword").addClass("is-invalid");
			$("#inputPassword").focus();
			$("#alertCamposVacios").show();
		}

		if($("#inputUsuario").val().length == 0){
			evento.preventDefault();
			$("#inputUsuario").addClass("is-invalid");
			$("#inputUsuario").focus();
			$("#alertCamposVacios").show();
		}
	});
});