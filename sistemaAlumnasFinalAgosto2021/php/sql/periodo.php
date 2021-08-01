<?php  
class Periodo{

	public $baseDatos = 0;
	public $idPeriodoActual = 0;
	public $nombrePeriodoActual = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function buscaPeriodoNombre($nombrePeriodo){
		$query = "	SELECT
						  idPeriodo,
						  periodo
						FROM
						  periodos
						WHERE 
						periodo LIKE '%s'";

		$parameters = array($nombrePeriodo);
		$this->baseDatos->selectDB($query, $parameters);

		$fila = $this->baseDatos->getSingleFetchAssocDB();

		if(is_null($fila)) return 0;
		else return 1;
	}

	public function generaPeriodo($nombrePeriodo){

		$query = "	INSERT INTO
				  periodos (
				    periodo
				  )
				VALUES
				  (
				    '%s'
				  )";

		$parameters = array($nombrePeriodo);
		$this->baseDatos->insertDB($query, $parameters);
	}

	public function consultaListaPeriodoId(){

		$parameters = array();
		$query = "	SELECT
						  idPeriodo
						FROM
						  periodos";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function consultaPeriodoActual(){

		$parameters = array();
		$query = "	SELECT
						  idPeriodo,
						  periodo
						FROM
						  periodos
						ORDER BY idPeriodo DESC
						LIMIT 1";

		$this->baseDatos->selectDB($query, $parameters);
		$fila = $this->baseDatos->getSingleFetchAssocDB();

		$this->idPeriodoActual     = $fila["idPeriodo"];
		$this->nombrePeriodoActual = $fila["periodo"];

		return $this->idPeriodoActual;
	}

	public function consultaPeriodoTodos(){
		$parameters = array();
		$query = "	SELECT
						  idPeriodo,
						  periodo
						FROM
						  periodos;";
		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>