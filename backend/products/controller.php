<?php

	include '../configuracion/conectar.php';
	include '../configuracion/define_variables.php';
	include 'ClassProducts.php';
	// echo $_FILES['file']['name'];
	// var_dump($_FILES);
	$objProducts = new ClassProducts($mysql);
	if (!isset($method)) {
		$method = ($id_producto==0)? 'addProduct' : 'editProduct' ;
	}
	// echo $method; exit;
	switch ($method) {
		case 'addProduct':
				$objProducts->addProduct($codigo,$nombre,$descripcion,$precio);
			break;
		case 'editProduct':
				$objProducts->editProduct($id_producto,$codigo,$nombre,$descripcion,$precio);
			break;
		case 'deleteProduct':
				$objProducts->deleteProduct($id_producto);
			break;
	}



 ?>