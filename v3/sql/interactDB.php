<?php  

	class InteractDB{

		private $hostname_db = "173.201.185.124";
		private $database_db = "sistemaAlumnas";
		private $username_db = "educzesto";
		private $password_db = "ServicioSocial2021";
		private $conexion = "";

		public $idUsuario 	 				= "";
		public $tipoUsuario 					= "";
		public $nombreUsuario          	= "";
		public $nombreCompletoUsuario    = "";
		public $apellidoPaternoUsuario 	= "";
		public $apellidoMaternoUsuario 	= "";
		public $fechaNacimientoUsuario 	= "";
		public $generoUsuario          	= "";
		public $emailUsuario           	= "";
		public $telefonoUsuario        	= "";
		public $infoContactoUsuario    	= "";

		public $vistaUsuario  	= "";

		public $ultimoPeriodo 	= 0;
		public $ultimaMinuta 	= 0;

		public $fechaMinutaActual 		= "";
		public $idPeriodoMinutaActual = 0;
		public $periodoMinutaActual 	= "";
		public $desgloseMinutaActual 	= "";

		public $idPeriodos 		= array();
		public $nombrePeriodos 	= array();

		public $idMinutas = array();
		public $fechas 	= array();

		public $idAcuerdos = array();
		public $acuerdos = array();
		public $responsables = array();
		public $fechasLimite = array();

		function __construct() {
	      // print "En el constructor InteractDB\n";
			$this->conexion = mysqli_connect($this->hostname_db, $this->username_db, $this->password_db);
			mysqli_select_db($this->conexion,$this->database_db) or die ("Ninguna DB seleccionada");
		}

		/* Minutas
		––––––––––––––––––––––––––––––––––––––––––––––––– */
		public function crearMinuta($fechaMinuta){

			$this->consultaUltimoPeriodo();

			$accion_nm = sprintf("INSERT INTO minutas(fecha, idPeriodo)
										VALUES ('%s','%d')", $fechaMinuta, $this->ultimoPeriodo);

			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());
		}

		public function consultaUltimaMinuta(){

			$accion_nm = "SELECT idMinuta FROM minutas ORDER BY idMinuta DESC LIMIT 1";
			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){

				$this->ultimaMinuta = $fila['idMinuta'];
			}
		}
		
		public function consultaParticipantes($idPeriodoMinutaActual){

			$arregloNombresCompletos = array();

			$accion_nm = sprintf("SELECT 	tipoUsuario,
													nombre,
													apellidoPaterno,
													apellidoMaterno,
													fechaNacimiento,
													genero,
													email,
													telefono,
													infoContacto,
													vista
										FROM personas
										WHERE idPeriodo = '%d'
										OR idUsuario = 1
										OR idUsuario = 2", $idPeriodoMinutaActual);

			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){

				$nombre = $fila['nombre'];
				$apellidoPaterno = $fila['apellidoPaterno'];
				array_push($arregloNombresCompletos,$nombre." ".$apellidoPaterno);
			}

			return $arregloNombresCompletos;
		}

		public function cargarMinuta($idMinuta){

			$accion_nm = sprintf("	SELECT 	*
											FROM	minutas
											LEFT JOIN periodos
											ON minutas.idPeriodo = periodos.idPeriodo
											WHERE idMinuta = '%d'",
											$idMinuta);

			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){

				$this->fechaMinutaActual 	 	= $fila['fecha'];
				$this->periodoMinutaActual	 	= $fila['periodo'];
				$this->idPeriodoMinutaActual	= $fila['idPeriodo'];
				$this->desgloseMinutaActual 	= $fila['desglose'];
			}
		}

		public function borrarMinuta($idMinuta){
			
			$accion_nm = sprintf("	DELETE FROM minutas
											WHERE idMinuta = '%d'",
											$idMinuta);
			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			// ** Borrar acuerdos
		}

		public function actualizaDesgloseMinuta($idMinuta, $txtdesgloseMinuta){

			$accion_nm = sprintf("UPDATE minutas SET desglose='%s' WHERE idMinuta = '%d'",$txtdesgloseMinuta, $idMinuta);
			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

		}

		public function cargaAcuerdosMinuta($idMinuta){
			$accion_nm = "SELECT idAcuerdo, acuerdo, responsable, fechaLimite FROM acuerdos WHERE idMinuta = '$idMinuta'";
			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){

				array_push($this->idAcuerdos,$fila['idAcuerdo']);
				array_push($this->acuerdos,$fila['acuerdo']);
				array_push($this->responsables,$fila['responsable']);
				array_push($this->fechasLimite,$fila['fechaLimite']);
			}

		}

		public function creaAcuerdoMinuta($idMinuta){

				$accion_nm = " INSERT INTO acuerdos(idMinuta)
									VALUES('$idMinuta')";

				$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());
		}

		public function borrarAcuerdo($idAcuerdo){

				$accion_nm = " DELETE FROM acuerdos
									WHERE idAcuerdo = '$idAcuerdo'";

				$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());
		}

		public function actualizaAcuerdo($contenidoAcuerdo, $responsableAcuerdo, $fechasLimiteAcuerdo, $idAcuerdo){

			$accion_nm = sprintf("UPDATE acuerdos SET desglose='%s' WHERE idMinuta = '%d'",$txtdesgloseMinuta, $idMinuta);

			// Armamos el query
			$accion_nm = "UPDATE acuerdos SET";

			if(!empty($contenidoAcuerdo)){
				$accion_set .= " acuerdo='$contenidoAcuerdo'";
			}

			if(!empty($responsableAcuerdo)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " responsable='$responsableAcuerdo'";
			}
			
			if(!empty($fechasLimiteAcuerdo)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " fechaLimite='$fechasLimiteAcuerdo'";
			}
			
			$accion_nm .= $accion_set;
			$accion_nm .= " WHERE idAcuerdo='$idAcuerdo'";

			$consulta_nm=mysqli_query($this->conexion,$accion_nm);
		}


		/* Periodos
		––––––––––––––––––––––––––––––––––––––––––––––––– */
		public function consultaUltimoPeriodo(){

			$accion_nm = "SELECT idPeriodo FROM periodos ORDER BY idPeriodo ASC LIMIT 1";
			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){
				$this->ultimoPeriodo = $fila['idPeriodo'];
			}
		}

		public function consultaPeriodo($periodo){
			$accion_nm = sprintf("SELECT periodo FROM periodos WHERE periodo LIKE '%s'", $periodo);

			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());
			return mysqli_num_rows($consulta_nm);
		}

		public function agregaPeriodo(){
			$fechaActual 	= date("m-d");

			$periodo1 		= "01-01";
			$periodo2 		= "07-01";

			$periodo3 		= "12-31";

			if(($fechaActual>=$periodo1)&&($fechaActual<$periodo2)){
				$periodo = "PRI-" .date("Y");
			}

			if(($fechaActual>=$periodo2)&&($fechaActual<$periodo3)){
				$periodo = "OTO-" .date("Y");
			}

			$respuestaPeriodo = $this->consultaPeriodo($periodo);

			if($respuestaPeriodo == 0){

				$accion_nm = " INSERT INTO periodos(periodo)
									VALUES('$periodo')";

				$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());
			}
		}

		public function consultaPeriodos(){
			$accion_nm = "SELECT idPeriodo, periodo FROM periodos";
			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){
				array_push($this->idPeriodos,$fila['idPeriodo']);
				array_push($this->nombrePeriodos,$fila['periodo']);
			}
		}

		public function consultaFechasPeriodo($idPeriodo){
			$accion_nm = "SELECT idMinuta, fecha FROM minutas WHERE idPeriodo = $idPeriodo";
			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){
				array_push($this->idMinutas,$fila['idMinuta']);
				array_push($this->fechas,$fila['fecha']);
			}
		}

		/* Agregar usuarios
		––––––––––––––––––––––––––––––––––––––––––––––––– */
		public function agregarAlumnos(){
			var_dump("agregarAlumnos");
			// ** agregarAlumnos
		}

		public function agregarTutores($inptNombre, $inptApellidoPaterno, $inptApellidoMaterno, $inptFechaNacimiento, $generoUsuario, $inptEmail, $inptTel, $inptContacto){

			$accion_nm = sprintf("	INSERT INTO personas (tipoUsuario,nombre,apellidoPaterno,apellidoMaterno,fechaNacimiento,genero,email,telefono,infoContacto,vista,idPeriodo)
											VALUES ('2','%s','%s','%s','%s','%d','%s','%s','%s','1','%d')",
											$inptNombre, 
											$inptApellidoPaterno, 
											$inptApellidoMaterno, 
											$inptFechaNacimiento, 
											$generoUsuario, 
											$inptEmail, 
											$inptTel, 
											$inptContacto,
											$this->ultimoPeriodo);

			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());
		}

		/* Consultas
		––––––––––––––––––––––––––––––––––––––––––––––––– */
		public function consultaLogin($inptUser, $inptPassword){
			$nombreA = $inptUser[0];
			$nombreB = substr($inptUser, 1);
			$flagResLogin = 0;

			$accion_nm = sprintf("	SELECT idUsuario, nombre, vista FROM personas 
											WHERE nombre LIKE '%s%%' 
											AND apellidoPaterno = '%s' 
											AND fechaNacimiento = '%s'",
											$nombreA,
											$nombreB, 
											$inptPassword);

			$consulta_nm = mysqli_query($this->conexion,$accion_nm) or die(mysqli_error());

			while($fila = mysqli_fetch_assoc($consulta_nm)){

				$this->idUsuario 		= $fila['idUsuario'];
				$this->nombreUsuario = $fila['nombre'];
				$this->vistaUsuario 	= $fila['vista'];
				$flagResLogin = 1;
			}

			return $flagResLogin;
		}

		public function consultaPerfil($id){

			$accion_nm = sprintf("	SELECT 	tipoUsuario,
														nombre,
														apellidoPaterno,
														apellidoMaterno,
														fechaNacimiento,
														genero,
														email,
														telefono,
														infoContacto,
														vista
											FROM personas 
											WHERE idUsuario = '%d'",
											$id);

			$consulta_nm=mysqli_query($this->conexion,$accion_nm);

			while($fila = mysqli_fetch_assoc($consulta_nm)){

				$this->tipoUsuario 	          	= $fila['tipoUsuario'];
				$this->nombreUsuario          	= $fila['nombre'];
				$this->nombreCompletoUsuario		= $fila['nombre']." ".$fila['apellidoPaterno']." ".$fila['apellidoMaterno'];
				$this->apellidoPaternoUsuario 	= $fila['apellidoPaterno'];
				$this->apellidoMaternoUsuario 	= $fila['apellidoMaterno'];
				$this->fechaNacimientoUsuario 	= $fila['fechaNacimiento'];
				$this->generoUsuario          	= $fila['genero'];
				$this->emailUsuario           	= $fila['email'];
				$this->telefonoUsuario        	= $fila['telefono'];
				$this->infoContactoUsuario    	= $fila['infoContacto'];

			}
		}

		/* Actualizaciones de usuario
		––––––––––––––––––––––––––––––––––––––––––––––––– */
		public function actualizaDatosUsr($inptNombre, $inptApellidoPaterno, $inptApellidoMaterno, $inptFechaNacimiento, $generoUsuario, $inptEmail, $inptTel, $idUsuario){

	  		// Armamos el query
			$accion_nm = "UPDATE personas SET";

			if(!empty($inptNombre)){
				$accion_set .= " nombre='$inptNombre'";
			}

			if(!empty($inptApellidoPaterno)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " apellidoPaterno='$inptApellidoPaterno'";
			}
			
			if(!empty($inptApellidoMaterno)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " apellidoMaterno='$inptApellidoMaterno'";
			}
			
			if(!empty($inptFechaNacimiento)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " fechaNacimiento='$inptFechaNacimiento'";
			}

			if(!empty($generoUsuario)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " genero='$generoUsuario'";
			}

			if(!empty($inptEmail)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " email='$inptEmail'";
			}

			if(!empty($inptTel)){
				if(!empty($accion_set)) $accion_set .= ",";
				$accion_set .= " telefono='$inptTel'";
			}

			$accion_nm .= $accion_set;
			$accion_nm .= " WHERE idUsuario='$idUsuario'";

			$consulta_nm=mysqli_query($this->conexion,$accion_nm);
		}

		public function cierraDB(){
			mysqli_close($this->conexion);
		}
	}
?>

