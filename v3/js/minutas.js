$(document).ready(function(){

	$("#inptFechaMinuta").on("input", function(){

		$("#btnModalMinutasCrear").prop("disabled", false);
		console.info('inptFechaMinuta');
	});

	$("#btnModalMinutasCrear").click(function(evento){

		if($("#inptFechaMinuta").val() === ""){

			evento.preventDefault();
			$("#inptFechaMinuta").addClass("is-invalid");
		}
		else $("#inptFechaMinuta").removeClass("is-invalid");

	});

	$(".btnAcuerdoAct").click(function(evento){

		console.info('.btnAcuerdoAct');

	});

	$(".btnAcuerdoBorrar").click(function(evento){

		console.info('.btnAcuerdoBorrar');

	});

	$("#inptPeriodoBusqueda").on("input", function(){

		$("#inptFechaBusqueda option").remove();

		let url = "http://educzesto.org/login/sql/ajax/ajaxFechas.php?idPeriodo="+$(this).val();

		$.ajax({url:url, success: function(result){
			// console.info(result);
			$("#inptFechaBusqueda").append(result);
		}});
	});

	$("#btnCargarFecha").click(function(evento){

		console.info('btnCargarFecha');
	});

});