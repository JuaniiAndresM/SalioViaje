let atributos = new Array();

$(document).ready(function () {

    steps(1);

    select_fiesta();
    select_transfer();

    setTimeout(() => {
        datavalue_oportunidades();
    }, 1000);


    $('.mensaje-error').hide();

    $("#fiestas").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/?opcion=4"
    });
    $("#aeropuerto").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/?opcion=3"
    });
    $("#paseo").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/?opcion=2"
    });
    $("#picada").on('click', function () {
        window.location.href = "https://www.salioviaje.com.uy/Viajar/?opcion=1"
    });

    if ($(".session-input").val() = 5) {
        setTimeout(() => {
            timeoutformulario(5);
        }, 500);
    }

    $("#contador-oportunidades").html(document.getElementsByClassName("oportunidad").length);
});

function datavalue_oportunidades() {
    var oportunidades = document.getElementsByClassName("oportunidad").length;

    $("#contador-oportunidades").html(oportunidades);

    console.log(oportunidades);

    if (oportunidades != 0) {
        for (var a = 0; a < oportunidades; a++) {
            let data_value_info = $("#Opo-" + a).data('value');
            atributos.push(data_value_info);
        }

        console.log(atributos);
    }
}

function abrirFormularioCotizacion() {
    window.location.href = "https://www.salioviaje.com.uy/Viajar/?opcion=5"
    timeoutformulario(5);
}

function timeoutformulario(opcion) {
    setTimeout(() => {
        if (opcion != "") {
            window.location.hash = "Cotizacion";
            desplegar(document.getElementById("agendar"), $(".session-output").val());
            if (opcion != 5) {
                select_usuario();
            }

        }
    }, 1000);
}

var step = 1;

let id_cotizacion;
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

