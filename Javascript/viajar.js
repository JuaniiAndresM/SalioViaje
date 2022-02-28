$(document).ready(function () {
    steps(1);
    select_fiesta();
    select_transfer();

    $('.mensaje-error').hide();

});

var step = 1;

let datos_traslado;
let datos_tour;
let datos_transfer_in;
let datos_transfer_out;
let datos_fiestaseventos_ida;
let datos_fiestaseventos_vuelta;
let datos_fiestaseventos_idavuelta;

let array_paradas_2 = new Array();
var count_paradas_2 = 0;

let array_paradas_1 = new Array();
var count_paradas_1 = 0;

function next(){
    step++;
    steps(step);
}

function finalizar(enviar_solicitud){
    tipo = $('#select_users').val();
        switch(tipo){
        /* 
        Traslado        
        */
        case "1":
            datos_traslado = {
                "FECHA_SALIDA": $('#fecha_salida').val(),
                "ORIGEN": $('#origen_traslado').val(),
                "CANTIDAD_PASAJEROS": $('#cant_pasajeros').val(),
                "HORA": $('#hora').val(),
                "DESTINO": $('#destino_traslado').val(),
                "OBSERVACIONES": $('#observaciones_traslado').val()
            };

            if (validacion('Translado',datos_traslado)) {
                next();
                if (enviar_solicitud == 1) {
                $.ajax({
                    type: "POST",
                    url: "/SalioViaje/Mail/mail-SalioViaje.php",
                    data: {TIPO: tipo, DATA: JSON.stringify(datos_traslado)},
                    success: function(response){
                        console.log("se ejecuta")
                    },
                    complete: function (response) {
                        if(response == 1){
                            step++;
                            steps(step);
                        }else{
                            console.log(response);
                        }         
                    }
                });
                }
            } else { console.log("No valido") }

            break;

        /* 
        Tour        
        */
        case "2":
            datos_tour = {
                "FECHA_SALIDA": $('#fecha_salida_tour').val(),
                "ORIGEN": $('#origen_tour').val(),
                "CANTIDAD_PASAJEROS": $('#cant_pasajeros_tour').val(),
                "HORA": $('#hora_tour').val(),
                "CIUDAD": $('#destino_tour').val(),
                "DURACION": $('#duracion_tour').val(),
                "OBSERVACIONES": $('#observaciones_tour').val()
            };

            if (validacion('Tour',datos_tour)) {

                next();
                
                if (enviar_solicitud == 1) {
                $.ajax({
                    type: "POST",
                    url: "/SalioViaje/Mail/mail-SalioViaje.php",
                    data: {TIPO: tipo, DATA: JSON.stringify(datos_tour)},
                    success: function(response){

                    },
                    complete: function (response) {
                        if(response == 1){
                            step++;
                            steps(step);
                        }else{
                            console.log(response);
                        }         
                    }
                });
                }

            }else{
                console.log("No valido"); 
            }

            break;

        /* 
        Transfer        
        */
        case "3":
            var tipo_transfer = $('#select_transfer').val();
            var transfer;

            switch(tipo_transfer){
                case "1":
                    transfer = "In";
                    datos_transfer_in = {
                        "TIPO_TRANSFER": transfer,
                        "FECHA_SALIDA": $('#fecha_regreso_transfer_in').val(),
                        "CANTIDAD_PASAJEROS": $('#cant_pasajeros_transfer_in').val(),
                        "HORA": $('#hora_transfer_in').val(),
                        "DESTINO": $('#destino_transfer_in').val(),
                        "AEROPUERTO": $('#aeropuerto_transfer_in').val(),
                        "EQUIPAJE": $('#equipaje_transfer_in').val(),
                        "OBSERVACIONES": $('#observaciones_transfer_in').val(),
                        "NUMERO_VUELO_BARCO_IN": $('#nro_vuelo_barco_in').val()
                    };
                    
                    if (validacion('Transfer_in',datos_transfer_in)) {
                        
                        next();
                        if (enviar_solicitud == 1) {
                            $.ajax({
                                type: "POST",
                                url: "/SalioViaje/Mail/mail-SalioViaje.php",
                                data: {TIPO: tipo, DATA: JSON.stringify(datos_transfer_in)},
                                success: function(response){

                                },
                                complete: function (response) {
                                    if(response == 1){
                                        step++;
                                        steps(step);
                                    }else{
                                        console.log(response);
                                    }       
                                }
                            });
                        }
                    }else{
                        console.log("No valido");
                    }

                    break;
                    
                case "2":
                    transfer = "Out";
                    datos_transfer_out = {
                        "TIPO_TRANSFER": transfer,
                        "FECHA_REGRESO": $('#fecha_salida_transfer_out').val(),
                        "CANTIDAD_PASAJEROS": $('#cant_pasajeros_transfer_out').val(),
                        "HORA": $('#hora_transfer_out').val(),
                        "AEROPUERTO": $('#aeropuerto_transfer_out').val(),
                        "ORIGEN": $('#origen_transfer_out').val(),
                        "EQUIPAJE": $('#equipaje_transfer_out').val(),
                        "OBSERVACIONES": $('#observaciones_transfer_out').val(),
                        "NUMERO_VUELO_BARCO_OUT": $('#nro_vuelo_barco_out').val()
                    };

                    if (validacion('Transfer_out',datos_transfer_out)) {

                        next();
                        if (enviar_solicitud == 1) {
                            $.ajax({
                                type: "POST",
                                url: "/SalioViaje/Mail/mail-SalioViaje.php",
                                data: {TIPO: tipo, DATA: JSON.stringify(datos_transfer_out)},
                                success: function(response){

                                },
                                complete: function (response) {
                                    if(response == 1){
                                        step++;
                                        steps(step);
                                    }else{
                                        console.log(response);
                                    }         
                                }
                            });
                        }
                    }else{
                        console.log("No valido");
                    }
                    break;
            }
            break;

        /* 
        Fiestas y Eventos        
        */
        case "4":
            var tramos = $('#select_fiesta').val();
            var fiestas;

            switch(tramos){
                case "1":
                    fiestas = "Solo Ida";
                    datos_fiestaseventos_ida = {
                        "TRAMOS_FIESTA": fiestas,
                        "FECHA_SALIDA": $('#fecha_salida_fiestas_ida').val(),
                        "ORIGEN": $('#origen_fiestas_ida').val(),
                        "CANTIDAD_PASAJEROS_IDA": $('#cant_pasajeros_fiesta_ida').val(),
                        "HORA": $('#hora_fiesta_ida').val(),
                        "DESTINO": $('#destino_fiesta_ida').val(),
                        "OBSERVACIONES": $('#observaciones_fiesta_ida').val()
                    };
         
                    if (validacion('FIESTA-IDA',datos_fiestaseventos_ida)) {

                            next();
                            if (enviar_solicitud == 1) {
                                $.ajax({
                                    type: "POST",
                                    url: "/SalioViaje/Mail/mail-SalioViaje.php",
                                    data: {TIPO: tipo, DATA: JSON.stringify(datos_fiestaseventos_ida)},
                                    success: function(response){

                                    },
                                    complete: function (response) {
                                        if(response == 1){
                                            step++;
                                            steps(step);
                                        }else{
                                            console.log(response);
                                        }         
                                    }
                                });
                            }

                    }else{
                        console.log("No valido")
                    }

                    break;
                case "2":
                    fiestas = "Solo Vuelta";
                    datos_fiestaseventos_vuelta = {
                        "TRAMOS_FIESTA": fiestas,
                        "FECHA_REGRESO": $('#fecha_regreso_fiestas_vuelta').val(),
                        "ORIGEN": $('#origen_fiestas_vuelta').val(),
                        "CANTIDAD_PASAJEROS_VUELTA": $('#cant_pasajeros_fiesta_vuelta').val(),
                        "HORA": $('#hora_fiesta_vuelta').val(),
                        "DESTINO": $('#destino_fiesta_vuelta').val(),
                        "OBSERVACIONES": $('#observaciones_fiesta_vuelta').val()
                    };
                                 
                    if (validacion('FIESTA-VUELTA',datos_fiestaseventos_vuelta)) {
                                        
                        next();
                        if (enviar_solicitud == 1) {
                            $.ajax({
                            type: "POST",
                            url: "/SalioViaje/Mail/mail-SalioViaje.php",
                            data: {TIPO: tipo, DATA: JSON.stringify(datos_fiestaseventos_vuelta), PARADAS_VUELTA: JSON.stringify(array_paradas_2)},
                            success: function(response){

                            },
                            complete: function (response) {
                                if(response.responseText == 1){
                                    step++;
                                    steps(step);
                                }else{
                                    console.log(response.responseText);
                                }       
                            }
                            });
                        }

                    }else{
                        console.log("No valido");
                    }

                    break;
                case "3":
                    fiestas = "Ida y Vuelta";
                    datos_fiestaseventos_idavuelta = {
                        "TRAMOS_FIESTA": fiestas,
                        "FECHA_SALIDA": $('#fecha_salida_fiestas_idavuelta').val(),
                        "ORIGEN": $('#origen_ida_fiestas_idavuelta').val(),
                        "CANTIDAD_PASAJEROS_IDA": $('#cant_pasajeros_ida_fiestas_idavuelta').val(),
                        "HORA": $('#hora_ida_fiestas_idavuelta').val(),
                        "DESTINO": $('#destino_ida_fiestas_idavuelta').val(),

                        "FECHA_REGRESO": $('#fecha_regreso_fiestas_idavuelta').val(),
                        "ORIGEN_REGRESO": $('#origen_vuelta_fiestas_idavuelta').val(),
                        "CANTIDAD_PASAJEROS_VUELTA": $('#cant_pasajeros_vuelta_fiestas_idavuelta').val(),
                        "HORA_REGRESO": $('#hora_vuelta_fiestas_idavuelta').val(),
                        "DESTINO_REGRESO": $('#destino_vuelta_fiestas_idavuelta').val(),
                        "OBSERVACIONES": $('#observaciones_fiesta_idavuelta').val()
                    };
                        
                    if (validacion('FIESTA-IDA-VUELTA',datos_fiestaseventos_idavuelta)) {

                        next();
                        if (enviar_solicitud == 1) {
                            $.ajax({
                                type: "POST",
                                url: "/SalioViaje/Mail/mail-SalioViaje.php",
                                data: {TIPO: tipo, DATA: JSON.stringify(datos_fiestaseventos_idavuelta), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2)},
                                success: function(response){

                                },
                                complete: function (response) {
                                    if(response.responseText == 1){
                                        step++;
                                        steps(step);
                                    }else{
                                        console.log(response.responseText);
                                    }
                                }
                            });
                        }
                    }else{
                        console.log("No valido");
                    }

                    break;
            }
            break;
    }
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

    $("#paradas_vuelta").hide();

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

            $('.loader_step3').hide();

            if($("#select_users").val() == "4"){
                if($('#select_fiesta').val() == 3){
                    $("#paradas_vuelta").show();
                    $("#paradas_ida").show();
                }else if($('#select_fiesta').val() == 2){
                    $("#paradas_vuelta").show();
                    $("#paradas_ida").hide();
                }else{
                    $("#paradas_vuelta").hide();
                    $("#paradas_ida").show();
                }
            }else{
                $("#paradas_vuelta").hide();
                $("#paradas_ida").show();
            }

            

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

