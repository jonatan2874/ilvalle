<?php

	/**
	 * ClassConfig
	 */
	class ClassConfig
	{

		public $mysql;

		function __construct($mysql){
			$this->mysql = $mysql;
		}

		public function deleteDataCert($anio,$typeCert){

        	$sql="UPDATE retenciones_proveedores SET activo=0 WHERE tipo='$typeCert' AND anio BETWEEN '$anio-01-01' AND '$anio-12-31' ";
        	$query=mysqli_query($this->mysql, $sql);
        	if ($query) {
				$response = array('response' => 'success', 'msg'=>'Se elimino correctamente', 'debug' => $sql );
            }
            else {
				$response = array('response' => 'failed', 'msg'=>'No se elimino la informacion', 'debug' => '' );
            }
			echo json_encode($response);
		}


	}


 ?>