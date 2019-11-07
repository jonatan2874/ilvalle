<?php
	set_time_limit(0);
	date_default_timezone_set("America/Bogota");

	$datosConexion  = array(
						'servidor' => "localhost",
						'usuario'  => "root",
						'password' => "",
						'bd'       => "ilvalle",
					);

	$mysql = mysqli_connect(
							$datosConexion["servidor"],
							$datosConexion["usuario"],
							$datosConexion["password"],
							$datosConexion["bd"],
						);
	if (!$mysql) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

?>
