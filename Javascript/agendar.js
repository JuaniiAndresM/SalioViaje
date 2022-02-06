$(document).ready(function () {
    steps(1);
});

var step = 1;
var count_rutas = 1;

function next(){
    step++;
    steps(step);
  }

function volver(){
    //reset_errores();
    step--;
    steps(step);
  }


function steps(step){
    $("#step_1").hide();
    $("#step_2").hide();
    $("#step_3").hide();
    $("#button_volver").show();

    $('.circle1').css('background-color', '#aaa');
    $('.circle2').css('background-color', '#aaa');
    $('.circle3').css('background-color', '#aaa');

    switch(step){
        case 1:
            $("#step_1").show();
            $("#button_volver").hide();
            
            $('.progress').css('width', '0%');
            $('.circle1').css('background-color', '#2b3179');
            break;

        case 2:
            $("#step_2").show();

            $('.progress').css('width', '50%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            
            break;

        case 3:
            $("#step_3").show();

            $('.progress').css('width', '100%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;
    }
}

function select_origen_destino(type){
    switch(type){
        case 1:
            origen = $("#origen_1").val();
            $("#destino_2").val(origen);
            break;

        case 2:
            destino = $("#destino_1").val();
            $("#origen_2").val(destino);
            break;

        case 3:
            origen = $("#origen_2").val();
            $("#destino_1").val(origen);
            break;

        case 4:
            destino = $("#destino_2").val();
            $("#origen_1").val(destino);
            break;
    }   
}

function rutas(){
    ruta = $("#rutas_1").val();

    $.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/agregarTag.php",
        data: {NRO_RUTA: count_rutas, NOMBRE_RUTA: ruta},
        success: function (response) {
            $("#tags_1").append(response);
            $("#rutas_1").val("");
        }
    });

    count_rutas++;
    
}