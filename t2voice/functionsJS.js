let send = new llamadas_PHP();
$(document).ready(function () {

    //
    //cuando apreta el boton manda la info
    $("#send_call").on('click', function() {

        send.realizarLlamada("tpc_notificacion_opciones","2022-02-07T15:00:00+03:00","76","098208189","Sol","Prueba 1 SalióViaje.Presione 1 para aceptar, 3 para rechazar");

    });
    $("#watch_call").on('click', function() {
        
        send.estadoLllamda("87");

    });
    $("#send_SMS").on('click', function() {

        send.enviarSMS("092614110","2022-02-04T15:00:00+03:00","Estoy probando","777");
        
    });
    $("#response_SMS").on('click', function() {

        send.verRespuestaSMS("405");
        
    });
    $("#watch_SMS").on('click', function() {

        send.verEstadoSMS("405");
        
    });

});

let mail_tta;


/*
require_once '../PHP/procedimientosBD.php';

                    if(strpos($estado, "Opci\\u00f3n 1") !== false){

                        $bd = new procedimientosBD();
                        $bd->cambio_estado_oportunidad("Aprobada",$id_oportunidad);

                    }else if(strpos($estado, "Opci\\u00f3n 3") !== false){

                        $bd = new procedimientosBD();
                        $bd->cambio_estado_oportunidad("Rechazada",$id_oportunidad);

                    }
*/


function comprar_oportunidad(id){

       console.log("comprada y mando mensaje - ID oportunidad : "+id)

       let id_llamada = Math.floor(Math.random() * 10000000)
       let mensaje = 'Tu oportunidad ha sido comprada! Aceptar: http://SalioViaje/Solicitud/2A  Rechazar: http://SalioViaje/Solicitud/2R';

        $.ajax({
            type: "POST",
            url: "/SalioViaje/PHP/comprar_oportunidad.php",
            data: {opcion:1, ID:id },
            success: function (response) {
                console.log(response)
                response = JSON.parse(response);
                send.realizarLlamada("tpc_notificacion_opciones","2022-02-07T15:00:00+03:00",id_llamada,response['TELEFONO'],response['NOMBRE'],"Su oportunidad numero "+id+" fue comprada. Presione 1 para aceptar, 3 para rechazar",id);
                send.enviarSMS(response['TELEFONO'],"2022-02-04T15:00:00+03:00",mensaje,id_llamada);
            }
        });
}

function mail_TTA(id){
        $.ajax({
            type: "POST",
            url: "/SalioViaje/PHP/comprar_oportunidad.php",
            data: { ID:id },
            success: function (response) {
                response = JSON.parse(response)
                mail_tta=response['MAIL'];
            }
        });
}

function notificar_administradores(){

}

function cambiar_estado_oportunidad(estado,id){
        $.ajax({
            type: "POST",
            url: "/SalioViaje/PHP/comprar_oportunidad.php",
            data: {opcion:2,ESTADO:estado,ID:id },
            success: function (response) {
                console.log(response)
            }
        });
}

function oportunidad_aprobada(id){
            mail_tta = $.ajax({
                        type: 'POST',       
                        url: "/SalioViaje/PHP/comprar_oportunidad.php",
                        data: { opcion:1,ID:id },
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;

        $.ajax({
            type: "POST",
            url: "/SalioViaje/Mail/mail-Oportunidades-Aceptado.php",
            data: { mail_tta:JSON.parse(mail_tta)['MAIL'] },
            success: function (response) {
                cambiar_estado_oportunidad('Aprobada',id)
            }
        });
}

function oportunidad_rechazada(id){
            mail_tta = $.ajax({
                        type: 'POST',       
                        url: "/SalioViaje/PHP/comprar_oportunidad.php",
                        data: { ID:id },
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;

        $.ajax({
            type: "POST",
            url: "/SalioViaje/Mail/mail-Oportunidades-Rechazado.php",
            data: { mail_tta:JSON.parse(mail_tta)['MAIL'] },
            success: function (response) {
                console.log(response)
            }
        });
}
