$(document).ready(function(){

	$(".buttonVista").click(function(evento){
		let idUsuario = $(this).data("id_usuario");
		let buttonVista = $(this);

		let url = "http://educzesto.org/login/php/sql/ajax/herramientasVistaUsuarios.php?idUsuario="+idUsuario;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v11/php/sql/ajax/herramientasVistaUsuarios.php?idUsuario="+idUsuario;

		$.ajax({url:url, success: function(result){

			if(result == 1){
				$(buttonVista).html("Activar");
				$(buttonVista).removeClass("btn-dark");
				$(buttonVista).addClass("btn-light");
			} 
			if(result == 0){
				$(buttonVista).html("Desactivar");
				$(buttonVista).removeClass("btn-light");
				$(buttonVista).addClass("btn-dark");
			} 
		}});
	});


	$(".buttonTipoUsuario").click(function(evento){

		let idUsuario = $(this).data("id_usuario");
		let buttonTipoUsuario = $(this);

		let url = "http://educzesto.org/login/php/sql/ajax/herramientasTipoUsuario.php?idUsuario="+idUsuario;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v11/php/sql/ajax/herramientasTipoUsuario.php?idUsuario="+idUsuario;

		$.ajax({url:url, success: function(result){

			if(result == 3){
				$(buttonTipoUsuario).removeClass("btn-warning");
				$(buttonTipoUsuario).addClass("btn-dark");
			} 
			if(result == 2){
				$(buttonTipoUsuario).removeClass("btn-dark");
				$(buttonTipoUsuario).addClass("btn-warning");
			} 
		}});
	});

	$(".buttonAsignar").click(function(evento){

		let idAlumno = $(this).data("id_alumno");
		console.log("idAlumno", idAlumno);
		let idTutor = $(this).data("id_tutor");
		console.log("idTutor", idTutor);

		let buttonAsignar = $(this);

		let url = "http://educzesto.org/login/php/sql/ajax/herramientasAsignarUsuario.php?idAlumno="+idAlumno+"&idTutor="+idTutor;
		// let url = "http://localhost/sistemaAlumnas2021/codigo/v11/php/sql/ajax/herramientasAsignarUsuario.php?idAlumno="+idAlumno+"&idTutor="+idTutor;

		$.ajax({url:url, success: function(result){

			if(result == 0){
				$(buttonAsignar).removeClass("btn-success");
				$(buttonAsignar).addClass("btn-dark");
			} 
			if(result == 1){
				$(buttonAsignar).removeClass("btn-dark");
				$(buttonAsignar).addClass("btn-success");
			} 
		}});
	});
});