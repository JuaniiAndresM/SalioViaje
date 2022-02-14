$(document).ready(function () {
    solicitud(1);
});

function solicitud(data){
    switch(data){
        case 1:
            $("#icon").attr('class', 'fas fa-check');
            $("#icon").css('color', 'rgb(116, 212, 129)');

            $("#info_1").text("Aceptado");
            $("#info_1").css('color', 'rgb(116, 212, 129)');

            $("#info_2").text("Viaje N° 21 Aceptado.");
            $("#info_3").text("Pronto serás contactado por el pasajero para coordinar el pago del viaje.");
            break;

        case 2:
            $("#icon").attr('class', 'fas fa-times');
            $("#icon").css('color', 'rgb(255, 91, 91)');

            $("#info_1").text("Rechazado");
            $("#info_1").css('color', 'rgb(255, 91, 91)');

            $("#info_2").text("Viaje N° 21 Rechazado.");
            $("#info_3").text("Pronto nos pondremos en contacto para saber el motivo de tu rechazo.");
            break;

        case 3:
            $("#icon").attr('class', 'far fa-clock');
            $("#icon").css('color', 'rgb(255, 211, 91)');

            $("#info_1").text("Expirado");
            $("#info_1").css('color', 'rgb(255, 211, 91)');

            $("#info_2").text("Este link ha caducado.");
            $("#info_3").text("De ser un error ponte en contacto con los administradores.");
            break;
    }
}