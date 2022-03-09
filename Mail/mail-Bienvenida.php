<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Plugins/PHPMailer/src/Exception.php';
require '../Plugins/PHPMailer/src/PHPMailer.php';
require '../Plugins/PHPMailer/src/SMTP.php';

/*------------------------------------------------------------------------------------------*/
// Importar Variables (Opcional)
//

$email = $_POST['email'];

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
$mail->Username ='totumdevcontacto@gmail.com';
$mail->Password = 'manuni7817';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->CharSet = 'UTF-8';
// $mail->From = 'sv_info@salioviaje.com.uy'; //  Editar
$mail->From = 'totumdevcontacto@gmail.com'; //  Editar
$mail->FromName = 'SalióViaje';  //  Editar
$mail->addAddress($email);  //  Editar
$mail->isHTML(true);
$mail->Subject = "Suscripción - SalióViaje";    //  Editar

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
                                        <b>¡Bienvenido a <span style="font-size: 15px;">SalióViaje</span>!</b>
                                        <p>Todos los meses te envíaremos novedades y sorpresas para ti.</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                                        <hr style="width: 90%; border: 1px solid #ccc;">
                                        <div style="text-align: center; width: 100%; margin: 20px 0;">
                                            <a style="color: #3844bc; margin: 0 20px; text-decoration: none;" href="https://www.salioviaje.com.uy/Servicios">Servicios</a>
                                            <a style="color: #3844bc; margin: 0 20px; text-decoration: none;" href="https://www.salioviaje.com.uy/Nosotros">Nosotros</a>
                                            <a style="color: #3844bc; margin: 0 20px; text-decoration: none;" href="https://www.salioviaje.com.uy/Oportunidades">Oportunidades</a>
                                        </div>
                                        <hr style="width: 90%; border: 1px solid #ccc;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">'.$email.'.</p>
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
    return 1;

} catch (Exception $e) {

    echo "Mailer Error: " . $mail->ErrorInfo;
    echo 0;
    return 0;
}
