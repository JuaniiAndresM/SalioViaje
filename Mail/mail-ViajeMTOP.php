<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Plugins/PHPMailer/src/Exception.php';
require '../Plugins/PHPMailer/src/PHPMailer.php';
require '../Plugins/PHPMailer/src/SMTP.php';
require_once '../PHP/procedimientosBD.php';

/*------------------------------------------------------------------------------------------*/
// ? Importar Variables (Opcional)

$BD = new procedimientosBD();

$DATOS = json_decode($_POST['datos_viaje'], true);

$fecha_salida = explode("T", $DATOS['FECHA_SALIDA']);
$fecha_llegada = explode("T", $DATOS['FECHA_LLEGADA']);

$ORIGEN = explode(", ", $DATOS['ORIGEN_TRAMO_1']);
$DESTINO = explode(", ", $DATOS['DESTINO_TRAMO_1']);

$ORIGEN[1] = substr($ORIGEN[1], 0, -1);
$DESTINO[1] = substr($DESTINO[1], 0, -1);


$CODIGOS_MTOP_ORIGEN = json_decode($BD->obtener_codigos_localidad_mtop($ORIGEN[0], $ORIGEN[1]), true);

$CODIGOS_MTOP_DESTINO = json_decode($BD->obtener_codigos_localidad_mtop($DESTINO[0], $DESTINO[1]), true);

echo json_encode($CODIGOS_MTOP_DESTINO);

echo json_encode($CODIGOS_MTOP_ORIGEN);

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
? -------- MAIL ADMINISTRADOR --------
*/


$mail->CharSet = 'UTF-8';
$mail->From = 'promouruguay010@gmail.com';
$mail->FromName = 'SalióViaje';
$mail->addAddress('admin@salioviaje.com.uy');
$mail->isHTML(true);
$mail->Subject = "¡Han agendado un nuevo viaje con MTOP! - SalióViaje";

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
                                        <b>'.$datos_transportista['NOMBRE'].' '.$datos_transportista['APELLIDO'].' ha agendado un nuevo viaje con MTOP.</b>
                                        <p>Aquí te mostramos la información del mismo.</p>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                                        <h1 style="font-size: 20px;">Información de la Oportunidad</h1>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">ID Viaje: </b>#'.$DATOS['ID'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">N° Usuario MTOP: </b>'.$DATOS['NRO_MTOP'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Contraseña MTOP: </b>'.$DATOS['PASS_MTOP'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Origen: </b>7 - URUGUAY, '.$CODIGOS_MTOP_ORIGEN['CODIGO_DEPARTAMENTO'].' - '.$ORIGEN[1].', '.$CODIGOS_MTOP_ORIGEN['CODIGO_LOCALIDAD'].' - '.$ORIGEN[0].'.</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Destino: </b> 7 - URUGUAY, '.$CODIGOS_MTOP_DESTINO['CODIGO_DEPARTAMENTO'].' - '.$DESTINO[1].', '.$CODIGOS_MTOP_DESTINO['CODIGO_LOCALIDAD'].' - '.$DESTINO[0].'.</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Kilometros: </b>'.$DATOS['DISTANCIA'].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de Salida: </b>'.$fecha_salida[0].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora de Salida: </b>'.$fecha_salida[1].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Fecha de Llegada: </b>'.$fecha_llegada[0].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Hora de Llegada: </b>'.$fecha_llegada[1].'</p>
                                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Matrícula: </b>'.$DATOS['MATRICULA'].'</p>';

                                        if(isset($rutas_viajeMTOP)){
                                            if(count($rutas_viajeMTOP,true) > 0){
                                                $mail->Body .= '<p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Rutas: </b>';
                                            
                                                for($a = 0; $a < count($rutas_viajeMTOP); $a++){
                                                    if($rutas_viajeMTOP[$a] != ""){
                                                        if($a == (count($rutas_viajeMTOP) - 1)){
                                                            $mail->Body .= $rutas_viajeMTOP[$a] . '.';
                                                        }else{
                                                            $mail->Body .= $rutas_viajeMTOP[$a] . ', ';
                                                        }
                                                    }
                                                }
                                                $mail->Body .= '</p>';
                                            }
                                        }

                                    $mail->Body .= '</div>
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

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo 1;
}

