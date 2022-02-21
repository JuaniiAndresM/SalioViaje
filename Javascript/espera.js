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
let esperar_aprobacion = setInterval(function(){ esperandoAprobacion(id_oportunidad) },2000)

function getIdOportunidad(id){
    id_oportunidad = id
}

function esperandoAprobacion(){
    console.log("Esperando estado 'Aprobado' en Oportunidad (id): "+id_oportunidad)

    $.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/comprar_oportunidad.php",
        data: {opcion:3,ID: id_oportunidad},
        success: function (response) {
            response = JSON.parse(response)
            console.log();
            if (response['ESTADO'] == 'Aprobada') { 
                steps(3);
                oportunidad_aprobada(id_oportunidad);
                clearInterval(esperar_aprobacion);
            }
            else if (response['ESTADO'] == 'Rechazada') { 
                steps(4);
                oportunidad_rechazada(id_oportunidad);
                clearInterval(esperar_aprobacion);
            }
        }
    });
}