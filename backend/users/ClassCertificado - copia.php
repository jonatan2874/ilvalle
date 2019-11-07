<?php

    /**
     * 
     */
    class ClassCertificado
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
                        AND R.tipo='fuente'  ";
            $query = mysqli_query($this->mysql,$sql);
            $cliente = '';
            $ciudad = '';
            $body    = '';
            while ($row = $query->fetch_assoc()){
                $valor = $row['base']*$row['porcentaje']/100;
                $cliente = $row['nombre'];
                $ciudad = $row['ciudad'];
                $body   .= "<tr>
                                <td>$row[concepto]</td>
                                <td>$row[base]</td>
                                <td style=''>$row[porcentaje]</td>
                                <td>$valor</td>
                            </tr>";

            }

            $boyCert = "<style>
                            table{
                                width:100%;
                                font-size:14px;
                                border-collapse:collapse;
                                font-family   : Verdana, Geneva, sans-serif
                            }
                            .title{
                                font-weight:bold;
                                text-align:center;
                            }
                            .title2{
                                text-align:center;
                            }
                        </style>
                        <div>
                            <table border=0>
                                <tr>
                                    <td><img src='../../images/LogoILV.jpg'></td>
                                    <td><img src='../../images/LOGO ISO 9001.jpg'></td>
                                    <td><img src='../../images/IQNet.jpg'></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>NIT: 890.399.012-0</td>
                                    <td>N° SC 639-1</td>
                                </tr>
                                <tr>
                                    <td colspan=4 class='title' >INDUSTRIA DE LICORES DEL VALLE</td>
                                </tr>
                                <tr>
                                    <td  colspan=4  class='title2' ></td>
                                </tr>
                                <tr>
                                    <td colspan=4 class='title2'>REGIMEN COMUN</td>
                                </tr>
                                <tr>
                                    <td colspan=4  class='title2'>GRAN CONTRIBUYENTE</td>
                                </tr>
                                <tr>
                                    <td colspan=4  class='title2'>KM 2 VIA ROZO-PALMASECA </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td colspan=4><b>$title</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td colspan=4>QUE DURANTE EL PERIODO ENERO-DICIEMBRE $anio SE LE RETUVO A:</td>
                                </tr>
                                <tr>
                                    <td colspan=4>$cliente</td>
                                </tr>
                                <tr>
                                    <td >IDENTIFICADO CON: #</td>
                                    <td colspan=2>LAS SIGUIENTES SUMAS:</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td>CONCEPTO</td>
                                    <td>VALOR BASE</td>
                                    <td style='width:100px;'>%</td>
                                    <td>VALOR RETENIDO</td>
                                </tr>
                                $body
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td colspan=4>CIUDAD DONDE SE CONSIGNO LA RETENCION: $ciudad</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td>FECHA DE EXPEDICION: ".(date("Y-m-d"))."</td>
                                </tr>
                                <tr>
                                    <td>RESPONSABLE: PROFESIONAL UNIVERSITARIO IMPUESTOS</td>
                                </tr>
                               </table>

                        </div>";
            return $boyCert;
        }

        public function generate($nit,$anio,$typeCert){
            $contentCert = $this->getData($nit,$anio,$typeCert);
            // exit;
            if(isset($TAM)){$HOJA = $TAM;}else{$HOJA = 'LETTER';}
            if(!isset($ORIENTACION)){$ORIENTACION = 'P';}
            if(!isset($PDF_GUARDA)){$PDF_GUARDA = 'false';}
            if(!isset($IMPRIME_PDF)){$IMPRIME_PDF = 'fal87se';}
            if(isset($MARGENES)){list($MS, $MD, $MI, $ML) = split( ',', $MARGENES );}else{$MS=10;$MD=10;$MI=10;$ML=10;}
            if(!isset($TAMANO_ENCA)){$TAMANO_ENCA = 12 ;}
            // if($IMPRIME_PDF == 'true'){
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
                // $mpdf-> debug = true;
                // $mpdf->useSubstitutions = true;
                // $mpdf->simpleTables = true;
                // $mpdf->packTableData= true;
                // $mpdf->SetAutoPageBreak(TRUE, 15);
                //$mpdf->SetTitle ( $documento );
                // $mpdf->SetAuthor ( $_SESSION['NOMBREFUNCIONARIO']." // ".$_SESSION['NOMBREEMPRESA'] );
                // $mpdf->SetDisplayMode ( 'fullpage' );
                // $mpdf->SetHeader("");
                // $mpdf->SetFooter('Pagina {PAGENO}/{nb}');

                $mpdf->WriteHTML(utf8_encode($contentCert));
                // if($PDF_GUARDA=='true'){$mpdf->Output($documento.".pdf",'D');}else{ 
                $mpdf->Output($documento.".pdf",'I');
                // }
                // exit;
            // }
            // else{ echo $contentCert; }

        }
    }
   
?>
