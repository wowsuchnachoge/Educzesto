<?php 
class Calendario{

	public $baseDatos = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	function consultaCalendario(){
		
		$query = "	SELECT 	idFila,
									fecha,
									nombre
						FROM calendario_minutas
						ORDER BY idFila ASC";

		$parameters = array();
		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	function editaCalendario($arregloFilasCalendario){

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha1"],$arregloFilasCalendario["persona1"], 1);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha2"],$arregloFilasCalendario["persona2"], 2);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha3"],$arregloFilasCalendario["persona3"], 3);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha4"],$arregloFilasCalendario["persona4"], 4);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha5"],$arregloFilasCalendario["persona5"], 5);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha6"],$arregloFilasCalendario["persona6"], 6);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha7"],$arregloFilasCalendario["persona7"], 7);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha8"],$arregloFilasCalendario["persona8"], 8);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha9"],$arregloFilasCalendario["persona9"], 9);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha10"],$arregloFilasCalendario["persona10"], 10);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha11"],$arregloFilasCalendario["persona11"], 11);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha12"],$arregloFilasCalendario["persona12"], 12);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha13"],$arregloFilasCalendario["persona13"], 13);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha14"],$arregloFilasCalendario["persona14"], 14);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha15"],$arregloFilasCalendario["persona15"], 15);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha16"],$arregloFilasCalendario["persona16"], 16);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha17"],$arregloFilasCalendario["persona17"], 17);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha18"],$arregloFilasCalendario["persona18"], 18);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha19"],$arregloFilasCalendario["persona19"], 19);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha20"],$arregloFilasCalendario["persona20"], 20);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha21"],$arregloFilasCalendario["persona21"], 21);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha22"],$arregloFilasCalendario["persona22"], 22);
		$this->baseDatos->updateDB($query, $parameters);

		$query = "	UPDATE calendario_minutas SET
						fecha = '%s',
						nombre = '%s'
						WHERE idFila = '%d'";

		$parameters = array($arregloFilasCalendario["fecha23"],$arregloFilasCalendario["persona23"], 23);
		$this->baseDatos->updateDB($query, $parameters);

	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>