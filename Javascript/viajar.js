$(document).ready(function () {
    steps(1);
});

var step = 1;

function next(){
    step++;
    steps(step);
}

function volver(){
    step--;
    steps(step);
}

function steps(step){
    $(".step_1").hide();
    $(".step_2_traslado").hide();
    $(".step_2_tour").hide();
    $(".step_2_transfer").hide();
    $(".step_2_fiestas").hide();
    $(".step_3").hide();
    $(".step_4").hide();

    console.log(step);

    switch(step){
        case 1:
            $(".step_1").show();

            $('.progress').css('width', '0%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 2:

            viaje = $("#select_users").val();
            switch(viaje){
                case "1":
                    $(".step_2_traslado").show();
                    break;

                case "2":
                    $(".step_2_tour").show();
                    break;

                case "3":
                    $(".step_2_transfer").show();
                    break;

                case "4":
                    $(".step_2_fiestas").show();
                    break;
            }
            

            $('.progress').css('width', '50%');
            
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 3:
            $(".step_3").show();

            $('.progress').css('width', '100%');
            
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;

        case 4:
            $(".step_4").show();
            $(".progress-bar").hide();
            break;
    }
}

function nueva_cotizacion(){
    step = 1;
    steps(step);
}

function select_usuario(){
    viaje = $("#select_users").val();

    if(viaje !== null){
        step++;
        steps(step);
    }
}

function desplegar(button){
    button.classList.toggle("active");
    button.nextElementSibling.classList.toggle("show");
}

let array_paradas = new Array();
var count_paradas = 0;

function paradas(){
    parada = $("#paradas_1").val();
    array_paradas[count_paradas] = parada

    $.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/Tablas/agregarParada.php",
        data: {NRO_PARADA: count_paradas, NOMBRE_PARADA: parada},
        success: function (response) {
            $("#tags_paradas").append(response);
            $("#paradas_1").val("");
        }
    });

    count_paradas++
    console.log(array_paradas);
}

function borrar_parada(parada){
    delete array_paradas[parada]
    $('#R'+parada).remove();
    console.log(array_paradas)
}