<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Plugins/PHPMailer/src/Exception.php';
require '../Plugins/PHPMailer/src/PHPMailer.php';
require '../Plugins/PHPMailer/src/SMTP.php';
require_once '../PHP/procedimientosBD.php';

/*------------------------------------------------------------------------------------------*/
// Importar Variables (Opcional)
//

$bd = new procedimientosBD();

$mail_tta = $_POST['mail_tta'];
$id = $_POST['id_viaje'];


$datos_oportunidad = $bd->traer_oportunidades_por_id($id);

$datos_comprador =  $bd->info_usuario_profile($datos_oportunidad[0]['ID_COMPRADOR']);
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
$mail->From = 'promouruguay010@gmail.com'; //  Editar
$mail->FromName = 'SalióViaje';  //  Editar
$mail->addAddress('admin@salioviaje.com.uy');  //  Editar
$mail->isHTML(true);
$mail->Subject = "Oops! Una oportunidad Reconfirmada ha sido Rechazada - SalióViaje";    //  Editar
$mail->Body    = '<div class="mail" style="max-width: 600px; background: white;">
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
                    <h1 style="font-family: Montserrat; font-size: 25px; color: rgb(255, 91, 91);">Oportunidad Cancelada</h1>
                    <p style="font-family: Montserrat; font-size: 18px; color: #3844bc"><b>N° Viaje: </b>'.$id.'</p>
                    <div style="background-color: #dfdfdf; width: 500px; margin: 20px auto; text-align: left; font-family: Montserrat; font-size: 13px; border-left: 3px solid #3844bc; padding: 5px 10px; box-sizing: border-box; color: #3844bc;">
                        <p>Lo lamentamos, una oportunidad fue cancelada.</p>
                        <b>El transportista canceló la oportunidad luego de haberla reconfirmado.</b>
                        <p></p>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                        <h1 style="font-size: 20px;">Información del Transportista</h1>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre: </b>'.$datos_oportunidad[0]['NOMBRE'].'</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Apellido: </b>'.$datos_oportunidad[0]['APELLIDO'].'</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:'.$datos_oportunidad[0]['TELEFONO'].'" style="text-decoration: none; color: #3844bc;">'.$datos_oportunidad[0]['TELEFONO'].'</a></p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Correo Electrónico: </b>'.$mail_tta.'</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                        <h1 style="font-size: 20px;">Información del Pasajero</h1>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre: </b>'.$datos_comprador[0]['NOMBRE'].'</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Apellido: </b>'.$datos_comprador[0]['APELLIDO'].'</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:'.$datos_comprador[0]['TELEFONO'].'" style="text-decoration: none; color: #3844bc;">'.$datos_comprador[0]['TELEFONO'].'</a></p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Correo Electrónico: </b>'.$datos_comprador[0]['EMAIL'].'</p>
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

    if(!$mail->send()){
        $returnPAX = "Mailer Error: " . $mail->ErrorInfo;
    }else{
                  
        /* 
        ? -------- MAIL PASAJERO --------
        */


        session_start();
        $mail->clearAddresses();
        $mail->addAddress($datos_comprador[0]['EMAIL']);  //  Editar
        $mail->isHTML(true);
        
        $mail->Subject = "Oportunidad Reconfirmada Rechazada - SalióViaje";    //  Editar
        $mail->Body    = '    <div class="mail" style="max-width: 600px; background: white;">
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
                        <h1 style="font-family: Montserrat; font-size: 25px; color: rgb(255, 91, 91);">Petición Reconfirmada Rechazada</h1>
                            <p style="font-family: Montserrat; font-size: 18px; color: #3844bc"><b>N° Viaje: </b>'.$id.'</p>
                            <div style="background-color: #dfdfdf; width: 500px; margin: 20px auto; text-align: left; font-family: Montserrat; font-size: 13px; border-left: 3px solid #3844bc; padding: 5px 10px; box-sizing: border-box; color: #3844bc;">
                                <p>Lo lamentamos, tu petición fue rechazada por problemas de fuerza mayor.</p>
                                <b>En breve nos comunicaremos con usted para comentarte los motivos.</b>
                                <p></p>
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

            if(!$mail->send()){
                $returnPAX = "Mailer Error: " . $mail->ErrorInfo;
            }else{
                         
                /* 
                ? -------- MAIL TRANSPORTISTA --------
                */


                $mail->clearAddresses();
                $mail->addAddress($mail_tta);
                $mail->isHTML(true);
                
                $mail->Subject = "Rechazaste una Oportunidad - SalióViaje";
                $mail->Body    = '       <div class="mail" style="max-width: 600px; background: white;">
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
                                    <h1 style="font-family: Montserrat; font-size: 25px; color: rgb(255, 91, 91);">Oportunidad Cancelada</h1>
                                    <p style="font-family: Montserrat; font-size: 18px; color: #3844bc"><b>N° Viaje: </b>'.$id.'</p>
                                    <div style="background-color: #dfdfdf; width: 500px; margin: 20px auto; text-align: left; font-family: Montserrat; font-size: 13px; border-left: 3px solid #3844bc; padding: 5px 10px; box-sizing: border-box; color: #3844bc;">
                                        <p>Lo lamentamos, tu oportunidad fue canecelada.</p>
                                        <b>Esto se puede deber a que usted rechazo la oportunidad, o pasaron 10 minutos sin recibir respuesta de la misma.</b>
                                        <p>En breve nos comunicaremos con usted.</p>
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">'.$mail_tta.'</span>.</p>
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
    }