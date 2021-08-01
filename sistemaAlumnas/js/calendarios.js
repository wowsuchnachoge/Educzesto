$(document).ready(function(){

	$(".campoEditar").on("input", function(){

		console.log('buttonGuardarCalendario');
		$("#buttonGuardarCalendario").removeClass("disabled");
	});
});