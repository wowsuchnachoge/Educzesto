<?php
class Material{

	public $baseDatos = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function registroMaterialNuevo($inputNombreArchivo, $inputSelectorAlumna, $inputMaterial, $inputLink, $idUsuario, $distribucion, $flagLink, $flagMaterial){

		if($inputSelectorAlumna == 0){
			$query = "	INSERT INTO
							  materiales (
							    url,
							    nombre,
							    idUsuarioTutor,
							    estado,
							    distribucion,
							    flagLink,
							    flagMaterial,
							    vista
							  )
							VALUES
							  (
							    '%s',
							    '%s',
							    '%d',
							    '0',
							    '%d',
							    '%d',
							    '%d',
							    '1'
							  )";
			$parameters = array($inputLink, $inputNombreArchivo, $idUsuario, $distribucion, $flagLink, $flagMaterial);
		}
		else {
			$query = "	INSERT INTO
							  materiales (
							    url,
							    nombre,
							    idUsuarioTutor,
							    idUsuarioAlumno,
							    estado,
							    distribucion,
							    flagLink,
							    flagMaterial,
							    vista
							  )
							VALUES
							  (
							    '%s',
							    '%s',
							    '%d',
							    '%d',
							    '0',
							    '%d',
							    '%d',
							    '%d',
							    '1'
							  )";
			$parameters = array($inputLink, $inputNombreArchivo, $idUsuario, $inputSelectorAlumna,$distribucion, $flagLink, $flagMaterial);

		}

		$this->baseDatos->insertDB($query, $parameters);
	}

	public function consultaUltimoArchivoAgregadoId(){
		$query = "	SELECT
							idMaterial
						FROM
						  materiales
						ORDER BY idMaterial DESC
						LIMIT 1";

		$parameters = array();
		$this->baseDatos->selectDB($query, $parameters);

		$fila = $this->baseDatos->getSingleFetchAssocDB();
		return $fila["idMaterial"];
	}

	public function consultaMaterialUsuarioId($idUsuario){
		
		$parameters = array($idUsuario);
		$query = "	SELECT
						  idMaterial,
						  url,
						  nombre,
						  idUsuarioTutor,
						  idUsuarioAlumno,
						  estado,
						  flagLink,
						  flagMaterial,
						  distribucion,
						  vista
						FROM
						  materiales
						WHERE
						  idUsuarioTutor = '%d'
						  AND vista = 1";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaMaterialUsuarioIdInicio($idUsuario){
		
		$parameters = array();
		$query = "	SELECT
						  idMaterial,
						  url,
						  nombre,
						  idUsuarioTutor,
						  idUsuarioAlumno,
						  estado,
						  flagLink,
						  flagMaterial,
						  vista
						FROM
						  materiales
						WHERE
						  distribucion = 1
						 AND vista = 1";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaMaterialUsuarioIdAlumnasInicio($idUsuario){
		
		$parameters = array($idUsuario);
		$query = "	SELECT
						  idMaterial,
						  url,
						  nombre,
						  idUsuarioTutor,
						  idUsuarioAlumno,
						  estado,
						  flagLink,
						  flagMaterial,
						  vista
						FROM
						  materiales
						WHERE
						  distribucion = 0
						AND vista = 1
						AND idUsuarioAlumno = '%d'";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function eliminaMaterial($idMaterial){

		$query = "	UPDATE materiales SET
						vista = 0
						WHERE idMaterial = '%d'";

		$parameters = array($idMaterial);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function estadoMaterial($idMaterial){

		$query = "	UPDATE materiales SET
						estado = 1
						WHERE idMaterial = '%d'";

		$parameters = array($idMaterial);
		$this->baseDatos->updateDB($query, $parameters);
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}

}
?>