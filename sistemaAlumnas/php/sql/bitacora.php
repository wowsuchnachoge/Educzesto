<?php  
class Bitacora{

	public $baseDatos = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function registroBitacora($idUsuario, $inputContenidoBitacora, $fechaActual){

		$query = "	INSERT INTO
						  bitacoras_alumnos (
						    desglose,
						    idUsuario,
						    fechaEntrega
						  )
						VALUES
						  (
						    '%s',
						    '%d',
						    '%s'
						  )";

		$parameters = array($inputContenidoBitacora, $idUsuario, $fechaActual);
		$this->baseDatos->insertDB($query, $parameters);
	}
	public function consultaBitacoraId($idUsuario){

		$query = "	SELECT
						  desglose,
						  idBitacora,
						  fecha
						FROM
						  bitacoras
						WHERE
						  idUsuario = '%d'
						ORDER BY idBitacora DESC";

		$parameters = array($idUsuario);
		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaBitacoraAlumnosId($idUsuario){

		$query = "	SELECT
						  desglose,
						  idBitacora,
						  fechaEntrega
						FROM
						  bitacoras_alumnos
						WHERE
						  idUsuario = '%d'
						ORDER BY idBitacora DESC";

		$parameters = array($idUsuario);
		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function eliminaBitacora($idBitacora){

		$query = "	DELETE FROM bitacoras
						WHERE idBitacora = '%d'";

		$parameters = array($idBitacora);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function eliminaBitacoraAlumnos($idBitacora){

		$query = "	DELETE FROM bitacoras_alumnos
						WHERE idBitacora = '%d'";

		$parameters = array($idBitacora);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}

	public function cambiarEstadoBitacora($estado, $idAcuerdo){
		$query = "	UPDATE bitacoras
					    SET realizado = '%d'
						    WHERE idBitacora = '%d'";
		$parameters = array($estado, $idAcuerdo);
		$this->baseDatos->updateDB($query, $parameters);
	}	
	
	public function getEstadoActualBitacora($idAcuerdo){
		$parameters = array($idAcuerdo);
		$query = "	SELECT
						  realizado
						FROM
						bitacoras
						WHERE
						idBitacora = '%d'";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function registroBitacoraRealizado($idAcuerdo, $realizado){
			
		$parameters = array($idBitacora, $realizado);
		$query = "	UPDATE
						  bitacoras_alumnos
						SET
						  realizado = '%d'
						WHERE
						  idBitacora = '%d'
						";

		$this->baseDatos->updateDB($query, $parameters);
	}

	public function cambiarEstadoBitacoraAlumnos($estado, $idBitacora){
		$query = "	UPDATE bitacoras_alumnos
					    SET realizado = '%d'
						    WHERE idBitacora = '%d'";
		$parameters = array($estado, $idBitacora);
		$this->baseDatos->updateDB($query, $parameters);
	}	
	
	public function getEstadoActualBitacoraAlumnos($idBitacora){
		$parameters = array($idBitacora);
		$query = "	SELECT
						  realizado
						FROM
						bitacoras_alumnos
						WHERE
						idBitacora = '%d'";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	
}
?>