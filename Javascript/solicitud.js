$(document).ready(function () {
    var ID = $("#id_get").val();
    var ID_Slice = ID.slice(0,-1);
    
        if($("#expired_get").val() == "1"){
            solicitud_response = "E";
        }else{
            solicitud_response = ID.charAt(ID.length-1);
        }

        switch(solicitud_response){
            case "A":
                oportunidad_aprobada(ID_Slice)
                solicitud(1,ID);
                break;
            case "R":
                oportunidad_rechazada(ID_Slice)
                solicitud(2,ID);
                break;
            case "E":
                solicitud(3,ID);
                break;
        }
    
    
});




function solicitud(data, ID){
    var ID_Slice = ID.slice(0,-1);

    switch(data){
        case 1:
            $("#icon").attr('class', 'fas fa-check');
            $("#icon").css('color', 'rgb(116, 212, 129)');

            $("#info_1").text("Aceptado");
            $("#info_1").css('color', 'rgb(116, 212, 129)');

            $("#info_2").text("Viaje N° "+ ID_Slice +" Aceptado.");
            $("#info_3").text("Pronto serás contactado por el pasajero para coordinar el pago del viaje.");
            break;

        case 2:
            $("#icon").attr('class', 'fas fa-times');
            $("#icon").css('color', 'rgb(255, 91, 91)');

            $("#info_1").text("Rechazado");
            $("#info_1").css('color', 'rgb(255, 91, 91)');

            $("#info_2").text("Viaje N° "+ ID_Slice +" Rechazado.");
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