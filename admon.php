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
$usuario = $session->getUsuario();
$data = Usuarios::leeUsuario($usuario);
$id = $data["id"];
/********************************
Modo de la página (CRUD o ABC)
S - Consulta (select)
A - Alta (insert)
B - Borrar (delete)
C - Cambiar (update)
********************************/
if(isset($_GET["m"])){
    $m = $_GET["m"];
} else{
    $m = "S";

}
/*Validación*/
if(isset($_POST["nueva"])){
    $nueva =$_POST["nueva"];
    $verifica = $_POST["verifica"];
    $m="C";
    //Validar
    if ($nueva=="") {
        array_push($msg,"1La clave de acceso no puede estar vacía.");
    } else if($verifica==""){
        array_push($msg,"1La clave de acceso de verificación no puede estar vacía.");
    } else if($nueva!=$verifica){
        array_push($msg,"1La clave de acceso de verificación no puede estar vacía.");
    } else{
        $encriptacionClave= substr(hash_hmac("sha512", $nueva, $keyEncript),0,100);
        $r = Usuarios::cambiarClaveAcceso($id,$usuario,$encriptacionClave);
        array_push($msg, $r);
    }
}


//Validar que se ha realizado el logueo correspondiente

//para permitir ver la página :D
if($session->getUsuario()==null){
//Como no se encuentra registrado lo mandamos al login para que ingrese nuevamente
header("location:index.php");
}
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Control de Gastos | Admon</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/favicon.ico">

	<!--Bootstrap CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<!--SCRIPT-->
<script>
        window.onload = function(){
            <?php if($m=="C"){ ?>
                document.getElementById("regresar").onclick = function(){
                    window.open("admon.php","_self");
                }
            <?php } ?>
        }
    </script>


</head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="home.php">Gastos</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a href="inicio.php" class="nav-link">Resumen</a>
                </li>
                <li class="nav-item">
                    <a href="categorias.php" class="nav-link">Categorías</a>
                </li>
                <li class="nav-item">
                    <a href="cuentas.php" class="nav-link">Cuentas</a>
                </li>
                <li class="nav-item">
                    <a href="movimientos.php" class="nav-link">Movimientos</a>
                </li>
                <li class="nav-item">
                    <a href="traspasos.php" class="nav-link">Traspasos</a>
                </li>
                <li class="nav-item">
                    <a href="presupuestos.php" class="nav-link">Presupuestos</a>
                </li>
                <li class="nav-item">
                    <a href="cxc.php" class="nav-link">CXC</a>
                </li>
                <li class="nav-item active">
                    <a href="admon.php" class="nav-link">Admon</a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center">
                <li class="nav-item text-danger text-light ">
                    <?php  print "<a>Bienvenido(a), ".$session->getUsuario()." </a>";?>
                </li>
                <li class="nav-item">
                    <a href="salir.php" class="nav-link">Salir</a>
                </li>
            </ul>
        </nav>
        <div class="conteiner-fluid text-center mt-5">
            <div class="row content">
                <div class="col-sm-2 sidevar"></div>
                <div class="col-sm-8 text-center">
                    <?php if($m=="C"){ 
                            require "php/mensajes.php";

                        ?> 

                        <form action="admon.php" method="post">
                            <div class="form-group text-left">
                                <label for="usuario">Usuario:</label>
                                <input type="text" name="usuario" id="usuario" disabled class="form-control" value="<?php print $usuario; ?>">
                            </div>
                            <div class="form-group text-left">
                                <label for="nueva">Nueva clave de acceso:</label>
                                <input type="password" name="nueva" id="nueva" class="form-control" placeholder="Escribe la nueva clave de acceso" required>
                            </div>
                            <div class="form-group text-left">
                                <label for="verifica">Verifica la clave de acceso:</label>
                                <input type="password" name="verifica" id="verifica" class="form-control" placeholder="Verifica la nueva clave de acceso" required>
                            </div>
                            <div class="form-group text-left">
                                <label for="enviar"></label>
                                <input type="submit" name="enviar" id="enviar" class="btn btn-success" value="Enviar"/>
                         
                                <label for="regresar"></label>
                                <input type="button" name="regresar" id="regresar" class="btn btn-info" value="Regresar"role="button">                              
                            </div>                   
                        </form>
                    <?php } 

                    if($m=="S"){
                       print "<table class='table table-striped' width='100%'>";
                       print "<tr>";
                       print "<th>id</th>";
                       print "<th>Usuario</th>";
                       print "<th>Cambiar clave</th>";
                       print "</tr>";
                       print "<tr>";
                       print "<td>".$id."</td>";
                       print "<td>".$usuario."</td>";
                       print "<td><a class='btn btn-info' href='admon.php?m=C&id=".$id."'>Cambiar clave</a></td>";
                       print "</tr>";
                       print "</table>";
                   }

                     ?>




                </div>
                <div class="col-sm-2 sidevar"></div>
            </div>  
        </div>
    </body>
</html>
