<?php 
	require "class/Session.php";
	$session = new Session();
	$session->finLogin();
	header("location:index.php");

 ?>