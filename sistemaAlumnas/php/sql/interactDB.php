<?php  
class InteractDB{

	private $connection = 0;

	/* -- Educzesto.org
	––––––––––––––––––––––––––––––––––––––––––––––––– */
	// private $connection_db = array(	"hostname_db"=>"localhost",
	// 							 				"database_db"=>"sistema_educzesto",
	// 							 				"username_db"=>"educzesto",
	// 							 				"password_db"=>"ServicioSocial2021");
	
	/* -- MAMP
	––––––––––––––––––––––––––––––––––––––––––––––––– */
	private $connection_db = array(	"hostname_db"=>"173.201.185.124",
								 				"database_db"=>"sistema_educzesto",
								 				"username_db"=>"educzesto",
								 				"password_db"=>"ServicioSocial2021");

	private $consulta = 0;
	private $arregloConsulta = array();

	function __construct(){
		$this->connection = mysqli_connect($this->connection_db["hostname_db"], $this->connection_db["username_db"], $this->connection_db["password_db"]);

		if (mysqli_connect_errno()) echo "<b>Hemos tenido un problema con la conexión MySQL:</b> ".mysqli_connect_error()."<br>";
		mysqli_select_db($this->connection,$this->connection_db["database_db"]) or die ("Ninguna DB seleccionada");
	}

	public function selectDB($query, $parameters=array()){
		
		$accion_nm   = vsprintf($query, $parameters);
		$consulta_nm = mysqli_query($this->connection,$accion_nm) or die(mysqli_error($this->connection));
		$this->consulta = $consulta_nm;
	}

	public function insertDB($query, $parameters=array()){

		$accion_nm   = vsprintf($query, $parameters);
		$consulta_nm = mysqli_query($this->connection,$accion_nm) or die(mysqli_error($this->connection));
	}

	public function updateDB($query, $parameters=array()){

		$accion_nm   = vsprintf($query, $parameters);
		$consulta_nm = mysqli_query($this->connection,$accion_nm) or die(mysqli_error($this->connection));
	}

	public function deleteDB($query, $parameters=array()){

		$accion_nm   = vsprintf($query, $parameters);
		$consulta_nm = mysqli_query($this->connection,$accion_nm) or die(mysqli_error($this->connection));
	}

	public function getSingleFetchAssocDB(){
		return mysqli_fetch_assoc($this->consulta);
	}

	public function getMultiFetchAssocDB(){	

		$arregloConsulta = array();
		while($fila = mysqli_fetch_assoc($this->consulta)){
			array_push($arregloConsulta,$fila);
		}
		return $arregloConsulta;
	}

	public function escapeSpecialCharacters($string){
		return $this->connection->real_escape_string($string);
		// return mysqli_real_escape_string($this->connection, $string);
		// echo '<pre>'; print_r($this->connection->real_escape_string($string)); echo '</pre>';
		// echo '<pre>'; print_r(mysqli_real_escape_string($this->connection, $string)); echo '</pre>';
		// exit();
	}

	public function cierraDB(){
		mysqli_close($this->connection);
	}
}
?>