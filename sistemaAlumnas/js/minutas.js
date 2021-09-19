$(document).ready(function () {

	$("#buttonMinimizarMinuta").click(function (evento) {

		if ($(this).hasClass("openDetails")) {
			$("#detailsParticipantes").removeAttr("open");
			$("#detailsDesgloce").removeAttr("open");
			$("#detailsAcuerdos").removeAttr("open");
			$(this).removeClass("openDetails");
			$("#iconMinimizarMinuta").removeClass("icon-minus");
			$("#iconMinimizarMinuta").addClass("icon-plus");
		}
		else {
			$("#detailsParticipantes").attr("open", true);
			$("#detailsDesgloce").attr("open", true);
			$("#detailsAcuerdos").attr("open", true);
			$(this).addClass("openDetails");
			$("#iconMinimizarMinuta").addClass("icon-minus");
			$("#iconMinimizarMinuta").removeClass("icon-plus");
		}
	});

	$("#adviseMaximoCaracteresDesglose").hide();
	$("#inputContenidoDesglose").on("input", function () {
		var maxlength = $(this).attr("maxlength");
		var currentLength = $(this).val().length;

		if (currentLength >= maxlength) {
			$("#caracteresRestantesDesglose").html(maxlength - currentLength);
			$("#adviseMaximoCaracteresDesglose").show();
			$("#contadorCaracteresDesglose").css("color", "red");
		} else {
			$("#caracteresRestantesDesglose").html(maxlength - currentLength);
			$("#adviseMaximoCaracteresDesglose").hide();
			$("#contadorCaracteresDesglose").css("color", "black");
		}
	});

	$("#periodoMinuta").click(function (evento) {
		if ($("#periodoMinuta").val() != 0) $("#cargarMinuta").show();
		else $("#cargarMinuta").hide();
	});

	$("#cargarMinuta").click(function (evento) {
		$("#minutaMinuta").show();
	});

	$("#adviseMaximoCaracteresAcuerdo").hide();
	$("#inputContenidoAcuerdo").on("input", function () {
		var maxlength = $(this).attr("maxlength");
		var currentLength = $(this).val().length;

		if (currentLength >= maxlength) {
			$("#caracteresRestantesAcuerdo").html(maxlength - currentLength);
			$("#adviseMaximoCaracteresAcuerdo").show();
			$("#contadorCaracteresAcuerdo").css("color", "red");
		} else {
			$("#caracteresRestantesAcuerdo").html(maxlength - currentLength);
			$("#adviseMaximoCaracteresAcuerdo").hide();
			$("#contadorCaracteresAcuerdo").css("color", "black");
		}
	});

	$("#adviseGenerarAcuerdo").hide();
	$(".buttonGenerarAcuerdo").click(function (evento) {

		// if($("#responsableAcuerdo").val() == 0){
		// 	evento.preventDefault();
		// 	$("#adviseGenerarAcuerdo").show();
		// 	$("#responsableAcuerdo").focus();
		// } 

		if ($("#inputFechaLimite").val().length == 0) {
			evento.preventDefault();
			$("#adviseGenerarAcuerdo").show();
			$("#inputFechaLimite").focus();
		}

		if ($("#inputContenidoAcuerdo").val().length == 0) {
			evento.preventDefault();
			$("#adviseGenerarAcuerdo").show();
			$("#inputContenidoAcuerdo").focus();
		}
	});

	$(".buttonEliminaAcuerdo").click(function (evento) {

		let idAcuerdo = $(this).data("id_acuerdo");
		$(this).closest('tr').remove();

		let url = "http://educzesto.org/login/php/sql/ajax/eliminaAcuerdo.php?idAcuerdo=" + idAcuerdo;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v12/php/sql/ajax/eliminaAcuerdo.php?idAcuerdo="+idAcuerdo;

		$.ajax({
			url: url, success: function (result) {

				console.log(result);
			}
		});
	});

	$("#periodoMinuta").on("input", function () {

		$("#fechaMinuta option").remove();
		let url = "http://educzesto.org/login/php/sql/ajax/consultaFechasMinuta.php?idPeriodo=" + $(this).val();
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v12/php/sql/ajax/consultaFechasMinuta.php?idPeriodo="+$(this).val();

		$.ajax({
			url: url, success: function (result) {
				$("#fechaMinuta").append(result);

			}
		});
	});

	let spanFechaMinuta = $("#spanFechaMinuta").html();
	fechaMinuta = new Date(spanFechaMinuta);

	fechaMinuta.setDate(fechaMinuta.getDate() + 8);
	fechaSigSemana = formatDate(fechaMinuta);

	$("#inputFechaLimite").val(fechaSigSemana);

	/* if (document.getElementById("realizado").textContent == "0") {
		console.log("Not done");
		document.getElementById("realizadoCheck").checked = true;
	} else {
		console.log("Done", document.getElementById("realizado").value);
		document.getElementById("realizadoCheck").checked = false;
	} */

	/* 	var matches = element.getElementsByClassName('realizado');
		for (var i=0; i<matches.length; i++) {	  
			if (matches[i] == "0") {
				console.log("No realizado");
				document.getElementById("realizadoCheckBox").checked = false;
				
			} else {			
				console.log("Realizado");
				document.getElementById("realizadoCheckBox").checked = true;			
			}
		} */

	function checkAndUncheckBoxes() {
		var elements = element.getElementsByClassName('realizado'); // get all elements
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].textContent == "0") {
				console.log("No realizado");
				document.getElementById("realizadoCheckBox").checked = false;
			} else {
				console.log("Realizado");
				document.getElementById("realizadoCheckBox").checked = true;
			}
		}
	}

	/* if (document.getElementById("realizado").textContent == "0") {
		console.log("Not done");
		document.getElementById("realizadoCheck").checked = true;
	} else {
		console.log("Done", document.getElementById("realizado").value);
		document.getElementById("realizadoCheck").checked = false;
	} */

});



function formatDate(date) {
	var d = new Date(date),
		month = '' + (d.getMonth() + 1),
		day = '' + d.getDate(),
		year = d.getFullYear();

	if (month.length < 2)
		month = '0' + month;
	if (day.length < 2)
		day = '0' + day;

	return [year, month, day].join('-');
}
