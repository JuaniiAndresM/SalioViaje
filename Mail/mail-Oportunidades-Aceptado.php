<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Plugins/PHPMailer/src/Exception.php';
require '../Plugins/PHPMailer/src/PHPMailer.php';
require '../Plugins/PHPMailer/src/SMTP.php';

/*------------------------------------------------------------------------------------------*/
// Importar Variables (Opcional)
//

$mail_tta = $_POST['mail_tta'];

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
$mail->From = 'info@salioviaje.com.uy'; //  Editar
$mail->FromName = 'SalióViaje';  //  Editar
$mail->addAddress('admin@salioviaje.com.uy');  //  Editar
$mail->isHTML(true);
$mail->Subject = "Nueva oportunidad vendida";    //  Editar
//ADM
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
                    <h1 style="font-family: Montserrat; font-size: 25px; color: rgb(116, 212, 129);">¡Oportunidad Vendida!</h1>
                    <p style="font-family: Montserrat; font-size: 18px; color: #3844bc"><b>N° Viaje: </b>21</p>
                    <div style="background-color: #dfdfdf; width: 500px; margin: 20px auto; text-align: left; font-family: Montserrat; font-size: 13px; border-left: 3px solid #3844bc; padding: 5px 10px; box-sizing: border-box; color: #3844bc;">
                        <p>¡Felicitaciones! Se vendió una oportunidad.</p>
                        <b>El transportista se pondrá en contácto pronto.</b>
                        <p></p>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                        <h1 style="font-size: 20px;">Información del Transportista</h1>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre: </b>Juan Andrés</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Apellido: </b>Morena</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:098234717" style="text-decoration: none; color: #3844bc;">098234717</a></p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Correo Electrónico: </b>juandres2003@gmail.com</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                        <h1 style="font-size: 20px;">Información del Pasajero</h1>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre: </b>Juan Andrés</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Apellido: </b>Morena</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:098234717" style="text-decoration: none; color: #3844bc;">098234717</a></p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Correo Electrónico: </b>juandres2003@gmail.com</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">thewolfmodzyt@gmail.com</span>.</p>
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

session_start();
$mail->CharSet = 'UTF-8';
$mail->From = 'info@salioviaje.com.uy'; //  Editar
$mail->FromName = 'SalióViaje';  //  Editar
$mail->addAddress($_SESSION['datos_usuario']['MAIL']);  //  Editar
$mail->isHTML(true);
$mail->Subject = "Oportunidad aprobada";    //  Editar
//PAX
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
                    <h1 style="font-family: Montserrat; font-size: 25px; color: rgb(116, 212, 129);">¡Petición Aceptada!</h1>
                    <p style="font-family: Montserrat; font-size: 18px; color: #3844bc"><b>N° Viaje: </b>21</p>
                    <div style="background-color: #dfdfdf; width: 500px; margin: 20px auto; text-align: left; font-family: Montserrat; font-size: 13px; border-left: 3px solid #3844bc; padding: 5px 10px; box-sizing: border-box; color: #3844bc;">
                        <p>¡Felicitaciones! Tu petición fue aceptada.</p>
                        <b>Pongase en contacto con el transportista para coordinar el pago.</b>
                        <p></p>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                        <h1 style="font-size: 20px;">Información del Transportista</h1>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre: </b>Juan Andrés</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Apellido: </b>Morena</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:098234717" style="text-decoration: none; color: #3844bc;">098234717</a></p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Correo Electrónico: </b>juandres2003@gmail.com</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">thewolfmodzyt@gmail.com</span>.</p>
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



$mail->CharSet = 'UTF-8';
$mail->From = 'info@salioviaje.com.uy'; //  Editar
$mail->FromName = 'SalióViaje';  //  Editar
$mail->addAddress($mail_tta);  //  Editar
$mail->isHTML(true);
$mail->Subject = "Oportunidad vendida";    //  Editar
//TTA
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
                    <h1 style="font-family: Montserrat; font-size: 25px; color: rgb(116, 212, 129);">¡Oportunidad Vendida!</h1>
                    <p style="font-family: Montserrat; font-size: 18px; color: #3844bc"><b>N° Viaje: </b>21</p>
                    <div style="background-color: #dfdfdf; width: 500px; margin: 20px auto; text-align: left; font-family: Montserrat; font-size: 13px; border-left: 3px solid #3844bc; padding: 5px 10px; box-sizing: border-box; color: #3844bc;">
                        <p>¡Felicitaciones! Tu oportunidad fue vendida.</p>
                        <b>Pongase en contacto con el pasajero para coordinar el pago.</b>
                        <p></p>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 500px; margin: 20px auto; background: #fff; font-family: Montserrat; color: #3844bc;">
                        <h1 style="font-size: 20px;">Información del Pasajero</h1>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Nombre: </b>Juan Andrés</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Apellido: </b>Morena</p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Teléfono: </b><a href="tel:098234717" style="text-decoration: none; color: #3844bc;">098234717</a></p>
                        <p style="font-size: 14px;"><b style="color: #444; margin-right: 5px;">Correo Electrónico: </b>juandres2003@gmail.com</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="mail-content" style="width: 95%; margin: 20px auto; background: #fff; font-family: Montserrat; color: #555; font-size: 13px;">
                        <p>Este mensaje se envió a <span style="color: #3844bc; font-weight: bold;">thewolfmodzyt@gmail.com</span>.</p>
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