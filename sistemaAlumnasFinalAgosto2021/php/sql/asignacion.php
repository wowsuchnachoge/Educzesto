<?php  
class Asignacion{
	public $baseDatos = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function consultaAsignacion($idTutor, $idAlumno){
		
		$query = "	SELECT idAsignacion
						FROM asignaciones
						WHERE idUsuarioTutor = '%d'
						  AND idUsuarioAlumno = '%d'";

		$parameters = array($idTutor, $idAlumno);
		$this->baseDatos->selectDB($query, $parameters);

		$fila = $this->baseDatos->getSingleFetchAssocDB();

		if(is_null($fila)) return 0;
		else return $fila["idAsignacion"];
	}

	public function registroAsignacion($idTutor, $idAlumno){

		$idAsignacion = self::consultaAsignacion($idTutor, $idAlumno);

		if($idAsignacion == 0){

			$query = "	INSERT INTO
							  asignaciones (
							    idUsuarioTutor,
							    idUsuarioAlumno
							  )
							VALUES
							  (
							    '%d',
							    '%d'
							  )";

			$parameters = array($idTutor, $idAlumno);
			$this->baseDatos->insertDB($query, $parameters);
			return 1;
		}else return 0;
	}

	public function eliminaAsignacion($idTutor, $idAlumno){

		$idAsignacion = self::consultaAsignacion($idTutor, $idAlumno);

		$query = "	DELETE FROM asignaciones
						WHERE idAsignacion = '%d'";

		$parameters = array($idAsignacion);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function consultaAsignacionAlumnas($idAlumna){

		$query = "	SELECT idUsuarioTutor
						FROM asignaciones
						WHERE idUsuarioAlumno = '%d'";

		$parameters = array($idAlumna);
		$this->baseDatos->selectDB($query, $parameters);

		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaAsignacionTodos($idTutor){

		$query = "	SELECT idUsuarioAlumno
						FROM asignaciones
						WHERE idUsuarioTutor = '%d'";

		$parameters = array($idTutor);
		$this->baseDatos->selectDB($query, $parameters);

		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>