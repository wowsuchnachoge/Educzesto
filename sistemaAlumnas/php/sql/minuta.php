<?php  
class Minuta{

	public $baseDatos = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function consultaIdMinutaUltimaAgregada(){
		
		$query = "	SELECT
							idMinuta
						FROM
						  minutas
						ORDER BY idMinuta DESC
						LIMIT 1";

		$parameters = array();
		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getSingleFetchAssocDB();
	}

	public function consultaMinutaId($idMinuta){

		$query = "	SELECT
							idMinuta,
							fecha,
							periodos.periodo,
							minutas.idPeriodo,
							desglose
						FROM	minutas
						LEFT JOIN periodos
						ON minutas.idPeriodo = periodos.idPeriodo
						WHERE idMinuta = '%d'";

		$parameters = array($idMinuta);		
		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getSingleFetchAssocDB();
	}

	public function consultaPeriodoIdTodos($idPeriodo){
		$parameters = array($idPeriodo);
		$query = "	SELECT
							idMinuta,
							fecha,
							periodos.periodo,
							minutas.idPeriodo,
							desglose
						FROM	minutas
						LEFT JOIN periodos
						ON minutas.idPeriodo = periodos.idPeriodo
						WHERE minutas.idPeriodo = '%d'
						ORDER BY idMinuta DESC";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function registroMinutaNueva($inputFechaNuevaMinuta, $idPeriodoActual){

		$query = "	INSERT INTO
						  minutas (
						    fecha,
						    idPeriodo
						 	)
						VALUES
						  (
						    '%s',
						    '%d'
						  )";

		$parameters = array($inputFechaNuevaMinuta, $idPeriodoActual);
		$this->baseDatos->insertDB($query, $parameters);
	}

	public function registroMinutaDesglose($idMinuta, $deglose){
			
			$parameters = array($deglose, $idMinuta);
			$query = "	UPDATE
							  minutas
							SET
							  desglose = '%s'
							WHERE
							  idMinuta = '%d'
							";

			$this->baseDatos->updateDB($query, $parameters);
	}

	public function registroMinutaAcuerdo($idMinuta, $inputContenidoAcuerdo, $responsableAcuerdo, $inputFechaLimite){

			$parameters = array($idMinuta, $inputContenidoAcuerdo, $responsableAcuerdo, $inputFechaLimite);

			$query = "	INSERT INTO
							  acuerdos (
							    idMinuta,
							    acuerdo,
							    responsable,
							    fechaLimite
							 	)
							VALUES
							  (
							    '%d',
							    '%s',
							    '%d',
							    '%s'
							  )";

			$this->baseDatos->insertDB($query, $parameters);
	}

	public function registroMinutaAcuerdoSinResponsable($idMinuta, $inputContenidoAcuerdo, $inputFechaLimite){

			$parameters = array($idMinuta, $inputContenidoAcuerdo, $inputFechaLimite);

			$query = "	INSERT INTO
							  acuerdos (
							    idMinuta,
							    acuerdo,
							    fechaLimite
							 	)
							VALUES
							  (
							    '%d',
							    '%s',
							    '%s'
							  )";

			$this->baseDatos->insertDB($query, $parameters);
	}

	public function consultaMinutaAcuerdoTodos($idMinuta){

		$parameters = array($idMinuta);
		$query = "	SELECT
						  idAcuerdo,
						  acuerdo,
						  responsable,
						  fechaLimite,
						  realizado
						FROM
						  acuerdos
						WHERE
							idMinuta = '%d'";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function eliminaMinuta($idMinuta){
		
		$query = "	DELETE FROM minutas
						WHERE idMinuta = '%d'";

		$parameters = array($idMinuta);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function eliminaAcuerdosMinuta($idMinuta){
		$query = "	DELETE FROM acuerdos
						WHERE idMinuta = '%d'";

		$parameters = array($idMinuta);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function eliminaAcuerdo($idAcuerdo){

		$query = "	DELETE FROM acuerdos
						WHERE idAcuerdo = '%d'";

		$parameters = array($idAcuerdo);
		$this->baseDatos->deleteDB($query, $parameters);
	}

	public function editaMinutaPeriodo($idMinuta, $accion, $listaPeriodos){
		$datosMinuta = self::consultaMinutaId($idMinuta);
		$idPeriodo = (int) $datosMinuta["idPeriodo"];

		if($accion == 1){

			$idPeriodo += 1; 
		}
		else{

			$idPeriodo -= 1; 
		}

		if($idPeriodo == 1) return 0;

		if(in_array($idPeriodo, $listaPeriodos)){
			
			$parameters = array($idPeriodo, $idMinuta);
			$query = "	UPDATE
							  minutas
							SET
							  idPeriodo = '%d'
							WHERE
							  idMinuta = '%d'
							";

			$this->baseDatos->updateDB($query, $parameters);
		}

		return $idPeriodo;
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>