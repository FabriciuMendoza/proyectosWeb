<?php 


//llamar a las otras clases
require "php/variables.php";
require "class/Session.php";
require "class/dbMySQL.php";
require "class/Usuarios.php";


/***************
Leemos la sesión
***************/

$session = new Session();

/***************
Validación del usuario
***************/


if (isset($_POST["inputUsuario"], $_POST["inputPassword"])) {

	$usuario = $_POST["inputUsuario"];
    $password = $_POST["inputPassword"];
	$password = substr(hash_hmac("sha512",$password,$keyEncript), 0,100);
    

	if (Usuarios::buscaUsuario($usuario, $password)) {
		//print("Las credenciales de acceso son validas");
		$session->inicioLogin($usuario);
		header("location:inicio.php");
		exit;
	}else{

		//print("Credenciales inválidas!");
        $datos=Usuarios::buscaUsuario($usuario, $password);
        array_push($msg, "1Clave de acceso o usuario inválido!");

	}

    //print($usuario."->".$password);

    //----------------------probando------------------
    //echo "todo ok!";
    //echo "El usuario es: $usuario y la contraseña es: $password";
}




//para permitir ver la página :D, si hay usuario conectado, dirigirlo a inicio
if($session->getUsuario()!==null){
    header("location:inicio.php");
}

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Control de Gastos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/favicon.ico">

	<!--Bootstrap CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>


</head>
    <body>
        <nav class="navbar navbar-expanded-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="index.php">Gastos</a>
        </nav>
        <div class="conteiner-fluid text-center mt-5">
            <div class="row content">
                <div class="col-sm-2 sidevar"></div>
                <div class="col-sm-8 text-center">
                    <img class="mb-1" src="img/iniciarSesion.png" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
                    <?php require"php/mensajes.php" ?>

                    <form action="index.php" class="text-left" method="post">

                        <!--USUARIO-->
                        <div class="form-group">
                            <label for="inputUsuario" class="sr-only sr-only-focusable">Ingresar Usuario</label>
                            <input type="text" name="inputUsuario" id="inputUsuario" class="form-control"
                            required autofocus="" placeholder="User">
                        </div>
                        <!--CONTRASEÑA-->
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Ingresar Contraseña</label>
                            <input type="password" name="inputPassword" id="inputPassword" class="form-control"
                            required placeholder="Password">
                        </div>
                        <!--CHECKBOX-->
                        <div class="checkbox mb-3">
                            <label>
                                <input class="form-check d-inline" type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>

                        <!--INGRESAR-->
                        <div class="form-group text-center">
                            <label for="inputEnter" class="sr-only">Botón para ingresar</label>
                            <input type="submit" name="inputEnter" id="inputEnter" class="btn btn-success shadow"
                            value="Login">
                        </div>




                    </form>
                    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
                </div>
                <div class="col-sm-2 sidevar"></div>
            </div>  
        </div>
    </body>
</html>