let send = new llamadas_PHP();
$(document).ready(function () {
    //
    //cuando apreta el boton manda la info
    $("#send_call").on('click', function() {

        id = Math.floor(Math.random() * 200);
        //send.realizarLlamada("tpc_notificacion_opciones","2022-02-07T15:00:00+03:00",id,"091446483","Sol","Prueba 1 SalióViaje.Presione 1 para aceptar, 3 para rechazar");

    });
    $("#watch_call").on('click', function() {
        
        send.estadoLllamda("87");

    });
    $("#send_SMS").on('click', function() {
        id = Math.floor(Math.random() * 200);
        send.enviarSMS("091446483","2022-02-04T15:00:00+03:00","Estoy probando",id);
        
    });
    $("#response_SMS").on('click', function() {

        send.verRespuestaSMS("405");
        
    });
    $("#watch_SMS").on('click', function() {

        send.verEstadoSMS("405");
        
    });

});

let mail_tta;

function comprar_oportunidad_function(id){

       let id_llamada = Math.floor(Math.random() * 100000);
       let mensaje = `Tu oportunidad ha sido comprada!  Aceptar:  https://www.salioviaje.com.uy/Solicitud/${id}A Rechazar: https://www.salioviaje.com.uy/Solicitud/${id}R`;

        $.ajax({
            type: "POST",
            url: "/PHP/comprar_oportunidad.php",
            data: {opcion:1, ID:id },
            success: function (response) {
                response = JSON.parse(response);
                send.realizarLlamada("tpc_notificacion_opciones","2022-02-07T15:00:00+03:00",id_llamada,response['TELEFONO'],response['NOMBRE'],"Su oportunidad numero "+id+" fue comprada. Presione 1 para aceptar, 3 para rechazar",id);
                send.enviarSMS(response['TELEFONO'],"2022-02-04T15:00:00+03:00",mensaje,id_llamada);
                mail_aprobar_rechazar(id)
            }
        });
}

function mail_TTA(id){
        $.ajax({
            type: "POST",
            url: "/PHP/comprar_oportunidad.php",
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
            url: "/PHP/comprar_oportunidad.php",
            data: {opcion:2,ESTADO:estado,ID:id },
            success: function (response) {
                console.log(response)
            }
        });
}

function oportunidad_aprobada(id){
            let mail_tta = $.ajax({
                        type: 'POST',       
                        url: "/PHP/comprar_oportunidad.php",
                        data: { opcion:1,ID:id },
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;
                    
            $.ajax({
                type: "POST",
                url: "/Mail/mail-Oportunidades-Aceptado.php",
                data: { mail_tta:JSON.parse(mail_tta)['MAIL'], id_viaje: id},
                success: function (response) {
                    cambiar_estado_oportunidad('Reconfirmado',id)
                }
            });
}

function oportunidad_rechazada(id){
            let mail_tta = $.ajax({
                        type: 'POST',     
                        url: "/PHP/comprar_oportunidad.php",
                        data: { opcion:1,ID:id },
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;

        $.ajax({
            type: "POST",
            url: "/Mail/mail-Oportunidades-Rechazado.php",
            data: { mail_tta:JSON.parse(mail_tta)['MAIL'], id_viaje: id },
            success: function (response) {
                console.log(response);
                cambiar_estado_oportunidad('Cancelado',id)
            }
        });
}


function mail_aprobar_rechazar(id) {
    $.ajax({
        type: "POST",
        url: "/Mail/mail-Oportunidad-Comprada.php",
        data: { id_viaje: id },
        success: function (response) {
            console.log(response);
        }
    });
}

