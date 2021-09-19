<?php  
class Usuario{

	public $baseDatos = 0;
	public $datosUsuario = 	array(	"idUsuario"	=>"",
												"tipoUsuario"=>"",
												"nombre"=>"",
												"apellidoPaterno"=>"",
												"apellidoMaterno"=>"",
												"nombreCompleto"=>"",
												"fechaNacimiento"=>"",
												"genero"=>"",
												"email"=>"",
												"telefono"=>"",
												"infoContacto"=>"",
												"vista"=>"",
												"idPeriodo"=>"");

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function consultaUsuarioId($idUsuario){

		$query = "	SELECT
						  idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  fechaNacimiento,
						  genero,
						  email,
						  telefono,
						  infoContacto,
						  vista,
						  idPeriodo
						FROM
						  usuarios
						WHERE
						  idUsuario = '%d'";

		$parameters = array($idUsuario);
		$this->baseDatos->selectDB($query, $parameters);
		$fila = $this->baseDatos->getSingleFetchAssocDB();
		
		if(is_null($fila)) return 0;
		else{
			$this->datosUsuario["idUsuario"]       = $fila["idUsuario"];
			$this->datosUsuario["tipoUsuario"]     = $fila["tipoUsuario"];
			$this->datosUsuario["nombre"]          = $fila["nombre"];
			$this->datosUsuario["apellidoPaterno"] = $fila["apellidoPaterno"];
			$this->datosUsuario["apellidoMaterno"] = $fila["apellidoMaterno"];
			$this->datosUsuario["nombreCompleto"]  = $fila["nombre"]." ".$fila["apellidoPaterno"]." ".$fila["apellidoMaterno"];
			$this->datosUsuario["fechaNacimiento"] = $fila["fechaNacimiento"];
			$this->datosUsuario["genero"]          = $fila["genero"];
			$this->datosUsuario["email"]           = $fila["email"];
			$this->datosUsuario["telefono"]        = $fila["telefono"];
			$this->datosUsuario["infoContacto"]    = $fila["infoContacto"];
			$this->datosUsuario["vista"]           = $fila["vista"];
			$this->datosUsuario["idPeriodo"]       = $fila["idPeriodo"];

			return 1;
		}
	}

	public function consultaUsuarioLogin($inputUsuario, $inputPassword){

		$letraInicial 		= $this->baseDatos->escapeSpecialCharacters($inputUsuario[0]);
		$apellido 	  		= $this->baseDatos->escapeSpecialCharacters(substr($inputUsuario, 1));
		$fechaNacimiento 	= $this->baseDatos->escapeSpecialCharacters($inputPassword);

		$query = "	SELECT
						  idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  fechaNacimiento,
						  genero,
						  email,
						  telefono,
						  infoContacto,
						  vista,
						  idPeriodo
						FROM
						  usuarios
						WHERE
						  nombre LIKE '%s%%'
						  AND vista = 1
						  AND apellidoPaterno = '%s'
						  AND fechaNacimiento = '%s'";

		$parameters = array($letraInicial, $apellido, $fechaNacimiento);
		$this->baseDatos->selectDB($query, $parameters);

		$fila = $this->baseDatos->getSingleFetchAssocDB();
		
		if(is_null($fila)) return 0;
		else{
			$this->datosUsuario["idUsuario"]       = $fila["idUsuario"];
			$this->datosUsuario["tipoUsuario"]     = $fila["tipoUsuario"];
			$this->datosUsuario["nombre"]          = $fila["nombre"];
			$this->datosUsuario["apellidoPaterno"] = $fila["apellidoPaterno"];
			$this->datosUsuario["apellidoMaterno"] = $fila["apellidoMaterno"];
			$this->datosUsuario["nombreCompleto"]  = $fila["nombre"]." ".$fila["apellidoPaterno"]." ".$fila["apellidoMaterno"];
			$this->datosUsuario["fechaNacimiento"] = $fila["fechaNacimiento"];
			$this->datosUsuario["genero"]          = $fila["genero"];
			$this->datosUsuario["email"]           = $fila["email"];
			$this->datosUsuario["telefono"]        = $fila["telefono"];
			$this->datosUsuario["infoContacto"]    = $fila["infoContacto"];
			$this->datosUsuario["vista"]           = $fila["vista"];
			$this->datosUsuario["idPeriodo"]       = $fila["idPeriodo"];

			return 1;
		}
	}

