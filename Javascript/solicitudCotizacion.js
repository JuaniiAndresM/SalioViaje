$(document).ready(function () {
    var ID = $("#id_get").val();
    let Datos = ID.split("_");
    var ID_Slice = Datos[1].slice(0,-1);
    
        console.log("Expired: " + $("#expired_get").val()) 

        if($("#expired_get").val() == "1"){
             solicitud_response = "E";
        }else{
             solicitud_response = Datos[1].charAt(Datos[1].length-1);
        }

        switch(solicitud_response){
            case "A":
                cotizacion_aprobada(Datos[0],ID_Slice)
                solicitud(1,ID_Slice);
                break;
            case "R":
                cotizacion_rechazada(Datos[0],ID_Slice)
                solicitud(2,ID_Slice);
                break;
            case "E":
                solicitud(3,ID_Slice);
                break;
        }
    
    
});




function solicitud(data, ID){

    switch(data){
        case 1:
            $("#icon").attr('class', 'fas fa-check');
            $("#icon").css('color', 'rgb(116, 212, 129)');

            $("#info_1").text("Aceptada");
            $("#info_1").css('color', 'rgb(116, 212, 129)');

            $("#info_2").text("Cotización N° "+ ID +" Aceptada.");
            $("#info_3").text("Pronto serás contactado por el pasajero para coordinar el pago del viaje.");
            break;

        case 2:
            $("#icon").attr('class', 'fas fa-times');
            $("#icon").css('color', 'rgb(255, 91, 91)');

            $("#info_1").text("Rechazada");
            $("#info_1").css('color', 'rgb(255, 91, 91)');

            $("#info_2").text("Cotización N° "+ ID +" Rechazada.");
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

function cotizacion_aprobada(id,id_viaje) {
    console.log("[APROBADA] ID ~ "+ id + " Viaje ~ "+ id_viaje)
    $.ajax({
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: { tipo: 'reconfirmar_cotizacion', id: id, id_viaje: id_viaje},
        success: function (response) {
           console.log(response)
        }
     });
}

function cotizacion_rechazada(id,id_viaje) {
    console.log("[RECHAZADA] ID ~ "+ id + " Viaje ~ "+ id_viaje)
    $.ajax({
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: { tipo: 'rechazar_cotizacion', id: id , id_viaje: id_viaje},
        success: function (response) {
           console.log(response)
        }
     });
}