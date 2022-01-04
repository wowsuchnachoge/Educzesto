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
		<link href="css/materialesConsulta.css" rel="stylesheet" />
	</header>
	<main>
		<div class="container">
    <br>
    <br>
    <h1><i class="icon-book text-dark mr-2"></i> Materiales de Consulta</h1>
    <div class="row">
    <div class="col-sm">
      <div class="component">
          <ul class="align">
            <li>
              <figure class='book'>
                <!-- Front -->
                <ul class='hardcover_front'>
                  <li>                    
                    <div class="coverDesign green">
                      <h1>Manejo</h1>
                      <p>de Plataformas</p>
                    </div>
                  </li>
                  <li></li>
                </ul>
                <!-- Pages -->
                <ul class='page'>
                  <li></li>
                  <li>
                    <br>
                    <a class="btn-book-google" href="https://drive.google.com/drive/u/1/folders/1Wp3gHGE8B_2TokbmTkYW-jbULSQpa1PY"><i class="icon-folder  text-info mr-2"></i> Ver en Google Drive</a>
                    <a class="btn-book" target="_blank" href="plataformas.php"><i class="icon-newspaper  text-dark mr-2"></i>Acceso a Plataformas</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/manejoPlataformas/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Khan Academy</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/manejoPlataformas/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Canva</a><br>                    
                  </li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                <!-- Back -->
                <ul class='hardcover_back'>
                  <li></li>
                  <li></li>
                </ul>
                <ul class='book_spine'>
                  <li></li>
                  <li></li>
                </ul>
              </figure>
              <br>
            </li>
          </ul>
        </div>
      </div>
    <div class="col-sm">
      <div class="component">
          <ul class="align">
            <li>
              <figure class='book'>
                <!-- Front -->
                <ul class='hardcover_front'>
                  <li>
                    <div class="coverDesign green">
                      <h1>Plantillas</h1>
                      <p>para Tutores</p>
                    </div>
                  </li>
                  <li></li>
                </ul>
                <!-- Pages -->
                <ul class='page'>
                  <li></li>
                  <li>
                    <br>
                    <a class="btn-book-google" href="https://drive.google.com/drive/u/1/folders/1_TvnXxHTyWUVzqchXBV-wlLVNCiLXorx"><i class="icon-folder  text-info mr-2"></i> Ver en Google Drive</a>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/templates/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Diploma alumnas</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/templates/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Infografía</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/templates/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Línea gráfica</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/templates/4.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Valor del mes</a><br>
                  </li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                <!-- Back -->
                <ul class='hardcover_back'>
                  <li></li>
                  <li></li>
                </ul>
                <ul class='book_spine'>
                  <li></li>
                  <li></li>
                </ul>
              </figure>
              <br>
            </li>
          </ul>
        </div>
      </div>
    <div class="col-sm">
      <div class="component">
          <ul class="align">
            <li>
              <figure class='book'>
                <!-- Front -->
                <ul class='hardcover_front'>
                  <li>
                    <div class="coverDesign green">
                      <h1>Material</h1>
                      <p>para Tutores</p>
                    </div>
                  </li>
                  <li></li>
                </ul>
                <!-- Pages -->
                <ul class='page'>
                  <li></li>
                  <li>
                    <br>
                    <a class="btn-book-google" href="https://drive.google.com/drive/u/1/folders/1_TvnXxHTyWUVzqchXBV-wlLVNCiLXorx"><i class="icon-folder  text-info mr-2"></i> Ver en Google Drive</a>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/materialTutores/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Plan de trabajo</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/materialTutores/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Trabajadoras del hogar y discriminación</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/materialTutores/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Trabajadoras domésticas_2015</a><br>
                    </li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                <!-- Back -->
                <ul class='hardcover_back'>
                  <li></li>
                  <li></li>
                </ul>
                <ul class='book_spine'>
                  <li></li>
                  <li></li>
                </ul>
              </figure>
              <br>
            </li>
          </ul>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-sm">
      <div class="component">
          <ul class="align">
            <li>
              <figure class='book'>
                <!-- Front -->
                <ul class='hardcover_front'>
                  <li>
                    <div class="coverDesign green">
                      <h2>Infografías</h2>
                      <p>de ejemplo</p>
                    </div>
                  </li>
                  <li></li>
                </ul>
                <!-- Pages -->
                <ul class='page'>
                  <li></li>
                  <li>
                    <br>
                    <a class="btn-book-google" href="https://drive.google.com/drive/u/1/folders/1_TvnXxHTyWUVzqchXBV-wlLVNCiLXorx"><i class="icon-folder  text-info mr-2"></i> Ver en Google Drive</a>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/infografias/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Datos personales</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/infografias/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Asesoría en la parroquia</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/infografias/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Información en tiempos de pandemia</a><br>			
                  </li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                <!-- Back -->
                <ul class='hardcover_back'>
                  <li></li>
                  <li></li>
                </ul>
                <ul class='book_spine'>
                  <li></li>
                  <li></li>
                </ul>
              </figure>
              <br>
            </li>
          </ul>
        </div>
      </div>
    <div class="col-sm">
      <div class="component">
          <ul class="align">
            <li>
              <figure class='book'>
                <!-- Front -->
                <ul class='hardcover_front'>
                  <li>
                    <div class="coverDesign green">
                      <h1>Guías</h1>
                      <p>generales</p>
                    </div>
                  </li>
                  <li></li>
                </ul>
                <!-- Pages -->
                <ul class='page'>
                  <li></li>
                  <li>
                    <br>
                    <a class="btn-book-google" href="https://drive.google.com/drive/u/1/folders/1_TvnXxHTyWUVzqchXBV-wlLVNCiLXorx"><i class="icon-folder  text-info mr-2"></i> Ver en Google Drive</a>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/guias/1.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Construyendo aprendizaje</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/guias/2.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Correo electrónico</a><br>
                    <a class="btn-book" target="_blank" href="archivos/materialesConsulta/guias/3.pdf"><i class="icon-newspaper  text-dark mr-2"></i>Curso ortografía</a><br>
                  </li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                <!-- Back -->
                <ul class='hardcover_back'>
                  <li></li>
                  <li></li>
                </ul>
                <ul class='book_spine'>
                  <li></li>
                  <li></li>
                </ul>
              </figure>
              <br>
            </li>
          </ul>
        </div>
      </div>
    <div class="col-sm">
      <div class="component">
          <ul class="align">
            <li>
              <figure class='book'>
                <!-- Front -->
                <ul class='hardcover_front'>
                  <li>
                    <div class="coverDesign green">
                      <h4>Diagnósticos</h4>
                      <p>para Alumnos</p>
                    </div>
                  </li>
                  <li></li>
                </ul>
                <!-- Pages -->
                <ul class='page'>
                  <li></li>
                  <li>
                    <br>
                    <br>
                    <a class="btn-book-google" href="https://drive.google.com/drive/u/1/folders/1_TvnXxHTyWUVzqchXBV-wlLVNCiLXorx"><i class="icon-folder  text-info mr-2"></i> Ver en Google Drive</a>
                  </li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                <!-- Back -->
                <ul class='hardcover_back'>
                  <li></li>
                  <li></li>
                </ul>
                <ul class='book_spine'>
                  <li></li>
                  <li></li>
                </ul>
              </figure>
              <br>
            </li>
          </ul>
        </div>
      </div>
  </div>
	<?php if($tipoUsuario != 1){?><?php include("php/includes/modals.php");?><?php }?>
</body>
</html>

<?php 
	include("php/sql/interactDB.php");
	include("php/sql/calendario.php");

	$idUsuario = $_POST["idUsuario"];

	$calendario = new Calendario();
	$arregloFilasCalendario = $calendario->consultaCalendario();
	// var_dump($arregloFilasCalendario);

?>