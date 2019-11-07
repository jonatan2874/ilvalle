<?php

	include '../configuracion/conectar.php';
	include '../configuracion/define_variables.php';

	$sql   = "SELECT id,documento,nombre,rol FROM users WHERE user_name='$user' AND password='$password' ";
	$query = mysqli_query($mysql,$sql);
	$result = $query->fetch_assoc();
	if ($result==NULL) {
		header('Location: ../../sign-in.php?error=Datos incorrectos');
	}
	else{
    	if(!session_start()){session_start();}
		$_SESSION['IDUSUARIO']        = $result ['id'];
		$_SESSION['DOCUMENTOUSUARIO'] = $result ['documento'];
		$_SESSION['NOMBREUSUARIO']    = $result ['nombre'];
		$_SESSION['ROLUSUARIO']       = $result ['rol'];
		header('Location: ../../index.php');
		// if (!isset($_SESSION['IDUSUARIO'])){ header('Location: sign-in.php');  }
		// var_dump($result);
	}



?>