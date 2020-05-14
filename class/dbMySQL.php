<?php 
/**
 * 
 */
class dbMySQL
{
	private $host = "localhost";
	private $usuario = "root";
	private $clave = ""; // la clave de MAMP es root, en el caso de Xamp es vacio 
	private $db ="gastos";
	private $puerto = "3306";//Puerto en windows
	private $conn;

	public function __construct()
	{
		$this->conn = mysqli_connect(
			$this->host,
			$this->usuario,
			$this->clave,
			$this->db,
			$this->puerto //No es necesario, solo para MAMP
		);


		if (mysqli_connect_error())
		{
			printf("Error en la conexión: %d",mysqli_connect_error());
		}else{
			//print "Conexión exitosa";
		}

	}


	public function query($q){

		$data = array();

		if($q!='')
		{

			if($r=mysqli_query($this->conn,$q)){

				//PARA SELECT*****************
				// Los dos primero ahorran más en recursos
				//Devuelve array con índices numéricos, 
				//$data = mysqli_fetch_row($r);

				//Devuelve un array asociativo, es decir la cadena como índice
				//$data = mysqli_fetch_assoc($r);

				/*Devuelve array con índices numéricos y campos asociativos*/
				$data = mysqli_fetch_array($r);
			}			
		}

		return $data;
	}

	public function queryNoSelect($q){

		//PARA UPDATE, INSERT, DELETE retorna valor boolean
		$r=false;

		if($q!='')
		{
			$r=mysqli_query($this->conn,$q);
		}

		return $r;
	}

	public function close(){
		mysqli_close($this->conn);
	}

}




 ?>