	public function consultaUsuarioDuplicado($inputUsuario, $idUsuario){

		$letraInicial 		= $this->baseDatos->escapeSpecialCharacters($inputUsuario[0]);
		$apellido 	  		= $this->baseDatos->escapeSpecialCharacters(substr($inputUsuario, 1));

		if($idUsuario == 0){
			
			$query = "	SELECT
							  nombre,
							  apellidoPaterno,
							  vista
							FROM
							  usuarios
							WHERE
							  nombre LIKE '%s%%'
							  AND vista = 1
							  AND apellidoPaterno = '%s'";

			$parameters = array($letraInicial, $apellido);
		}
		else{

			$query = "	SELECT
							  nombre,
							  apellidoPaterno,
							  vista
							FROM
							  usuarios
							WHERE
							  nombre LIKE '%s%%'
							  AND vista = 1
							  AND apellidoPaterno = '%s'
							  AND idUsuario != '%d'";

			$parameters = array($letraInicial, $apellido, $idUsuario);
			
		}


		$this->baseDatos->selectDB($query, $parameters);

		$fila = $this->baseDatos->getSingleFetchAssocDB();

		if(is_null($fila)) return 0;
		else return 1;
	}

	public function consultaUsuarioUltimoAgregado(){

		$query = "	SELECT
							idUsuario,
							tipoUsuario,
							nombre,
							apellidoPaterno,
							apellidoMaterno,
							fechaNacimiento,
							genero,
							email,
							telefono,
							infoContacto,
							vista,
							idPeriodo
						FROM
						  usuarios
						ORDER BY idUsuario DESC
						LIMIT 1";

		$parameters = array();
		$this->baseDatos->selectDB($query, $parameters);

		$fila = $this->baseDatos->getSingleFetchAssocDB();

		$this->datosUsuario["idUsuario"]       = $fila["idUsuario"];
		$this->datosUsuario["tipoUsuario"]     = $fila["tipoUsuario"];
		$this->datosUsuario["nombre"]          = $fila["nombre"];
		$this->datosUsuario["apellidoPaterno"] = $fila["apellidoPaterno"];
		$this->datosUsuario["apellidoMaterno"] = $fila["apellidoMaterno"];
		$this->datosUsuario["nombreCompleto"]  = $fila["nombre"]." ".$fila["apellidoPaterno"]." ".$fila["apellidoMaterno"];
		$this->datosUsuario["fechaNacimiento"] = $fila["fechaNacimiento"];
		$this->datosUsuario["genero"]          = $fila["genero"];
		$this->datosUsuario["email"]           = $fila["email"];
		$this->datosUsuario["telefono"]        = $fila["telefono"];
		$this->datosUsuario["infoContacto"]    = $fila["infoContacto"];
		$this->datosUsuario["vista"]           = $fila["vista"];
		$this->datosUsuario["idPeriodo"]       = $fila["idPeriodo"];

		return $this->datosUsuario["idUsuario"];
	}

