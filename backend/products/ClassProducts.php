<?php

	/**
	 * ClassProducts
	 */
	class ClassProducts
	{

		public $mysql;

		function __construct($mysql){
			$this->mysql = $mysql;
		}

		public function addProduct($codigo='',$nombre='',$descripcion='',$precio=''){

			if(!empty($_FILES["file"]["type"])){
		        $fileName = time().'_'.$_FILES['file']['name'];
		        $valid_extensions = array("jpeg", "jpg", "png");
		        $temporary = explode(".", $_FILES["file"]["name"]);
		        $file_extension = end($temporary);
		        // if((($_FILES["hard_file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
		            $sourcePath = $_FILES['file']['tmp_name'];
		            $targetPath = "images/".$fileName;
		            if(move_uploaded_file($sourcePath,$targetPath)){
		                $uploadedFile = $fileName;

		                // INSERTAR EL REGISTRO EN LA BASE DE DATOS
		                $sql="INSERT INTO Products
		                		(
									codigo,
									nombre,
									descripcion,
									precio,
									logo
		                		) VALUES
		                		(
		                			'$codigo',
									'$nombre',
									'$descripcion',
									'$precio',
									'$uploadedFile'
		                		)";
		                $query=mysqli_query($this->mysql, $sql);
		                if ($query) {
							$response = array('response' => 'success', 'msg'=>'Se inserto correctamente', 'debug' => $_FILES["file"]["type"] );
		                }
		                else {
		                	unlink("images/".$fileName);
							$response = array('response' => 'failed', 'msg'=>'No se inserto el producto', 'debug' => $_FILES["file"]["type"] );
		                }
		            }
		        // }
		    }
		    else{
		    	// INSERTAR EL REGISTRO EN LA BASE DE DATOS
		                $sql="INSERT INTO Products
		                		(
									codigo,
									nombre,
									descripcion,
									precio
		                		) VALUES
		                		(
		                			'$codigo',
									'$nombre',
									'$descripcion',
									'$precio'
		                		)";
		                $query=mysqli_query($this->mysql, $sql);
		                if ($query) {
							$response = array('response' => 'success', 'msg'=>'Se inserto correctamente', 'debug' => $_FILES["file"]["type"] );
		                }
		                else {
		                	unlink("images/".$fileName);
							$response = array('response' => 'failed', 'msg'=>'No se inserto el producto', 'debug' => $_FILES["file"]["type"] );
		                }
		    }

			echo json_encode($response);
		}

		public function editProduct($idProduct,$codigo,$nombre,$descripcion,$precio){

			if(!empty($_FILES["file"]["type"])){
		        $fileName = time().'_'.$_FILES['file']['name'];
		        $valid_extensions = array("jpeg", "jpg", "png");
		        $temporary = explode(".", $_FILES["file"]["name"]);
		        $file_extension = end($temporary);
		        // if((($_FILES["hard_file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
		            $sourcePath = $_FILES['file']['tmp_name'];
		            $targetPath = "images/".$fileName;
		            if(move_uploaded_file($sourcePath,$targetPath)){
		                $uploadedFile = $fileName;
						$sql   = "SELECT logo FROM Products WHERE id=$idProduct";
						$query = mysqli_query($this->mysql,$sql);
						while($result = $query->fetch_assoc()){
							$logo_old = $result['logo'];
						}

		                // INSERTAR EL REGISTRO EN LA BASE DE DATOS
		                $sql="UPDATE Products SET
									codigo      = '$codigo',
									nombre      = '$nombre',
									descripcion = '$descripcion',
									precio      = '$precio',
									logo        = '$uploadedFile'
								WHERE id=$idProduct ";
		                $query=mysqli_query($this->mysql, $sql);
		                if ($query) {
		                	unlink("images/".$logo_old);
							$response = array('response' => 'success', 'msg'=>'Se Actualizo correctamente', 'debug' => $_FILES["file"]["type"] );
		                }
		                else {
		                	unlink("images/".$fileName);
							$response = array('response' => 'failed', 'msg'=>'No se Actualizo el producto', 'debug' => $_FILES["file"]["type"] );
		                }
		            }
		        // }
		    }
		    else{
		    	// ACTUALIZAR EL REGISTRO EN LA BASE DE DATOS
                $sql="UPDATE Products SET
							codigo      = '$codigo',
							nombre      = '$nombre',
							descripcion = '$descripcion',
							precio      = '$precio'
						WHERE id=$idProduct ";
                $query=mysqli_query($this->mysql, $sql);
                if ($query) {
					$response = array('response' => 'success', 'msg'=>'Se Actualizo correctamente', 'debug' =>  'N/F' );
                }
                else {
					$response = array('response' => 'failed', 'msg'=>'No se Actualizo el producto', 'debug' => $sql );
                }
		    }

			echo json_encode($response);
		}

		public function deleteProduct($idProduct){
			$sql   = "SELECT logo FROM Products WHERE id=$idProduct";
			$query = mysqli_query($this->mysql,$sql);
			while($result = $query->fetch_assoc()){
				$logo_old = $result['logo'];
			}
        	@unlink("images/".$logo_old);
        	$sql="UPDATE Products SET activo=0 WHERE id=$idProduct ";
        	$query=mysqli_query($this->mysql, $sql);
        	if ($query) {
				$response = array('response' => 'success', 'msg'=>'Se elimino correctamente', 'debug' => '' );
            }
            else {
				$response = array('response' => 'failed', 'msg'=>'No se elimino el producto', 'debug' => '' );
            }
			echo json_encode($response);
		}

	}


 ?>