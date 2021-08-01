$(document).ready(function(){

	$("#inputContenidoBitacora").on("input", function(){
	    var maxlength = $(this).attr("maxlength");
	    var currentLength = $(this).val().length;

		if(currentLength >= maxlength){
			$("#caracteresRestantes").html(maxlength - currentLength);
			$("#adviseMaximoCaracteres").show();
			$("#contadorCaracteres").css("color","red");
		}else{
			$("#caracteresRestantes").html(maxlength - currentLength);
			$("#adviseMaximoCaracteres").hide();
			$("#contadorCaracteres").css("color","black");
		}
	});

	$(".buttonEliminaBitacora").click(function(evento){

		let idBitacora = $(this).data("id_bitacora");
		$(this).closest('tr').remove();

		let url = "http://educzesto.org/login/php/sql/ajax/eliminaBitacora.php?idBitacora="+idBitacora;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v11/php/sql/ajax/eliminaBitacora.php?idBitacora="+idBitacora;

		$.ajax({url:url, success: function(result){

			console.log(result);
		}});
	});
});