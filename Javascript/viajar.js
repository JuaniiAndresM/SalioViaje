$(document).ready(function () {
    
        steps(1);

    select_fiesta();
    select_transfer();

    $('.mensaje-error').hide();

    $("#fiestas").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/#Cotizacion"
        sessionStorage.setItem("origen", 1)
        sessionStorage.setItem("opcion", "1")
    });
    $("#aeropuerto").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/#Cotizacion"
        sessionStorage.setItem("origen", 1)
        sessionStorage.setItem("opcion", "2")
    });
    $("#paseo").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/#Cotizacion"
        sessionStorage.setItem("origen", 1)
        sessionStorage.setItem("opcion", "3")
    });
    $("#picada").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/#Cotizacion"
        sessionStorage.setItem("origen", 1)
        sessionStorage.setItem("opcion", "4")
    });

});

var step = 1;

let viaje
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

function next() {
    step++;
    steps(step);
}

function finalizar(enviar_solicitud) {
    tipo = $('#select_users').val();
    switch (tipo) {
        /* 
        Traslado        
        */
        case "1":
            datos_traslado = {
                "FECHA_SALIDA": $('#fecha_salida').val(),
                "DIRECCION_ORIGEN": $('#direccion_traslado_origen').val(),
                "BARRIO_ORIGEN": $('#barrio_traslado_origen').val(),
                "LOCALIDAD_ORIGEN": $('#localidad_traslado_origen').val(),
                "DIRECCION_DESTINO": $('#direccion_traslado_destino').val(),
                "BARRIO_DESTINO": $('#barrio_traslado_destino').val(),
                "LOCALIDAD_DESTINO": $('#localidad_traslado_destino').val(),
                "MASCOTAS": $('#mascotas_traslado').val(),
                "CANTIDAD_PASAJEROS": $('#cant_pasajeros').val(),
                "HORA": $('#hora').val(),
                "OBSERVACIONES": $('#observaciones_traslado').val()
            };

            if (validacion('Translado', datos_traslado)) {
                if (verificar_fechas(datos_traslado['FECHA_SALIDA'], null, 0)) {
                    next();
                    if (enviar_solicitud == 1) {
                        var id_cotizacion = guardar_cotizacion(datos_traslado,array_paradas_1,0,"traslados");

                        setTimeout(() => {
                            $.ajax({
                                type: "POST",
                                url: "/Mail/mail-SalioViaje.php",
                                data: {COTIZACION: id_cotizacion, TIPO: "Traslado", DATA: JSON.stringify(datos_traslado), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                success: function () {
                                    console.log("se ejecuta")
                                },
                                complete: function (response) {
                                    if (response.responseText == 1) {
                                        step++;
                                        steps(step);
                                    } else {
                                        console.log(response);
                                    }
                                }
                            });
                        }, 1000);

                        
                    }
                } else {
                    $(".mensaje-error").show();
                    $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                }
            } else { console.log("No valido") }
            vaciar_paradas()
            break;

        /* 
        Tour        
        */
        case "2":
            datos_tour = {
                "FECHA_SALIDA": $('#fecha_salida_tour').val(),
                "DIRECCION_SALIDA_TOUR": $('#direccion_salida_tour').val(),
                "BARRIO_TOUR": $('#barrio_barrios').val(),
                "LOCALIDAD_TOUR": $('#localidad_tour').val(),
                "CANTIDAD_PASAJEROS": $('#cant_pasajeros_tour').val(),
                "HORA": $('#hora_tour').val(),
                "CIUDAD": $('#destino_tour').val(),
                "DURACION": $('#duracion_tour').val(),
                "MASCOTA": $('#mascota_tour').val(),
                "OBSERVACIONES": $('#observaciones_tour').val()
            };

            if (validacion('Tour', datos_tour)) {
                if (verificar_fechas(datos_tour['FECHA_SALIDA'], null, 0)) {
                    next();
                    if (enviar_solicitud == 1) {
                        var id_cotizacion = guardar_cotizacion(datos_tour,array_paradas_1,0,"tour");

                        setTimeout(() => {
                            $.ajax({
                                type: "POST",
                                url: "/Mail/mail-SalioViaje.php",
                                data: {ID: id_cotizacion, TIPO: "Tour o Servicio por Hora", DATA: JSON.stringify(datos_tour), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                success: function (response) {
    
                                },
                                complete: function (response) {
                                    if (response.responseText == 1) {
                                        step++;
                                        steps(step);
                                    } else {
                                        console.log(response);
                                    }
                                }
                            });
                        }, 1000);
                        
                        
                    }
                } else {
                    $(".mensaje-error").show();
                    $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                }
            } else {
                console.log("No valido");
            }
            vaciar_paradas()
            break;

        /* 
        Transfer        
        */
        case "3":
            var tipo_transfer = $('#select_transfer').val();
            var transfer;

            switch (tipo_transfer) {
                case "1":
                    transfer = "Transfer In";
                    datos_transfer_in = {
                        "TIPO_TRANSFER": transfer,
                        "FECHA_ARRIBO": $('#fecha_regreso_transfer_in').val(),
                        "CANTIDAD_PASAJEROS": $('#cant_pasajeros_transfer_in').val(),
                        "HORA": $('#hora_transfer_in').val(),
                        "DIRECCION_DESTINO": $('#direccion_transfer_in').val(),
                        "BARRIO_DESTINO": $('#barrio_transfer_in').val(),
                        "LOCALIDAD_DESTINO": $('#localidad_transfer_in').val(),
                        "PUNTO_ORIGEN": $('#aeropuerto_transfer_in').val(),
                        "EQUIPAJE": $('#equipaje_transfer_in').val(),
                        "MASCOTAS": $('#mascotas_transfer_in').val(),
                        "OBSERVACIONES": $('#observaciones_transfer_in').val(),
                        "NRO_VUELO_BARCO": $('#nro_vuelo_barco_in').val()
                    };

                    if (validacion('Transfer_in', datos_transfer_in)) {
                        if (verificar_fechas(datos_transfer_in['FECHA_ARRIBO'], null, 0)) {
                            next();
                            if (enviar_solicitud == 1) {
                                var id_cotizacion = guardar_cotizacion(datos_transfer_in,array_paradas_1,0,"transferIn");

                                setTimeout(() => {
                                    $.ajax({
                                        type: "POST",
                                        url: "/Mail/mail-SalioViaje.php",
                                        data: {ID: id_cotizacion, TIPO: "Transfer de Arribo", DATA: JSON.stringify(datos_transfer_in), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                        success: function (response) {
    
                                        },
                                        complete: function (response) {
                                            if (response.responseText == 1) {
                                                step++;
                                                steps(step);
                                            } else {
                                                console.log(response);
                                            }
                                        }
                                    });
                                }, 1000);
                                
                                
                            }
                        } else {
                            $(".mensaje-error").show();
                            $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                        }
                    } else {
                        console.log("No valido");
                    }

                    break;

                case "2":
                    transfer = "Transfer Out";
                    datos_transfer_out = {
                        "TIPO_TRANSFER": transfer,
                        "FECHA_PARTIDA": $('#fecha_salida_transfer_out').val(),
                        "CANTIDAD_PASAJEROS": $('#cant_pasajeros_transfer_out').val(),
                        "HORA": $('#hora_transfer_out').val(),
                        "DIRECCION_ORIGEN": $('#direccion_transfer_out').val(),
                        "BARRIO_ORIGEN": $('#barrio_transfer_out').val(),
                        "LOCALIDAD_ORIGEN": $('#localidad_transfer_out').val(),
                        "PUNTO_DESTINO": $('#aeropuerto_transfer_out').val(),
                        "EQUIPAJE": $('#equipaje_transfer_out').val(),
                        "MASCOTAS": $('#mascotas_transfer_out').val(),
                        "OBSERVACIONES": $('#observaciones_transfer_out').val(),
                        "NRO_VUELO_BARCO": $('#nro_vuelo_barco_out').val()
                    };

                    if (validacion('Transfer_out', datos_transfer_out)) {
                        if (verificar_fechas(datos_transfer_out['FECHA_PARTIDA'], null, 0)) {
                            next();
                            if (enviar_solicitud == 1) {
                                var id_cotizacion = guardar_cotizacion(datos_transfer_out,array_paradas_1,0,"transferOut");

                                setTimeout(() => {
                                    $.ajax({
                                        type: "POST",
                                        url: "/Mail/mail-SalioViaje.php",
                                        data: {ID: id_cotizacion, TIPO: "Transfer de Partida", DATA: JSON.stringify(datos_transfer_out), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                        success: function (response) {
    
                                        },
                                        complete: function (response) {
                                            if (response.responseText == 1) {
                                                step++;
                                                steps(step);
                                            } else {
                                                console.log(response);
                                            }
                                        }
                                    });
                                }, 1000);
                                
                                
                            }
                        } else {
                            $(".mensaje-error").show();
                            $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                        }
                    } else {
                        console.log("No valido");
                    }
                    break;
            }
            vaciar_paradas()
            break;

        /* 
        Fiestas y Eventos        
        */
        case "4":
            var tramos = $('#select_fiesta').val();
            var fiestas;
            console.log(array_paradas_1)
            console.log(array_paradas_2)
            switch (tramos) {
                case "1":
                    fiestas = "Solo Ida";
                    datos_fiestaseventos_ida = {
                        "TRAMOS_FIESTA": fiestas,
                        "FECHA_SALIDA": $('#fecha_salida_fiestas_ida').val(),
                        "DIRECCION_ORIGEN": $('#direccion_fiestas_ida').val(),
                        "BARRIO_ORIGEN": $('#barrio_fiestas_ida').val(),
                        "LOCALIDAD_ORIGEN": $('#localidad_fiestas_ida').val(),
                        "PUNTO_DESTINO": $('#destino_fiesta_ida').val(),
                        "BARRIO_DESTINO": $('#fiestasida_origen_barrios').val(),
                        "CANTIDAD_PASAJEROS_IDA": $('#cant_pasajeros_fiesta_ida').val(),
                        "HORA": $('#hora_fiesta_ida').val(),
                        "MASCOTAS": $('#mascotas_fiestas_ida').val(),
                        "OBSERVACIONES": $('#observaciones_fiesta_ida').val()
                    };

                    if (validacion('FIESTA-IDA', datos_fiestaseventos_ida)) {
                        if (verificar_fechas(datos_fiestaseventos_ida['FECHA_SALIDA'], null, 0)) {
                            next();
                            if (enviar_solicitud == 1) {
                                var id_cotizacion = guardar_cotizacion(datos_fiestaseventos_ida,array_paradas_1,0,"fiestasIda");

                                setTimeout(() => {
                                    $.ajax({
                                        type: "POST",
                                        url: "/Mail/mail-SalioViaje.php",
                                        data: {ID: id_cotizacion, TIPO: "Fiesta o Evento - Ida", DATA: JSON.stringify(datos_fiestaseventos_ida), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                        success: function (response) {
    
                                        },
                                        complete: function (response) {
                                            if (response.responseText == 1) {
                                                step++;
                                                steps(step);
                                            } else {
                                                console.log(response);
                                            }
                                        }
                                    });
                                }, 1000);
                                
                               console.log(datos_fiestaseventos_ida)
                               
                            }
                        } else {
                            $(".mensaje-error").show();
                            $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                        }
                    } else {
                        console.log("No valido")
                    }

                    break;
                case "2":
                    fiestas = "Solo Vuelta";
                    datos_fiestaseventos_vuelta = {
                        "TRAMOS_FIESTA": fiestas,
                        "FECHA_REGRESO": $('#fecha_regreso_fiestas_vuelta').val(),
                        "DIRECCION_DESTINO": $('#direccion_fiesta_vuelta').val(),
                        "BARRIO_DESTINO": $('#barrio_fiesta_vuelta').val(),
                        "LOCALIDAD_DESTINO": $('#localidad_fiesta_vuelta').val(),
                        "PUNTO_ORIGEN": $('#origen_fiestas_vuelta').val(),
                        "BARRIO_ORIGEN": $('#fiestasvuelta_origen_barrios').val(),
                        "CANTIDAD_PASAJEROS_VUELTA": $('#cant_pasajeros_fiesta_vuelta').val(),
                        "HORA": $('#hora_fiesta_vuelta').val(),
                        "MASCOTAS": $('#mascotas_fiestas_vuelta').val(),
                        "OBSERVACIONES": $('#observaciones_fiesta_vuelta').val()
                    };

                    if (validacion('FIESTA-VUELTA', datos_fiestaseventos_vuelta)) {
                        if (verificar_fechas(datos_fiestaseventos_vuelta['FECHA_REGRESO'], null, 0)) {
                            next();
                            if (enviar_solicitud == 1) {
                                var id_cotizacion = guardar_cotizacion(datos_fiestaseventos_vuelta,0,array_paradas_2,"fiestasVuelta");
                                
                                setTimeout(() => {
                                    $.ajax({
                                        type: "POST",
                                        url: "/Mail/mail-SalioViaje.php",
                                        data: {ID: id_cotizacion, TIPO: "Fiesta o Evento - Vuelta", DATA: JSON.stringify(datos_fiestaseventos_vuelta), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                        success: function (response) {
    
                                        },
                                        complete: function (response) {
                                            if (response.responseText == 1) {
                                                step++;
                                                steps(step);
                                            } else {
                                                console.log(response.responseText);
                                            }
                                        }
                                    });
                                }, 1000);
                               
                                console.log(datos_fiestaseventos_ida)
                                console.log(array_paradas_2)
                                
                            }
                        } else {
                            $(".mensaje-error").show();
                            $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                        }
                    } else {
                        console.log("No valido");
                    }

                    break;
                case "3":
                    fiestas = "Ida y Vuelta";
                    datos_fiestaseventos_idavuelta = {
                        "TRAMOS_FIESTA": fiestas,

                        "FECHA_SALIDA": $('#fecha_salida_fiestas_idavuelta').val(),
                        
                        "DIRECCION_ORIGEN": $('#direccion_ida_origen_fiestas_idavuelta').val(),
                        "BARRIO_ORIGEN": $('#barrio_ida_origen_fiestas_idavuelta').val(),
                        "LOCALIDAD_ORIGEN": $('#localidad_ida_origen_fiestas_idavuelta').val(),
                        
                        "DIRECCION_DESTINO": $('#direccion_ida_destino_fiestas_idavuelta').val(),
                        "BARRIO_DESTINO": $('#barrio_ida_destino_fiestas_idavuelta').val(),
                        "LOCALIDAD_DESTINO": $('#localidad_ida_destino_fiestas_idavuelta').val(),
                        
                        "HORA_SALIDA": $('#hora_ida_fiestas_idavuelta').val(),
                        "CANTIDAD_PASAJEROS_IDA": $('#cant_pasajeros_ida_fiestas_idavuelta').val(),



                        "FECHA_REGRESO": $('#fecha_regreso_fiestas_idavuelta').val(),
                        
                        "DIRECCION_ORIGEN_VUELTA": $('#direccion_vuelta_origen_fiestas_idavuelta').val(),
                        "BARRIO_ORIGEN_VUELTA": $('#barrio_vuelta_origen_fiestas_idavuelta').val(),
                        "LOCALIDAD_ORIGEN_VUELTA": $('#localidad_vuelta_origen_fiestas_idavuelta').val(),
                        
                        "DIRECCION_DESTINO_VUELTA": $('#direccion_vuelta_destino_fiestas_idavuelta').val(),
                        "BARRIO_DESTINO_VUELTA": $('#barrio_vuelta_destino_fiestas_idavuelta').val(),
                        "LOCALIDAD_DESTINO_VUELTA": $('#localidad_vuelta_destino_fiestas_idavuelta').val(),
                        
                        "HORA_REGRESO": $('#hora_vuelta_fiestas_idavuelta').val(),
                        "CANTIDAD_PASAJEROS_VUELTA": $('#cant_pasajeros_vuelta_fiestas_idavuelta').val(),
                    
                        "MASCOTAS": $('#mascotas_fiestas_idavuelta').val(),
                        "OBSERVACIONES": $('#observaciones_fiesta_idavuelta').val()
                    };

                    if (validacion('FIESTA-IDA-VUELTA', datos_fiestaseventos_idavuelta)) {
                        if (verificar_fechas(datos_fiestaseventos_idavuelta['FECHA_SALIDA'], datos_fiestaseventos_idavuelta['FECHA_REGRESO'], 1)) {
                            next();
                            if (enviar_solicitud == 1) {
                                var id_cotizacion = guardar_cotizacion(datos_fiestaseventos_idavuelta,array_paradas_1,array_paradas_2,"fiestasIdaVuelta");

                                setTimeout(() => {
                                    $.ajax({
                                        type: "POST",
                                        url: "/Mail/mail-SalioViaje.php",
                                        data: {ID: id_cotizacion, TIPO: "Fiesta o Evento - Ida y Vuelta", DATA: JSON.stringify(datos_fiestaseventos_idavuelta), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                        success: function (response) {
    
                                        },
                                        complete: function (response) {
                                            if (response.responseText == 1) {
                                                step++;
                                                steps(step);
                                            } else {
                                                console.log(response.responseText);
                                            }
                                        }
                                    });
                                }, 1000);
                                
                                
                            }
                        } else {
                            $(".mensaje-error").show();
                            $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                        }
                    } else {
                        console.log("No valido");
                    }
                    break;
            }
            vaciar_paradas()
            break;
    }
}

function guardar_cotizacion(datos_cotizacion,paradas_ida,paradas_vuelta,tipo) {
    $.ajax({
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: { tipo: "agregar_cotizacion", datos: JSON.stringify(datos_cotizacion), PARADAS_IDA: JSON.stringify(paradas_ida), PARADAS_VUELTA: JSON.stringify(paradas_vuelta),tipo_cotizacion:tipo },
        success: function (response) {
            console.log(response)
        }
    });
}

function verificar_fechas(fecha1, fecha2, evento) {

    var fecha_actual = new Date();
    var dd = String(fecha_actual.getDate()).padStart(2, '0');
    var mm = String(fecha_actual.getMonth() + 1).padStart(2, '0');
    var yyyy = fecha_actual.getFullYear();
    fecha_actual = yyyy + '-' + mm + '-' + dd;

    if (evento == 1) {
        if (fecha1 < fecha2 && fecha1 >= fecha_actual && fecha2 > fecha_actual) {
            return true
        } else { return false }
    } else {
        if (fecha1 >= fecha_actual) {
            return true
        } else { return false }
    }

}

function restarHoras(inicio, fin) {

    inicioMinutos = parseInt(inicio.substr(3, 2));
    inicioHoras = parseInt(inicio.substr(0, 2));

    finMinutos = parseInt(fin.substr(3, 2));
    finHoras = parseInt(fin.substr(0, 2));

    transcurridoMinutos = finMinutos - inicioMinutos;
    transcurridoHoras = finHoras - inicioHoras;

    if (transcurridoMinutos < 0) {
        transcurridoHoras--;
        transcurridoMinutos = 60 + transcurridoMinutos;
    }

    horas = transcurridoHoras.toString();
    minutos = transcurridoMinutos.toString();

    if (horas.length < 2) {
        horas = "0" + horas;
    }

    if (horas.length < 2) {
        horas = "0" + horas;
    }

    console.log(parseInt(horas));
    return parseInt(horas);


}

function verificar_largo_fiesta() {
    if (restarHoras($('#hora_ida_fiestas_idavuelta').val(), $('#hora_vuelta_fiestas_idavuelta').val()) <= -6) {
        $('.mensaje-error').html("El evento por el que estas consultando tiene una duracion superior a las 6h quieres continuar?");
        $('.mensaje-error').css('color', 'rgb(255, 211, 91)');
        $('.mensaje-error').show();
    } else {
        $('.mensaje-error').hide();
    }
}

function vaciar_paradas() {
    array_paradas_1 = [];
    array_paradas_2 = [];
    count_paradas_1 = 0;
    count_paradas_2 = 0;
    $("#tags_paradas_1").html(" ");
    $("#tags_paradas_2").html(" ");
}

function volver() {
    step--;
    steps(step);
}

function steps(step) {

    $(".step_1").hide();
    $(".step_2_traslado").hide();
    $(".step_2_tour").hide();
    $(".step_2_transfer").hide();
    $(".step_2_fiestas").hide();
    $(".step_3").hide();
    $(".step_4").hide();
    $("#paradas_vuelta").hide();

    $(".mensaje-error").css('color', '#ff635a');

    switch (step) {
        case 1:
            $(".step_1").show();

            $('.progress').css('width', '0%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 2:
            if (sessionStorage.getItem("opcion") != null) {
                viaje = sessionStorage.getItem("opcion")
                sessionStorage.removeItem("opcion")
            } else {
                viaje = $("#select_users").val();
            }
            //
            console.log(viaje)
            switch (viaje) {
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

            if ($("#select_users").val() == "4") {
                if ($('#select_fiesta').val() == 3) {
                    $("#paradas_vuelta").show();
                    $("#paradas_ida").show();
                } else if ($('#select_fiesta').val() == 2) {
                    $("#paradas_vuelta").show();
                    $("#paradas_ida").hide();
                } else {
                    $("#paradas_vuelta").hide();
                    $("#paradas_ida").show();
                }
            } else {
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

function nueva_cotizacion() {
    step = 1;
    steps(step);
}

function select_usuario(arg) {

    if (sessionStorage.getItem("opcion") != null) {
        console.log(sessionStorage.getItem("opcion"))
        setTimeout(function () {
            $("#select_users").val(sessionStorage.getItem("opcion"));
            viaje = $("#select_users").val()
            next()
        }, 500);
    }

    if (arg == null) {
        viaje = $("#select_users").val();
        if (viaje != null) {
            next()
        }
    }

}

function desplegar(button, session) {

    if (session == 1) {
        location.href = "/Login";
    } else {
        button.classList.toggle("active");
        button.nextElementSibling.classList.toggle("show");
    }
}

function paradas(tipo) {

    switch (tipo) {
        case 1:
            parada = $("#paradas_1").val();
            console.log(array_paradas_1.indexOf(parada))
            if (array_paradas_1.indexOf(parada) == -1) {
                array_paradas_1[count_paradas_1] = parada;
                $.ajax({
                    type: "POST",
                    url: "/PHP/Tablas/agregarParada.php",
                    data: { NRO_PARADA: count_paradas_1, NOMBRE_PARADA: parada, TIPO: 1 },
                    success: function (response) {
                        $("#tags_paradas_1").append(response);
                        $("#paradas_1").val("");
                    }
                });
                count_paradas_1++;
            } else { console.log("la parada ya existe") }

            break;

        case 2:
            parada = $("#paradas_2").val();
            console.log(array_paradas_2.indexOf(parada))
            if (array_paradas_2.indexOf(parada) == -1) {
                array_paradas_2[count_paradas_2] = parada;
                $.ajax({
                    type: "POST",
                    url: "/PHP/Tablas/agregarParada.php",
                    data: { NRO_PARADA: count_paradas_2, NOMBRE_PARADA: parada, TIPO: 2 },
                    success: function (response) {
                        $("#tags_paradas_2").append(response);
                        $("#paradas_2").val("");
                    }
                });
                count_paradas_2++;
            }
            break;
    }
}

function borrar_parada(parada, tipo) {
    switch (tipo) {
        case 1:
            delete array_paradas_1[parada];
            $('#R' + parada).remove();
            console.log(array_paradas_1);
            break;

        case 2:
            delete array_paradas_2[parada];
            $('#R' + parada).remove();
            console.log(array_paradas_2);
            break;
    }
}

function select_fiesta() {
    tipo = $('#select_fiesta').val();

    $('#fiesta_ida').hide();
    $('#fiesta_vuelta').hide();
    $('#fiesta_idavuelta').hide();

    switch (tipo) {
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

function select_transfer() {
    tipo = $('#select_transfer').val();

    $('#transfer_in').hide();
    $('#transfer_out').hide();

    switch (tipo) {
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

function validacion(TIPO, DATOS) {
    console.log(DATOS)
    let validacion;
    let VALIDO = false;

    //Fiestas_ida

    reset_errores()

    switch (TIPO) {
        case "Translado":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "Translado", datos: JSON.stringify(DATOS) },
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

        case "Tour":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "Tour", datos: JSON.stringify(DATOS) },
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

        case "Transfer_in":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "Transfer-in", datos: JSON.stringify(DATOS) },
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

        case "Transfer_out":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "Transfer-out", datos: JSON.stringify(DATOS) },
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

        case "FIESTA-IDA":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "Fiestas_ida", datos: JSON.stringify(DATOS) },
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

        case "FIESTA-VUELTA":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "Fiestas_vuelta", datos: JSON.stringify(DATOS) },
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

        case "FIESTA-IDA-VUELTA":
            validacion = $.ajax({
                type: 'POST',
                url: "/PHP/Validaciones.php",
                data: { tipo: "Fiestas_ida_vuelta", datos: JSON.stringify(DATOS) },
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
    }

    return VALIDO
}

function reset_errores() {

    $('.mensaje-error').hide();

    $('#pasajeros-input').css('border-bottom', '1px solid #aaaaaa')
    $('#tipo-select_1').css('border-bottom', '1px solid #aaaaaa')
    $('#tipo-select_2').css('border-bottom', '1px solid #aaaaaa')
}