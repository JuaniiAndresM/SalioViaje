<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Plugins/PHPMailer/src/Exception.php';
require '../Plugins/PHPMailer/src/PHPMailer.php';
require '../Plugins/PHPMailer/src/SMTP.php';

/*------------------------------------------------------------------------------------------*/
// Importar Variables (Opcional)
//

$TIPO = $_POST['TIPO'];
$DATOS = $_POST['DATA'];



if(isset($_POST['PARADAS_IDA'])){
    $PARADAS_IDA = $_POST['PARADAS_IDA'];

    $paradas_ida_array = json_decode($PARADAS_IDA, true);
}
if(isset($_POST['PARADAS_VUELTA'])){
    $PARADAS_VUELTA = $_POST['PARADAS_VUELTA'];

    $paradas_vuelta_array = json_decode($PARADAS_VUELTA, true);
}


$datos_array = json_decode(stripslashes($DATOS),true);

$paradas_array = json_decode($PARADAS_IDA,true);

$TIPO_VIAJE = "";

switch($TIPO){
    case 1:
        $TIPO_VIAJE = "Traslado";
        break;

    case 2:
        $TIPO_VIAJE = "Tour";
        break;

    case 3:
        $TIPO_VIAJE = "Transfer";
        break;

    case 4:
        $TIPO_VIAJE = "Fiesta o Evento";
        break;
}

//
/*------------------------------------------------------------------------------------------*/

$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;
$mail->IsSMTP();
$mail->Host = 'mail.salioviaje.com.uy';
$mail->SMTPAuth = true;
$mail->Username ='info@salioviaje.com.uy';
$mail->Password = 'SalioViaje_info';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->CharSet = 'UTF-8';
$mail->From = 'info@salioviaje.com.uy';             //  Editar
$mail->FromName = 'SalióViaje';                     //  Editar
$mail->addAddress('thewolfmodzyt@gmail.com');       //  Editar
$mail->isHTML(true);
$mail->Subject = "Nueva Solicitud de Cotización - SalióViaje";   //  Editar

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
                                        <p>¡Felicitaciones!</p>
                                        <b>Recibiste una nueva solicitud de cotización.</b>
                                        <p></p>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                                        <h1 style="font-size: 20px;">Información de la Solicitud</h1>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Tipo de Viaje: </b>'.$TIPO_VIAJE.'</p>';

                                        if($TIPO == 3){
                                            $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Transfer: </b>'.$datos_array["TIPO_TRANSFER"].'</p>';
                                        }else if($TIPO == 4){
                                            $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Tramos: </b>'.$datos_array["TRAMOS_FIESTA"].'</p>';
                                        }

                                        if($TIPO == 4){
                                            if($datos_array["TRAMOS_FIESTA"] == "Solo Ida" || $datos_array["TRAMOS_FIESTA"] == "Ida y Vuelta"){
                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Información Ida:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de Salida: </b>'.$datos_array["FECHA_SALIDA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino o Punto de Interés: </b>'.$datos_array["DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS_IDA"].'</p>';
                                            }
                                            if($datos_array["TRAMOS_FIESTA"] == "Solo Vuelta" || $datos_array["TRAMOS_FIESTA"] == "Ida y Vuelta"){
                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Información Vuelta:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de Regreso: </b>'.$datos_array["FECHA_REGRESO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA"].'</p>
        
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen o Punto de Interés: </b>'.$datos_array["ORIGEN"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_array["DESTINO"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS_VUELTA"].'</p>';
                                            }
                                        }else{
                                            if($TIPO == 3){
                                                if($datos_array["TIPO_TRANSFER"] == "Out"){
                                                    $mail->Body .= '<h4 style="font-size: 16px; margin-top: 40px;">Información Vuelta:</h4>';
                                                }else{
                                                    $mail->Body .= '<h4 style="font-size: 16px; margin-top: 40px;">Información Ida:</h4>';
                                                }
                                            }else{

                                                $mail->Body .= '
                                                <h4 style="font-size: 16px; margin-top: 40px;">Información Ida:</h4>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de Salida: </b>'.$datos_array["FECHA_SALIDA"].'</p>
                                                <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora: </b>'.$datos_array["HORA"].'</p>';
                                            
                                            }
    
                                            if($TIPO == 3){
                                                if($datos_array["TIPO_TRANSFER"] == "In"){

                                                    $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["ORIGEN"].'</p>';
                                                    $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Aeropuero o Puerto: </b>'.$datos_array["AEROPUERTO"].'</p>';
                                                
                                                }else if($datos_array["TIPO_TRANSFER"] == "Out"){

                                                    $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Aeropuero o Puerto: </b>'.$datos_array["AEROPUERTO"].'</p>';
                                                    $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b>'.$datos_array["DESTINO"].'</p>';
                                                
                                                }
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Equipaje: </b>'.$datos_array["EQUIPAJE"].'</p>';
                                            }else{
                                                
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>'.$datos_array["ORIGEN"].'</p>';
                                                if($TIPO != 2){
                                                    $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino o Punto de Interés: </b>'.$datos_array["DESTINO"].'</p>';
                                                }
                                                                
                                            }
    
                                            if($TIPO == 2){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Ciudad: </b>'.$datos_array["CIUDAD"].'</p>';
                                            }
    
                                            $mail->Body .= '
                                            <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Cantidad de Pasajeros: </b>'.$datos_array["CANTIDAD_PASAJEROS"].'</p>';
    
                                            if($TIPO == 2){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Duración: </b>'.$datos_array["DURACION"].' horas</p>';
                                            }
                                        }

                                        if(isset($PARADAS_IDA) || isset($PARADAS_VUELTA) ){

                                            $mail->Body .= '
                                            <h4 style="font-size: 16px; margin-top: 40px;">Información Paradas:</h4>';

                                            if(isset($paradas_ida_array)){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Paradas (Ida): </b>';
                                                
                                                for($a = 0; $a < count($paradas_ida_array); $a++){

                                                    if($a == (count($paradas_ida_array) - 1)){
                                                        $mail->Body .= $paradas_ida_array[$a];
                                                    }else{
                                                        $mail->Body .= $paradas_ida_array[$a] . ' - ';
                                                    }
                                                }
                                                $mail->Body .= '</p>';
                                                
                                            }
                                            if(isset($paradas_vuelta_array)){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Paradas (Vuelta): </b>';
                                                
                                                for($a = 0; $a < count($paradas_vuelta_array); $a++){

                                                    if($a == (count($paradas_vuelta_array) - 1) ){
                                                        $mail->Body .= $paradas_vuelta_array[$a];
                                                    }else{
                                                        $mail->Body .= $paradas_vuelta_array[$a] . ' - ';
                                                    }

                                                    
                                                }
                                                $mail->Body .= '</p>';
                                            }
                                        }
                                        $mail->Body .= '
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                                        <h1 style="font-size: 20px;">Información del Pasajero</h1>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre: </b>'.$_SESSION['usuario'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:'.$_SESSION['datos_usuario']['TELEFONO'].'" style="text-decoration: none; color: #3844bc;">'.$_SESSION['datos_usuario']['TELEFONO'].'</a></p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Correo Electrónico: </b>'.$_SESSION['datos_usuario']['MAIL'].'</p>
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

    echo "Mailer Error: " . $mail->ErrorInfo;
}