	public function registroUsuarioAlumno($arregloDatos, $idPeriodoActual){

		$inputNombre 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNombre"]);
		$inputApellidoPaterno 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputApellidoPaterno"]);
		$inputApellidoMaterno 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputApellidoMaterno"]);
		$inputFechaNacimiento 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputFechaNacimiento"]);
		$generoUsuario 		       = $this->baseDatos->escapeSpecialCharacters($arregloDatos["generoUsuario"]);
		$inputEmail 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputEmail"]);
		$inputPhone 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputPhone"]);
		$inputContacto 		       = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputContacto"]);

		$inputTrabajoActual 		            = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputTrabajoActual"]);
		$inputZonaTrabajo 		            = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputZonaTrabajo"]);
		$inputNivelEstudios 		            = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelEstudios"]);
		$inputNivelEstudiosDiagnostico 		= $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelEstudiosDiagnostico"]);
		$inputMotivo 		                  = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputMotivo"]);
		$inputIntereses 		               = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputIntereses"]);
		$inputIncentivos 		               = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputIncentivos"]);
		$inputNivelComunication 		      = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelComunication"]);
		$inputNivelConciencia 		         = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelConciencia"]);
		$inputSelectorPersonalidad 		   = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputSelectorPersonalidad"]);
		$inputNotas 		                  = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNotas"]);

		$query = "	INSERT INTO
						  usuarios (
						    tipoUsuario,
						    nombre,
						    apellidoPaterno,
						    apellidoMaterno,
						    fechaNacimiento,
						    genero,
						    email,
						    telefono,
						    infoContacto,
						    vista,
						    idPeriodo
						  )
						VALUES
						  (
						    '1',
						    '%s',
						    '%s',
						    '%s',
						    '%s',
						    '%d',
						    '%s',
						    '%s',
						    '%s',
						    '1',
						    '%d'
						  )";

		$parameters = array($inputNombre, $inputApellidoPaterno, $inputApellidoMaterno, $inputFechaNacimiento, $generoUsuario, $inputEmail, $inputPhone, $inputContacto, $idPeriodoActual);
		$this->baseDatos->insertDB($query, $parameters);

		self::consultaUsuarioUltimoAgregado();

		$query = "	INSERT INTO
						  datos_alumnas (
						    idUsuario,
						    trabajoActual,
						    zonaTrabajo,
						    nivelEstudiosCompletados,
						    nivelDiagnosticado,
						    motivador,
						    intereses,
						    tecnicasContacto,
						    nivelComunicacion,
						    nivelConciencia,
						    personalidad,
						    notas
						  )
						VALUES
						  (
						    '%d',
						    '%d',
						    '%s',
						    '%d',
						    '%d',
						    '%s',
						    '%s',
						    '%s',
						    '%d',
						    '%d',
						    '%s',
						    '%s'
						  )";

		$parameters = array($this->datosUsuario["idUsuario"],$inputTrabajoActual, $inputZonaTrabajo, $inputNivelEstudios, $inputNivelEstudiosDiagnostico, $inputMotivo, $inputIntereses, $inputIncentivos, $inputNivelComunication, $inputNivelConciencia, $inputSelectorPersonalidad, $inputNotas);

		$this->baseDatos->insertDB($query, $parameters);
	}

	public function registroUsuarioTutor($arregloDatos, $idPeriodoActual){
		
		$inputNombre 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNombre"]);
		$inputApellidoPaterno 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputApellidoPaterno"]);
		$inputApellidoMaterno 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputApellidoMaterno"]);
		$inputFechaNacimiento 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputFechaNacimiento"]);
		$generoUsuario 		       = $this->baseDatos->escapeSpecialCharacters($arregloDatos["generoUsuario"]);
		$inputEmail 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputEmail"]);
		$inputPhone 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputPhone"]);
		$inputContacto 		       = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputContacto"]);

		$query = "	INSERT INTO
						  usuarios (
						    tipoUsuario,
						    nombre,
						    apellidoPaterno,
						    apellidoMaterno,
						    fechaNacimiento,
						    genero,
						    email,
						    telefono,
						    infoContacto,
						    vista,
						    idPeriodo
						  )
						VALUES
						  (
						    '2',
						    '%s',
						    '%s',
						    '%s',
						    '%s',
						    '%d',
						    '%s',
						    '%s',
						    '%s',
						    '1',
						    '%d'
						  )";

		$parameters = array($inputNombre, $inputApellidoPaterno, $inputApellidoMaterno, $inputFechaNacimiento, $generoUsuario, $inputEmail, $inputPhone, $inputContacto, $idPeriodoActual);
		$this->baseDatos->insertDB($query, $parameters);
	}

