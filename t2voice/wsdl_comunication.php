<?php  

include("nusoap/lib/nusoap.php");

//indico la ruta de ubicacion del WSDL
$objClienteSOAP =
new Soapclient('https://notifyme.t2voice.com/ws/NotifymeWSBean?wsdl');

// parametros a pasar al metodo - por ahora estan los predeterminados pero aca irian los que manda el js
$parameters=array(
            "usuario"=>"salioviaje",
            "password"=>"salio2021",
            "dialogo"=>"ws_es_Masculino_Mauricio",
            "fecha"=>"03/02/2022",
            "identificadorUnico"=>"5000024",
            "telefono"=>"099149525",
            "nombre"=>"nombre",
            "valor"=>"Carlos"
            );

//invocamos al metodo
$valor = $objClienteSOAP->crearNotificaciones($parameters);

// muestro el resultado con un formato correcto
$d = json_encode($valor->return);

echo $d;

?>