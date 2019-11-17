<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    include '../configuracion/conectar.php';
    include '../configuracion/define_variables.php';

    // $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    $filename = $_FILES['file']['name'];
    $uploadfile = basename($filename);

    // echo '<pre>';
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
        // echo "File is valid, and was successfully uploaded.\n";
    } else {
        // echo "Possible file upload attack!\n";
        $arrayResponse = array('status' => 'failed', 'msg'=>'No se cargo el Excel');
        echo json_encode($arrayResponse);
        exit;
    }

    $pathinfo = pathinfo($filename);
    $ext      = $pathinfo['extension'];
    if ($ext<>'xls' && $ext<>'xlsx') {
        $arrayResponse = array('status' => 'failed', 'msg'=>"solo se permiten formatos xls y xlsx $ext");
        echo json_encode($arrayResponse);
        rollback($filename);
        exit;
    }
    if ($anio=='' && $typeCert<>'ingresos_retenciones') {
        echo "<script>
                    alert('in');
                </script>
                ";
        $arrayResponse = array('status' => 'failed', 'msg'=>"debe digitar el año");
        echo utf8_encode( json_encode($arrayResponse) );
        rollback($filename);
        exit;
    }

    include 'load_excel.php';

    function rollback($filename){
        unlink($filename);
    }


?>

