<?php 
class Documento{

	public $baseDatos = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function registroDocumentoNuevo($inputSelectorDocumento, $idUsuario){

		$query = "	INSERT INTO
						  documentos (
						    tipoDocumento,
						    idUsuario,
						    vista
						  )
						VALUES
						  (
						    '%d',
						    '%d',
						    '1'
						  )";
		$parameters = array($inputSelectorDocumento, $idUsuario);
		$this->baseDatos->insertDB($query, $parameters);
	}

	public function consultaUltimoDocumentoAgregadoId(){

		$query = "	SELECT
							idDocumento
						FROM
						  documentos
						ORDER BY idDocumento DESC
						LIMIT 1";

		$parameters = array();
		$this->baseDatos->selectDB($query, $parameters);

		$fila = $this->baseDatos->getSingleFetchAssocDB();
		return $fila["idDocumento"];
	}

	public function consultaDocumentoUsuarioId($idUsuario){
		$parameters = array($idUsuario);
		$query = "	SELECT
						  idDocumento,
						  tipoDocumento
						FROM
						  documentos
						WHERE
						  idUsuario = '%d'
						  AND vista = 1";
		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function eliminaDocumento($idDocumento){

		$query = "	UPDATE documentos SET
						vista = 0
						WHERE idDocumento = '%d'";

		$parameters = array($idDocumento);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>