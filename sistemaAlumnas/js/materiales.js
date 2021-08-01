$(document).ready(function(){

	$("#adviseGenerarArchivo").hide();
	$("#adviseTamanioArchivo").hide();

	$("#buttonRegistroArchivo").click(function(evento){
		
		if($("#inputNombreArchivo").val().length == 0){
			evento.preventDefault();
			$("#adviseGenerarArchivo").show();
			$("#inputNombreArchivo").focus();
		}
		else{

			$(this).html("Subiendo");
			$(this).addClass("vov");
			$(this).addClass("flash");
			$(this).addClass("infinite");
			$(this).addClass("slow");
			$("#adviseTamanioArchivo").show();
		}
	});

	$(".buttonEliminarMaterial").click(function(evento){

		let idMaterial = $(this).data("id_material");
		$(this).closest('tr').remove();

		let url = "http://educzesto.org/login/php/sql/ajax/eliminaMaterial.php?idMaterial="+idMaterial;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v14/php/sql/ajax/eliminaMaterial.php?idMaterial="+idMaterial;

		$.ajax({url:url, success: function(result){

			console.log(result);
		}});
	});


});