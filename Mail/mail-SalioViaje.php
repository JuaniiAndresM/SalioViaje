<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Plugins/PHPMailer/src/Exception.php';
require '../Plugins/PHPMailer/src/PHPMailer.php';
require '../Plugins/PHPMailer/src/SMTP.php';

require_once '../PHP/procedimientosBD.php';

/*------------------------------------------------------------------------------------------*/
// Importar Variables (Opcional)
//

$TIPO = $_POST['TIPO'];
$DATOS = $_POST['DATA'];



$datos_array = json_decode(stripslashes($DATOS),true);

$id_cotizacion = "1";
$nombre_transportista = "John Doe";


if(isset($_POST['PARADAS_IDA'])){
    $paradas_ida_array = json_decode(stripslashes($_POST['PARADAS_IDA']),true);
}
if(isset($_POST['PARADAS_VUELTA'])){
    $paradas_vuelta_array = json_decode(stripslashes($_POST['PARADAS_VUELTA']),true);
}

if(isset($datos_array['FECHA_SALIDA'])){
    $fecha_salida = date("d-m-Y", strtotime($datos_array['FECHA_SALIDA']));  
}
if(isset($datos_array['FECHA_ARRIBO'])){
    $fecha_arribo = date("d-m-Y", strtotime($datos_array['FECHA_ARRIBO']));  
}
if(isset($datos_array['FECHA_REGRESO'])){
    $fecha_regreso = date("d-m-Y", strtotime($datos_array['FECHA_REGRESO']));  
}
if(isset($datos_array['FECHA_PARTIDA'])){
    $fecha_partida = date("d-m-Y", strtotime($datos_array['FECHA_PARTIDA']));  
}

$TIPO_VIAJE = $TIPO;

date_default_timezone_set('America/Montevideo');

$diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$num_dia = date("N");
$dia = date("j");
$num_mes = date("n");
$year = date("Y");

//
/*------------------------------------------------------------------------------------------*/

$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;
// $mail->IsSMTP();

// $mail->Host = 'mail.salioviaje.com.uy';
// $mail->SMTPAuth = true;
// $mail->Username ='sv_info@salioviaje.com.uy';
// $mail->Password = 'SalioViaje_avisa_para_exito';
// $mail->SMTPSecure = 'ssl';
// $mail->Port = 465;

$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username ='promouruguay010@gmail.com';
$mail->Password = 'El trabajo es la respuesta';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->CharSet = 'UTF-8';
// $mail->From = 'sistema_sv_de_avisos@salioviaje.com.uy';             //  Editar
$mail->From = 'promouruguay010@gmail.com';             //  Editar
$mail->FromName = 'SalióViaje';                    //  Editar
$mail->addAddress('admin@salioviaje.com.uy');       //  Editar
$mail->isHTML(true);
$mail->Subject = "Invitación a cotizar un " . $TIPO_VIAJE . " #" . $id_cotizacion;   //  Editar

