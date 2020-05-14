<?php 

/**
 * 
 */
class Usuarios
{
	private $usuario;
	private $clave;



	
	function __construct(){}

	public static function buscaUsuario($usuario, $clave){

		$db = new dbMySQL();
		$sql = "SELECT * FROM usuarios WHERE usuario='".$usuario."' AND clave='".$clave."'";
		$data = $db->query($sql);
		$db->close();
		unset($db);
		return isset($data[0]);
		
		

	}

	public static function leeUsuario($usuario){

		$db = new dbMySQL();
		$sql = "SELECT * FROM usuarios WHERE usuario='".$usuario."'";
		$data = $db->query($sql);
		$db->close();
		unset($db);
		return $data;

	}

	public static function cambiarClaveAcceso($id, $usuario, $nuevaClave){

		$db = new dbMySQL();
		$sql = "UPDATE usuarios SET clave='".$nuevaClave."' 
		WHERE id='".$id."' AND usuario='".$usuario."'";

		$r = $db->queryNoSelect($sql);
		$db->close();
		unset($db);

		if ($r) {
			$c = "0Clave de acceso modificada exitosamente!";
		} else{
			$c = "1Error al modificar la clave de acceso!";
		}

		return $c;
	}
}


 ?>