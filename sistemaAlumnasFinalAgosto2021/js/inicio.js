$(document).ready(function(){

	$(".buttonMaterialEstado").click(function(evento){

		$(this).removeClass('btn-secondary');
		$(this).addClass('btn-success');

		let idMaterial = $(this).data("id_material");

		let url = "http://educzesto.org/login/php/sql/ajax/estadoMaterial.php?idMaterial="+idMaterial;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v12/php/sql/ajax/estadoMaterial.php?idMaterial="+idMaterial;

		$.ajax({url:url, success: function(result){

			console.log(result);
		}});
	});
});