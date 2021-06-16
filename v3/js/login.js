$(document).ready(function(){

	$("#alrtLogin").hide();

    /* Validación de campos vacíos
	––––––––––––––––––––––––––––––––––––––––––––––––– */
	$("#btnLogin").click(function(evento){

		$("#inptUser").removeClass("is-invalid");
		$("#inptPassword").removeClass("is-invalid");
		$("#alrtLogin").hide();
		
		if($("#inptPassword").val().length == 0){

			evento.preventDefault();
			$("#inptPassword").addClass("is-invalid");
			$("#inptPassword").focus();
			$("#alrtLogin").show();
		}

		if($("#inptUser").val().length == 0){

			evento.preventDefault();
			$("#inptUser").addClass("is-invalid");
			$("#inptUser").focus();
			$("#alrtLogin").show();
		}
	});

});