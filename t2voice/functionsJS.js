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

function comprar_oportunidad(id){

       console.log("comprada y mando mensaje - ID oportunidad : "+id)

       let mensaje = 'Tu oportunidad ha sido comprada!!! \n Entra en este link para aceptarlo: ';

        $.ajax({
            type: "POST",
            url: "/SalioViaje/PHP/comprar_oportunidad.php",
            data: { ID:id },
            success: function (response) {
                response = JSON.parse(response)
                console.log(response)
                console.log(send.realizarLlamada("tpc_notificacion_opciones","2022-02-07T15:00:00+03:00",'4332664',response['TELEFONO'],response['NOMBRE'],"Prueba 1 SalióViaje.Presione 1 para aceptar, 3 para rechazar",response['ID_OPORTUNIDAD']));
                send.enviarSMS(response['TELEFONO'],"2022-02-04T15:00:00+03:00",mensaje,"7778");
            }
        });
}

function notificar_administradores(){

}

function cambiar_estado_oportunidad(estado){
        $.ajax({
            type: "POST",
            url: "/SalioViaje/PHP/comprar_oportunidad.php",
            data: { ID:id },
            success: function (response) {
                console.log(response)
            }
        });
}