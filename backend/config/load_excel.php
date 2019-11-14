<?php
    include_once('../misc/PHPExcel/Classes/PHPExcel.php');

    $objPHPExcel = PHPExcel_IOFactory::load($filename);
    $arrayExcel  = $objPHPExcel->getActiveSheet()->toArray(null,true,false,false);

    // $contArray  = COUNT($arrayExcel);
    // $contCol    = COUNT($arrayExcel[0]);
    // $debug      = "cuentas";

    // print_r($arrayExcel);
   
    // switch ($typeCert) {
    //     case 'fuente':
    //         $tipo = "";
    //         break;
    //     case 'iva':
    //         $tipo = "";
    //         break;
    //     case 'ica':
    //         $tipo = "";
    //         break;
    //     case 'estampillas':
    //         $tipo = "";
    //         break;
    // }

    // [0] => Consecutivo
    //         [1] => Nit
    //         [2] => Tipo
    //         [3] => Concepto
    //         [4] => Base
    //         [5] => Porcentaje
    //         [6] => subtotal
    //         [7] => fecha_expedicion
    //         [8] => ciudad
    //         [9] => ciudad_consignacion
    //     )
    // 'consecutivo',
    // 'documento_proveedor',
    // 'concepto',
    // 'tipo',
    // 'porcentaje',
    // 'subtotal',
    // 'base',
    // 'anio',
    // 'fecha_expedicion',
    // 'ciudad',
    // 'ciudad_consignacion',

    $contFilas = 0;
    foreach ($arrayExcel as $filas => $arrayExcelCol) {
        if ($contFilas<=0) { $contFilas++; continue; }

        $valueInsert .= "(
                            '$arrayExcelCol[0]',
                            '$arrayExcelCol[1]',
                            '$arrayExcelCol[3]',
                            '$typeCert',
                            '$arrayExcelCol[5]',
                            '$arrayExcelCol[6]',
                            '$arrayExcelCol[4]',
                            '$anio',
                            '$arrayExcelCol[7]',
                            '$arrayExcelCol[8]',
                            '$arrayExcelCol[9]'

                        ),";
    }
    $valueInsert = substr($valueInsert,0,-1);
    $sql="INSERT INTO retenciones_proveedores 
            (
                consecutivo,
                documento_proveedor,
                concepto,
                tipo,
                porcentaje,
                subtotal,
                base,
                anio,
                fecha_expedicion,
                ciudad,
                ciudad_consignacion
            ) 
            VALUES $valueInsert";
    $query=mysqli_query($mysql, $sql);
    if ($query) {
        $arrayResponse = array('status' => 'succes', 'msg'=>'se cargo la informacion correctamente');
        echo json_encode($arrayResponse);
        // echo "success";
        // $response = array('response' => 'success', 'msg'=>'Se inserto correctamente', 'debug' => "");
    }
    else {
        $arrayResponse = array('status' => 'succes', 'msg'=>'No se cargo la informacion correctamente');
        echo json_encode($arrayResponse);
        // echo "failed";
        // unlink("images/".$fileName);
        // $response = array('response' => 'failed', 'msg'=>'No se inserto el usuario', 'debug' => "" );
    }
    
    rollback($filename);

?>
