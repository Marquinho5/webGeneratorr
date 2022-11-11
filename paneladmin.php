<?php
session_start();
if(!isset($_SESSION['email'])){
	header("Location: login.php");
}else if($_SESSION['email']!="admin@server.com"){
	header("Location: login.php");
}
include 'credenciales.php';
$bd= mysqli_connect(HOST,USER,PASS,BD);
$sql='SELECT * FROM webs';
$response= mysqli_query($bd,$sql);
$listar="<table>";
if(mysqli_num_rows($response)>0){
	while($f=mysqli_fetch_array($response,MYSQLI_ASSOC)){
		$listar.='<tr><td><a href="../'.$f["dominio"].'">'.$f["dominio"].'</a></td></tr>';
	}
}else{
	$listar='No hay dominios registrados';
}
$listar.="</table>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panel Administrador</title>
</head>
<body>
	<center>
	<h1>Bienvenido <?php echo $_SESSION['email']; ?></h1><br>
	<a href="logout.php">Cerrar sesión</a><br><br>
	<?php echo $listar;?>
	</center>
</body>
</html>