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

session_start();
$id_cot_presentada = $_POST['id'];
$id_viaje = $_POST['id_viaje_cotizado'];
$mail_tta = $_POST['mail'];

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
$mail->addAddress($mail_tta);
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
                                        <p style="font-size: 13px; color: #555;">Han aceptado tu cotizacion para el viaje #'.$id_viaje.'!</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="width: 500px; margin: 20px 0; margin-bottom: 30px; text-align: center;">
                                        <a href="https://www.salioviaje.com.uy/Solicitud_C/'.$id_cot_presentada.'_'.$id_viaje.'A" target="_blank" style="padding: 12px 18px; margin: 15px 5px; background-color: #4db979; color: #ffffff; text-decoration: none;
                                        font-family: Montserrat; font-size: 15px; border-radius: 10px;">
                                            Confirmar
                                        </a>

                                        <a href="https://www.salioviaje.com.uy/Solicitud_C/'.$id_cot_presentada.'_'.$id_viaje.'R" target="_blank" style="padding: 12px 28px; margin: 15px 5px; background-color: #ff635a; color: #ffffff; text-decoration: none;
                                        font-family: Montserrat; font-size: 15px; border-radius: 10px;">
                                            Rechazar
                                        </a>
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

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo 1;
}
