<!-- Si el usuario se registra correctamente -->
<?if((isset($_GET["login"]))&&($_GET["login"] == 1)){?>
	<div class="alert alert-success mt-2">
		<p><small><strong>¡Muy bien!</strong> El registro se agregó <strong>correctamente.</strong></small></p>
	</div>
<?}?>
<!-- Si existe una falla en el registo -->
<?if((isset($_GET["login"]))&&($_GET["login"] == 2)){?>
	<div class="alert alert-danger mt-2">
		<p><small><strong>Lo sentimos.</strong><br>El usuario o la contraseña ingresados <strong>no son válidos</strong>.<br><strong><hr>Por favor, ponte en contacto con los administradores.</strong></small></p>
	</div>
<?}?>
<!-- Si existe una falla en el registo -->
<?if((isset($_GET["login"]))&&($_GET["login"] == 3)){?>
	<div class="alert alert-warning mt-2">
		<p><small><strong>Lo sentimos</strong>, la página que intentas buscar <strong>no existe</strong>.</small></p>
	</div>
<?}?>