	public function editaDatosUsuarioTutor($arregloDatos, $idUsuario){

		$query = "	UPDATE usuarios SET";
		$parameters = array();

		if(!empty($arregloDatos["inputNombre"])){
			$queryCuerpo .= " nombre='%s'";
			array_push($parameters,$arregloDatos["inputNombre"]);
		}
		if(!empty($arregloDatos["inputApellidoPaterno"])){
			if(!empty($queryCuerpo)) $queryCuerpo .= ",";
			$queryCuerpo .= " apellidoPaterno='%s'";
			array_push($parameters,$arregloDatos["inputApellidoPaterno"]);
		}
		if(!empty($arregloDatos["inputApellidoMaterno"])){
			if(!empty($queryCuerpo)) $queryCuerpo .= ",";
			$queryCuerpo .= " apellidoMaterno='%s'";
			array_push($parameters,$arregloDatos["inputApellidoMaterno"]);
		}
		if(!empty($arregloDatos["inputFechaNacimiento"])){
			if(!empty($queryCuerpo)) $queryCuerpo .= ",";
			$queryCuerpo .= " fechaNacimiento='%s'";
			array_push($parameters,$arregloDatos["inputFechaNacimiento"]);
		}
		if(!empty($arregloDatos["generoUsuario"])){
			if(!empty($queryCuerpo)) $queryCuerpo .= ",";
			$queryCuerpo .= " genero='%d'";
			array_push($parameters,$arregloDatos["generoUsuario"]);
		}
		if(!empty($arregloDatos["inputEmail"])){
			if(!empty($queryCuerpo)) $queryCuerpo .= ",";
			$queryCuerpo .= " email='%s'";
			array_push($parameters,$arregloDatos["inputEmail"]);
		}
		if(!empty($arregloDatos["inputPhone"])){
			if(!empty($queryCuerpo)) $queryCuerpo .= ",";
			$queryCuerpo .= " telefono='%s'";
			array_push($parameters,$arregloDatos["inputPhone"]);
		}

		$query .= $queryCuerpo;
		$query .= " WHERE idUsuario = '%d'";
		array_push($parameters,$idUsuario);

		$this->baseDatos->updateDB($query, $parameters);
	}