$mail->Body    = '  <div class="mail" style="max-width: 600px; background: white;">
                        <table style="width: 100%; background: linear-gradient(120deg, #3844bc, #2b3179); border: none;" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="height: 150px; text-align: center;">
                                    <img src="https://i.imgur.com/iCfeHtM.png" alt="" style="max-width: 100px;" />
                                </td>
                            </tr>
                        </table>
                        <table style="width: 100%; margin: 0;" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="text-align: center;">
                                    <div style="background-color: #dfdfdf; width: 500px; margin: 20px auto; text-align: left; font-family: Montserrat; font-size: 13px; border-left: 3px solid #3844bc; padding: 5px 10px; box-sizing: border-box; color: #3844bc;">
                                        <p>'.$diassemana[$num_dia - 1].' '.$dia.' de '.$meses[$num_mes - 1].' de '.$year.'</p>
                                        <b>Estimado: '.$nombre_transportista.'.</b>
                                        <p>SalióViaje te invita a cotizar el servicio: #'.$id_cotizacion.'</p>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                                        <h1 style="font-size: 20px;">Información del Servicio a Cotizar:</h1>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Tipo de Viaje: </b>'.$TIPO_VIAJE.'</p>';

                                            if($TIPO_VIAJE == "Transfer de Arribo"){
                                                $mail->Body .= '
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha del Arribo: </b>'.$fecha_arribo.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora del Arribo: </b>'.$datos_array["HORA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Número del Vuelo / Barco: </b>'.$datos_array["NRO_VUELO_BARCO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Equipaje: </b>'.$datos_array["EQUIPAJE"].'</p>';
                                            }else if($TIPO_VIAJE == "Transfer de Partida"){
                                                $mail->Body .= '
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha del Partida: </b>'.$fecha_partida.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora para pasar a buscar: </b>'.$datos_array["HORA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Número del Vuelo / Barco: </b>'.$datos_array["NRO_VUELO_BARCO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Equipaje: </b>'.$datos_array["EQUIPAJE"].'</p>';
                                            }else if($TIPO_VIAJE == "Fiesta o Evento - Ida"){
                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Datos de la Ida:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de ida: </b>'.$fecha_salida.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["LOCALIDAD_ORIGEN"].', '.$datos_array["BARRIO_ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino o Punto de Interés: </b>'.$datos_array["BARRIO_DESTINO"].', '.$datos_array["PUNTO_DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>';
                                            }else if($TIPO_VIAJE == "Fiesta o Evento - Vuelta"){
                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Datos de la Vuelta:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen o Punto de Interés: </b>'.$datos_array["BARRIO_ORIGEN"].', '.$datos_array["PUNTO_ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_array["LOCALIDAD_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].', '.$datos_array["DIRECCION_DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>';
                                            }else if($TIPO_VIAJE == "Fiesta o Evento - Ida y Vuelta"){
                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Datos de la Ida:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de ida: </b>'.$fecha_salida.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA_SALIDA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["LOCALIDAD_ORIGEN"].', '.$datos_array["BARRIO_ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino o Punto de Interés: </b>'.$datos_array["BARRIO_DESTINO"].', '.$datos_array["PUNTO_DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>';

                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Datos de la Vuelta:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA_REGRESO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen o Punto de Interés: </b>'.$datos_array["BARRIO_ORIGEN"].', '.$datos_array["PUNTO_ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_array["LOCALIDAD_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].', '.$datos_array["DIRECCION_DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>';
                                            }else{
                                                $mail->Body .= '
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de Salida: </b>'.$fecha_salida.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>';
                                            }

                                            if($TIPO_VIAJE == "Transfer de Arribo"){
                                                $mail->Body .= '
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Aeropuerto / Puerto: </b>'.$datos_array['PUNTO_ORIGEN'].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_array["LOCALIDAD_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].'</p>';
                                            }
                                            if($TIPO_VIAJE == "Transfer de Partida"){
                                                $mail->Body .= '
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array['LOCALIDAD_ORIGEN'].','.$datos_array['BARRIO_ORIGEN'].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Aeropuerto / Puerto: </b>'.$datos_array["PUNTO_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].'</p>';
                                            }
                                            
                                            if($TIPO_VIAJE == "Traslado"){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["LOCALIDAD_ORIGEN"].', '.$datos_array["BARRIO_ORIGEN"].'</p>';
                                            }else if($TIPO_VIAJE == "Tour o Servicio por Hora"){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["LOCALIDAD_TOUR"].', '.$datos_array["BARRIO_TOUR"].'</p>';
                                            }
                                            
                                            if($TIPO_VIAJE == "Tour o Servicio por Hora"){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Ciudad del Servicio: </b>'.$datos_array["CIUDAD"].'</p>';
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Duración del Servicio en horas: </b>'.$datos_array["HORA"].'</p>';
                                            }

                                            if($TIPO_VIAJE == "Traslado"){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino o Punto de Interés: </b>'.$datos_array["LOCALIDAD_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].', '.$datos_array["DIRECCION_DESTINO"].'</p>';
                                            }
                                            
    
                                            if(isset($paradas_ida_array) || isset($paradas_vuelta_array)){    

                                                if(isset($paradas_ida_array)){
                                                    if(count($paradas_ida_array,true) > 0){
                                                        $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Paradas (Ida): </b>';
                                                    
                                                        for($a = 0; $a < count($paradas_ida_array); $a++){
                                                            if($paradas_ida_array[$a] != ""){
                                                                if($a == (count($paradas_ida_array) - 1)){
                                                                    $mail->Body .= $paradas_ida_array[$a] . '.';
                                                                }else{
                                                                    $mail->Body .= $paradas_ida_array[$a] . ', ';
                                                                }
                                                            }
                                                        }
                                                        $mail->Body .= '</p>';
                                                    }
                                                }
    
                                                if(isset($paradas_vuelta_array)){
                                                    if(count($paradas_vuelta_array,true) > 0){
                                                        $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Paradas (Vuelta): </b>';
                                                    
                                                        for($a = 0; $a < count($paradas_vuelta_array); $a++){
                                                            if($paradas_vuelta_array[$a] != ""){
                                                                if($a == (count($paradas_vuelta_array) - 1)){
                                                                    $mail->Body .= $paradas_vuelta_array[$a] . '.';
                                                                }else{
                                                                    $mail->Body .= $paradas_vuelta_array[$a] . ', ';
                                                                }
                                                            }
                                                        }
                                                        $mail->Body .= '</p>';
                                                    }
                                                }
                                            }

                                            if(isset($datos_array['OBSERVACIONES'])){
                                                if($datos_array['OBSERVACIONES'] != ""){
                                                    $mail->Body .= '<h4 style="font-size: 16px; margin-top: 40px;">Observaciones:</h4>
                                                    <p style="font-size: 14px; color: #444;">'.$datos_array['OBSERVACIONES'].'</p>';
                                                }
                                            }
                                            if(isset($datos_array['MASCOTAS'])){
                                                if($datos_array['MASCOTAS'] == "Con mascota"){
                                                    $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Mascotas Admitidas</b>';
                                                }
                                            }

                                        $mail->Body .= '
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="margin: 20px 0; margin-bottom: 30px; text-align: center;">
                                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSeQtd-s1ngnM-F-HbLYHhIOSW1_L0GiUZKoVoiXdnWWV5nsBg/viewform" target="_blank" style="padding: 15px 20px; background-color: #4db979; color: #ffffff; text-decoration: none; font-family: Montserrat; font-size: 15px; border-radius: 10px; margin: 0 50px;">
                                            Cotizar
                                        </a>

                                        <a href="https://www.salioviaje.com.uy" target="_blank" style="padding: 15px 20px; background-color: #ff635a; color: #ffffff; text-decoration: none; font-family: Montserrat; font-size: 15px; border-radius: 10px; margin: 0 50px;">
                                            No Cotizar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">admin@salioviaje.com.uy</span>.</p>
                                        <p>Si no quieres recibir estos emails de SalióViaje en el futuro, puedes darte de baja de la lista de correo.</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                                        <h1 style="font-size: 20px;">Información del Solicitante:</h1>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre del Solicitante: </b>'.$_SESSION['usuario'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:'.$_SESSION['datos_usuario']['TELEFONO'].'">'.$_SESSION['datos_usuario']['TELEFONO'].'</b></p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Mail: </b>'.$_SESSION['datos_usuario']['MAIL'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Domicilio: </b>'.$_SESSION['datos_usuario']['DEPARTAMENTO'].', '.$_SESSION['datos_usuario']['BARRIO'].'.</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="mail-footer" style="width: 100%; display: flex; justify-content: center; align-items: center; flex-direction: column; text-align: center; background: #3844bc;">
                                    <p style="color: #ccc; font-size: 1em; margin: 5px auto; font-family: Montserrat; font-size: 14px;">Copyright © 2022 <b style="font-weight: normal; color: white;">SalióViaje</b>. All Rights Reserved.</p>
                                </div>
                                </td>
                            </tr>
                        </table>
                    </div>';


try {
    $mail->send();
    echo 1;

} catch (Exception $e) {

    echo $mail->ErrorInfo;
}
