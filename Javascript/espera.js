$(document).ready(function () {
    steps(1);
    setTimeout(() => {
        steps(2);
    }, 2000);
});





function steps(step){
    $("#step_1").hide();
    $("#step_2").hide();
    $("#step_3").hide();
    $("#step_4").hide();

    switch(step){
        case 1:
            $('.progress-line').css('width', '0%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');
            $("#step_1").show();
            break;

        case 2:
            $('.progress-line').css('width', '50%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');
            $("#step_2").show();
            break;

        case 3:
            $('.progress-line').css('width', '100%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            $("#step_3").show();
            break;

        case 4:
            $('.progress-line').css('width', '100%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            $("#step_4").show();

            $("#aprobado-progress").html('<i class="fas fa-times"></i><br />Petición <br />Rechazada');
            break;

    }

}

let id_oportunidad;
let contador = 0;
let esperar_aprobacion = setInterval(function(){ esperandoAprobacion($("#id_oportunidad").val()) },2000)

function esperandoAprobacion(id_oportunidad){
    console.log("Esperando estado 'Aprobado' en Oportunidad (id): "+id_oportunidad)
    if (contador == 0) {
        setTimeout(() => {
            comprar_oportunidad_function($("#id_oportunidad").val())
        }, 1000);
    }
    contador++;
    $.ajax({
        type: "POST",
        url: "/PHP/comprar_oportunidad.php",
        data: {opcion:3,ID: id_oportunidad},
        success: function (response) {
            console.log(response)
            response = JSON.parse(response)
            
            if (response[0]['ESTADO'] == 'Reconfirmado') { 
                steps(3);
                oportunidad_aprobada(id_oportunidad);
                clearInterval(esperar_aprobacion);

                $("#espera-nombre").html("<b>Nombre:</b> " + response[0]['NOMBRE'] + " " + response[0]['APELLIDO']);
                $("#espera-telefono").html("<b>Teléfono:</b> <a href='tel:0"+ response[0]['TELEFONO'] + "'>0"+ response[0]['TELEFONO'] + "</a>");
            }
            else if (response[0]['ESTADO'] == 'Cancelado') { 
                steps(4);
                oportunidad_rechazada(id_oportunidad);
                clearInterval(esperar_aprobacion);
            }
        }
    });
}