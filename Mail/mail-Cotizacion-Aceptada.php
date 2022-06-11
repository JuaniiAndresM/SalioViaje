<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Plugins/PHPMailer/src/Exception.php';
require '../Plugins/PHPMailer/src/PHPMailer.php';
require '../Plugins/PHPMailer/src/SMTP.php';
require_once '../PHP/procedimientosBD.php';

/*------------------------------------------------------------------------------------------*/
// ? Importar Variables (Opcional)
//

$bd = new procedimientosBD();

$id = $_POST['id_viaje'];

session_start();


$datos_oportunidad = $bd->traer_oportunidades_por_id($id);

$datos_comprador =  $bd->info_usuario_profile($_SESSION['datos_usuario']['ID']);
$datos_transportista =  $bd->info_usuario_profile($datos_oportunidad[0]['ID_TRANSPORTISTA']);

$fecha = explode(' ', $datos_oportunidad[0]['FECHA']);

$descuento = $datos_oportunidad[0]['DESCUENTO']/100;
$PRECIO_CON_DESCUENTO_APLICADO =  round($datos_oportunidad[0]['PRECIO'] - $datos_oportunidad[0]['PRECIO'] * $descuento);

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
                
/* 
? -------- MAIL TRANSPORTISTA --------
*/


$mail->CharSet = 'UTF-8';
$mail->From = 'promouruguay010@gmail.com';
$mail->FromName = 'SalióViaje';
$mail->addAddress($datos_transportista[0]['EMAIL']);
$mail->isHTML(true);
$mail->Subject = "¡Felicitaciones! Han elegido tu cotización. - SalióViaje";

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
                                        <p>Felicitaciones, un pasajero ha elegido tu cotización!</p>
                                        <b>Tenés 5 minutos para confirmar que podes realizar el viaje o si no será cancelado.</b>
                                        <p>Acordáte, una cotización reconfirmada es un compromiso.</p>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                                        <h1 style="font-size: 20px;">Información del Servicio Cotizado:</h1>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">ID Cotización: </b>'.$ID_COTIZACION.'</p>
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
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS_IDA"].'</p>';
                                            }else if($TIPO_VIAJE == "Fiesta o Evento - Vuelta"){
                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Datos de la Vuelta:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen o Punto de Interés: </b>'.$datos_array["BARRIO_ORIGEN"].', '.$datos_array["PUNTO_ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_array["LOCALIDAD_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].', '.$datos_array["DIRECCION_DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS_VUELTA"].'</p>';
                                            }else if($TIPO_VIAJE == "Fiesta o Evento - Ida y Vuelta"){
                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Datos de la Ida:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de ida: </b>'.$fecha_salida.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA_SALIDA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["LOCALIDAD_ORIGEN"].', '.$datos_array["BARRIO_ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino o Punto de Interés: </b>'.$datos_array["LOCALIDAD_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].', '.$datos_array["DIRECCION_DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS_IDA"].'</p>';

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

                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Datos de la Vuelta:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de vuelta: </b>'.$fecha_regreso.'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA_REGRESO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen o Punto de Interés: </b>'.$datos_array["DIRECCION_ORIGEN_VUELTA"].', '.$datos_array["BARRIO_ORIGEN_VUELTA"].', '.$datos_array["DIRECCION_ORIGEN_VUELTA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_array["LOCALIDAD_DESTINO_VUELTA"].', '.$datos_array["BARRIO_DESTINO_VUELTA"] .'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS_VUELTA"].'</p>';

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
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Duración del Servicio en horas: </b>'.$datos_array["DURACION"].'</p>';
                                            }

                                            if($TIPO_VIAJE == "Traslado"){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino o Punto de Interés: </b>'.$datos_array["LOCALIDAD_DESTINO"].', '.$datos_array["BARRIO_DESTINO"].', '.$datos_array["DIRECCION_DESTINO"].'</p>';
                                            }
                                            
    
                                            if(isset($paradas_ida_array) || isset($paradas_vuelta_array)){
                                                
                                                if($TIPO_VIAJE != "Fiesta o Evento - Ida y Vuelta"){
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
                                    <div style="width: 500px; margin: 20px 0; margin-bottom: 30px; text-align: center;">
                                        <a href="https://www.salioviaje.com.uy/Solicitud_C/'.$datos_cotizacion[0]['ID'].'A" target="_blank" style="padding: 12px 18px; margin: 15px 5px; background-color: #4db979; color: #ffffff; text-decoration: none;
                                        font-family: Montserrat; font-size: 15px; border-radius: 10px;">
                                            Confirmar
                                        </a>

                                        <a href="https://www.salioviaje.com.uy/Solicitud_C/'.$datos_cotizacion[0]['ID'].'R" target="_blank" style="padding: 12px 28px; margin: 15px 5px; background-color: #ff635a; color: #ffffff; text-decoration: none;
                                        font-family: Montserrat; font-size: 15px; border-radius: 10px;">
                                            Rechazar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">'.$datos_transportista[0]['EMAIL'].'</span>.</p>
                                        <p>Si no quieres recibir estos emails de SalióViaje en el futuro, puedes darte de baja de la lista de correo.</p>
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

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo 1;
                        
    /* 
    ? -------- MAIL PASAJERO --------
    */

    $mail->clearAddresses();
    $mail->addAddress($datos_comprador[0]['EMAIL']);
    $mail->isHTML(true);

    $mail->Subject = "¡Gracias por comprar una oportunidad! - SalióViaje";

    $mail->Body = ' <div class="mail" style="max-width: 600px; background: white;">
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
                                        <p>Gracias por comprar una oportunidad!</p>
                                        <b>Aguarde unos minutos a que su solicitud sea aceptada por un transportista.</b>
                                        <p></p>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                                        <h1 style="font-size: 20px;">Información de la Oportunidad</h1>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">ID Oportunidad: </b>#'.$datos_oportunidad[0]['ID'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_oportunidad[0]['ORIGEN'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_oportunidad[0]['DESTINO'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha: </b>'.$fecha[0].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$fecha[1].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Capacidad: </b>'.$datos_oportunidad[0]['CAPACIDAD_VEHICULO'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Precio ('.$datos_oportunidad[0]['DESCUENTO'].'% OFF): </b> <span style="color: #ff635a; text-decoration: line-through; margin-right: 5px;">$'.number_format($datos_oportunidad[0]['PRECIO']).'</span><span style="color: #4db979;">$'.number_format($PRECIO_CON_DESCUENTO_APLICADO).'</span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">'.$datos_comprador[0]['EMAIL'].'</span>.</p>
                                        <p>Si no quieres recibir estos emails de SalióViaje en el futuro, puedes darte de baja de la lista de correo.</p>
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

                    $mail->send();
}
