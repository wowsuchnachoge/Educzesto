$(document).ready(function(){

	$("#alrtRegistro").hide();
	$("#inptTipoUsuario").val(1);

    $("#inptTipoUsuario").change(function(){
        let valorTipoUsuario = $(this).val();

        if(valorTipoUsuario == 1){
        		$(".alumno").show();
        }
        else{
        	$(".alumno").hide();
			$(".tutor").show();
			$(".admin").show();
        } 
    });

	$("#btnRegistro").click(function(evento){

		$("#inptNombre").removeClass("is-invalid");
		$("#inptApellidoPaterno").removeClass("is-invalid");
		$("#inptApellidoMaterno").removeClass("is-invalid");
		$("#inptFechaNacimiento").removeClass("is-invalid");
		$("#inptTel").removeClass("is-invalid");
		$("#alrtRegistro").hide();

	    /* Validación de campos vacíos
		–––––––––––––––––––––––––––––––––––––––––––––––––*/
		if($("#inptTel").val().length == 0){

			evento.preventDefault();
			$("#inptTel").addClass("is-invalid");
			$("#inptTel").focus();
			$("#alrtRegistro").show();
		}

		if($("#inptFechaNacimiento").val().length == 0){

			evento.preventDefault();
			$("#inptFechaNacimiento").addClass("is-invalid");
			$("#inptFechaNacimiento").focus();
			$("#alrtRegistro").show();
		}


		if($("#inptApellidoMaterno").val().length == 0){

			evento.preventDefault();
			$("#inptApellidoMaterno").addClass("is-invalid");
			$("#inptApellidoMaterno").focus();
			$("#alrtRegistro").show();
		}

		if($("#inptApellidoPaterno").val().length == 0){

			evento.preventDefault();
			$("#inptApellidoPaterno").addClass("is-invalid");
			$("#inptApellidoPaterno").focus();
			$("#alrtRegistro").show();
		}
		
		if($("#inptNombre").val().length == 0){

			evento.preventDefault();
			$("#inptNombre").addClass("is-invalid");
			$("#inptNombre").focus();
			$("#alrtRegistro").show();
		}




	});
});