	public function editaDatosUsuarioAlumno($arregloDatos, $idUsuario){


		$inputNombre 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNombre"]);
		$inputApellidoPaterno 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputApellidoPaterno"]);
		$inputApellidoMaterno 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputApellidoMaterno"]);
		$inputFechaNacimiento 		 = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputFechaNacimiento"]);
		$generoUsuario 		       = $this->baseDatos->escapeSpecialCharacters($arregloDatos["generoUsuario"]);
		$inputEmail 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputEmail"]);
		$inputPhone 		          = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputPhone"]);
		$inputContacto 		       = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputContacto"]);

		$inputTrabajoActual 		            = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputTrabajoActual"]);
		$inputZonaTrabajo 		            = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputZonaTrabajo"]);
		$inputNivelEstudios 		            = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelEstudios"]);
		$inputNivelEstudiosDiagnostico 		= $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelEstudiosDiagnostico"]);
		$inputMotivo 		                  = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputMotivo"]);
		$inputIntereses 		               = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputIntereses"]);
		$inputIncentivos 		               = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputIncentivos"]);
		$inputNivelComunication 		      = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelComunication"]);
		$inputNivelConciencia 		         = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNivelConciencia"]);
		$inputSelectorPersonalidad 		   = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputSelectorPersonalidad"]);
		$inputNotas 		                  = $this->baseDatos->escapeSpecialCharacters($arregloDatos["inputNotas"]);

		$parameters = array($inputNombre,$inputApellidoPaterno,$inputApellidoMaterno,$inputFechaNacimiento,$generoUsuario,$inputEmail,$inputPhone,$inputContacto,$idUsuario);
		$query = "	UPDATE usuarios SET
							nombre='%s',
							apellidoPaterno='%s',
							apellidoMaterno='%s',
							fechaNacimiento='%s',
							genero='%d',
							email='%s',
							telefono='%s',
							infoContacto='%s'
						WHERE idUsuario = '%d'";

		// echo '<pre>'; print_r(vsprintf($query, $parameters)); echo '</pre>';
		// exit();
		$this->baseDatos->updateDB($query, $parameters);

		$parameters = array($inputTrabajoActual,$inputZonaTrabajo,$inputNivelEstudios,$inputNivelEstudiosDiagnostico,$inputMotivo,$inputIntereses,$inputIncentivos,$inputNivelComunication,$inputNivelConciencia,$inputSelectorPersonalidad,$inputNotas,$idUsuario);
		$query = "	UPDATE datos_alumnas SET
							trabajoActual='%d',
							zonaTrabajo='%s',
							nivelEstudiosCompletados='%d',
							nivelDiagnosticado='%d',
							motivador='%s',
							intereses='%s',
							tecnicasContacto='%s',
							nivelComunicacion='%d',
							nivelConciencia='%d',
							personalidad='%s',
							notas='%s'
						WHERE idUsuario = '%d'";

		$this->baseDatos->updateDB($query, $parameters);
	}

	public function consultaTipoUsuario($idUsuario){

		$parameters = array();

		$query = "	SELECT
						  tipoUsuario
						FROM
						  usuarios
						WHERE
						  idUsuario = '%d'";

		array_push($parameters,$idUsuario);
		$this->baseDatos->selectDB($query, $parameters);

		$consulta = $this->baseDatos->getSingleFetchAssocDB();

		return $consulta["tipoUsuario"];
	}

	public function consultaUsuariosAlumno($idUsuario){

		$query = "	SELECT
						  usuarios.idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  fechaNacimiento,
						  genero,
						  email,
						  telefono,
						  infoContacto,
						  vista,
						  idPeriodo,
						  trabajoActual,
						  zonaTrabajo,
						  nivelEstudiosCompletados,
						  nivelDiagnosticado,
						  motivador,
						  intereses,
						  tecnicasContacto,
						  nivelComunicacion,
						  nivelConciencia,
						  personalidad,
						  notas
						FROM
						  usuarios
						  INNER JOIN datos_alumnas ON usuarios.idUsuario = datos_alumnas.idUsuario
						WHERE 
						  usuarios.idUsuario = '%d'";

		$parameters = array($idUsuario);
		$this->baseDatos->selectDB($query, $parameters);
		$fila = $this->baseDatos->getSingleFetchAssocDB();
		return $fila;
	}

	public function consultaUsuariosTutor($idUsuario){

		$query = "	SELECT
						  idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  fechaNacimiento,
						  genero,
						  email,
						  telefono,
						  infoContacto,
						  vista,
						  idPeriodo
						FROM
						  usuarios
						WHERE
						  idUsuario = '%d'";

		$parameters = array($idUsuario);
		$this->baseDatos->selectDB($query, $parameters);
		$fila = $this->baseDatos->getSingleFetchAssocDB();
		return $fila;
	}

