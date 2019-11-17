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


    $contFilas = 0;
    if ($typeCert=='ingresos_retenciones') {
        // 0   Codigo
        // 1   Agravable
        // 2   24TipoDocumento
        // 3   25NumeroDocumento
        // 4   26PrimerApellido
        // 5   27SegundoApellido
        // 6   28PrimerNombre
        // 7   29SegundoNombre
        // 8   30PeriodoDe
        // 9   31PeriodoA
        // 10  32FechaExpedicion
        // 11  33Lugar
        // 12  34Depto
        // 13  35Municipio
        // 14  36Agencias
        // 15  37
        // 16  38
        // 17  39
        // 18  40
        // 19  41
        // 20  42
        // 21  43
        // 22  44
        // 23  45
        // 24  46
        // 25  47
        // 26  48
        // 27  49
        // 28  50
        // 29  51
        // 30  52
        // 31  53
        // 32  Observaciones
        // 33  NombreDelPagador
        // {
            // codigo
            // anio
            // tipo_documento
            // documento
            // primer_apellido
            // segundo_apellido
            // primer_nombre
            // segundo_nombre
            // anio_inicio
            // anio_fin
            // fecha_expedicion
            // lugar
            // departamento
            // municipio
            // agencias
            // 37
            // 38
            // 39
            // 40
            // 41
            // 42
            // 43
            // 44
            // 45
            // 46
            // 47
            // 48
            // 49
            // 50
            // 51
            // 52
            // 53
            // observaciones
            // nombre_pagador
        // }

        foreach ($arrayExcel as $filas => $arrayExcelCol) {
            if ($contFilas<=0) { $contFilas++; continue; }
            $valueInsert .= "(
                                '$arrayExcelCol[0]',
                                '$arrayExcelCol[1]',
                                '$arrayExcelCol[2]',
                                '$arrayExcelCol[3]',
                                '$arrayExcelCol[4]',
                                '$arrayExcelCol[5]',
                                '$arrayExcelCol[6]',
                                '$arrayExcelCol[7]',
                                '$arrayExcelCol[8]',
                                '$arrayExcelCol[9]',
                                '$arrayExcelCol[10]',
                                '$arrayExcelCol[11]',
                                '$arrayExcelCol[12]',
                                '$arrayExcelCol[13]',
                                '$arrayExcelCol[14]',
                                '$arrayExcelCol[15]',
                                '$arrayExcelCol[16]',
                                '$arrayExcelCol[17]',
                                '$arrayExcelCol[18]',
                                '$arrayExcelCol[19]',
                                '$arrayExcelCol[20]',
                                '$arrayExcelCol[21]',
                                '$arrayExcelCol[22]',
                                '$arrayExcelCol[23]',
                                '$arrayExcelCol[24]',
                                '$arrayExcelCol[25]',
                                '$arrayExcelCol[26]',
                                '$arrayExcelCol[27]',
                                '$arrayExcelCol[28]',
                                '$arrayExcelCol[29]',
                                '$arrayExcelCol[30]',
                                '$arrayExcelCol[31]',
                                '$arrayExcelCol[32]',
                                '$arrayExcelCol[33]'
                            ),";
            // $i=15;
            // for ($i=15; $i <=31 ; $i++) { 
            //     if ($arrayExcelCol[$i]<>''){
            //         $valueInsert .= "(
            //                             '$arrayExcelCol[0]',
            //                             '$arrayExcelCol[1]',
            //                             '$arrayExcelCol[2]',
            //                             '$arrayExcelCol[3]',
            //                             '$arrayExcelCol[4]',
            //                             '$arrayExcelCol[5]',
            //                             '$arrayExcelCol[6]',
            //                             '$arrayExcelCol[7]',
            //                             '$arrayExcelCol[8]',
            //                             '$arrayExcelCol[9]',
            //                             '$arrayExcelCol[10]',
            //                             '$arrayExcelCol[11]',
            //                             '$arrayExcelCol[12]',
            //                             '$arrayExcelCol[13]',
            //                             '$arrayExcelCol[14]',
            //                             '$arrayConceptos[$i]',
            //                             '$arrayExcelCol[$i]',
            //                             '$arrayExcelCol[32]',
            //                             '$arrayExcelCol[33]'
            //                         ),";
            //     }
            // }

            
        }
        $valueInsert = substr($valueInsert,0,-1);
        $sql="INSERT INTO retenciones_empleados 
                (
                `codigo`,
                `anio`,
                `tipo_documento`,
                `documento`,
                `primer_apellido`,
                `segundo_apellido`,
                `primer_nombre`,
                `segundo_nombre`,
                `anio_inicio`,
                `anio_fin`,
                `fecha_expedicion`,
                `lugar`,
                `departamento`,
                `municipio`,
                `agencias`,
                `37`,
                `38`,
                `39`,
                `40`,
                `41`,
                `42`,
                `43`,
                `44`,
                `45`,
                `46`,
                `47`,
                `48`,
                `49`,
                `50`,
                `51`,
                `52`,
                `53`,
                `observaciones`,
                `nombre_pagador`
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
            $arrayResponse = array('status' => 'failed', 'msg'=>'No se cargo la informacion correctamente','debug'=>$sql);
            echo json_encode($arrayResponse);
            // echo "failed";
            // unlink("images/".$fileName);
            // $response = array('response' => 'failed', 'msg'=>'No se inserto el usuario', 'debug' => "" );
        }
    }
    else{        
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
    }
    
    rollback($filename);

?>
