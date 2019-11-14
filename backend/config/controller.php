<?php

	include '../configuracion/conectar.php';	
	include '../configuracion/define_variables.php';
	include 'ClassConfig.php';
	$objCert    = new ClassConfig($mysql);

	switch ($method) {
		case 'deleteDataCert':
			$objCert->deleteDataCert($anio,$typeCert);
		break;
	}



 ?>