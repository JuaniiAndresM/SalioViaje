$(document).ready(function () {
    let send = new llamadas_PHP();

    //cuando apreta el boton manda la info
    $("#send_call").on('click', function() {

        send.realizarLlamada("tpc_notificacion_opciones","2022-02-07T15:00:00+03:00","89","098208189","Sol","Prueba 1 SalióViaje.");

    });
    $("#watch_call").on('click', function() {
        
        send.estadoLllamda("444");

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