function desplegar(button, session){

    if(session == 1){
        location.href = "/SalioViaje/Login";
    }else{
        button.classList.toggle("active");
        button.nextElementSibling.classList.toggle("show");
    }    
}

function paradas(tipo){

    switch(tipo){
        case 1:
            parada = $("#paradas_1").val();
            array_paradas_1[count_paradas_1] = parada;

            $.ajax({
                type: "POST",
                url: "/SalioViaje/PHP/Tablas/agregarParada.php",
                data: {NRO_PARADA: count_paradas_1, NOMBRE_PARADA: parada, TIPO: 1},
                success: function (response) {
                    $("#tags_paradas_1").append(response);
                    $("#paradas_1").val("");
                }
            });
            count_paradas_1++;

            break;

        case 2:
            parada = $("#paradas_2").val();
            array_paradas_2[count_paradas_2] = parada;

            $.ajax({
                type: "POST",
                url: "/SalioViaje/PHP/Tablas/agregarParada.php",
                data: {NRO_PARADA: count_paradas_2, NOMBRE_PARADA: parada, TIPO: 2},
                success: function (response) {
                    $("#tags_paradas_2").append(response);
                    $("#paradas_2").val("");
                }
            });
            count_paradas_1++;

            break;
    }
}

function borrar_parada(parada, tipo){
    switch(tipo){
        case 1:
            delete array_paradas_1[parada];
            $('#R'+parada).remove();
            console.log(array_paradas_1);
            break;

        case 2:
            delete array_paradas_2[parada];
            $('#R'+parada).remove();
            console.log(array_paradas_2);
            break;
    }    
}

