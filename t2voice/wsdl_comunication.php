<?php
require_once '../PHP/procedimientosBD.php';
include "nusoap/lib/nusoap.php";

$user = 'salioviaje'; //usuario notifyMe
$password = 'salio2021'; //contra notifyMe

//indico la ruta de ubicacion del WSDL
$objClienteSOAPCALL = new Soapclient('https://notifyme.t2voice.com/ws/NotifymeWSBean?wsdl'); //xmls de llamada
$objClienteSOAPMSJ = new Soapclient('http://notifyme.t2voice.com/ws/NotifymeSmsWsBean?wsdl'); //xmls de SMS

class notifyMeActions
{

    //resliza la llamda al cliente
    public function callClient($dialago, $dateNhoure, $id, $tel, $name, $msj, $id_viaje, $tipo_viaje, $id_viaje_cotizado)
    {
        // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
        $parameters = array(
            "usuario" => $GLOBALS["user"],
            "password" => $GLOBALS["password"],
            "notificacion" => array(
                "dialogo" => "tpc_notificacion_opciones",
                "fecha" => $dateNhoure, // formato 2022-02-28T15:00:00+03:00 -- https://www.w3.org/TR/xmlschema-2/#dt-value-space
                "identificadorUnico" => $id, //identificador de la llamada
                "telefono" => $tel, //telefono del cliente
                "variable" => array(
                    array(
                        "nombre" => "nombre", //nombre variable
                        "valor" => $name, //nombre del cliente
                    ),
                    array(
                        "nombre" => "texto", //nombre variable
                        "valor" => $msj, //mensaje principal
                    ),
                    array(
                        "nombre" => "opcion1", //nombre variable
                        "valor" => "Gracias por aceptar el viaje", //mensaje cuando presiona 1
                    ),
                    array(
                        "nombre" => "opcion3", //nombre variable
                        "valor" => "Usted ha rechazado el viaje", //pensaje cuando presiona 2
                    ),
                ),
            ),
        );

        //invocamos al metodo
        $input = $GLOBALS["objClienteSOAPCALL"]->crearNotificaciones($parameters);

        // muestro el resultado con un formato correcto
        $response = json_encode($input->return);

        echo $response;

        //se fija que haya realizado la llamada
        if (strpos($response, "OK") !== false) {

            //espera a que termine la llamada
            do {
                $llamarFunction = new notifyMeActions();
                $estado = $llamarFunction->watchCall($id);
            } while (strpos($estado, "Mensaje para...") === false);

            //se fija si el usuario selecciono alguna de las opciones
            if (strpos($estado, "ENTREGADA") !== false) {
                session_start();
                if (strpos($estado, "Opci\\u00f3n 1") !== false) {
                    $bd = new procedimientosBD();
                    if ($tipo_viaje == 0) { 
                        $bd->cambio_estado_oportunidad("Reconfirmado", $id_viaje, $_SESSION['datos_usuario']['ID']);
                    }else{
                        $bd->reconfirmarCotizacion($id_viaje, $id_viaje_cotizado);
                    }

                } elseif (strpos($estado, "Opci\\u00f3n 3") !== false) {
                    $bd = new procedimientosBD();
                    if ($tipo_viaje == 0) {
                        $bd->cambio_estado_oportunidad("Cancelado", $id_viaje, $_SESSION['datos_usuario']['ID']);
                    }else{
                        $bd->rechazarCotizacion($id_viaje, $id_viaje_cotizado);
                    }
                }
            }
        }
    }

    //devuelve el estado de la llamada realizada
    public function watchCall($id)
    {

        // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
        $parameters = array(
            "usuario" => $GLOBALS["user"],
            "password" => $GLOBALS["password"],
            "identificadorUnico" => $id, //identificador unico de la llamda realizada
        );

        //invocamos al metodo
        $input = $GLOBALS["objClienteSOAPCALL"]->consultarNotificaciones($parameters);

        // muestro el resultado con un formato correcto
        $response = json_encode($input->return);

        return $response;
    }

    //manda mensaje al cliente
    public function sendMsj($phone, $schedule, $text, $uniqueId)
    {

        // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
        $parameters = array(
            "username" => $GLOBALS["user"],
            "password" => $GLOBALS["password"],
            "messages" => array(
                "phone" => $phone, //telefono del cliente que se le mandara
                "schedule" => $schedule, //fecha que se mandara el SMS
                "text" => $text, //texto que se manda aen el SMS
                "uniqueId" => $uniqueId, //identificador unico del mensaje
            ),
        );

        //invocamos al metodo
        $input = $GLOBALS["objClienteSOAPMSJ"]->deliverMessages($parameters);

        $response = json_encode($input);

        if ($response == "{}") {
            echo "El mensaje se mando correctamente";
        } else {
            echo json_encode($input->return);
        }

    }

    //ver la respuesta del mensaje
    public function watchMsjResponse($msjId)
    {

        // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
        $parameters = array(
            "username" => $GLOBALS["user"],
            "password" => $GLOBALS["password"],
            "messageIds" => $msjId, //identificador del mensaje enviado
        );

        //invocamos al metodo
        $input = $GLOBALS["objClienteSOAPMSJ"]->getMessagesResponse($parameters);

        // muestro el resultado con un formato correcto
        $response = json_encode($input->return);

        echo $response;
    }

    //ver el estado del mensaje
    public function watchMsjStatus($msjId)
    {

        // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
        $parameters = array(
            "username" => $GLOBALS["user"],
            "password" => $GLOBALS["password"],
            "messageIds" => $msjId, //identificador del mensaje enviado
        );

        //invocamos al metodo
        $input = $GLOBALS["objClienteSOAPMSJ"]->getMessagesStatus($parameters);

        // muestro el resultado con un formato correcto
        $response = json_encode($input->return);

        echo $response;
    }
}
