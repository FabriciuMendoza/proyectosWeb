<?php 


//llamar a las otras clases
require "php/variables.php";
require "class/Session.php";
require "class/dbMySQL.php";



/***************
Leemos la sesión
***************/

$session = new Session();

//para permitir ver la página :D
if($session->getUsuario()==null){

    //Como no se encuentra registrado lo mandamos al login para que ingrese nuevamente
    header("location:index.php");
}

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Control de Gastos | Inicio</title>
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
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
            <a class="navbar-brand" href="inicio.php">Gastos</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
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
                <li class="nav-item">
                    <a href="admon.php" class="nav-link">Admon</a>
                </li><
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
                </div>
                <div class="col-sm-2 sidevar"></div>
            </div>  
        </div>
    </body>
</html>
