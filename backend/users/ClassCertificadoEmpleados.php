<?php

    /**
     * 
     */
    class ClassCertificadoEmpleados
    {
        public $mysql;

        function __construct($mysql){
            $this->mysql = $mysql;
        }

        public function getData($nit,$anio,$typeCert){

            switch ($typeCert) {
                case 'fuente':
                    $title = "CERTIFICADO DE RETENCION EN LA FUENTE";
                    break;
                case 'iva':
                    $title = "CERTIFICADO DE RETENCION DE IVA";
                    break;
                case 'ica':
                    $title = "CERTIFICADO DE RETENCION DE ICA";
                    break;
                case 'estampillas':
                    $title = "CERTIFICADO ESTAMPILLAS";
                    break;
            }
            $this->title = $title;
            $sql   = "SELECT
                            U.id,
                            U.nombre,
                            R.nombre AS concepto,
                            R.porcentaje,
                            RP.anio,
                            RP.ciudad,
                            RP.base
                        FROM
                            users AS U
                        LEFT JOIN retenciones_proveedores AS RP ON RP.id_proveedor = U.id
                        LEFT JOIN retenciones AS R ON R.id = RP.id_retencion
                        WHERE
                            U.documento = $nit
                        AND RP.anio='$anio'
                        AND R.tipo='$typeCert'  ";
            $query = mysqli_query($this->mysql,$sql);
            $cliente = '';
            $ciudad = '';
            $body    = '';
            $acumTotal=0;
            while ($row = $query->fetch_assoc()){
                $valor = ($row['base']*$row['porcentaje']/100);
                $acumTotal += $valor;
                $cliente = $row['nombre'];
                $ciudad = $row['ciudad'];
                $body   .= "<tr>
                                <td >$row[concepto]</td>
                                <td>".number_format ($row['base'], 2, "." , "," )."</td>
                                <td >$row[porcentaje]</td>
                                <td >".number_format ($valor, 2, "." , "," )."</td>
                            </tr>";

            }

            if ($body=="") {
                echo "<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
                    <center><h1>No existen datos de ese año y ese tipo de certificado a generar</h1></center>";
                exit;
            }
            

            ?>  
                <style>
                    .parent-content{
                        width: 100%;
                        height: 100%;
                        font-size: 14px;
                        font-family   : Verdana, Geneva, sans-serif;
                    }
                    .header{
                        width: 100%;
                    }
                    .header table{
                        width: 100%;
                        float: left;
                    }

                    .typeCert{
                        width         : 50%;
                        float         : left; 
                        border        : 1px solid; 
                        border-radius : 10px;
                        height        : 100px;
                        text-align    : center;
                        padding-top   : 30px;
                    }

                    .logosCert{
                        width: 49%;float: left;
                    }
                    .logosCert table{
                        text-align: center;
                        border-collapse: collapse;
                        font-size: 11px;
                    }
        
                    .titleCert{
                        width           : 400px;
                        float           : left;
                        border-radius   : 10px;
                        text-align      : center;
                        height          : 100px;
                        display         : flex;
                        justify-content : center;
                        align-items     : center;
                        font-size       : 14px;
                        font-family     : Verdana, Geneva, sans-serif;
                    }
                    .title, .content, .footer{
                        width         : 100%;
                        border        : 1px solid;
                        border-radius : 10px;
                        float         : left;
                        margin-top    : 10px;
                        text-align    : center;
                        padding       : 10px;  
                    }
                    .title h5,h2{
                        margin: 0px;
                    }
                    .content, .footer{
                        text-align: left;
                    }
                    .content .fila div{
                        float: left;
                        width: 49%;
                    }
                    .content .table{
                        float       : left;
                        margin      : 20px 0px 20px 0px;
                        width       : 100%;
                        font-size   : 14px;
                        font-family : Verdana, Geneva, sans-serif;

                    }
                    .labelTotal{
                        width: 100%;
                        text-align: right;
                        font-weight: bold;
                    }
                    .bottom div{
                        width: 50%;
                        /*position: absolute;*/
                        /*bottom: 0px;*/
                    }
                </style>
                <div class="parent-content">
                    <div class="header">
                        <div class= "logosCert">
                            <!-- <div style="width: 200px;float: left;">
                                <table>
                                    <tr>
                                    </tr>
                                </table>
                            </div>
                            <div style="width: 200px;float: left;" > -->
                                <table >
                                    <tr>
                                        <td>                                            
                                            <img style='width:200px;' src='../../images/LogoILV.jpg'>
                                        </td>
                                        <td>                                            
                                            <img style='width:50px;' src='../../images/LOGO ISO 9001.png'>
                                            <br>No SC 639-1
                                        </td>
                                        <td>                                            
                                            <img style='width:70px;' src='../../images/IQNet.png'>                            
                                        </td>
                                    </tr>
                                </table>
                            <!-- </div> -->
                        </div>
                        <div class="typeCert">
                            <?= $title ?>  <br>                               
                            <?= $anio ?>                                 
                        </div>                    
                    </div>
                    <div class="title">
                        <h2>INDUSTRIA DE LICORES DEL VALLE</h2>
                        <h5>NIT: 890.399.012-0</h5>
                        <h5>KM 2, VÍA A ROZO CORREGIMIENTO PALMASECA</h5>
                        <h5>PALMIRA – VALLE DEL CAUCA</h5>
                        <h5>REGIMEN COMÚN - GRAN CONTRIBUYENTE</h5>
                    </div>
                    <div class="content">
                        <p>Que durante el periodo: ENERO - DICIEMBRE <?= $anio; ?></p>
                        <p>Se le retuvo a: <?= $cliente; ?></p>
                        <div class="fila div">
                            <div>Identificado con No: <?= $nit; ?></div>
                            <div>Las siguientes sumas:</div>
                        </div>
                        <table class="table">
                            <tr>
                                <td >CONCEPTO</td>
                                <td >VALOR BASE</td>
                                <td >%</td>
                                <td >VALOR RETENIDO</td>
                            </tr>
                            <?= $body; ?>
                        </table>
                        <div class="labelTotal">VALOR TOTAL RETENIDO: $ <?= number_format ($acumTotal, 2, "." , "," ) ?>  </div>
                    </div>
                    <div class="footer">
                        <p>Ciudad donde se realizo la retencion: <?= $ciudad; ?></p>
                        <p>Fecha de expedicion: <?= date("Y-m-d"); ?></p>
                        <div class="labelTotal">RESPONSABLE<br>PROFESIONAL UNIVERSITARIO IMPUESTOS</div>
                    </div>
                </div>

            <?php
        }

        public function generate($nit,$anio,$typeCert){
            error_reporting(0);
            ob_start();

            $this->getData($nit,$anio,$typeCert);
            // exit;

            $contentCert = ob_get_contents(); 
            ob_end_clean(); 
            // flush();
            // ob_clean();
            // echo $contentCert; exit;
            if(isset($TAM)){$HOJA = $TAM;}else{$HOJA = 'LETTER';}
            if(!isset($ORIENTACION)){$ORIENTACION = 'P';}
            if(!isset($PDF_GUARDA)){$PDF_GUARDA = 'false';}
            if(!isset($IMPRIME_PDF)){$IMPRIME_PDF = 'fal87se';}
            if(isset($MARGENES)){list($MS, $MD, $MI, $ML) = split( ',', $MARGENES );}else{$MS=10;$MD=10;$MI=10;$ML=10;}
            if(!isset($TAMANO_ENCA)){$TAMANO_ENCA = 12 ;}
            // // if($IMPRIME_PDF == 'true'){
                include("../misc/MPDF54/mpdf.php");
                $mpdf = new mPDF(
                            'utf-8',        // mode - default ''
                            $HOJA,          // format - A4, for example, default ''
                            12,             // font size - default 0
                            '',             // default font family
                            $MI,            // margin_left
                            $MD,            // margin right
                            $MS,            // margin top
                            $ML,            // margin bottom
                            10,             // margin header
                            10,             // margin footer
                            $ORIENTACION    // L - landscape, P - portrait
                        );
                $mpdf-> debug = true;
                // $mpdf->useSubstitutions = true;
                $mpdf->simpleTables = true;
                // $mpdf->packTableData= true;
                $mpdf->SetAutoPageBreak(TRUE, 15);
                $mpdf->SetTitle ( $this->title );
                // $mpdf->SetAuthor ( $_SESSION['NOMBREFUNCIONARIO']." // ".$_SESSION['NOMBREEMPRESA'] );
                $mpdf->SetDisplayMode ( 'fullpage' );
                // $mpdf->SetHeader("");
                $mpdf->SetHTMLFooter("<div style='width:100%;font-size:14px;'>
                                        <div style='float:left;width:50%;' >
                                            Fecha de generacion: ".date("Y-m-d")."
                                        </div>
                                        <div style='float:left;width:50%;text-align:right;' >
                                            Hora de generacion: ".date("H:i:s")."
                                        </div>
                                    </div>");
                // $mpdf->SetFooter('Pagina {PAGENO}');

                $mpdf->WriteHTML( $contentCert );
                // $mpdf->WriteHTML( 'hola' );
                $mpdf->Output($documento.".pdf",'I');
                // // }
                // exit;
            // }
            // else{ echo $contentCert; }

        }
    }
   
?>