function finalizar(enviar_solicitud, modal, domicilio) {
    $('#modal').hide();
    $('#modal').html("");
    tipo = $('#select_users').val();
    switch (tipo) {
        /* 
        Traslado        
        */
        case "1": default:
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
                if (verificar_fechas(datos_traslado['FECHA_SALIDA'], null, 0, datos_traslado['HORA'])) {
                    if (enviar_solicitud == 1) {

                        if (modal == 2) {

                            if (domicilio == 1) {
                                actualizar_direccion_usuario(datos_traslado['DIRECCION_ORIGEN'],datos_traslado['BARRIO_ORIGEN'],datos_traslado['LOCALIDAD_ORIGEN'])
                            }

                            guardar_cotizacion(datos_traslado, array_paradas_1, 0, "traslados");
                            notificarTransportistas()
                            next();

                            setTimeout(() => {
                                $.ajax({
                                    type: "POST",
                                    url: "/Mail/mail-SalioViaje.php",
                                    data: { COTIZACION: id_cotizacion, TIPO: "Traslado", DATA: JSON.stringify(datos_traslado), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                    success: function () {
                                        console.log("se ejecuta")
                                    },
                                    complete: function (response) {
                                        if (response.responseText == 1) {
                                            step++;
                                            steps(step);
                                            vaciar_paradas()
                                        } else {
                                            console.log(response);
                                        }
                                    }
                                });
                            }, 1000);
                        } else {
                            var info = [datos_traslado['DIRECCION_ORIGEN'], datos_traslado['BARRIO_ORIGEN'], datos_traslado['LOCALIDAD_ORIGEN']]
                            $.ajax({
                                type: "POST",
                                url: "https://www.salioviaje.com.uy/Panel/modal.php",
                                data: { opcion: 3, data: info },
                                success: function (response) {
                                    console.log(response);
                                    $('#modal').css('display', 'flex');
                                    $('#modal').html(response);
                                }
                            });
                        }



                    }
                } else {
                    $(".mensaje-error").show();
                    $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                }
            } else { console.log("No valido") }

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
                if (verificar_fechas(datos_tour['FECHA_SALIDA'], null, 0, datos_tour['HORA'])) {
                    if (enviar_solicitud == 1) {
                        if (modal == 2) {

                            if (domicilio == 1) {
                                actualizar_direccion_usuario(datos_tour['DIRECCION_SALIDA_TOUR'], datos_tour['BARRIO_TOUR'], datos_tour['LOCALIDAD_TOUR'])
                            }

                            guardar_cotizacion(datos_tour, array_paradas_1, 0, "tour");
                            notificarTransportistas()
                            next();
                            setTimeout(() => {
                                $.ajax({
                                    type: "POST",
                                    url: "/Mail/mail-SalioViaje.php",
                                    data: { COTIZACION: id_cotizacion, TIPO: "Tour o Servicio por Hora", DATA: JSON.stringify(datos_tour), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                    success: function (response) {

                                    },
                                    complete: function (response) {
                                        if (response.responseText == 1) {
                                            step++;
                                            steps(step);
                                            vaciar_paradas();
                                        } else {
                                            console.log(response);
                                        }
                                    }
                                });
                            }, 1000);
                        } else {
                            var info = [datos_tour['DIRECCION_SALIDA_TOUR'], datos_tour['BARRIO_TOUR'], datos_tour['LOCALIDAD_TOUR']]
                            $.ajax({
                                type: "POST",
                                url: "https://www.salioviaje.com.uy/Panel/modal.php",
                                data: { opcion: 3, data: info },
                                success: function (response) {
                                    console.log(response);
                                    $('#modal').css('display', 'flex');
                                    $('#modal').html(response);
                                }
                            });
                        }



                    }
                } else {
                    $(".mensaje-error").show();
                    $(".mensaje-error").text("No puedes poner una fecha anterior a la actual.");
                }
            } else {
                console.log("No valido");
            }
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
                        if (verificar_fechas(datos_transfer_in['FECHA_ARRIBO'], null, 0, datos_transfer_in['HORA'])) {
                            if (enviar_solicitud == 1) {
                                if (modal == 2) {

                                    if (domicilio == 1) {
                                        actualizar_direccion_usuario(datos_transfer_in['DIRECCION_DESTINO'], datos_transfer_in['BARRIO_DESTINO'], datos_transfer_in['LOCALIDAD_DESTINO'])
                                    }

                                    guardar_cotizacion(datos_transfer_in, array_paradas_1, 0, "transferIn");
                                    notificarTransportistas()
                                    next();
                                    setTimeout(() => {
                                        $.ajax({
                                            type: "POST",
                                            url: "/Mail/mail-SalioViaje.php",
                                            data: { COTIZACION: id_cotizacion, TIPO: "Transfer de Arribo", DATA: JSON.stringify(datos_transfer_in), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                            success: function (response) {

                                            },
                                            complete: function (response) {
                                                if (response.responseText == 1) {
                                                    step++;
                                                    steps(step);
                                                    vaciar_paradas()
                                                } else {
                                                    console.log(response);
                                                }
                                            }
                                        });
                                    }, 1000);
                                } else {
                                    var info = [datos_transfer_in['DIRECCION_DESTINO'], datos_transfer_in['BARRIO_DESTINO'], datos_transfer_in['LOCALIDAD_DESTINO']]
                                    $.ajax({
                                        type: "POST",
                                        url: "https://www.salioviaje.com.uy/Panel/modal.php",
                                        data: { opcion: 3, data: info },
                                        success: function (response) {
                                            console.log(response);
                                            $('#modal').css('display', 'flex');
                                            $('#modal').html(response);
                                        }
                                    });
                                }



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
                        if (verificar_fechas(datos_transfer_out['FECHA_PARTIDA'], null, 0, datos_transfer_out['HORA'])) {
                            if (enviar_solicitud == 1) {
                                if (modal == 2) {

                                    if (domicilio == 1) {
                                        actualizar_direccion_usuario(datos_transfer_out['DIRECCION_ORIGEN'], datos_transfer_out['BARRIO_ORIGEN'], datos_transfer_out['LOCALIDAD_ORIGEN'])
                                    }

                                    guardar_cotizacion(datos_transfer_out, array_paradas_1, 0, "transferOut");
                                    notificarTransportistas()
                                    next();
                                    setTimeout(() => {
                                        $.ajax({
                                            type: "POST",
                                            url: "/Mail/mail-SalioViaje.php",
                                            data: { COTIZACION: id_cotizacion, TIPO: "Transfer de Partida", DATA: JSON.stringify(datos_transfer_out), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                            success: function (response) {

                                            },
                                            complete: function (response) {
                                                if (response.responseText == 1) {
                                                    step++;
                                                    steps(step);
                                                    vaciar_paradas()
                                                } else {
                                                    console.log(response);
                                                }
                                            }
                                        });
                                    }, 1000);
                                } else {
                                    var info = [datos_transfer_out['DIRECCION_ORIGEN'], datos_transfer_out['BARRIO_ORIGEN'], datos_transfer_out['LOCALIDAD_ORIGEN']]
                                    $.ajax({
                                        type: "POST",
                                        url: "https://www.salioviaje.com.uy/Panel/modal.php",
                                        data: { opcion: 3, data: info },
                                        success: function (response) {
                                            console.log(response);
                                            $('#modal').css('display', 'flex');
                                            $('#modal').html(response);
                                        }
                                    });
                                }



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
                case "1": default:
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
                        if (verificar_fechas(datos_fiestaseventos_ida['FECHA_SALIDA'], null, 0, datos_fiestaseventos_ida["HORA"])) {
                            if (enviar_solicitud == 1) {
                                if (modal == 2) {

                                    if (domicilio == 1) {
                                        actualizar_direccion_usuario(datos_fiestaseventos_ida['DIRECCION_ORIGEN'], datos_fiestaseventos_ida['BARRIO_ORIGEN'], datos_fiestaseventos_ida['LOCALIDAD_ORIGEN'])
                                    }

                                    guardar_cotizacion(datos_fiestaseventos_ida, array_paradas_1, 0, "fiestasIda");
                                    notificarTransportistas()
                                    next();
                                    setTimeout(() => {
                                        $.ajax({
                                            type: "POST",
                                            url: "/Mail/mail-SalioViaje.php",
                                            data: { COTIZACION: id_cotizacion, TIPO: "Fiesta o Evento - Ida", DATA: JSON.stringify(datos_fiestaseventos_ida), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                            success: function (response) {

                                            },
                                            complete: function (response) {
                                                if (response.responseText == 1) {
                                                    step++;
                                                    steps(step);
                                                    vaciar_paradas()
                                                } else {
                                                    console.log(response);
                                                }
                                            }
                                        });
                                    }, 1000);

                                } else {
                                    var info = [datos_fiestaseventos_ida['DIRECCION_ORIGEN'], datos_fiestaseventos_ida['BARRIO_ORIGEN'], datos_fiestaseventos_ida['LOCALIDAD_ORIGEN']]
                                    $.ajax({
                                        type: "POST",
                                        url: "https://www.salioviaje.com.uy/Panel/modal.php",
                                        data: { opcion: 3, data: info },
                                        success: function (response) {
                                            console.log(response);
                                            $('#modal').css('display', 'flex');
                                            $('#modal').html(response);
                                        }
                                    });
                                }


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
                        if (verificar_fechas(datos_fiestaseventos_vuelta['FECHA_REGRESO'], null, 0, datos_fiestaseventos_vuelta['HORA'])) {
                            if (enviar_solicitud == 1) {
                                if (modal == 2) {

                                    if (domicilio == 1) {
                                        actualizar_direccion_usuario(datos_fiestaseventos_vuelta['DIRECCION_DESTINO'], datos_fiestaseventos_vuelta['BARRIO_DESTINO'], datos_fiestaseventos_vuelta['LOCALIDAD_DESTINO'])
                                    }

                                    guardar_cotizacion(datos_fiestaseventos_vuelta, 0, array_paradas_2, "fiestasVuelta");
                                    notificarTransportistas()
                                    next();
                                    setTimeout(() => {
                                        $.ajax({
                                            type: "POST",
                                            url: "/Mail/mail-SalioViaje.php",
                                            data: { COTIZACION: id_cotizacion, TIPO: "Fiesta o Evento - Vuelta", DATA: JSON.stringify(datos_fiestaseventos_vuelta), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                            success: function (response) {

                                            },
                                            complete: function (response) {
                                                if (response.responseText == 1) {
                                                    step++;
                                                    steps(step);
                                                    vaciar_paradas()
                                                } else {
                                                    console.log(response.responseText);
                                                }
                                            }
                                        });
                                    }, 1000);

                                    console.log(datos_fiestaseventos_ida)
                                    console.log(array_paradas_2)
                                } else {
                                    var info = [datos_fiestaseventos_vuelta['DIRECCION_DESTINO'], datos_fiestaseventos_vuelta['BARRIO_DESTINO'], datos_fiestaseventos_vuelta['LOCALIDAD_DESTINO']]
                                    $.ajax({
                                        type: "POST",
                                        url: "https://www.salioviaje.com.uy/Panel/modal.php",
                                        data: { opcion: 3, data: info },
                                        success: function (response) {
                                            console.log(response);
                                            $('#modal').css('display', 'flex');
                                            $('#modal').html(response);
                                        }
                                    });
                                }


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
                        if (verificar_fechas(datos_fiestaseventos_idavuelta['FECHA_SALIDA'], datos_fiestaseventos_idavuelta['FECHA_REGRESO'], 1, datos_fiestaseventos_idavuelta['HORA_SALIDA'], datos_fiestaseventos_idavuelta['HORA_REGRESO'])) {
                            if (enviar_solicitud == 1) {
                                if (modal == 2) {

                                    if (domicilio == 1) {
                                        actualizar_direccion_usuario(datos_fiestaseventos_idavuelta['DIRECCION_ORIGEN'], datos_fiestaseventos_idavuelta['BARRIO_ORIGEN'], datos_fiestaseventos_idavuelta['LOCALIDAD_ORIGEN'])
                                    }

                                    guardar_cotizacion(datos_fiestaseventos_idavuelta, array_paradas_1, array_paradas_2, "fiestasIdaVuelta");
                                    notificarTransportistas()
                                    next();
                                    setTimeout(() => {
                                        $.ajax({
                                            type: "POST",
                                            url: "/Mail/mail-SalioViaje.php",
                                            data: { COTIZACION: id_cotizacion, TIPO: "Fiesta o Evento - Ida y Vuelta", DATA: JSON.stringify(datos_fiestaseventos_idavuelta), PARADAS_IDA: JSON.stringify(array_paradas_1), PARADAS_VUELTA: JSON.stringify(array_paradas_2) },
                                            success: function (response) {

                                            },
                                            complete: function (response) {
                                                if (response.responseText == 1) {
                                                    step++;
                                                    steps(step);
                                                    vaciar_paradas()
                                                } else {
                                                    console.log(response.responseText);
                                                }
                                            }
                                        });
                                    }, 1000);
                                } else {
                                    var info = [datos_fiestaseventos_idavuelta['DIRECCION_DESTINO'], datos_fiestaseventos_idavuelta['BARRIO_DESTINO'], datos_fiestaseventos_idavuelta['LOCALIDAD_DESTINO']]
                                    $.ajax({
                                        type: "POST",
                                        url: "https://www.salioviaje.com.uy/Panel/modal.php",
                                        data: { opcion: 3, data: info },
                                        success: function (response) {
                                            console.log(response);
                                            $('#modal').css('display', 'flex');
                                            $('#modal').html(response);
                                        }
                                    });
                                }



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
            break;
    }

}

function actualizar_direccion_usuario(direccion,barrio,localidad){
    $.ajax({
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: { tipo: "actualizar_direccion_usuario", direccion: direccion, barrio: barrio, localidad: localidad },
        success: function (response) {
            console.log(response)
        }
    });
}

function guardar_cotizacion(datos_cotizacion, paradas_ida, paradas_vuelta, tipo) {
    $.ajax({
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: { tipo: "agregar_cotizacion", datos: JSON.stringify(datos_cotizacion), PARADAS_IDA: JSON.stringify(paradas_ida), PARADAS_VUELTA: JSON.stringify(paradas_vuelta), tipo_cotizacion: tipo },
        success: function (response) {
            id_cotizacion = response;
        }
    });
}

function verificar_fechas(fecha1, fecha2, evento, hora_salida, hora_vuelta) {

    console.log(hora_vuelta);
    if (fecha2 != null && hora_vuelta != null) {
        var hora_vuelta = hora_vuelta.split(":")
        var fecha2 = fecha2.split("-")
        var fecha2 = new Date(fecha2[0], fecha2[1], fecha2[2], hora_vuelta[0], hora_vuelta[1])
    }
    var fecha1 = fecha1.split("-")
    var hora_salida = hora_salida.split(":")

    var fecha_actual = new Date();
    var dd = String(fecha_actual.getDate()).padStart(2, '0');
    var mm = String(fecha_actual.getMonth() + 1).padStart(2, '0');
    var yyyy = fecha_actual.getFullYear();
    var hh = String(fecha_actual.getHours());
    var min = String(fecha_actual.getMinutes());

    var fecha1 = new Date(fecha1[0], fecha1[1], fecha1[2], hora_salida[0], hora_salida[1])
    var fecha_actual = new Date(yyyy, mm, dd, hh, min)

    if (evento == 1) {
        if (fecha1 <= fecha2 && fecha1 >= fecha_actual && fecha2 > fecha_actual) {
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

    $('#select_users').val(0)
}

function steps(step) {

    $(".step_1").hide();
    $(".step_2_traslado").hide();
    $(".step_2_tour").hide();
    $(".step_2_transfer").hide();
    $(".step_2_fiestas").hide();
    $(".step_3").hide();
    $(".step_4").hide();
    $(".step_5").hide();
    $("#paradas_vuelta").hide();

    $(".mensaje-error").css('color', '#ff635a');
    var paradas_div = document.getElementById("Cotizacion");

    switch (step) {

        case 1:
            $(".step_1").show();

            $('.progress').css('width', '0%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 2:
            paradas_div.scrollIntoView();

            if ($(".session-input").val() != "" && $(".session-input").val() != null) {
                if ($(".session-input").val() != "5") {
                    viaje = $(".session-input").val();
                }
            } else {
                viaje = $("#select_users").val();
                console.log(viaje);
            }
            $('.loader_step3').hide();
            $(".step_3").show();
            console.log(viaje)
            switch (viaje) {
                case "1":
                    $(".step_2_traslado").show();
                    $(".session-input").val()
                    $(".session-input").val("");
                    break;

                case "2":
                    $(".step_2_tour").show();
                    $(".session-input").val()
                    $(".session-input").val("");
                    break;

                case "3":
                    $(".step_2_transfer").show();
                    $(".session-input").val()
                    $(".session-input").val("");
                    $('.step_3').hide();
                    break;

                case "4":
                    $(".step_2_fiestas").show();
                    $(".session-input").val()
                    $(".session-input").val("");
                    $('.step_3').hide();
                    break;
            }


            $('.progress').css('width', '50%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 3:
            paradas_div.scrollIntoView();
            $(".step_4").show();
            $(".progress-bar").hide();
            break;
        case 4:
            $('.progress').css('width', '100%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');

            paradas_div.scrollIntoView();
            $(".step_5").show();
            $(".progress-bar").hide();
            break;
    }
}

function nueva_cotizacion() {
    step = 1;
    steps(step);
}

function select_usuario(tipo) {

    console.log("Opción: " + $("#select_users").val());

    if ($(".session-input").val() != "" && $(".session-input").val() != 5 && tipo != 1) {
        console.log("---------");
        let opcion_input = $(".session-input").val();
        $("#select_users").val(opcion_input);
        viaje = opcion_input;
        next();
    } else {
        console.log("++++++++");
        viaje = $("#select_users").val();
        next();
    }

}

function desplegar(button, session) {

    if (session == 1) {
        setTimeout(() => {
            location.href = "/Login";
        }, 500);

    } else {
        button.classList.toggle("active");
        button.nextElementSibling.classList.toggle("show");

        if($(`.session-input`).val() != ``){
            var paradas_div = document.getElementById("Cotizacion");
            paradas_div.scrollIntoView();
        }
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
                        console.log(array_paradas_1);
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
            $('#fiesta_vuelta').hide();
            $('#fiesta_idavuelta').hide();
            $('.step_3').show();
            break;

        case "2":
            $('#fiesta_ida').hide();
            $('#fiesta_vuelta').show();
            $('#fiesta_idavuelta').hide();
            $('.step_3').show();
            break;

        case "3":
            $('#fiesta_ida').hide();
            $('#fiesta_vuelta').hide();
            $('#fiesta_idavuelta').show();
            $('.step_3').show();
            break;

        default:
            $('#fiesta_ida').hide();
            $('#fiesta_vuelta').hide();
            $('#fiesta_idavuelta').hide();
            $('.step_3').hide();
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
            $('#transfer_out').hide();
            $('.step_3').show();
            break;

        case "2":
            $('#transfer_in').hide();
            $('#transfer_out').show();
            $('.step_3').show();
            break;

        default:
            $('#transfer_in').hide();
            $('#transfer_out').hide();
            $('.step_3').hide();
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

function rellenar(input) {
    switch (input) {
        // Autorellanar Origen

        case "Direccion_Origen":
            var direccion_origen = $("#direccion_ida_origen_fiestas_idavuelta").val();
            $("#direccion_vuelta_destino_fiestas_idavuelta").val(direccion_origen);
            break;

        case "Barrio_Origen":
            var barrio_origen = $("#barrio_ida_origen_fiestas_idavuelta").val();
            $("#barrio_vuelta_destino_fiestas_idavuelta").val(barrio_origen);
            break;

        case "Localidad_Origen":
            var localidad_origen = $("#localidad_ida_origen_fiestas_idavuelta").val();
            $("#localidad_vuelta_destino_fiestas_idavuelta").val(localidad_origen);
            break;

        // Autorellanar Destino

        case "Direccion_Destino":
            var direccion_destino = $("#direccion_ida_destino_fiestas_idavuelta").val();
            $("#direccion_vuelta_origen_fiestas_idavuelta").val(direccion_destino);
            break;

        case "Barrio_Destino":
            var barrio_destino = $("#barrio_ida_destino_fiestas_idavuelta").val();
            $("#barrio_vuelta_origen_fiestas_idavuelta").val(barrio_destino);
            break;

        case "Localidad_Destino":
            var localidad_destino = $("#localidad_ida_destino_fiestas_idavuelta").val();
            $("#localidad_vuelta_origen_fiestas_idavuelta").val(localidad_destino);
            break;

        case "Cantidad_Pasajeros":
            var cantidad_pasajeros = $("#cant_pasajeros_ida_fiestas_idavuelta").val();
            $("#cant_pasajeros_vuelta_fiestas_idavuelta").val(cantidad_pasajeros);
            break;

    }

}


// ---------------- FILTROS ------------------

function filtrar_divs(tipo) {
    var origen;
    switch (tipo) {

        case "Oportunidad":
            origen = $("#origen_oportunidad").val();
            var destino = $("#destino_oportunidad").val();
            var fecha = $("#fecha_oportunidad").val();
            break;

    }

    if (origen != "" || destino != "" || fecha != "") {

        var encontrado_origen = [];
        var encontrado_destino = [];
        var encontrado_fecha = [];

        var comparacion_1 = [];
        var comparacion_2 = [];
        var comparacion_3 = [];

        for (let i = 0; i < atributos.length; i++) {
            datos = atributos[i].split(',')

            function dateFormat(inputDate, format) {
                const date = new Date(inputDate);

                const day = date.getDate() + 1;
                const month = date.getMonth() + 1;
                const year = date.getFullYear();

                format = format.replace("MM", month.toString().padStart(2, "0"));

                if (format.indexOf("yyyy") > -1) {
                    format = format.replace("yyyy", year.toString());
                } else if (format.indexOf("yy") > -1) {
                    format = format.replace("yy", year.toString().substr(2, 2));
                }

                format = format.replace("dd", day.toString().padStart(2, "0"));

                return format;
            }

            console.log(origen);

            if (datos[0].toLowerCase().includes(origen.toLowerCase()) && origen != "") {
                encontrado_origen.push(i);
            }

            if (datos[1].toLowerCase().includes(destino.toLowerCase()) && destino != "") {
                encontrado_destino.push(i);
            }

            if (datos[2] == dateFormat(fecha, 'dd-MM-yyyy')) {
                encontrado_fecha.push(i);
            }

        }


        if (encontrado_origen.length != 0 && encontrado_destino.length != 0) {
            for (let x = 0; x < encontrado_origen.length; x++) {
                for (let a = 0; a < encontrado_destino.length; a++) {
                    if (encontrado_origen[x] == encontrado_destino[a]) {
                        comparacion_1.push(encontrado_destino[a]);
                    }
                }
            }
        } else if (encontrado_origen.length == 0 && encontrado_destino.length != 0 && origen == "") {
            comparacion_1 = encontrado_destino;
        } else if (encontrado_origen.length != 0 && encontrado_destino.length == 0 && destino == "") {
            comparacion_1 = encontrado_origen;
        }

        if (encontrado_origen.length != 0 && encontrado_fecha.length != 0) {
            for (let x = 0; x < encontrado_origen.length; x++) {
                for (let a = 0; a < encontrado_fecha.length; a++) {
                    if (encontrado_origen[x] == encontrado_fecha[a]) {
                        comparacion_2.push(encontrado_fecha[a]);
                    }
                }
            }
        } else if (encontrado_origen.length == 0 && encontrado_fecha.length != 0 && origen == "") {
            comparacion_2 = encontrado_fecha;
        } else if (encontrado_origen.length != 0 && encontrado_fecha.length == 0 && fecha == "") {
            comparacion_2 = encontrado_origen;
        }



        if (comparacion_1.length != 0 && comparacion_2.length != 0) {
            for (let x = 0; x < comparacion_1.length; x++) {
                for (let a = 0; a < comparacion_2.length; a++) {
                    if (comparacion_1[x] == comparacion_2[a]) {
                        comparacion_3.push(comparacion_2[a]);
                    }
                }
            }
        } else if (comparacion_1.length == 0 && comparacion_2.length != 0 && origen == "" && destino == "") {
            comparacion_3 = comparacion_2;
        } else if (comparacion_1.length != 0 && comparacion_2.length == 0 && origen == "" && fecha == "") {
            comparacion_3 = comparacion_1;
        }

        console.log(comparacion_3);

        for (let i = 0; i < atributos.length; i++) {
            datos = atributos[i].split(',');

            if (comparacion_3.length != 0) {
                $(".oportunidades-list").show();
                $(".list-empty").css('display', 'none');
                var encontrado_final = false;

                for (let x = 0; x < comparacion_3.length; x++) {

                    if (i == comparacion_3[x]) {
                        $("#Opo-" + i).show();
                        encontrado_final = true;
                    } else {
                        if (encontrado_final != true) {
                            $("#Opo-" + i).hide();
                        }
                    }
                }
            } else {
                for (let i = 0; i < atributos.length; i++) {
                    $("#Opo-" + i).hide();

                    $(".oportunidades-list").hide();
                    $(".list-empty").css('display', 'flex');
                }
            }

        }



    } else {
        for (let i = 0; i < atributos.length; i++) {
            $("#Opo-" + i).show();

            $(".oportunidades-list").show();
            $(".list-empty").css('display', 'none');
        }
    }



    /*
    for(var a = 0; a < (cards - 1); a++){
       console.log($('[data-value="Fecha'+cards+'"]').text()); 
    }
    */
}

function eliminar_filtros(tipo) {

    switch (tipo) {
        case "Oportunidad":
            $("#origen_oportunidad").val("");
            $("#destino_oportunidad").val("");
            $("#fecha_oportunidad").val("");
            break;
    }

    filtrar_divs(tipo);
}

function closeModal() {
    $('#modal').hide();
    $('#modal').html("");
}

/**
 * 
 * 
 * 
 * 
 * NOTIFICAR TRANSPORTISTAS
 * 
 * 
 * 
 * 
 */




function notificarTransportistas() {

    const id_inputs = tipoViaje(document.getElementById("select_users").value)
    let datos
    console.log(id_inputs)

    if (id_inputs.length == 6) {
        datos = {
            "fecha": document.getElementById(id_inputs[0]).value,
            "hora": document.getElementById(id_inputs[1]).value,
            "cantidad_pasajeros": document.getElementById(id_inputs[2]).value,
            "mascotas": document.getElementById(id_inputs[3]).value,
            "origen": document.getElementById(id_inputs[4]).value,
            "destino": document.getElementById(id_inputs[5]).value
        }
        transportistasAptos(datos, false)
    } else {
        datos = {
            "fecha": document.getElementById(id_inputs[0]).value,
            "hora": document.getElementById(id_inputs[1]).value,
            "cantidad_pasajeros": document.getElementById(id_inputs[2]).value,
            "fecha_vuelta": document.getElementById(id_inputs[3]).value,
            "hora_vuelta": document.getElementById(id_inputs[4]).value,
            "cantidad_pasajeros_vuelta": document.getElementById(id_inputs[5]).value,
            "mascotas": document.getElementById(id_inputs[6]).value,
            "origen": document.getElementById(id_inputs[4]).value,
            "destino": document.getElementById(id_inputs[5]).value,
            "origen_vuelta": document.getElementById(id_inputs[4]).value,
            "destino_vuelta": document.getElementById(id_inputs[5]).value
        }
        transportistasAptos(datos, true)
    }

}

const transportistasAptos = (datos_filtros, fiesta_ida_vuelta) => {
    $.ajax({
        type: "POST",
        url: "/PHP/topTransportistas.php",
        data: { data: JSON.stringify(datos_filtros) , fiesta_ida_vuelta: fiesta_ida_vuelta},
        success: function (response) {
            var transportistas = JSON.parse(response)
            enviarMailsTransportistas(transportistas)
        }
    });
}

function enviarMailsTransportistas(transportistas) {
    setTimeout(() => {
        for (let index = 0; index < transportistas.length; index++) {
            $.ajax({
                type: "POST",
                url: "/Mail/mail-Cotizacion-Invitacion.php",
                data: { id_viaje: id_cotizacion , mail: transportistas[index]['MAIL']},
                success: function (response) {
                    console.log(response)
                }
            });
        }
    }, 1000);
}


function tipoViaje(tipo) {
    switch (tipo) {
        case "1":
            inputs = ['fecha_salida', 'hora', 'cant_pasajeros', 'mascotas_traslado','localidad_traslado_origen','localidad_traslado_destino']
            break;
        case "2":
            inputs = ['fecha_salida_tour', 'hora_tour', 'cant_pasajeros_tour', 'mascota_tour', 'localidad_tour', 'destino_tour']
            break;
        case "3":
            if (document.getElementById("select_transfer").value == 1) {
                inputs = ['fecha_regreso_transfer_in', 'hora_transfer_in', 'cant_pasajeros_transfer_in', 'mascotas_transfer_in', 'aeropuerto_transfer_in', 'localidad_transfer_in']
            } else {
                inputs = ['fecha_regreso_transfer_out', 'hora_transfer_out', 'cant_pasajeros_transfer_out', 'mascotas_transfer_out', 'localidad_transfer_out','aeropuerto_transfer_out']
            }
            break;
        default:
            if (document.getElementById("select_fiesta").value == 1) {
                inputs = ['fecha_salida_fiestas_ida', 'hora_fiesta_ida', 'cant_pasajeros_fiesta_ida', 'mascotas_fiestas_ida', 'localidad_fiestas_ida', 'fiestasida_origen_localidad']
            } else if (document.getElementById("select_fiesta").value == 2) {
                inputs = ['fecha_regreso_fiestas_vuelta', 'hora_fiesta_vuelta', 'cant_pasajeros_fiesta_vuelta', 'mascotas_fiestas_vuelta', 'fiestasvuelta_origen_localidad', 'localidad_fiesta_vuelta']
            } else {
                inputs = ['fecha_salida_fiestas_idavuelta', 'hora_ida_fiestas_idavuelta', 'cant_pasajeros_ida_fiestas_idavuelta', 'fecha_regreso_fiestas_idavuelta', 'hora_vuelta_fiestas_idavuelta', 'cant_pasajeros_vuelta_fiestas_idavuelta', 'mascotas_fiestas_idavuelta', 'localidad_ida_origen_fiestas_idavuelta', 'localidad_ida_destino_fiestas_idavuelta', 'localidad_vuelta_origen_fiestas_idavuelta', 'localidad_vuelta_destino_fiestas_idavuelta']
            }
            break;
    }
    return inputs
}
