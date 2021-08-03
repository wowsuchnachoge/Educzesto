<?php session_start();?>
<?php  
	include("php/sql/interactDB.php");
	include("php/sql/usuario.php");
	include("php/includes/cleanText.php");

	include("php/includes/validaSesionActiva.php");
	$tituloArchivo = "materialesConsulta.php";

	$usuario = new Usuario();

	// Undefined index: datosUsuarioActivo in /home/vlm0dijktjmb/public_html/login/herramientas.php on line 16
	$usuario->consultaUsuarioId($_SESSION["datosUsuarioActivo"]["idUsuario"]);
	$_SESSION["datosUsuarioActivo"] = $usuario->datosUsuario;

	$tipoUsuario = $_SESSION["datosUsuarioActivo"]["tipoUsuario"];
	$idUsuario = $_SESSION["datosUsuarioActivo"]["idUsuario"];

	$usuario->cierraBaseDatos();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("php/includes/head.html");?>
	<title>Materiales de Consulta</title>

	<!-- Recursos locales
	––––––––––––––––––––––––––––––––––––––––––––––––– -->
</head>
<body>
	<header>
		<?php include("php/includes/dynamicHeader.php");?>
	</header>
	<main>
		<div class="container">
      <br>
    <div class="col-sm-12 col-lg-8">
						<div class="card mb-3">
							<div class="card-header"><i class="icon-folder text-dark mr-2"></i>Material para <strong><?php echo $_SESSION["datosUsuarioActivo"]["nombreCompleto"];?></strong></div>
							<div class="card-body">
							<details>
							<summary>Lista de archivos</summary>
							<br>
								<?php /*foreach($listaMateriales as $valor){*/?>
								<div class="row">
									<div class="col"><p><i class="icon-newspaper text-dark"></i><?php echo $valor["nombre"];?></p></div>
									<div class="col mt-2">
										<?php if($valor["flagLink"] == 1){?>
										<a href="<?php echo "https://".$valor["url"];?>" type="button" class="btn btn-secondary float-right ml-1" target="_blank"><i class="icon-link text-light"></i></a><?php }?>
										<?php if($valor["flagMaterial"] == 1){?>
										 <a href="<?php echo 'archivos/'.$valor['idMaterial'].'.pdf';?>" type="button" class="btn btn-secondary float-right" target="_blank"><i class="icon-newspaper text-light"></i></a><?php }?>
									</div>
								</div>
								<hr>
								<?php /*}*/?>
							</details>
							</div>
						</div>
			</div>
			<section value="linksAlumno" class="mt-3">
				<div class="row mb-3">
					<div class="col-12">
						<div class="card mb-3">
							<div class="card-header"><i class="icon-archive text-dark mr-2"></i>Material de consulta</div>
							<div class="card-body">


<!-- Acordeon: 
––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div id="accordion">
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse1">
          <i class="icon-folder text-dark mr-2"></i>Manejo de plataformas
        </button>
      </h5>
    </div>
    <div id="collapse1" class="collapse" data-parent="#accordion">
      <div class="card-body">
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/manejoPlataformas/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Khana Academy</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/manejoPlataformas/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Canva</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/manejoPlataformas/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Facebook</a><br>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse2">
          <i class="icon-folder text-dark mr-2"></i>Templates
        </button>
      </h5>
    </div>
    <div id="collapse2" class="collapse" data-parent="#accordion">
      <div class="card-body">
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/templates/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Diploma alumnas</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/templates/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Ejemplo infografía</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/templates/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Línea gráfica</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/templates/4.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Valor del mes</a><br>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse3">
          <i class="icon-folder text-dark mr-2"></i>Material para tutores
        </button>
      </h5>
    </div>
    <div id="collapse3" class="collapse" data-parent="#accordion">
      <div class="card-body">
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/materialTutores/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Plan de trabajo</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/materialTutores/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Trabajadoras del hogar y discriminación</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/materialTutores/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Trabajadoras domésticas_2015</a><br>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4">
          <i class="icon-folder text-dark mr-2"></i>Infografías
        </button>
      </h5>
    </div>
    <div id="collapse4" class="collapse" data-parent="#accordion">
      <div class="card-body">
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/infografias/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Datos personales</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/infografias/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Asesoría en parroquia Czestochowa</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/infografias/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Información para alumnas en tiempos de pandemia</a><br>			
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/infografias/4.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Ortografía</a><br>
      </div>
    </div>
  </div>

  <br>
  <h5>Guías y diagnósticos</h5>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse5">
          <i class="icon-folder text-dark mr-2"></i>Guías generales
        </button>
      </h5>
    </div>
    <div id="collapse5" class="collapse" data-parent="#accordion">
      <div class="card-body">
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/guias/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Construyendo aprendizaje</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/guias/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Correo electrónico</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/guias/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Curso ortografía</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/guias/4.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Guía internet</a><br>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse6">
          <i class="icon-folder text-dark mr-2"></i>Contenido detallado
        </button>
      </h5>
    </div>
    <div id="collapse6" class="collapse" data-parent="#accordion">
      <div class="card-body">
			<span class="badge rounded-pill bg-warning text-dark" style="font-size: 14px;">Para ver materiales de consulta, ir a <a href="https://www.box.com">Box</a></span>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse7">
          <i class="icon-folder text-dark mr-2"></i>Diagnósticos
        </button>
      </h5>
    </div>
    <div id="collapse7" class="collapse" data-parent="#accordion">
      <div class="card-body">
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/1.pdf"><i class="icon-newspaper text-dark mr-2"></i>Examen_diagnostico_primer_grado_2020-2021-1</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/2.pdf"><i class="icon-newspaper text-dark mr-2"></i>Examen_diagnostico_segundo_grado_2020-2021-1</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/3.pdf"><i class="icon-newspaper text-dark mr-2"></i>Examen_diagnostico_tercer_grado_2020-2021</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/4.pdf"><i class="icon-newspaper text-dark mr-2"></i>Examen_diagnostico_cuarto_grado_2020-2021</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/5.pdf"><i class="icon-newspaper text-dark mr-2"></i>Examen_diagnostico_quinto_grado_2020-2021</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/6.pdf"><i class="icon-newspaper text-dark mr-2"></i>Examen_diagnostico_sexto_grado_2020-2021</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/7.pdf"><i class="icon-newspaper text-dark mr-2"></i>Matematicas-secu-l1eso-AYUDA-PARA-EL-MAESTRO-BLOG</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/8.pdf"><i class="icon-newspaper text-dark mr-2"></i>Matemticas-secu-2ESO-AYUDA-PARA-EL-MAESTRO-BLOG</a><br>
			<a type="button" class="btn btn-link" target="_blank" href="archivos/materialesConsulta/diagnosticos/9.pdf"><i class="icon-newspaper text-dark mr-2"></i>Matemticas-secu-3ESO-AYUDA-PARA-EL-MAESTRO-BLOG</a><br>
      </div>
    </div>
  </div>
</div>








							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
	<?php if($tipoUsuario != 1){?><?php include("php/includes/modals.php");?><?php }?>
</body>
</html>