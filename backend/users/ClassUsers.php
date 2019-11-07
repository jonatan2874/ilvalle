<?php

	/**
	 * ClassUsers
	 */
	class ClassUsers
	{

		public $mysql;

		function __construct($mysql){
			$this->mysql = $mysql;
		}

		public function addUser($documento='',$dv,$nombre='',$user_name='',$password='',$rol){

            // INSERTAR EL REGISTRO EN LA BASE DE DATOS
            $sql="INSERT INTO users
            		(
						documento,
						dv,
						nombre,
						user_name,
						password,
						rol

            		) VALUES
            		(
            			'$documento',
            			'$dv',
						'$nombre',
						'$user_name',
						'$password',
						'$rol'
            		)";
            $query=mysqli_query($this->mysql, $sql);
            if ($query) {
				$response = array('response' => 'success', 'msg'=>'Se inserto correctamente', 'debug' => "");
            }
            else {
            	unlink("images/".$fileName);
				$response = array('response' => 'failed', 'msg'=>'No se inserto el usuario', 'debug' => "" );
            }
	
			echo json_encode($response);
		}

		public function editUser($id_user,$documento,$dv,$nombre,$user_name,$password,$rol){
	    	// ACTUALIZAR EL REGISTRO EN LA BASE DE DATOS
            $sql="UPDATE users SET
						documento = '$documento',
						dv        = '$dv',
						nombre    = '$nombre',
						user_name = '$user_name',
						password  = '$password',
						rol       = '$rol'
					WHERE id=$id_user ";
            $query=mysqli_query($this->mysql, $sql);
            if ($query) {
				$response = array('response' => 'success', 'msg'=>'Se Actualizo correctamente', 'debug' =>  'N/F' );
            }
            else {
				$response = array('response' => 'failed', 'msg'=>'No se Actualizo el usuario', 'debug' => $sql );
            }
		    

			echo json_encode($response);
		}

		public function deleteUser($id_user){

        	$sql="UPDATE users SET activo=0 WHERE id=$id_user ";
        	$query=mysqli_query($this->mysql, $sql);
        	if ($query) {
				$response = array('response' => 'success', 'msg'=>'Se elimino correctamente', 'debug' => '' );
            }
            else {
				$response = array('response' => 'failed', 'msg'=>'No se elimino el usuario', 'debug' => '' );
            }
			echo json_encode($response);
		}

		public function editProfile($id_user,$password){
			// ACTUALIZAR EL REGISTRO EN LA BASE DE DATOS
            $sql="UPDATE users SET
						password  = '$password'
					WHERE id=$id_user ";
            $query=mysqli_query($this->mysql, $sql);
            if ($query) {
				$response = array('response' => 'success', 'msg'=>'Se Actualizo correctamente', 'debug' =>  'N/F' );
            }
            else {
				$response = array('response' => 'failed', 'msg'=>'No se Actualizo el usuario', 'debug' => $sql );
            }
		    

			echo json_encode($response);
		}

	}


 ?>