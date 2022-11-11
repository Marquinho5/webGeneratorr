<?php
session_start();
if(isset($_SESSION['email'])){
	header("Location: panel.php");
}
$mensaje='';
if(isset($_GET['login'])){
	include 'credenciales.php';
	$bd = mysqli_connect(HOST,USER,PASS,BD);
	$email=$_GET['email'];
	$pass=$_GET['pass'];
	$pass2=$_GET['pass2'];
	$sql  = "SELECT * FROM usuarios";
	$resultado=mysqli_query($bd,$sql);
	if(mysqli_num_rows($resultado)>0){
		while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
			if($fila['email']==$email){
				$mensaje='Este email esta en uso, prueba otro!';
			}else{
				if($pass==$pass2){
					$dia=date("Y-m-d");
					$sql='INSERT INTO usuarios (email,password,fechaRegistro) VALUES ("'.$email.'","'.$pass.'","'.$dia.'")';
					$response=mysqli_query($bd,$sql);
					if($response){
						$mensaje='Se creo exitosamente su usuario.';
						header("Location: login.php");
					}else{
						$mensaje='No se pudo crear su usuario';
					}
				}else{
					$mensaje='No hay similitud entre las contraseñas.';
				}
			}
		}
	}else{
		$mensaje='No existe este usuario, por favor registrarse.';
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
</head>
<body>
	<h1>Registro de cuenta.</h1>
	<form action="">
		<p>Email<input type="text" name="email" placeholder="Email"></p>
		<p>Password<input type="password" name="pass" id=""></p>
		<p>Repetir Password<input type="password" name="pass2" id=""></p>
		<input type="submit" value="Registrar" name="login">
	</form>
	<div>
		<?php
			echo $mensaje;
		?>
	</div>
</body>
</html>