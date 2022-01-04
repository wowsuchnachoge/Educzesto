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
						    fechaEntrada
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
						  idUsuario,
						  desglose,
						  fechaEntrada, 
						  fechaEntrega, 
						  realizado
						FROM
						  bitacoras_alumnos
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

		$query = "	DELETE FROM bitacoras_alumnos
						WHERE idBitacora = '%d'";

		$parameters = array($idBitacora);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>