function select_fiesta(){
    tipo = $('#select_fiesta').val();

    $('#fiesta_ida').hide();
    $('#fiesta_vuelta').hide();
    $('#fiesta_idavuelta').hide();

    switch(tipo){
        case "1":
            $('#fiesta_ida').show();
            break;

        case "2":
            $('#fiesta_vuelta').show();
            break;

        case "3":
            $('#fiesta_idavuelta').show();
            break;

        default:
            $('#fiesta_ida').show();
            break;
    }
}

function select_transfer(){
    tipo = $('#select_transfer').val();

    $('#transfer_in').hide();
    $('#transfer_out').hide();

    switch(tipo){
        case "1":
            $('#transfer_in').show();
            break;

        case "2":
            $('#transfer_out').show();
            break;

        default:
            $('#transfer_in').show();
            break;
    }
}

function validacion(TIPO,DATOS){
  console.log(DATOS)
  let validacion;
  let VALIDO = false;

  //Fiestas_ida

  reset_errores()

  switch(TIPO){
    case "Translado":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"Translado",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;

    case "Tour":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"Tour",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;

    case "Transfer_in":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"Transfer-in",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;

    case "Transfer_out":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"Transfer-out",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;

    case "FIESTA-IDA":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"Fiestas_ida",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;

    case "FIESTA-VUELTA":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"Fiestas_vuelta",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;

    case "FIESTA-IDA-VUELTA":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"Fiestas_ida_vuelta",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;
 }

 return VALIDO
}

function reset_errores(){

  $('.mensaje-error').hide();

  $('#pasajeros-input').css('border-bottom', '1px solid #aaaaaa')
  $('#tipo-select_1').css('border-bottom', '1px solid #aaaaaa')
  $('#tipo-select_2').css('border-bottom', '1px solid #aaaaaa')
}