<?php  

include("nusoap/lib/nusoap.php");

$user = 'salioviaje';//usuario notifyMe
$password = 'salio2021';//contra notifyMe

//indico la ruta de ubicacion del WSDL
//$objClienteSOAPCALL = new Soapclient('https://notifyme.t2voice.com/ws/NotifymeWSBean?wsdl');//xmls de llamada
$objClienteSOAPCALL = new Soapclient('https://notifyme.t2voice.com/ws/NotifymeWSBean?wsdl');//xmls de llamada
$objClienteSOAPMSJ = new Soapclient('http://notifyme.t2voice.com/ws/NotifymeSmsWsBean?wsdl');//xmls de SMS

class notifyMeActions {

    //resliza la llamda al cliente
    function callClient($dialago,$dateNhoure,$id,$tel,$name,$msj) {

            // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
            $parameters=array(
                        "usuario"=>$GLOBALS["user"],
                        "password"=>$GLOBALS["password"],
                        "notificacion"=>array(
                            "dialogo"=>$dialago,//tpc_texto_a_voz (no estoy segura)
                            "fecha"=>$dateNhoure,// formato 2022-02-28T15:00:00+03:00 -- https://www.w3.org/TR/xmlschema-2/#dt-value-space
                            "identificadorUnico"=>$id,//identificador de la llamada
                            "telefono"=>$tel,//telefono del cliente
                            "variable"=>array(
                                array(
                                    "nombre"=>"nombre",//nombre variable
                                    "valor"=>$name//nombre del cliente
                                ),
                                array(
                                    "nombre"=>"texto",//nombre variable
                                    "valor"=>$msj//nombre del cliente
                                )
                            )
                        )
                    );

            //invocamos al metodo
            $input = $GLOBALS["objClienteSOAPCALL"]->crearNotificaciones($parameters);

            // muestro el resultado con un formato correcto
            $response = json_encode($input->return);

            echo $response;
    }

    //devuelve el estado de la llamada realizada
    function watchCall($id){

         // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
         $parameters=array(
                    "usuario"=>$GLOBALS["user"],
                    "password"=>$GLOBALS["password"],
                    "identificadorUnico"=>$id//identificador unico de la llamda realizada
                     );

         //invocamos al metodo
         $input = $GLOBALS["objClienteSOAPCALL"]->consultarNotificaciones($parameters);

         // muestro el resultado con un formato correcto
         $response = json_encode($input->return);

         echo $response;//
    }

    //manda mensaje al cliente
    function sendMsj($phone,$schedule,$text,$uniqueId){

        // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
        $parameters=array(
                   "username"=>$GLOBALS["user"],
                   "password"=>$GLOBALS["password"],
                   "messages"=>array(
                        "phone"=>$phone,//telefono del cliente que se le mandara 
                        "schedule"=>$schedule,//fecha que se mandara el SMS
                        "text"=>$text,//texto que se manda aen el SMS
                        "uniqueId"=>$uniqueId,//identificador unico del mensaje
                   )
                );

        //invocamos al metodo
        $input = $GLOBALS["objClienteSOAPMSJ"]->deliverMessages($parameters);

        $response = json_encode($input);

        if($response == "{}"){
            echo "El mensaje se mando correctamente";
        }else{
            echo json_encode($input->return);
        }


    }

    //ver la respuesta del mensaje
    function watchMsjResponse($msjId){
 
         // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
         $parameters=array(
                    "username"=>$GLOBALS["user"],
                    "password"=>$GLOBALS["password"],
                    "messageIds"=>$msjId,//identificador del mensaje enviado
                 );
 
         //invocamos al metodo
         $input = $GLOBALS["objClienteSOAPMSJ"]->getMessagesResponse($parameters);
 
         // muestro el resultado con un formato correcto
         $response = json_encode($input->return);
 
         echo $response;
    }

    //ver el estado del mensaje
    function watchMsjStatus($msjId){
 
         // parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
         $parameters=array(
                    "username"=>$GLOBALS["user"],
                    "password"=>$GLOBALS["password"],
                    "messageIds"=>$msjId,//identificador del mensaje enviado
                 );
 
         //invocamos al metodo
         $input = $GLOBALS["objClienteSOAPMSJ"]->getMessagesStatus($parameters);
 
         // muestro el resultado con un formato correcto
         $response = json_encode($input->return);
 
         echo $response;
    }
}

?>