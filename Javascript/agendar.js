$(document).ready(function () {
    select_vehiculos()
    $('.empty-list').show()
    $('.vehicle').hide()
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
    $("#step_4").hide();

    $('.progress-bar').show();

    $("#button_volver").show();

    $("#descuento1").hide();
    $("#descuento2").hide();

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

            precio_referencia();        
            select_tipo(1);       
            select_tipo(2);       
            break;

        case 3:
            $("#step_3").show();

            $('.progress').css('width', '100%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;

        case 4:
            $("#step_4").show();

            $('.progress-bar').hide();
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;
    }
}

function select_tipo(tipo){
    switch(tipo){
        case 1:
            tipo = $("#tipo-select_1").val();
            if(tipo == 2){
                $("#descuento1").show();
            }else{
                $("#descuento1").hide();
            }
            break;
        case 2:
            tipo = $("#tipo-select_2").val();
            if(tipo == 2){
                $("#descuento2").show();
            }else{
                $("#descuento2").hide();
            }
            break;
    }
}

function precio_referencia(){
    var pasajeros = $("#pasajeros-input").val();
    var distancia = $("#distancia-input").val();

    var referencia;

    if(pasajeros >= 4){
        referencia = distancia * 34;
    }else if(pasajeros >= 6){
        referencia = distancia * 56;
    }else if(pasajeros >= 8){
        referencia = distancia * 66;
    }else if(pasajeros >= 11){
        referencia = distancia * 76;
    }else if(pasajeros >= 15){
        referencia = distancia * 88;
    }else if(pasajeros >= 17){
        referencia = distancia * 90;
    }else if(pasajeros >= 22){
        referencia = distancia * 104;
    }else if(pasajeros >= 28){
        referencia = distancia * 110;
    }else if(pasajeros >= 47){
        referencia = distancia * 120;
    }

    $("#precioref_1").attr('placeholder', referencia);
    $("#precioref_2").attr('placeholder', referencia);
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
        url: "https://www.salioviaje.com.uy/PHP/agregarTag.php",
        data: {NRO_RUTA: count_rutas, NOMBRE_RUTA: ruta},
        success: function (response) {
            $("#tags_1").append(response);
            $("#rutas_1").val("");
        }
    });

    count_rutas++;
    
}

function borrar_ruta(ruta){
    $('#R'+ruta).remove();
}

/*-------------------------------------------------------------------------------------------*/
//                                    Formularios Agendar                                    //
/*-------------------------------------------------------------------------------------------*/
let vehiculos_select
let vehiculo_seleccionado
let datos_etapa_1

//agrego vehiculos al select
function select_vehiculos(){
$.ajax({
    type: "POST",
    url: "/PHP/procedimientosForm.php",
    data: {tipo: "vehiculos"},
    success: function (response) {
        console.log(response)
      vehiculos_select = JSON.parse(response);
      var selectVehiculos = document.getElementById('vehiculos-select');
      $("#vehiculos-select").empty().append($("<option></option>").attr({"value": 0,"selected": true, 'disabled': true, 'hidden': true}).text('Seleccione un vehiculo'));
      for (var i = 0; i < vehiculos_select.length; i++){
        var opt = document.createElement('option');
        opt.value = vehiculos_select[i]["MATRICULA"];
        opt.text = vehiculos_select[i]["MARCA"]+" "+vehiculos_select[i]["MODELO"]+" ("+vehiculos_select[i]["MATRICULA"]+")";
        selectVehiculos.appendChild(opt);
      }
   }
});
}

function actualizar_vista_previa(vehiculo){
    for (var i = 0; i < vehiculos_select.length; i++) {
        if(vehiculos_select[i]['MATRICULA'] == vehiculo){
            $('.empty-list').hide()
            $('.vehicle').show()
            $("#matricula").html('<i class="fas fa-address-card"></i> '+vehiculos_select[i]['MATRICULA'])
            $("#marca").html('<i class="fas fa-car"></i> '+vehiculos_select[i]['MARCA'])
            $("#modelo").html('<i class="fas fa-list"></i> '+vehiculos_select[i]['MODELO'])
            $("#capacidad").html('<i class="fas fa-users"></i> '+vehiculos_select[i]['CAPACIDAD'])
            $("#combustible").html('<i class="fas fa-gas-pump"></i> '+vehiculos_select[i]['COMBUSTIBLE'])
            if (vehiculos_select[i]['CAPACIDAD'] <= 3) { $(".vehicle-icon").html('<i class="fas fa-car"></i>') } else if (vehiculos_select[i]['CAPACIDAD'] > 3 && vehiculos_select[i]['CAPACIDAD'] <= 12) { $(".vehicle-icon").html('<i class="fas fa-shuttle-van"></i>') } else { $(".vehicle-icon").html('<i class="fas fa-bus"></i>') }
            vehiculo_seleccionado = vehiculos_select[i]
        }
    }
}
/*
function etapa_1(){
    datos_etapa_1 = {
        "CANTIDAD_DE_PASAJEROS": document.getElementById().value
    }
}
*/