<?php  
class Plataformas{

	public $baseDatos = 0;

	function __construct(){
		$this->baseDatos = new InteractDB();
	}

	public function consultaPlataformas(){

		$parameters = array();
		$query = "	SELECT
						  idPlataforma,
						  plataforma,
						  usuario,
						  passwordPlataforma,
						  fecha,
						  descripcion,
						  link
						FROM
						  plataformas";

		$this->baseDatos->selectDB($query, $parameters);
		return $this->baseDatos->getMultiFetchAssocDB();
	}

	public function cierraBaseDatos(){
		$this->baseDatos->cierraDB();
	}
}
?>