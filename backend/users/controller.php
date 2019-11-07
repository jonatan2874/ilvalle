<?php

	include '../configuracion/conectar.php';
	
	include '../configuracion/define_variables.php';
	include 'ClassUsers.php';
	include 'ClassCertificado.php';
	include 'certificado_ingresos_retenciones.php';
	// echo $_FILES['file']['name'];
	// var_dump($_FILES);
	$objUsers   = new ClassUsers($mysql);
	$objCert    = new ClassCertificado($mysql);

	if (!isset($method)) {
		$method = ($id_user==0)? 'addUser' : 'editUser' ;
	}
	// echo $method; exit;
	switch ($method) {
		case 'addUser':
				$objUsers->addUser($documento,$dv,$nombre,$user_name,$password,$rol);
			break;
		case 'editUser':
				$objUsers->editUser($id_user,$documento,$dv,$nombre,$user_name,$password,$rol);
			break;
		case 'deleteUser':
				$objUsers->deleteUser($id_user);
			break;
		case 'certificado':			
			$objCert->generate($nit,$anio,$typeCert);
			break;

		case 'certificadoEmp':			
			$objCertEmp = new certificadoIngresoRetenciones($anio,$documento,'',$mysql);;
			$objCertEmp->generate();
			break;			
		case 'editProfile':
			$objUsers->editProfile($id_user,$password);
			break;
		case 'saveCert':
			$objCert->saveCert($type,$content);
			break;
	}



 ?>