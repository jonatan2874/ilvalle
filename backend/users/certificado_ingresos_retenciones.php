<?php
    error_reporting(E_ERROR | E_PARSE);

    // if($IMPRIME_XLS=='true'){
    //     // header('Content-Encoding: UTF-8');
    //     header('Content-type: application/vnd.ms-excel;');
    //     header("Content-Disposition: attachment; filename=CIRE_".date("Y-m-d").".xls");
    //     header("Pragma: no-cache");
    //     header("Expires: 0");
    // }

    // $id_empresa = $_SESSION['EMPRESA'];
    // $object = new certificadoIngresoRetenciones($fecha_inicio,$fecha_final,$id_empleado,$IMPRIME_XLS,$id_empresa,$mysql);
    // $object->createFormat();


    /**
    * @class certificadoIngresoRetenciones
    *
    */
    class certificadoIngresoRetenciones
    {
        private $fecha_inicio          = '';
        private $fecha_final           = '';
        private $id_empleado           = '';
        private $mysql                 = '';
        private $IMPRIME_XLS           = '';
        private $id_empresa            = '';
        private $arraySecciones        = '';
        private $arrayFilas            = '';
        private $arrayConceptosFormato = '';
        private $arrayInfoEmpleado     = '';
        private $arrayInfoEmpresa      = '';
        private $arrayFormatStructure  = '';

        /**
        * @method construct
        * @param int id de la empresa
        * @param obj objeto de conexion mysql
        */
        function __construct($anio,$documento,$IMPRIME_XLS,$mysql)
        {
            $this->anio   = $anio;
            $this->documento   = $documento;
            // $this->fecha_inicio   = $fecha_inicio;
            // $this->fecha_final    = $fecha_final;
            // $this->id_empleado     = $id_empleado;
            // $this->id_empresa     = $id_empresa;
            $this->IMPRIME_XLS    = $IMPRIME_XLS;
            $this->mysql          = $mysql;
            // $arrayFormatStructure['Concepto de los Ingresos'] =
        }

        /**
        * @method generate Crear el formato solicitado por el usuario
        */
        public function generate()
        {
            // $this->getInfoEmpleado();
            // $this->getInfoEmpresa();
            // $this->setSecciones();
            // $this->setFilas();
            // $this->setConceptos();
            // $this->setConceptosValue();

            // if($this->IMPRIME_XLS=='true'){
            //     $logo_dian      = $_SERVER['DOCUMENT_ROOT'].'/LOGICALERP/informes/img/logo_dian.png';
            //     $logo_muisca    = $_SERVER['DOCUMENT_ROOT'].'/LOGICALERP/informes/img/logo_muisca.png';
            //     $numero_formato = $_SERVER['DOCUMENT_ROOT'].'/LOGICALERP/informes/img/numero_formato.png';
            // }
            // else{
            //     $logo_dian      = 'img/logo_dian.png';
            //     $logo_muisca    = 'img/logo_muisca.png';
            //     $numero_formato = 'img/numero_formato.png';
            // }

            $logo_dian      = '../../images/logo_dian.png';
            $logo_muisca    = '../../images/logo_muisca.png';
            $numero_formato = '../../images/numero_formato.png';

            // list( $anio_inicio,$mes_inicio, $dia_inicio) = split('-', $this->fecha_inicio);
            // list($anio_fin,$mes_fin, $dia_fin, ) = split('-', $this->fecha_final);
            $this->arrayInfoEmpresa = array(
                                                'documento'           => '890399012',
                                                'digito_verificacion' => '0',
                                                'razon_social'        => 'INDUSTRIA DE LICORES DEL VALLE',
                                            );
            $sql   = "SELECT
                        documento,
                        nombre,
                        nombre1,
                        nombre2,
                        apellido1,
                        apellido2
                    FROM users WHERE documento='$this->documento'";
            $query = mysqli_query($this->mysql,$sql);
            // var_dump($query);
            $result    = $query->fetch_assoc();
            $this->arrayInfoEmpleado = array(
                                                'documento' => $result['documento'],
                                                'apellido1' => $result['apellido1'],
                                                'apellido2' => $result['apellido2'],
                                                'nombre1'   => $result['nombre1'],
                                                'nombre2'   => $result['nombre2'],
                                            );

            $sql   = "SELECT * FROM retenciones_empleados WHERE documento='$this->documento' AND anio='$this->anio' ";
            $query = mysqli_query($this->mysql,$sql);
            // var_dump($query);
            $result    = $query->fetch_assoc();
            $arrayDepto     = str_split($result['departamento']);
            $arrayMunicipio = str_split($result['municipio']);
            // $documento = $result['documento'];
            // $dv        = $result['dv'];
            // $nombre    = $result['nombre'];
            // $user_name = $result['user_name'];
            // $password  = $result['password'];
            // $rol       = $result['rol'];



            // $this->arrayInfoEmpresa['documento']           =
            // $this->arrayInfoEmpresa['digito_verificacion'] =
            // $this->arrayInfoEmpresa['razon_social']        =

            // $this->arrayInfoEmpresa['documento']='';
            // $this->arrayInfoEmpresa['digito_verificacion'] = 0;
            $bodyResul = '';
            $bodyResul.='
                        <script>
                            // console.log("'.$_SERVER['HTTP_HOST'].' - '.$_SERVER['SERVER_PORT'].' - '.$_SERVER['REQUEST_URI'].' ");
                            console.log("'.$_SERVER['SERVER_NAME'].'");
                        </script>
                        <tr style="height:50px;">
                            <td colspan="6" class="img"><img align=center src="'.$logo_dian.'"></td>
                            <td colspan="20" class="title">CERTIFICADO  DE  INGRESOS  Y  RETENCIONES PARA PERSONAS NATURALES EMPLEADOS  AÑO GRAVABLE</td>
                            <td colspan="8" class="img"><img align=center src="'.$logo_muisca.'"></td>
                            <td colspan="4" class="img"><img align=center src="'.$numero_formato.'"></td>
                        </tr>
                        <tr>
                            <td colspan="21"></td>
                            <td colspan="17">4. Numero de Formulario</td>
                        </tr>
                        <tr>
                            <td rowspan="5" class="verticalTd title">Retenedor</td>
                            <td style="border:none;" colspan="13">5. Numero de Identificacion Tributaria (NIT)</td>
                            <td style="border:none;border-right:0.5px solid;" colspan="2">6. DV</td>
                            <td style="border:none;" colspan="6">7. Primer Apellido</td>
                            <td style="border:none;" colspan="6">8. Segundo Apellido</td>
                            <td style="border:none;" colspan="7">9. Primer Nombre</td>
                            <td style="border:none;" colspan="3">10. Otros Nombres</td>
                        </tr>
                        <tr>
                            <td colspan="15" style="border-top:none;border-bottom:none;"></td>
                            <td colspan="22" style="border:none;"></td>
                        </tr>
                        <tr>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -13,-12).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -12,-11).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -11,-10).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -10,-9).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -9,-8).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -8,-7).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -7,-6).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -6,-5).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -5,-4).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -4,-3).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -3,-2).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -2,-1).'</td>
                            <td style="border-top:none;">'.substr($this->arrayInfoEmpresa['documento'], -1).'</td>
                            <td style="border-top:none;">-</td>
                            <td style="border-top:none;">'.$this->arrayInfoEmpresa['digito_verificacion'].'</td>
                            <td style="border-top:none;" colspan="6"></td>
                            <td style="border-top:none;" colspan="6"></td>
                            <td style="border-top:none;" colspan="7"></td>
                            <td style="border-top:none;" colspan="3"></td>
                        </tr>
                        <tr ><td style="border:none;background-color:#CCFFCC;"colspan="37">11. Razon Social</td></tr>
                        <tr ><td style="border:none;" colspan="37" >'.$this->arrayInfoEmpresa['razon_social'].'</td></tr>

                        <tr >
                            <td rowspan="4" class="verticalTd title">Asalariado</td>
                            <td style="border-bottom:none;" colspan="5">24. Cod. tipo de documento</td>
                            <td style="border-bottom:none;" colspan="12">25. Numero de Documento de Identificacion</td>
                            <td style="border-bottom:none;" colspan="20">Apellidos y Nombres</td>
                        </tr>
                        <tr>
                            <td style="border-top:none;border-bottom:none;" colspan="5"></td>
                            <td style="border-top:none;border-bottom:none;" colspan="12">'.$this->arrayInfoEmpleado['documento'].'</td>
                            <td style="border-top:none;border-bottom:none;" colspan="20">
                                '.$this->arrayInfoEmpleado['apellido1'].'
                                '.$this->arrayInfoEmpleado['apellido2'].'
                                '.$this->arrayInfoEmpleado['nombre1'].'
                                '.$this->arrayInfoEmpleado['nombre2'].'
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top:none;border-bottom:none;" colspan="5"></td>
                            <td style="border-top:none;border-bottom:none;" colspan="12"></td>
                            <td style="border-top:none;border-bottom:none;" colspan="20"></td>
                        </tr>
                        <tr>
                            <td style="border-top:none;" colspan="5"></td>
                            <td style="border-top:none;" colspan="12"></td>
                            <td colspan="5">26. Primer Apellido</td>
                            <td colspan="6">27. Segundo Apellido</td>
                            <td colspan="6">28. Primer Nombre</td>
                            <td colspan="3">29. Otros Nombres</td>
                        </tr>
                        <tr >
                            <td colspan="18" style="border-bottom:none;" class="text-center" >Periodo de la certificacion</td>
                            <td colspan="7"  style="border-bottom:none;height:35px;" class="text-center" >32. Fecha de Expedicion</td>
                            <td colspan="8"  style="border-bottom:none;" class="text-center" >33. Lugar Donde Se practico</td>
                            <td colspan="2"  style="border-bottom:none;" class="text-center" >34. Cod. Depto</td>
                            <td colspan="3"  style="border-bottom:none;" class="text-center" >34. 35. Cod. Ciudad/ Municipio</td>
                        </tr>
                        <tr >
                            <td style="border-top:none;text-align:right;"  colspan="4">30. DE:</td>
                            <td style="border:none;border-right:0.5px solid;" colspan="4">'.$this->anio.'</td>
                            <td style="border:none;border-right:0.5px solid;" >01</td>
                            <td style="border:none;border-right:0.5px solid;" >01</td>
                            <td style="border:none;text-align:center;"  colspan="3">31. A:</td>
                            <td style="border:none;border-right:0.5px solid;"  colspan="2">'.$this->anio.'</td>
                            <td style="border:none;border-right:0.5px solid;" >12</td>
                            <td style="border:none;" >31</td>
                            <td style="border:none;border-right:0.5px solid;" ></td>
                            <td style="border:none;" ></td>
                            <td style="border:none;"  colspan="3">'.date("Y").'</td>
                            <td style="border:none;" >'.date("m").'</td>
                            <td style="border:none;" >'.date("d").'</td>
                            <td style="border:none;border-right:0.5px solid;" ></td>
                            <td style="border:none;border-right:0.5px solid;text-align:center;"  colspan="8">'.$result['lugar'].'</td>
                            <td style="border:none;" ></td>
                            <td style="border:none;border-right:0.5px solid;" >'.$result['departamento'].'</td>
                            <td style="border:none;border-right:0.5px solid;" >'.$arrayMunicipio[0].'</td>
                            <td style="border:none;border-right:0.5px solid;" >'.$arrayMunicipio[1].'</td>
                            <td style="border:none;border-right:0.5px solid;" >'.$arrayMunicipio[2].'</td>
                        </tr>
                        <tr>
                            <td colspan="24">36. Numero de agencias, sucursales, filiales o subsidiarias de la empresa retenedora cuyos montos de retención se consolidan:</td>
                            <td colspan="14">'.$result['agencias'].'</td>
                        </tr>
                        ';

            $bodyResul.='
                        <tr class="title">
                            <td style="background-color:#FEFF8E;" colspan="27">Concepto de los Ingresos</td>
                            <td style="background-color:#FEFF8E;" colspan="11">Valor</td>
                        </tr>
                        <tr>
                            <td colspan="27">Pagos por salarios o emolumentos eclesiásticos</td>
                            <td>37</td>
                            <td colspan="10">'.$result['37'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;"  colspan="27">Pagos por honorarios</td>
                            <td style="background-color:#CCFFCC;" >38</td>
                            <td style="background-color:#CCFFCC;"  colspan="10">0</td>
                        </tr>
                        <tr>
                            <td colspan="27">Pagos por servicios</td>
                            <td>39</td>
                            <td colspan="10">'.$result['39'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;"  colspan="27">Pagos por comisiones</td>
                            <td style="background-color:#CCFFCC;" >40</td>
                            <td style="background-color:#CCFFCC;"  colspan="10">'.$result['40'].'</td>
                        </tr>
                        <tr>
                            <td colspan="27">Pagos por prestaciones sociales</td>
                            <td>41</td>
                            <td colspan="10">'.$result['41'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;" colspan="27">Pagos por viáticos</td>
                            <td style="background-color:#CCFFCC;">42</td>
                            <td style="background-color:#CCFFCC;" colspan="10">'.$result['42'].'</td>
                        </tr>
                        <tr>
                            <td   colspan="27"> Pagos por gastos de representación</td>
                            <td  >43</td>
                            <td   colspan="10">'.$result['43'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;"  colspan="27"> Pagos por compensaciones por el trabajo asociado cooperativo</td>
                            <td style="background-color:#CCFFCC;" >44</td>
                            <td style="background-color:#CCFFCC;"  colspan="10">'.$result['44'].'</td>
                        </tr>
                        <tr>
                            <td colspan="27">Otros pagos</td>
                            <td>45</td>
                            <td colspan="10">'.$result['45'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;"  colspan="27">Cesantias e intereses de cesantias efectivamente pagadas, consignadas o reconocidas en el periodo</td>
                            <td style="background-color:#CCFFCC;" >46</td>
                            <td style="background-color:#CCFFCC;"  colspan="10">'.$result['46'].'</td>
                        </tr>
                        <tr>
                            <td colspan="27">Pensiones de Jubilación, vejez o invalidez</td>
                            <td>47</td>
                            <td colspan="10">'.$result['47'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;"  colspan="27">Total de ingresos brutos (Sume casillas 37 a 47)</td>
                            <td style="background-color:#CCFFCC;" >48</td>
                            <td style="background-color:#CCFFCC;"  colspan="10">'.$result['48'].'</td>
                        </tr>
                        <tr class="title">
                            <td style="background-color:#FEFF8E;" colspan="27">Concepto de los aportes</td>
                            <td style="background-color:#FEFF8E;" colspan="11">Valor</td>
                        </tr>
                        <tr>
                            <td colspan="27">Aportes obligatorios por salud</td>
                            <td>49</td>
                            <td colspan="10">'.$result['49'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;" colspan="27">Aportes obligatorios a fondos de pensiones y solidaridad pensional y Aportes voluntarios al - RAIS</td>
                            <td style="background-color:#CCFFCC;">50</td>
                            <td style="background-color:#CCFFCC;" colspan="10">'.$result['50'].'</td>
                        </tr>
                        <tr>
                            <td colspan="27">Aportes voluntarios, a fondos de pensiones</td>
                            <td>51</td>
                            <td colspan="10">'.$result['51'].'</td>
                        </tr>
                        <tr>
                            <td style="background-color:#CCFFCC;" colspan="27"> Aportes a cuentas AFC</td>
                            <td style="background-color:#CCFFCC;">52</td>
                            <td style="background-color:#CCFFCC;" colspan="10">'.$result['52'].'</td>
                        </tr>
                        <tr>
                            <td colspan="27">Valor de la retención en la fuente por rentas de trabajo y pensiones</td>
                            <td>53</td>
                            <td colspan="10">'.$result['53'].'</td>
                        </tr>
                        <tr>
                            <td colspan="38"><b>Nombre del pagador o agente retenedor</b><br>'.$result['nombre_pagador'].'</td>
                        </tr>

                        <tr >
                            <td style="background-color:#FEFF8E;" class="title" colspan="38">Datos a Cargo del Asalariado</td>
                        </tr>
                        <tr >
                            <td style="background-color:#CCFFCC;text-align:center;" colspan="24" >Concepto de otro Ingresos</td>
                            <td style="background-color:#CCFFCC;" colspan="7">Valor Recibido</td>
                            <td style="background-color:#CCFFCC;" colspan="7">Valor Retenido</td>
                        </tr>
                        <tr>
                            <td colspan="24">Arrendamientos</td>
                            <td>54</td>
                            <td colspan="6">-</td>
                            <td>61</td>
                            <td colspan="6">-</td>
                        </tr>
                        <tr >
                            <td style="background-color:#CCFFCC;" colspan="24">Honorarios, comisiones y servicios</td>
                            <td style="background-color:#CCFFCC;" >55</td>
                            <td style="background-color:#CCFFCC;" colspan="6">-</td>
                            <td style="background-color:#CCFFCC;">62</td>
                            <td style="background-color:#CCFFCC;" colspan="6">-</td>
                        </tr>
                        <tr>
                            <td colspan="24">Intereses y rendimientos financieros</td>
                            <td>56</td>
                            <td colspan="6">-</td>
                            <td>63</td>
                            <td colspan="6">-</td>
                        </tr>
                        <tr >
                            <td style="background-color:#CCFFCC;" colspan="24">Enajenacion de activos fijos</td>
                            <td style="background-color:#CCFFCC;">57</td>
                            <td style="background-color:#CCFFCC;" colspan="6">-</td>
                            <td style="background-color:#CCFFCC;">64</td>
                            <td style="background-color:#CCFFCC;" colspan="6">-</td>
                        </tr>
                        <tr>
                            <td colspan="24">Loterias, rifas, apuestas y similares</td>
                            <td>58</td>
                            <td colspan="6">-</td>
                            <td>65</td>
                            <td colspan="6">-</td>
                        </tr>
                        <tr >
                            <td style="background-color:#CCFFCC;" colspan="24">Otros</td>
                            <td style="background-color:#CCFFCC;">59</td>
                            <td style="background-color:#CCFFCC;" colspan="6">-</td>
                            <td style="background-color:#CCFFCC;">66</td>
                            <td style="background-color:#CCFFCC;" colspan="6">-</td>
                        </tr>
                        <tr>
                            <td colspan="24">Totales: (Valor recibido: Sume casillas 47 a 52),  (Valor retenido: Sume casillas 54 a  59)</td>
                            <td>60</td>
                            <td colspan="6">-</td>
                            <td>67</td>
                            <td colspan="6">-</td>
                        </tr>
                        <tr >
                            <td style="background-color:#CCFFCC;" colspan="31">Total retenciones año gravable '.$this->anio.'  (Sume casillas 46 + 60)</td>
                            <td style="background-color:#CCFFCC;">68</td>
                            <td style="background-color:#CCFFCC;" colspan="6">-</td>
                        </tr>
                        <tr class="title">
                            <td style="background-color:#FEFF8E;">Item</td>
                            <td style="background-color:#FEFF8E;" colspan="30">62. Identificacion de los bienes poseidos</td>
                            <td style="background-color:#FEFF8E;" colspan="7">63. Valor Patrimonial</td>
                        </tr>
                        <tr >
                            <td style="background-color:#CCFFCC;">1</td>
                            <td style="background-color:#CCFFCC;" colspan="30"></td>
                            <td style="background-color:#CCFFCC;" colspan="7">-</td>
                        </tr>
                        <tr><td>2</td><td colspan="30"></td><td colspan="7">-</td></tr>
                        <tr >
                            <td style="background-color:#CCFFCC;">3</td>
                            <td style="background-color:#CCFFCC;" colspan="30"></td>
                            <td style="background-color:#CCFFCC;" colspan="7">-</td>
                        </tr>
                        <tr><td>4</td><td colspan="30"></td><td colspan="7">-</td></tr>
                        <tr >
                            <td style="background-color:#CCFFCC;">5</td>
                            <td style="background-color:#CCFFCC;" colspan="30"></td>
                            <td style="background-color:#CCFFCC;" colspan="7">-</td>
                        </tr>
                        <tr><td>6</td><td colspan="30"></td><td colspan="7">-</td></tr>
                        <tr >
                            <td style="background-color:#CCFFCC;">7</td>
                            <td style="background-color:#CCFFCC;" colspan="30"></td>
                            <td style="background-color:#CCFFCC;" colspan="7">-</td>
                        </tr>
                        <tr><td>8</td><td colspan="30"></td><td colspan="7">-</td></tr>
                        <tr >
                            <td style="background-color:#CCFFCC;" colspan="31">Deudas vigentes a 31 de Diciembre de  '.$this->anio.'  </td>
                            <td style="background-color:#CCFFCC;" colspan="7">71 -</td>
                        </tr>

                        <tr >
                            <td style="background-color:#FEFF8E;" class="title" colspan="38">Identificacion de las personas dependientes de acuerdo al paragrafo 2 del articulo 387 del E.T.</td>
                        </tr>
                        <tr >
                            <td style="background-color:#CCFFCC;" >Item</td>
                            <td style="background-color:#CCFFCC;" colspan="7">72. C.C. o NIT</td>
                            <td style="background-color:#CCFFCC;" colspan="23">73. Apellidos y Nombres</td>
                            <td style="background-color:#CCFFCC;" colspan="7">74. Parentesco</td>
                        </tr>
                        <tr><td></td><td colspan="7"></td><td colspan="23"></td><td colspan="7"></td></tr>

                        <tr>
                            <td colspan="27">
                                Certifico que durante el año gravable '.$this->anio.'  :<br>
                                1. Por lo menos el 80% de mis ingresos brutos provinieron de una relación laboral o reglamentaria.
                                2. Mi patrimonio bruto era igual o inferior a  4.500 UVT ($149.202.000).
                                3. No fui responsable del impuesto sobre las ventas.
                                4. Mis ingresos totales fueron iguales o inferiores a  1.400 UVT ( $46.418.000)
                                5. Mis consumos mediante tarjeta de crédito no excedieron de  1.400 UVT ($46.418.000)
                                6. Que el total de mis compras y consumos no superaron  1.400 UVT ($46.418.000)
                                7. Que el valor total de mis consignaciones bancarias, depositos o inversiones financieras no excedieron los  1.400 UVT ($ 46.418.000)
                                   Por lo tanto, manifiesto que no estoy obligado a presentar declaracion de renta y complementarios por el año gravable 2018

                            </td>
                            <td colspan="11">Firma del Asalariado:</td>
                        </tr>
                        ';

            $formato="
                <head>
                    <meta content='charset=UTF-8' />
                </head>
                <style>

                    td{
                      width : 37px !important;
                          font-family: \"Trebuchet MS\", Verdana, Arial, sans-serif, \"Lucida Grande\";
                    }

                   .tabla td {
                        font-size:12px;
                        padding:5px;
                        border:0.5px solid;
                        height : 30px;

                    }

                    .tabla {
                        border-collapse: collapse;
                        border: 1px solid green;
                    }

                    img{
                        width: 130px;
                        height : 50px;
                        text-align : center;
                    }

                    .verticalTd{
                        font-weight       : bold;
                        text-align        : center;
                        vertical-align    : middle;
                        width             : 20px;
                        margin            : 0px;
                        padding           : 0px;
                        padding-left      : 3px;
                        padding-right     : 3px;
                        padding-top       : 10px;
                        white-space       : nowrap;
                        -webkit-transform : rotate(-90deg);
                        -moz-transform    : rotate(-90deg);
                    }

                    .title, .title td{
                        font-weight: bold;
                        text-align: center;
                    }

                    .img{
                        text-align: center;
                    }

                    .text-center{
                        text-align:center;
                    }

                </style>
                <table class='tabla'>
                $bodyResul
                </table>
                ";

            // echo $formato;

            // if(isset($TAM)){$HOJA = $TAM;}else{$HOJA = 'LETTER';}
            if(isset($TAM)){$HOJA = $TAM;}else{$HOJA = 'LEGAL';}
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
                // $mpdf-> debug = true;
                // $mpdf->useSubstitutions = true;
                $mpdf->simpleTables = true;
                // $mpdf->packTableData= true;
                $mpdf->SetAutoPageBreak(TRUE, 15);
                $mpdf->SetTitle ( $this->title );
                // $mpdf->SetAuthor ( $_SESSION['NOMBREFUNCIONARIO']." // ".$_SESSION['NOMBREEMPRESA'] );
                $mpdf->SetDisplayMode ( 'fullpage' );
                // $mpdf->SetHeader("");
                // $mpdf->SetHTMLFooter("<div style='width:100%;font-size:14px;'>
                //                         <div style='float:left;width:50%;' >
                //                             Fecha de generacion: ".date("Y-m-d")."
                //                         </div>
                //                         <div style='float:left;width:50%;text-align:right;' >
                //                             Hora de generacion: ".date("H:i:s")."
                //                         </div>
                //                     </div>");
                // $mpdf->SetFooter('Pagina {PAGENO}');

                $mpdf->WriteHTML( $formato );
                // $mpdf->WriteHTML( 'hola' );
                $mpdf->Output($documento.".pdf",'I');

        }


    }

?>