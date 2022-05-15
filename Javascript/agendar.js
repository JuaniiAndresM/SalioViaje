let id_empresas_array
$(document).ready(function () {
    id_empresas_array = id_empresas()
    select_vehiculos()
    $('.empty-list').show()
    $('.vehicle').hide()
    steps(1);
});

var step = 1;
var count_rutas = 0;
let fecha_1;
let fecha_2;

function next() {
    step++;
    steps(step);
}

function volver() {
    //reset_errores();
    step--;
    steps(step);
}


function steps(step) {
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

    switch (step) {
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

function select_tipo(tipo) {
    switch (tipo) {
        case 1:
            tipo = $("#tipo-select_1").val();
            if (tipo == 2) {
                $("#descuento1").show();
            } else {
                $("#descuento1").hide();
            }
            break;
        case 2:
            tipo = $("#tipo-select_2").val();
            if (tipo == 2) {
                $("#descuento2").show();
            } else {
                $("#descuento2").hide();
            }
            break;
    }

    if ($("#tipo-select_1").val() == 2 && $("#tipo-select_2").val() == 2) {
        $('#mensaje-agenda-info').hide();
    } else {
        $('#mensaje-agenda-info').show();

        if ($("#tipo-select_1").val() == 2) {
            $('#mensaje-agenda-info').html('<i class="fas fa-info-circle"></i> Debes llenar primero el Tramo N° 2.');
        } else if ($("#tipo-select_2").val() == 2) {
            $('#mensaje-agenda-info').html('<i class="fas fa-info-circle"></i> Debes llenar primero el Tramo N° 1.');
        }
    }
}

function precio_referencia() {
    var pasajeros = $("#pasajeros-input").val();
    var distancia = $("#distancia-input").val();

    var referencia;

    if (pasajeros >= 3) {
        referencia = distancia * 34;
    } else if (pasajeros >= 6) {
        referencia = distancia * 56;
    } else if (pasajeros >= 8) {
        referencia = distancia * 66;
    } else if (pasajeros >= 11) {
        referencia = distancia * 76;
    } else if (pasajeros >= 15) {
        referencia = distancia * 88;
    } else if (pasajeros >= 17) {
        referencia = distancia * 90;
    } else if (pasajeros >= 22) {
        referencia = distancia * 104;
    } else if (pasajeros >= 28) {
        referencia = distancia * 110;
    } else if (pasajeros >= 47) {
        referencia = distancia * 120;
    }

    $("#precioref_1").attr('value', referencia);
    $("#precioref_2").attr('value', referencia);
}

function calcular_hora() {

    fecha_1 = $("#fecha_1").val();

    let km = document.getElementById('distancia-input').value
    let tiempo = $("#fecha_1").val().substring(11, 16);
    let tiempo_2;
    let dd = fecha_1.substring(8, 10)
    let mm = fecha_1.substring(5, 7)
    let yyyy = fecha_1.substring(0, 4)
    let horas = tiempo.substring(0, 2)
    let minutos = tiempo.substring(3, 5)

    for (var i = 0; i < km; i++) {
        if (minutos == 60) {
            horas++
            minutos = 0
        } else if (horas == 24) {
            horas = 0
            dd++
            minutos++
        } else {
            minutos++
        }

        if (dd == 30) { dd = "01" }
    }

    horas++

    if (horas < 10 && minutos < 10) {
        tiempo_2 = '0' + horas + ':0' + minutos
    } else if (horas < 10 && minutos > 10) {
        tiempo_2 = '0' + horas + ':' + minutos
    } else if (horas > 10 && minutos < 10) {
        tiempo_2 = horas + ':0' + minutos
    } else {
        tiempo_2 = horas + ':' + minutos
    }

    fecha_2 = yyyy + "-" + mm + "-" + dd + "T"

    fecha_2 = fecha_2 + tiempo_2

    if ($("#fecha_2").val() == "") {
        $("#fecha_2").val(fecha_2)
    }
}

function calcular_hora_invertido() {

    fecha_1 = $("#fecha_2").val();

    let km = document.getElementById('distancia-input').value
    let tiempo = $("#fecha_2").val().substring(11, 16);
    let tiempo_2;
    let dd = fecha_1.substring(8, 10)
    let mm = fecha_1.substring(5, 7)
    let yyyy = fecha_1.substring(0, 4)
    let horas = tiempo.substring(0, 2)
    let minutos = tiempo.substring(3, 5)

    for (var i = 0; i < km; i++) {
        if (minutos == 0) {
            --horas
            minutos = 60
        } else if (horas == 0) {
            horas = 24
            dd--
            --minutos
        } else {
            --minutos
        }
    }

    --horas

    if (horas < 10 && minutos < 10) {
        tiempo_2 = '0' + horas + ':0' + minutos
    } else if (horas < 10 && minutos > 10) {
        tiempo_2 = '0' + horas + ':' + minutos
    } else if (horas > 10 && minutos < 10) {
        tiempo_2 = horas + ':0' + minutos
    } else {
        tiempo_2 = horas + ':' + minutos
    }

    if (dd < 10) { dd = "0" + dd }

    fecha_2 = yyyy + "-" + mm + "-" + dd + "T"

    fecha_2 = fecha_2 + tiempo_2

    
    if ($("#fecha_1").val() == "") {
        $("#fecha_1").val(fecha_2)
    }
}


function select_origen_destino(type) {
    switch (type) {
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

let array_rutas = new Array()

function rutas() {
    ruta = $("#rutas_1").val();
    array_rutas[count_rutas] = ruta
    $.ajax({
        type: "POST",
        url: "/PHP/Tablas/agregarTag.php",
        data: { NRO_RUTA: count_rutas, NOMBRE_RUTA: ruta },
        success: function (response) {
            $("#tags_1").append(response);
            $("#rutas_1").val("");
        }
    });
    count_rutas++
    console.log(array_rutas)
}

function borrar_ruta(ruta) {
    delete array_rutas[ruta]
    $('#R' + ruta).remove();
    console.log(array_rutas)
}

/*-------------------------------------------------------------------------------------------*/
//                                    Formularios Agendar                                    //
/*-------------------------------------------------------------------------------------------*/
let vehiculos_select
let vehiculo_seleccionado
let datos_etapa_1


function id_empresas() {
    let id_empresas_array = $.ajax({
        type: 'POST',
        url: "/PHP/procedimientosForm.php",
        data: { tipo: "id-empresas" },
        global: false,
        async: false,
        success: function (response) {
            return response;
        }
    }).responseText;
    return JSON.parse(id_empresas_array);
}

//agrego vehiculos al select
function select_vehiculos() {
    console.log(id_empresas_array)
    //tipo: "vehiculos-agenda",id_empresa:id_empresas_array[i]['ID']
    var selectVehiculos = document.getElementById('vehiculos-select');
    $("#vehiculos-select").empty().append($("<option></option>").attr({ "value": 0, "selected": true, 'disabled': true, 'hidden': true }).text('Seleccione un Vehículo'));

    for (var i = 0; i < id_empresas_array.length; i++) {
        let vehiculos_select_array = $.ajax({
            type: 'POST',
            url: "/PHP/procedimientosForm.php",
            data: { tipo: "vehiculos-agenda", id_empresa: id_empresas_array[i]['ID'] },
            global: false,
            async: false,
            success: function (response) {
                return response;
            }
        }).responseText;

        if (vehiculos_select == undefined) {
            vehiculos_select = JSON.parse(vehiculos_select_array);
        } else {
            vehiculos_select = vehiculos_select.concat(JSON.parse(vehiculos_select_array));
        }
    }
    console.log(vehiculos_select)
    for (var i = 0; i < vehiculos_select.length; i++) {
        if (vehiculos_select[i]["MATRICULA"] != undefined) {
            var opt = document.createElement('option');
            opt.value = vehiculos_select[i]["MATRICULA"];
            opt.text = vehiculos_select[i]["MARCA"] + " " + vehiculos_select[i]["MODELO"] + " (" + vehiculos_select[i]["MATRICULA"] + ")";
            selectVehiculos.appendChild(opt);
        }
    }
}

function actualizar_vista_previa(vehiculo) {
    for (var i = 0; i < vehiculos_select.length; i++) {
        if (vehiculos_select[i]['MATRICULA'] == vehiculo) {
            $('.empty-list').hide()
            $('.vehicle').show()
            $(".matricula").html('<i class="fas fa-address-card"></i> ' + vehiculos_select[i]['MATRICULA'])
            $(".marca").html('<i class="fas fa-car"></i> ' + vehiculos_select[i]['MARCA'])
            $(".modelo").html('<i class="fas fa-list"></i> ' + vehiculos_select[i]['MODELO'])
            $(".capacidad").html('<i class="fas fa-users"></i> ' + vehiculos_select[i]['CAPACIDAD'])
            $(".combustible").html('<i class="fas fa-gas-pump"></i> ' + vehiculos_select[i]['COMBUSTIBLE'])
            if (vehiculos_select[i]['CAPACIDAD'] <= 3) { $(".vehicle-icon").html('<i class="fas fa-car"></i>') } else if (vehiculos_select[i]['CAPACIDAD'] > 3 && vehiculos_select[i]['CAPACIDAD'] <= 12) { $(".vehicle-icon").html('<i class="fas fa-shuttle-van"></i>') } else { $(".vehicle-icon").html('<i class="fas fa-bus"></i>') }
            vehiculo_seleccionado = vehiculos_select[i]
        }
    }
}

function mostrar_datos_vehiculo() {
    $(".matricula").html('<i class="fas fa-address-card"></i> ' + vehiculo_seleccionado['MATRICULA'])
    $(".marca").html('<i class="fas fa-car"></i> ' + vehiculo_seleccionado['MARCA'])
    $(".modelo").html('<i class="fas fa-list"></i> ' + vehiculo_seleccionado['MODELO'])
    $(".capacidad").html('<i class="fas fa-users"></i> ' + vehiculo_seleccionado['CAPACIDAD'])
    $(".combustible").html('<i class="fas fa-gas-pump"></i> ' + vehiculo_seleccionado['COMBUSTIBLE'])
    if (vehiculos_select[i]['CAPACIDAD'] <= 3) { $(".vehicle-icon").html('<i class="fas fa-car"></i>') } else if (vehiculos_select[i]['CAPACIDAD'] > 3 && vehiculos_select[i]['CAPACIDAD'] <= 12) { $(".vehicle-icon").html('<i class="fas fa-shuttle-van"></i>') } else { $(".vehicle-icon").html('<i class="fas fa-bus"></i>') }
}

/*-------------------------------------------------------------------------------------------*/
//                                           Etapa 1                                         //
/*-------------------------------------------------------------------------------------------*/

function etapa_1() {
    datos_etapa_1 = {
        "VEHICULO": vehiculo_seleccionado,
        "CANTIDAD_DE_PASAJEROS": document.getElementById('pasajeros-input').value,
        "DISTANCIA": document.getElementById('distancia-input').value
    }
    if (validacion('AGENDAR-VIAJE-ETAPA-1', datos_etapa_1)) {
        next()

        $("#step-next").on('click', function () {
            etapa_2();
        });
    } else { console.log("No valido...") }
}

/*-------------------------------------------------------------------------------------------*/
//                                           Etapa 2                                         //
/*-------------------------------------------------------------------------------------------*/

function etapa_2() {
    datos_etapa_2_tramo_1 = {
        "TIPO": document.getElementById('tipo-select_1').value,
        "FECHA": document.getElementById('fecha_1').value,
        "ORIGEN": document.getElementById('origen_1').value,
        "DESTINO": document.getElementById('destino_1').value,
        "PRECIO_REFERENCIA": document.getElementById('precioref_1').value
    }

    datos_etapa_2_tramo_2 = {
        "TIPO": document.getElementById('tipo-select_2').value,
        "FECHA": document.getElementById('fecha_2').value,
        "ORIGEN": document.getElementById('origen_2').value,
        "DESTINO": document.getElementById('destino_2').value,
        "PRECIO_REFERENCIA": document.getElementById('precioref_2').value
    }

    if (datos_etapa_2_tramo_1['TIPO'] == 2) { datos_etapa_2_tramo_1['DESCUENTO_OPORTUNIDAD'] = document.getElementById('desc_oport1').value }
    if (datos_etapa_2_tramo_2['TIPO'] == 2) { datos_etapa_2_tramo_2['DESCUENTO_OPORTUNIDAD'] = document.getElementById('desc_oport2').value }

    if (validacion('AGENDAR-VIAJE-ETAPA-2-TRAMO-1', datos_etapa_2_tramo_1)) {
        if (validacion('AGENDAR-VIAJE-ETAPA-2-TRAMO-2', datos_etapa_2_tramo_2)) {
            next()
        } else { console.log("No valido...") }
    } else { console.log("No valido...") }
}

/*-------------------------------------------------------------------------------------------*/
//                                           Etapa 3                                         //
/*-------------------------------------------------------------------------------------------*/

function verificar_rutas_para_MTOP() {

    if (array_rutas.length == 0) {

        console.log("Para agendar con MTOP debe ingresar almenos una ruta")

    } else {

        datos_etapa_2_tramo_1['FECHA'] = fecha_1.replace("T", " ");
        datos_etapa_2_tramo_2['FECHA'] = fecha_2.replace("T", " ");

        next(2)

        $('.pasajeros').html('<i class="fas fa-user-friends"></i> ' + datos_etapa_1['CANTIDAD_DE_PASAJEROS'])
        $('.distancia').html('<i class="fas fa-road"></i> ' + datos_etapa_1['DISTANCIA'] + " Km")

        if (datos_etapa_2_tramo_1['TIPO'] == "1") { $('.tipo_1').html("Agenda") } else { $('.tipo_1').html("Oportunidad") }
        if (datos_etapa_2_tramo_1['DESCUENTO_OPORTUNIDAD'] != undefined) { $('.tipo_1').html("Oportunidad") } else { $('.tipo_1').html("Agenda") }
        $('.fecha_1').html(datos_etapa_2_tramo_1['FECHA'])
        $('.origen_1').html(datos_etapa_2_tramo_1['ORIGEN'])
        $('.destino_1').html(datos_etapa_2_tramo_1['DESTINO'])
        $('.precio_1').html("$" + datos_etapa_2_tramo_1['PRECIO_REFERENCIA'])

        if (datos_etapa_2_tramo_2['TIPO'] == "1") { $('.tipo_2').html("Agenda") } else { $('.tipo_2').html("Oportunidad") }
        if (datos_etapa_2_tramo_2['DESCUENTO_OPORTUNIDAD'] != undefined) { $('.tipo_2').html("Oportunidad") } else { $('.tipo_2').html("Agenda") }
        $('.fecha_2').html(datos_etapa_2_tramo_2['FECHA'])
        $('.origen_2i').html(datos_etapa_2_tramo_2['ORIGEN'])
        $('.destino_2').html(datos_etapa_2_tramo_2['DESTINO'])
        $('.precio_2').html("$" + datos_etapa_2_tramo_2['PRECIO_REFERENCIA'])
    }
}

/*-------------------------------------------------------------------------------------------*/
//                                Vista previa de viaje agendado                             //
/*-------------------------------------------------------------------------------------------*/

function cargar_vista_previa() {
    
    datos_etapa_2_tramo_1['FECHA'] = datos_etapa_2_tramo_1['FECHA'].replace("T", " ");
    datos_etapa_2_tramo_2['FECHA'] = datos_etapa_2_tramo_2['FECHA'].replace("T", " ");

    next(1)

    $('.pasajeros').html('<i class="fas fa-user-friends"></i> ' + datos_etapa_1['CANTIDAD_DE_PASAJEROS'])
    $('.distancia').html('<i class="fas fa-road"></i> ' + datos_etapa_1['DISTANCIA'] + " Km")

    if (datos_etapa_2_tramo_1['TIPO'] == 1) { $('.tipo_1').html("Agenda") } else { $('.tipo_1').html("Oportunidad") }
    if (datos_etapa_2_tramo_1['DESCUENTO_OPORTUNIDAD'] != undefined) { $('.porcentaje_1').html(datos_etapa_2_tramo_1['DESCUENTO_OPORTUNIDAD'] + "%") } else { $('.porcentaje_1').html("No hay descuento") }
<<<<<<< HEAD
    $('.fecha_1').html(formato(datos_etapa_2_tramo_1['FECHA'].substring(0,10))+datos_etapa_2_tramo_1['FECHA'].substring(10,17))
=======
    
    var fecha_1 = datos_etapa_2_tramo_1['FECHA'].split(' ');
    var fecha_1_arreglada = dateFormat(fecha_1[0], 'dd-MM-yyyy')

    $('.fecha_1').html(fecha_1_arreglada + ' ' + fecha_1[1])
>>>>>>> 64546b3e44dc63a0ab60e5d872eba1bebc3f004e
    $('.origen_1').html(datos_etapa_2_tramo_1['ORIGEN'])
    $('.destino_1').html(datos_etapa_2_tramo_1['DESTINO'])
    $('.precio_1').html("$" + datos_etapa_2_tramo_1['PRECIO_REFERENCIA'])

    if (datos_etapa_2_tramo_2['TIPO'] == 1) { $('.tipo_2').html("Agenda") } else { $('.tipo_2').html("Oportunidad") }
    if (datos_etapa_2_tramo_2['DESCUENTO_OPORTUNIDAD'] != undefined) { $('.porcentaje_2').html(datos_etapa_2_tramo_2['DESCUENTO_OPORTUNIDAD'] + "%") } else { $('.porcentaje_2').html("No hay descuento") }
<<<<<<< HEAD
    $('.fecha_2').html(formato(datos_etapa_2_tramo_2['FECHA'].substring(0,10))+datos_etapa_2_tramo_2['FECHA'].substring(10,17))
=======
    
    var fecha_2 = datos_etapa_2_tramo_2['FECHA'].split(' ');
    var fecha_2_arreglada = dateFormat(fecha_2[0], 'dd-MM-yyyy')
    
    $('.fecha_2').html(fecha_2_arreglada + ' ' + fecha_2[1])
>>>>>>> 64546b3e44dc63a0ab60e5d872eba1bebc3f004e
    $('.origen_2').html(datos_etapa_2_tramo_2['ORIGEN'])
    $('.destino_2').html(datos_etapa_2_tramo_2['DESTINO'])
    $('.precio_2').html("$" + datos_etapa_2_tramo_2['PRECIO_REFERENCIA'])

    for (var i = 0; i < array_rutas.length; i++) {
        if (i != array_rutas.length - 1 && array_rutas[i] != undefined) {
            $('.rutas_ingresadas').append(array_rutas[i]+", ")
        } else {
            $('.rutas_ingresadas').append(array_rutas[i]+".")
        }
    }
}

<<<<<<< HEAD
function formato(texto){
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
  }
=======
function dateFormat(inputDate, format) {
    const date = new Date(inputDate);

    const day = date.getDate() + 1;
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    format = format.replace("MM", month.toString().padStart(2,"0"));        

    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}

>>>>>>> 64546b3e44dc63a0ab60e5d872eba1bebc3f004e
/*-------------------------------------------------------------------------------------------*/
//                                         Agendar Viaje                                     //
/*-------------------------------------------------------------------------------------------*/

function finalizar() {  
    $('#step-agendar_MTOP').attr('disabled', 'disabled');
    let datos = {}
    let tipos_tramo = {}

    if (datos_etapa_2_tramo_1['TIPO'] == 1) { tipos_tramo['TIPO_TRAMO_1'] = 1 } else if (datos_etapa_2_tramo_1['TIPO'] == 2) { tipos_tramo['TIPO_TRAMO_1'] = 2 }
    if (datos_etapa_2_tramo_2['TIPO'] == 1) { tipos_tramo['TIPO_TRAMO_2'] = 1 } else if (datos_etapa_2_tramo_2['TIPO'] == 2) { tipos_tramo['TIPO_TRAMO_2'] = 2 }

    for (const property in tipos_tramo) {
        switch (property) {
            case "TIPO_TRAMO_1":
                console.log(tipos_tramo['TIPO_TRAMO_1'])
                datos = datos_etapa_2_tramo_1;
                datos['MATRICULA'] = vehiculo_seleccionado['MATRICULA']
                datos['DISTANCIA'] = datos_etapa_1['DISTANCIA']
                datos['CANTIDAD_DE_PASAJEROS'] = datos_etapa_1['CANTIDAD_DE_PASAJEROS']
                switch (tipos_tramo['TIPO_TRAMO_1']) {
                    case 1:
                        console.log("Registro tramo 1 como... Agenda")
                        console.log(datos)
                        $.ajax({
                            type: "POST",
                            url: "/PHP/Backend.php",
                            data: { opcion: "agendarViaje", datos: JSON.stringify(datos), rutas:JSON.stringify(array_rutas) },
                            success: function (response) {
                                console.log(response)
                            },
                        });
                        break;

                    case 2:
                        console.log("Registro tramo 1 como... Oportunidad")
                        console.log(datos)
                        $.ajax({
                            type: "POST",
                            url: "/PHP/Backend.php",
                            data: { opcion: "agregarOportunidad", datos: JSON.stringify(datos), rutas:JSON.stringify(array_rutas) },
                            success: function (response) {
                                console.log(response)
                            },
                        });
                        break;
                }
                break;

            case "TIPO_TRAMO_2":
                datos = datos_etapa_2_tramo_2;
                datos['MATRICULA'] = vehiculo_seleccionado['MATRICULA']
                datos['DISTANCIA'] = datos_etapa_1['DISTANCIA']
                datos['CANTIDAD_DE_PASAJEROS'] = datos_etapa_1['CANTIDAD_DE_PASAJEROS']
                switch (tipos_tramo['TIPO_TRAMO_2']) {
                    case 1:
                        console.log("Registro tramo 2 como... Agenda")
                        console.log(datos)
                        $.ajax({
                            type: "POST",
                            url: "/PHP/Backend.php",
                            data: { opcion: "agendarViaje", datos: JSON.stringify(datos), rutas:JSON.stringify(array_rutas) },
                            success: function (response) {
                                console.log(response)
                            },
                        });
                        break;

                    case 2:
                        console.log("Registro tramo 2 como... Oportunidad")
                        console.log(datos)
                        $.ajax({
                            type: "POST",
                            url: "/PHP/Backend.php",
                            data: { opcion: "agregarOportunidad", datos: JSON.stringify(datos), rutas:JSON.stringify(array_rutas) },
                            success: function (response) {
                                console.log(response)
                            },
                        });
                        break;
                        break;
                }
        }
    }
    setTimeout(function () {
        window.location = "https://www.salioviaje.com.uy/Panel/Success_Agenda";
    }, 1000);
}

/*-------------------------------------------------------------------------------------------*/
//                                          Validacion                                       //
/*-------------------------------------------------------------------------------------------*/

function validacion(TIPO, DATOS) {
    console.log(DATOS)
    let validacion;
    let VALIDO = false;

    reset_errores()

    switch (TIPO) {
        case "AGENDAR-VIAJE-ETAPA-1":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "ETAPA-1", datos: JSON.stringify(DATOS) },
                global: false,
                async: false,
                success: function (response) {
                    return response;
                }
            }).responseText;
            console.log(validacion)
            if (validacion == "VALIDO") { VALIDO = true }
            else if (validacion == "Err-1") {
                $('.mensaje-error').show();
                $('.mensaje-error').text("Debe completar todos los campos.");
            } else { marcar_errores(validacion) }
            break;
        case "AGENDAR-VIAJE-ETAPA-2-TRAMO-1":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "ETAPA-2-TRAMO-1", datos: DATOS },
                global: false,
                async: false,
                success: function (response) {
                    return response;
                }
            }).responseText;
            if (validacion == "VALIDO") { VALIDO = true }
            else if (validacion == "Err-1") {
                $('.mensaje-error').show();
                $('.mensaje-error').text("Debe completar todos los campos.");
            } else { marcar_errores(validacion, 1) }
            break;
        case "AGENDAR-VIAJE-ETAPA-2-TRAMO-2":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "ETAPA-2-TRAMO-2", datos: DATOS },
                global: false,
                async: false,
                success: function (response) {
                    return response;
                }
            }).responseText;
            if (validacion == "VALIDO") { VALIDO = true }
            else if (validacion == "Err-1") {
                $('.mensaje-error').show();
                $('.mensaje-error').text("Debe completar todos los campos.");
            } else { marcar_errores(validacion, 2) }
            break;
        case "AGENDAR-VIAJE-ETAPA-3":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "ETAPA-3", datos: JSON.stringify(DATOS) },
                global: false,
                async: false,
                success: function (response) {
                    return response;
                }
            }).responseText;
            if (validacion == "VALIDO") { VALIDO = true }
            else if (validacion == "Err-1") {
                $('.mensaje-error').show();
                $('.mensaje-error').text("Debe completar todos los campos.");
            } else { marcar_errores(validacion) }
            break;
    }

    return VALIDO
}

