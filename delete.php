<?php
session_start();
include 'credenciales.php';
if(!isset($_SESSION['email'])){
	header("Location: login.php");
}
if(isset($_GET['dominio'])){
	shell_exec('rm -r '.$_GET['dominio']);
	$bd= mysqli_connect(HOST,USER,PASS,BD);
	$sql='DELETE FROM `webs` WHERE `webs`.`dominio`="'.$_GET["dominio"].'"';
	$response= mysqli_query($bd,$sql);
}
?>