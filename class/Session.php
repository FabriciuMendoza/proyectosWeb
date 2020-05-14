<?php 

/**
 * 
 */
class Session
{
	
	private $login = false;
	private $usuario;	


	function __construct()
	{
		session_start();
		$this->verificaLogin();


	}

	private function verificaLogin()
	{
		if (isset($_SESSION["usuario"])) {
			$this->usuario = $_SESSION["usuario"];
			$this->login = true;
		}else{
			unset($this->usuario);
			$this->login = false;
		}
	}

	public function inicioLogin($usuario)
	{
		if (isset($usuario)) {
			$this->usuario = $_SESSION["usuario"] = $usuario;
			$this->login = true;
		}
	}

	public function finLogin($usuario)
	{
		unset($_SESSION["usuario"]);
		unset($this->usuario);
		$this->login = false;				
	}

	public function estadoLogion()
	{
		return $this->login;
	}

	public function getUsuario()
	{
		return $this->usuario;
	}
}

?>