	public function consultaUsuariosAlumnoTodos(){

		$parameters = array();
		$query = "	SELECT
						  usuarios.idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  fechaNacimiento,
						  genero,
						  email,
						  telefono,
						  infoContacto,
						  vista,
						  idPeriodo,
						  trabajoActual,
						  zonaTrabajo,
						  nivelEstudiosCompletados,
						  nivelDiagnosticado,
						  motivador,
						  intereses,
						  tecnicasContacto,
						  nivelComunicacion,
						  nivelConciencia,
						  personalidad,
						  notas
						FROM
						  usuarios
						  INNER JOIN datos_alumnas ON usuarios.idUsuario = datos_alumnas.idUsuario";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaUsuariosTutorTodos(){

		$parameters = array();
		$query = "	SELECT
						  idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  fechaNacimiento,
						  genero,
						  email,
						  telefono,
						  infoContacto,
						  vista,
						  idPeriodo
						FROM
						  usuarios
						WHERE
						  tipoUsuario = 2
						  OR tipoUsuario = 3
						ORDER BY
						  idPeriodo DESC";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaUsuariosTutorTodosInicio(){

		$parameters = array();
		$query = "	SELECT
						  idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  fechaNacimiento,
						  genero,
						  email,
						  telefono,
						  infoContacto,
						  vista,
						  idPeriodo
						FROM
						  usuarios
						WHERE
						  tipoUsuario = 2
						  OR tipoUsuario = 3
						ORDER BY
						  idPeriodo ASC";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaVistaUsuario($idUsuario){

		$parameters = array();
		$query = "	SELECT
						  vista
						FROM
						  usuarios
						WHERE
						  idUsuario = '%d'";

		array_push($parameters,$idUsuario);

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getSingleFetchAssocDB();
	}

	public function editaVistaUsuario($idUsuario){

		$query = "	UPDATE usuarios SET";
		$parameters = array();

		$vistaUsuario = self::consultaVistaUsuario($idUsuario);

		if($vistaUsuario["vista"] == 1) $query .= " vista=0";
		else  $query .= " vista=1";

		$query .= " WHERE idUsuario = '%d'";
		array_push($parameters,$idUsuario);
		$this->baseDatos->updateDB($query, $parameters);

		return $vistaUsuario["vista"];
	}

	public function editaTipoUsuario($idUsuario){

		$query = "	UPDATE usuarios SET";
		$parameters = array();

		$tipoUsuario = self::consultaTipoUsuario($idUsuario);

		if($tipoUsuario == 2) $query .= " tipoUsuario=3";
		else  $query .= " tipoUsuario=2";

		$query .= " WHERE idUsuario = '%d'";
		array_push($parameters,$idUsuario);
		$this->baseDatos->updateDB($query, $parameters);

		return $tipoUsuario;
	}

	public function editaUsuarioPeriodo($idUsuario, $accion, $listaPeriodos){

		self::consultaUsuarioId($idUsuario);
		$idPeriodo = (int) $this->datosUsuario["idPeriodo"];

		if($accion == 1){

			$idPeriodo += 1; 
		}
		else{

			$idPeriodo -= 1; 
		}

		if($idPeriodo == 1) return 0;

		if(in_array($idPeriodo, $listaPeriodos)){
			
			$query = "	UPDATE
							  usuarios
							SET
							  idPeriodo = '%d'
							WHERE
							  idUsuario = '%d'
							";

			$parameters = array($idPeriodo, $idUsuario);
			$this->baseDatos->updateDB($query, $parameters);
		}

		return $idPeriodo;
	}

	public function consultaUsuariosPorPeriodo($idPeriodo){

		$parameters = array($idPeriodo);
		$query = "	SELECT
						  idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  idPeriodo
						FROM
						  usuarios
						WHERE
							idPeriodo = '%d'
							OR tipoUsuario = 4
						ORDER BY
						  idPeriodo DESC";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaAlumnosPorPeriodo($idPeriodo){

		$parameters = array($idPeriodo);
		$query = "	SELECT
						  idUsuario,
						  tipoUsuario,
						  nombre,
						  apellidoPaterno,
						  apellidoMaterno,
						  idPeriodo
						FROM
						  usuarios
						WHERE
							idPeriodo = '%d'
							OR tipoUsuario = 1
						ORDER BY
						  idPeriodo DESC";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>