$(document).ready(function(){

	$("#adviseGenerarDocumento").hide();

	$("#buttonRegistroDocumento").click(function(evento){		

		if($("#inputSelectorDocumento").val() == 0){
			evento.preventDefault();
			$("#adviseGenerarDocumento").show();
			$("#inputSelectorDocumento").focus();
		}
		else{

			$(this).html("Subiendo");
			$(this).addClass("vov");
			$(this).addClass("flash");
			$(this).addClass("infinite");
			$(this).addClass("slow");
		}

	});

	$(".buttonEliminarDocumento").click(function(evento){

		let idDocumento = $(this).data("id_documento");
		$(this).closest('tr').remove();

		let url = "http://educzesto.org/login/php/sql/ajax/eliminaDocumento.php?idDocumento="+idDocumento;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v11/php/sql/ajax/eliminaDocumento.php?idDocumento="+idDocumento;

		$.ajax({url:url, success: function(result){

			console.log(result);
		}});
	});


});