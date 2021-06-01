$(document).ready(function(){

	let credenciales = [
	{"pltf":"gmail","user":"edu.czesto@gmail.com","passw":"Serviciosocial2020"},
	{"pltf":"youtube","user":"edu.czesto@gmail.com","passw":"Serviciosocial2021"},
	{"pltf":"facebook","user":"edu.czesto@gmail.com","passw":"Serviciosocial2020"},
	{"pltf":"instagram","user":"edu.czesto@gmail.com","passw":"Serviciosocial2021"},
	{"pltf":"edublogs","user":"edu.czesto@gmail.com","passw":"Serviciosocial2020"},
	{"pltf":"khanacademy","user":"edu.czesto@gmail.com","passw":"Serviciosocial2020"},
	{"pltf":"wordpress","user":"edu.czesto@gmail.com","passw":"Serviciosocial2020"},
	{"pltf":"box","user":"edu.czesto@gmail.com","passw":"Serviciosocial2021"},
	{"pltf":"classroom","user":"edu.czesto@gmail.com","passw":"Serviciosocial2020"},
	{"pltf":"configFTP","user":"edu.czesto@gmail.com","passw":"Serviciosocial2020"}];

	// Inicialización
	armarCard('gmail');

	function armarCard(menuOpcion){

		$('.card').hide();

		let query = "*[data-tag='"+menuOpcion+"']";
		// $('*[data-tag="gmail"]').show();
		$(query).show();

		for (let elemento = 0; elemento < credenciales.length; elemento++){
			if(menuOpcion == credenciales[elemento]['pltf']){

				// Texto en div
				$('.infoUser').text(credenciales[elemento]['user']);

				// Texto en data
				$('.btnCopiarUser').data('info',credenciales[elemento]['user']);
				$('.btnCopiarPswd').data('info',credenciales[elemento]['passw']);

			}
		}
	}

	function volverColorNormal(){

		$(".btnCopiar").css("background-color", "#FFCD00");
		// $(".btnCopiar").css("color", "#fff");
		$(".btnCopiar").html("Copiar");
	}

	function volverTextoOculto(){

		$(".infoPswd").html("************");
	}

	function copyToClipboard(text) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(text).select();
		document.execCommand("copy");
		$temp.remove();
	}

	// Copia valor data
	$(".btnCopiar").click(function(evento){

		let dataInfo = $(this).data("info");

		copyToClipboard(dataInfo);

		$(this).css("background-color", "#B5F0BC");
		$(this).css("color", "#fff");
		$(this).html("Copiado");

		setTimeout(volverColorNormal, 2000);

	});

	// Muestra la contraseña
	$(".linkPswdShow").click(function(evento){
		let infoPswd = $('.btnCopiarPswd').data('info');
		$('.infoPswd').text(infoPswd);

		setTimeout(volverTextoOculto, 1500);
	});

	// Opción menú lateral
	$('*[data-pltf]').click(function(evento){

		let menuOpcion = $(this).data();
		$('.btnMenuPltf').removeClass('active');
		$(this).addClass('active');

		armarCard(menuOpcion['pltf']);
	});


});