function marcar_errores(resultado_validacion, TRAMO) {
    console.log("hola")
    $('.mensaje-error').show();

    console.log(resultado_validacion)
    let resultado = JSON.parse(resultado_validacion)

    for (const property in resultado) {
        switch (property) {

            case "CANTIDAD_DE_PASAJEROS":
                if (resultado[property] == 0) {
                    $('#pasajeros-input').css('border-bottom', '1px solid #ff635a');
                    $('.mensaje-error').text("El numero de pasajeros no puede ser mayor a la capacidad del vehiculo.");
                }

                break;
            case "TIPO":

                if (resultado[property] == 0) {

                    if (TRAMO == 1) {
                        $('#tipo-select_1').css('border-bottom', '1px solid #ff635a');
                    }
                    if (TRAMO == 2) {
                        $('#tipo-select_2').css('border-bottom', '1px solid #ff635a');
                    }

                    $('.mensaje-error').text("Debe seleccionar un tipo de viaje.");
                }

                break;
        }

    }
}

function reset_errores() {

    $('.mensaje-error').hide();

    $('#pasajeros-input').css('border-bottom', '1px solid #aaaaaa')
    $('#tipo-select_1').css('border-bottom', '1px solid #aaaaaa')
    $('#tipo-select_2').css('border-bottom', '1px solid #aaaaaa')
}