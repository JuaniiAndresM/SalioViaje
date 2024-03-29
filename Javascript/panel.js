
let NOMBRE_USUARIO;

$(document).ready(function () {
    $('#panel-navbar').load('/web/panel-navbar.php');
    let list = document.querySelectorAll('#panel-navbar li');

    function activateLink() {
        list.forEach((item) =>
            item.classList.remove('hovered'));
        this.classList.add('hovered');
    }

    list.forEach((item) =>
        item.addEventListener('mouseover', activateLink));

    traigoVisitas();



    $("#ID").on('click', function () {
        console.log(cambiarOrden(orden))
        ordenarId(orden)
    });


    $("#actualizar_panel").on('click', function () {
        actualizar_panel()
    });

    $('#vehiculos-select').on('change', function () {
        let matricula = document.getElementById('vehiculos-select').value;
        actualizar_vista_previa(matricula);
    });

    //

    $('#vehiculos-select').on('change', function () {
        let matricula = document.getElementById('vehiculos-select').value;
        actualizar_vista_previa(matricula);
    });


    $("#cerrar_session_dashboard").on('click', function () {
        $.ajax({
            url: "/PHP/cerrarSession.php",
            success: function () {
                window.location = "https://www.salioviaje.com.uy";
            }
        });
    });

    $('#select_actualizar').change(function () {
        actualizar_panel($(this).children('option:selected').val());
    });

    setTimeout(() => {
        console.log(document.getElementById(`cotz-reci`).rows.length - 1);
        if((document.getElementById(`cotz-reci`).rows.length - 1) >= 5){
            document.getElementById(`full-cotiz-reci`).style.display = 'flex';
        }else{
            document.getElementById(`full-cotiz-reci`).style.display = 'none';
        }
    }, 500);
});

function navbar() {
    let navbar = document.getElementById('panel-navbar');
    let header = document.getElementById('header');
    let panel = document.getElementById('panel');

    navbar.classList.toggle('active');
    header.classList.toggle('active');
    panel.classList.toggle('active');
}

function buscarUsuarios(buscador, filter) {
    var input, filter, table, tr, td, i, txtValue, tdlength;
    if (filter != null) {
        input = document.getElementById("searchbar" + filter);
    } else {
        input = document.getElementById("searchbar");
    }
    filter = input.value.toUpperCase();

    switch (buscador) {
        case 1:
            table = document.getElementById("search-table");
            tdlength = 5;
            break;
        case 2:
            table = document.getElementById("search-table-usuarios");
            tdlength = 12;
            break;
        case 3:
            table = document.getElementById("search-table-empresas");
            tdlength = 6;
            break;
        case 4:
            table = document.getElementById("search-table-cotizaciones");
            tdlength = 5;
            break;
        case 5:
            table = document.getElementById("search-table-agenda");
            tdlength = 6;
            break;
        case 6:
            table = document.getElementById("search-agendar-table");
            tdlength = 11;
            break;
        case 7:
            table = document.getElementById("search-table-vehiculos");
            tdlength = 10;
            break;
        case 8:
            table = document.getElementById("search-facturacion-table");
            tdlength = 8;
            break;
        case 9:
            table = document.getElementById("cotz-pres");
            tdlength = 7;
            break;
        case 10:
            table = document.getElementById("cotz-reci");
            tdlength = 5;
            break;
        case 11:
            table = document.getElementById("search-table-permisosmtop");
            tdlength = 4;
            break;
        case 12:
            table = document.getElementById("tbody-cotizaciones-recibidas");
            tdlength = 7;
            break;
    }

    tr = table.getElementsByTagName("tr");


    for (i = 0; i < tr.length; i++) {

        a = 0;
        encontrado = false;

        do {
            td = tr[i].getElementsByTagName("td")[a];

            if (td) {
                txtValue = td.textContent || td.innerText;

                console.log(txtValue.toUpperCase());
                console.log(filter);
                console.log(txtValue.toUpperCase().indexOf(filter));

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    encontrado = true;
                } else {
                    tr[i].style.display = "none";
                }
            }

            a++;
        } while (a != tdlength && encontrado == false);

    }
}
/*-------------------------------------------------------------------------------------------*/
//                                       TABLAS                                              //
/*-------------------------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------*/
//                                     Usuarios                                              //
/*-------------------------------------------------------------------------------------------*/
let usuarios

function traerUsuarios(seccion) {

    usuarios = $.ajax({
        type: 'POST',
        url: "/PHP/Backend.php",
        data: { opcion: "usr" },
        global: false,
        async: false,
        success: function (response) {
            return response;
        }
    }).responseText;
    console.log("Usuarios: " + usuarios);
    usuarios = JSON.parse(usuarios)

    tablas_usuarios(seccion);
}

function traerUsuariosESPECIFICOS(seccion, rut) {

    usuarios = $.ajax({
        type: 'POST',
        url: "/PHP/llamadosSol.php",
        data: { tipe: 9, rut: rut },
        global: false,
        async: false,
        success: function (response) {
            return response;
        }
    }).responseText;
    usuarios = JSON.parse(usuarios)
    tablas_usuarios(seccion);
}

function tablas_usuarios(seccion) {
    for (var i = 0; i < usuarios.length; i++) {
        switch (seccion) {
            case "Dashboard":
                tabla_usuarios_dashboard(usuarios[i])
                break;

            case "usuarios":
                tabla_seccion_usuarios(usuarios[i])
                break;
            case "usuariosESPECIFICOS":
                tabla_seccion_usuarios_especificos(usuarios[i]);
                break;
        }
    }
}

function tabla_usuarios_dashboard() {

    $.ajax({
        type: "POST",
        data: { opcion: "tab_dashboard_usuarios" },
        url: "https://www.salioviaje.com.uy/PHP/Backend.php",
        success: function (response) {
            let numero_usuarios
            if (response != 0) {
                $("#tbody-usuarios").html(response)
                numero_usuarios = $("#tbody-usuarios tr").length
            } else {
                numero_usuarios = 0
                $("#tbody-usuarios").html("")
            }
        },
        complete: function () {
            $('.ADM').remove();
            let usuarios_total = $("#tbody-usuarios > tr").length;
            if (usuarios_total == 1) {
                $("#cantidad-usuarios").html('<h2>0</h2><i class="fas fa-user-friends"></i>')
            } else {
                $("#cantidad-usuarios").html('<h2>' + usuarios_total + '</h2><i class="fas fa-user-friends"></i>')
            }
        }
    })
}

function actualizar_tablas() {
    tabla_usuarios_dashboard()
    tabla_empresas_dashboard()
}

function tabla_seccion_usuarios(usuario) {

    let ID_USUARIO
    var tabla = document.getElementById('tbody')
    if (usuario['TIPO_USUARIO'] != "ADM") {
        var row = document.createElement("tr")
        row.setAttribute('class', usuario['TIPO_USUARIO'])
        let contador = 0;

        for (const property in usuario) {
            let td = document.createElement("td");
            if (contador != 13) {
                if (usuario[property] == null || usuario[property] == '' || usuario[property] == undefined) {
                    td.innerHTML = "-"
                } else if (property == "ID") {
                    ID_USUARIO = usuario[property]
                    td.innerHTML = usuario[property]
                } else if (property != "RUT") {
                    td.innerHTML = usuario[property]
                }

                if (property == "SUPERVISOR") {
                    td.setAttribute('class', "HTL");
                }
                else if (property == "AGENCIA_CONTRATISTA") {
                    td.setAttribute('class', "CHO");
                }
                row.appendChild(td);
            }
            contador++
        }
        let td = document.createElement("td");
        td.innerHTML += '<div class="button-wrapper"><button id="' + ID_USUARIO + '" class="button tooltip left" data-tooltip="Ver Usuario" onclick="ver_usuario(' + ID_USUARIO + ')"><i class="far fa-eye"></i></button><button id="' + ID_USUARIO + '" class="button tooltip left" data-tooltip="Editar Usuario" onclick="editarUsuario(' + ID_USUARIO + ')"><i class="fas fa-edit"></i></button><button id="' + ID_USUARIO + '" class="button tooltip left" data-tooltip="Eliminar Usuario" onclick="eliminar_usuario(' + ID_USUARIO + ')"><i class="fas fa-trash-alt"></i></button></div>'
        row.appendChild(td);
        //
        //agrego la fila a la tabla
        //
        console.log(row)
        if (row != " ") { tabla.appendChild(row); }
    }
}

function ver_usuario(id) {
    location.href = "/Profile/" + id;
}

function tabla_seccion_usuarios_especificos(usuario) {

    var tabla = document.getElementById('tbody')
    if (usuario[0]['TIPO_USUARIO'] != "ADM") {
        var row = document.createElement("tr")
        row.setAttribute('class', usuario[0]['TIPO_USUARIO'])
        let contador = 0;

        for (const property in usuario[0]) {
            let td = document.createElement("td");
            if (contador != 13) {
                if (usuario[0][property] == null || usuario[0][property] == '' || usuario[0][property] == undefined) {
                    td.innerHTML = "-"
                } else if (property == "ID") {
                    ID_USUARIO = usuario[0][property]
                    td.innerHTML = usuario[0][property]
                } else if (property != "RUT") {
                    td.innerHTML = usuario[0][property]
                }

                if (property == "SUPERVISOR") {
                    td.setAttribute('class', "HTL")
                }
                if (property == "AGENCIA_CONTRATISTA") {
                    td.setAttribute('class', "CHO")
                }
                row.appendChild(td);
            }
            contador++
        }

        let td = document.createElement("td");
        td.innerHTML += '<div class="button-wrapper"><button id="' + ID_USUARIO + '" class="button tooltip left" data-tooltip="Ver Usuario" onclick="ver_usuario(' + ID_USUARIO + ')"><i class="far fa-eye"></i></button>'
        row.appendChild(td);
        //
        //agrego la fila a la tabla
        //
        console.log(row)
        if (row != " ") { tabla.appendChild(row); }
    }
}

/*-------------------------------------------------------------------------------------------*/
//                                     Empresas                                              //
/*-------------------------------------------------------------------------------------------*/
let traer_empresas

function traerEmpresas(seccion) {
    traer_empresas = $.ajax({
        type: 'POST',
        url: "/PHP/Backend.php",
        data: { opcion: "emp" },
        global: false,
        async: false,
        success: function (response) {
            return response;
        }
    }).responseText;
    traer_empresas = JSON.parse(traer_empresas)
    tablas_empresas(seccion);
}

function tablas_empresas(seccion) {
    console.log(seccion)
    for (var i = 0; i < traer_empresas.length; i++) {
        switch (seccion) {
            case "Dashboard":
                tabla_empresas_dashboard(traer_empresas[i])
                break;

            case "empresas":
                tabla_seccion_empresas(traer_empresas[i])
                break;
        }
    }
}

function tabla_empresas_dashboard() {
    $.ajax({
        type: "POST",
        data: { opcion: "tab_dashboard_empresas" },
        url: "https://www.salioviaje.com.uy/PHP/Backend.php",
        success: function (response) {
            console.log(response);
            if (response != 0) {
                $(".propietarios").html(response)
            } else {
                $(".propietarios").html("")
            }

        }
    })
}

function tabla_seccion_empresas(empresa) {
    var tabla = document.getElementById('tbody')
    var row = document.createElement("tr")
    row.setAttribute('class', empresa['TIPO_USUARIO'])
    let contador = 0;

    for (const property in empresa) {
        let td = document.createElement("td");
        console.log(empresa[property])
        if (property == "ID") {
            ID_EMPRESA = empresa[property]
            td.innerHTML = empresa[property]
        } else {
            td.innerHTML = empresa[property]
        }
        row.appendChild(td);
        contador++
    }
    /*
    let td = document.createElement("td");
    td.innerHTML += '<button id="'+ID_EMPRESA+'">Ver</button>'
    row.appendChild(td);
    */
    //
    //agrego la fila a la tabla
    //
    tabla.appendChild(row);
}

/*-------------------------------------------------------------------------------------------*/
//                                     Choferes                                              //
/*-------------------------------------------------------------------------------------------*/
let choferes

function traerChoferes(idTta) {
    console.log(idTta)
    choferes = $.ajax({
        type: 'POST',
        url: "/PHP/Backend.php",
        data: { opcion: "cho", datos: idTta },
        global: false,
        async: false,
        success: function (response) {
            return response;
        }
    }).responseText;

    choferes = JSON.parse(choferes)
    console.log(choferes)
    tabla_seccion_choferes(choferes)
}

function tabla_seccion_choferes(choferes) {

    var tabla = document.getElementById('tbody-choferes')
    let ID_CHOFER
    let contador = 0;

    for (let i = 0; i < choferes.length; i++) {
        var row = document.createElement("tr")
        let td
        for (const property in choferes[i]) {
            td = document.createElement("td");
            if (choferes[i][property] == null || choferes[i][property] == '' || choferes[i][property] == undefined) {
                td.innerHTML = "-"
            } else if (property == "ID") {
                ID_CHOFER = choferes[i][property]
                td.innerHTML = choferes[i][property]
            } else if (property != "RUT") {
                td.innerHTML = choferes[i][property]
            } else {
                td.innerHTML = choferes[i][property]
            }
            row.appendChild(td);
        }
        //
        //agrego la fila a la tabla
        //
        let td2 = document.createElement("td");
        td2.innerHTML += '<div class="button-wrapper"><button id="' + ID_CHOFER + '" class="button tooltip left" data-tooltip="Ver Usuario" onclick="ver_usuario(' + ID_CHOFER + ')"><i class="far fa-eye"></i></button><button id="' + ID_CHOFER + '" class="button tooltip left" data-tooltip="Editar Usuario" onclick="editarUsuario(' + ID_CHOFER + ')"><i class="fas fa-edit"></i></button><button id="' + ID_CHOFER + '" class="button tooltip left" data-tooltip="Eliminar Usuario" onclick="eliminar_usuario(' + ID_CHOFER + ')"><i class="fas fa-trash-alt"></i></button></div>'
        row.appendChild(td2);
        tabla.appendChild(row);
    }
}
/*-------------------------------------------------------------------------------------------*/
//                                     Vehiculos                                             //
/*-------------------------------------------------------------------------------------------*/
let traer_vehiculos

function traerVehiculos() {
    traer_vehiculos = $.ajax({
        type: 'POST',
        url: "/PHP/Backend.php",
        data: { opcion: "vih" },
        global: false,
        async: false,
        success: function (response) {
            return response;
        }
    }).responseText;
    traer_vehiculos = JSON.parse(traer_vehiculos)
    console.log(traer_vehiculos)
    tablas_vehiculos();
}

function tablas_vehiculos() {
    for (var i = 0; i < traer_vehiculos.length; i++) {
        tabla_seccion_vehiculos(traer_vehiculos[i])
    }
}

function tabla_seccion_vehiculos(vehiculo) {
    var tabla = document.getElementById('tbody')
    var row = document.createElement("tr")
    let contador = 0;
    let ID_VEHICULO

    for (const property in vehiculo) {
        let td = document.createElement("td");

        if (property == "ID") {
            ID_VEHICULO = vehiculo[property]
            td.innerHTML = vehiculo[property]
        } else if (property == "RUT_EM" && vehiculo[property] == "1") {
            td.innerHTML = "NO"
        } else if (property == "RUT_EM" && vehiculo[property] == "2") {
            td.innerHTML = "SI"
        } else {
            td.innerHTML = vehiculo[property]
        }

        row.appendChild(td);
        contador++
    }
    /*
    let td = document.createElement("td");
    td.innerHTML += '<button id="'+ID_EMPRESA+'">Ver</button>'
    row.appendChild(td);
    */
    //
    //agrego la fila a la tabla
    //
    tabla.appendChild(row);
}

function filtros() {
    $(".checkboxs").on('click', function () {
        if (!$("#pax").prop("checked")) { $(".PAX").hide() } else { $(".PAX").show() }
        if (!$("#tta").prop("checked")) { $(".TTA").hide() } else { $(".TTA").show() }
        if (!$("#cho").prop("checked")) { $(".CHO").hide() } else { $(".CHO").show() }
        if (!$("#anf").prop("checked")) { $(".ANF").hide() } else { $(".ANF").show() }
        if (!$("#htl").prop("checked")) { $(".HTL").hide() } else { $(".HTL").show() }
        if (!$("#agt").prop("checked")) { $(".AGT").hide() } else { $(".AGT").show() }
        if (!$("#ase").prop("checked")) { $(".ASE").hide() } else { $(".ASE").show() }
        if (!$("#Cotizando").prop("checked")) { $(".1").hide() } else { $(".1").show() }
        if (!$("#Cotizado").prop("checked")) { $(".2").hide() } else { $(".2").show() }
        if (!$("#Aceptado").prop("checked")) { $(".3").hide() } else { $(".3").show() }
        if (!$("#Reconfirmado").prop("checked")) { $(".4").hide() } else { $(".4").show() }
        //if(!$("#").prop("checked")){ console.log("Oculto") }else{ console.log("Muestro") }
    });
}


function tabla_oportunidades() {
    $.ajax({
        type: 'POST',
        url: "/PHP/Tablas/tabla_viajes_panel.php",
        success: function (response) {
            console.log(response)
            $('#tbody-agenda').html(response)
        }
    });
}

function tabla_oportunidades_dashboard() {
    $.ajax({
        type: 'POST',
        url: "/PHP/Tablas/tabla_viajes_panel_principal.php",
        success: function (response) {
            console.log(response)
            if (response != 'null' && response != '') {
                $('#empty-viajes').hide();
                $('#tbody-viajes-dashboard').html(response)
            } else {
                console.log($('table[id=search-table-agenda]'));
                setTimeout(() => {
                    $('table[id=search-table-agenda]').css('display', 'none');
                    $('#empty-viajes').css('display', 'flex');
                }, 100);
            }
        }
    });
}

/*-------------------------------------------------------------------------------------------*/
//                                       Visitas                                             //
/*-------------------------------------------------------------------------------------------*/

function traigoVisitas() {
    visitas = $.ajax({
        type: 'POST',
        url: "/PHP/Backend.php",
        data: { opcion: "visitas" },
        global: false,
        async: false,
        success: function (response) {
            return response;
        }
    }).responseText;
    if (visitas == "null") {
        $('#visitas_hoy').html("0")
    } else { $('#visitas_hoy').html(visitas) }

}

/*-------------------------------------------------------------------------------------------*/
//                                       Actualizar                                          //
/*-------------------------------------------------------------------------------------------*/
var actualizar
function actualizar_panel(opc) {
    switch (opc) {
        case '0':
            console.log("parar")
            clearInterval(actualizar)
            break;
        case '1':
            crear_intervalo(1000)
            break;
        case '2':
            crear_intervalo(5000)
            break;
        case '3':
            crear_intervalo(10000)
            break;
        case '4':
            crear_intervalo(15000)
            break;
    }


}

function crear_intervalo(tiempo) {
    actualizar = setInterval(function () {
        traigoVisitas()
        actualizar_tablas()
    }, tiempo)
}

/*-------------------------------------------------------------------------------------------*/
//                                     Edicion                                             //
/*-------------------------------------------------------------------------------------------*/

function guardarEdicionUsuario(id, ciAnterior) {
    window.ciAnterior = ciAnterior;
    datos_Usuario = {
        "CI": ciAnterior,
        "CORREO": document.getElementById("CorreoEdicion").value,
        "NOMBRE": document.getElementById("NombreEdicion").value,
        "APELLIDO": document.getElementById("ApellidoEdicion").value,
        "DIRECCION": document.getElementById("DireccionEdicion").value,
        "BARRIO": document.getElementById("BarrioEdicion").value,
        "DEPARTAMENTO": document.getElementById("DepartamentoEdicion").value,
        "TELEFONO": document.getElementById("TelEdicion").value,
        "PIN": 1111,
        "RE-PIN": 1111
    };
    validacion = $.ajax({
        type: 'POST',
        url: "/PHP/Validaciones.php",
        data: { tipo: "USUARIO", datos: JSON.stringify(datos_Usuario) },
        global: false,
        async: false,
        success: function (response) {

        }
    }).responseText;
    console.log(validacion)
    if (confirmar_ci(validacion) == false) {
        validacion = "VALIDO"
    }
    if (validacion == "VALIDO") {
        $.ajax({
            type: "POST",
            url: "/PHP/llamadosSol.php",
            //aca mandarias la info necesaria para el xml de llamada
            data: { tipe: 0, ID: id, CI: ciAnterior, NOMBRE: datos_Usuario["NOMBRE"], APELLIDO: datos_Usuario["APELLIDO"], CORREO: datos_Usuario["CORREO"], DEPARTAMENTO: datos_Usuario["DEPARTAMENTO"], BARRIO: datos_Usuario["BARRIO"], DIRECCION: datos_Usuario["DIRECCION"], TEL: datos_Usuario["TELEFONO"] },
            success: function (response) {
                location.reload();
            }
        });
    } else if (validacion == "Err-1") {
        next = false;
        $('#mensaje-error').show();
        $('#mensaje-error').text("Debe completar todos los campos.");
    } else {
        marcar_errores(validacion)
    }
}

function cambiarPin(id, ciAnterior) {
    var pinAnterior = document.getElementById("password1").value;
    window.ciAnterior = ciAnterior;

    datos_Usuario = {
        "CI": ciAnterior,
        "CORREO": document.getElementById("CorreoEdicion").value,
        "NOMBRE": document.getElementById("NombreEdicion").value,
        "APELLIDO": document.getElementById("ApellidoEdicion").value,
        "DIRECCION": document.getElementById("DireccionEdicion").value,
        "BARRIO": document.getElementById("BarrioEdicion").value,
        "DEPARTAMENTO": document.getElementById("DepartamentoEdicion").value,
        "TELEFONO": document.getElementById("TelEdicion").value,
        "PIN": document.getElementById("password").value,
        "RE-PIN": document.getElementById("re-password").value
    };
    $.ajax({
        type: "POST",
        url: "/PHP/llamadosSol.php",
        //aca mandarias la info necesaria para el xml de llamada
        data: { tipe: 2, ID: id, PIN: pinAnterior },
        success: function (response) {
            if (response != "null") {
                validacion = $.ajax({
                    type: 'POST',
                    url: "/PHP/Validaciones.php",
                    data: { tipo: "USUARIO", datos: JSON.stringify(datos_Usuario) },
                    global: false,
                    async: false,
                    success: function (response) {

                    }
                }).responseText;
                console.log(validacion)
                if (confirmar_ci(validacion) == false) {
                    validacion = "VALIDO"
                }
                if (validacion == "VALIDO") {
                    $(".mensaje-error").hide();
                    $.ajax({
                        type: "POST",
                        url: "/PHP/llamadosSol.php",
                        //aca mandarias la info necesaria para el xml de llamada
                        data: { tipe: 1, ID: id, PINNUEVO: datos_Usuario["PIN"] },
                        success: function (response) {
                            if (pinAnterior != null) {
                                $('.button-pin').attr('disabled', true);
                                $('.button-pin').html('<span class="loader-register"><i class="fas fa-spinner"></i></span>');

                                setTimeout(() => {
                                    $('.button-pin').attr('disabled', false);
                                    $('.button-pin').html('<i class="fas fa-save"></i> Cambiar PIN');

                                    $('#mensaje-error-PIN').show();
                                    $('#mensaje-error-PIN').css('color', 'rgb(97, 150, 62)');
                                    $('#mensaje-error-PIN').text("PIN cambiado correctamente.");

                                }, 2000);

                            } else {
                                $('#mensaje-error-PIN').show();
                                $('#mensaje-error-PIN').text("Debe completar todos los campos.");
                            }
                        }
                    });
                } else if (validacion == "Err-1") {
                    next = false;
                    $('#mensaje-error-PIN').show();
                    $('#mensaje-error-PIN').text("Debe completar todos los campos.");
                } else { marcar_errores(validacion) }
            } else {
                $('#mensaje-error-PIN').show();
                $('#mensaje-error-PIN').text("Pin anterior incorrecto.");
            }
        }
    });
}

function cambiarPinAdmin(id, ciAnterior) {
    window.ciAnterior = ciAnterior;

    datos_Usuario = {
        "CI": ciAnterior,
        "CORREO": document.getElementById("CorreoEdicion").value,
        "NOMBRE": document.getElementById("NombreEdicion").value,
        "APELLIDO": document.getElementById("ApellidoEdicion").value,
        "DIRECCION": document.getElementById("DireccionEdicion").value,
        "BARRIO": document.getElementById("BarrioEdicion").value,
        "DEPARTAMENTO": document.getElementById("DepartamentoEdicion").value,
        "TELEFONO": document.getElementById("TelEdicion").value,
        "PIN": document.getElementById("password").value,
        "RE-PIN": document.getElementById("re-password").value
    };
    validacion = $.ajax({
        type: 'POST',
        url: "/PHP/Validaciones.php",
        data: { tipo: "USUARIO", datos: JSON.stringify(datos_Usuario) },
        global: false,
        async: false,
        success: function (response) {

        }
    }).responseText;
    console.log(validacion)
    if (confirmar_ci(validacion) == false) {
        validacion = "VALIDO"
    }
    if (validacion == "VALIDO") {
        location.reload();
    } else if (validacion == "Err-1") {
        next = false;
        $('#mensaje-error-PIN').show();
        $('#mensaje-error-PIN').text("Debe completar todos los campos.");
    } else { marcar_errores(validacion) }
    ;
}

function guardarEdicionEmpresa(rut) {

    let data_ajax

    if ($("#NmEdicion").val() == undefined && $("#CaEdicion").val() == undefined) {

        datos_Empresa = {
            "RUT": document.getElementById("rut_empresa").value,
            "NOMBRE_COMERCIAL": document.getElementById("NcEdicion").value,
            "RAZON_SOCIAL": document.getElementById("RsEdicion").value,
            "NO_TTA_NO_CHO": 1
        };
        data_ajax = { tipe: 5, RUTANTERIOR: rut, RUT: datos_Empresa['RUT'], NOMBRE: datos_Empresa["NOMBRE_COMERCIAL"], RS: datos_Empresa["RAZON_SOCIAL"], NM: datos_Empresa["NUMERO_MTOP"], CM: datos_Empresa["PASSWORD_MTOP"] };
    } else if ($("#NmEdicion").val() != undefined && $("#CaEdicion").val() == undefined) {
        datos_Empresa = {
            "RUT": document.getElementById("rut_empresa").value,
            "NOMBRE_COMERCIAL": document.getElementById("NcEdicion").value,
            "RAZON_SOCIAL": document.getElementById("RsEdicion").value,
            "NUMERO_MTOP": document.getElementById("NmEdicion").value,
            "PASSWORD_MTOP": document.getElementById("password").value,
            "VEHICULOS": {}
        };
        data_ajax = { tipe: 5, RUTANTERIOR: rut, RUT: datos_Empresa['RUT'], NOMBRE: datos_Empresa["NOMBRE_COMERCIAL"], RS: datos_Empresa["RAZON_SOCIAL"], NM: datos_Empresa["NUMERO_MTOP"], CM: datos_Empresa["PASSWORD_MTOP"] };

    } else {
        datos_Empresa = {
            "RUT": document.getElementById("rut_empresa").value,
            "NOMBRE_COMERCIAL": document.getElementById("NcEdicion").value,
            "RAZON_SOCIAL": document.getElementById("RsEdicion").value,
            "NUMERO_MTOP": document.getElementById("NmEdicion").value,
            "PASSWORD_MTOP": document.getElementById("password").value,
            "CHOFERES_SUB": document.getElementById("CaEdicion").value,
            "VEHICULOS": {}
        };
        data_ajax = { tipe: 5, RUTANTERIOR: rut, RUT: datos_Empresa['RUT'], NOMBRE: datos_Empresa["NOMBRE_COMERCIAL"], RS: datos_Empresa["RAZON_SOCIAL"], CA: document.getElementById("CaEdicion").value, NM: datos_Empresa["NUMERO_MTOP"], CM: datos_Empresa["PASSWORD_MTOP"] };
    }


    console.log(datos_Empresa);
    validacion = $.ajax({
        type: 'POST',
        url: "/PHP/Validaciones.php",
        data: { tipo: "EMP", datos: JSON.stringify(datos_Empresa) },
        global: false,
        async: false,
        success: function (response) {
        }
    }).responseText;
    if (confirmar_rut(validacion) == false) {
        validacion = "VALIDO"
    }
    if (validacion == "VALIDO") {
        $(".mensaje-error").hide();
        $.ajax({
            type: "POST",
            url: "/PHP/llamadosSol.php",
            //aca mandarias la info necesaria para el xml de llamada
            data: data_ajax,
            success: function (response) {
                editarEmpresa(rut);
            }
        });
    }
    else if (validacion == "Err-1") {
        $("#mensaje-error").show();
        $('#mensaje-error').text("Debe completar todos los campos.");
    } else { marcar_errores(validacion) }
}

function editarUsuario(id) {
    location.href = "/Profile/Editar/" + id;
}


function verEmpresa(rut) {
    location.href = "/Profile/Empresa/" + rut;
}

function editarEmpresa(rut) {
    location.href = "/Profile/Empresa/Editar/" + rut;
}

function eliminarEmpresa(rut) {
    $.ajax({
        type: "POST",
        url: "/PHP/llamadosSol.php",
        data: { tipe: 3, RUT: rut },
        success: function () {
            location.reload();
        }
    });
}

function eliminar_usuario(id) {
    $.ajax({
        type: "POST",
        url: "/PHP/llamadosSol.php",
        data: { tipe: 4, ID: id },
        success: function () {
            location.reload();
        }
    });
}

function marcar_errores(resultado_validacion) {

    console.log(resultado_validacion)
    let resultado = JSON.parse(resultado_validacion)

    for (const property in resultado) {
        switch (property) {
            case "CI":
                if (resultado[property] == 0) {
                    $('#CI').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("C.I no válida.");
                } else if (resultado[property] == 2) {
                    $('#CI').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("C.I ya registrada.");
                }

                break;
            case "NOMBRE":
                if (resultado[property] == 0) {
                    $('#nombre').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("El nombre no debe contener espacios ni caracteres especiales.");
                }

                break;
            case "APELLIDO":
                if (resultado[property] == 0) {
                    $('#apellido').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("El apellido no debe contener espacios ni caracteres especiales.");
                }

                break;
            case "MAIL":
                if (resultado[property] == 0) {
                    $('#correo').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("Correo Electrónico no válido.");
                }

                break;
            case "DIRECCION":
                if (resultado[property] == 0) {
                    $('#direccion').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("Dirección no válida.");
                }

                break;
            case "BARRIO":
                if (resultado[property] == 0) {
                    $('#barrio').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("Barrio no válido.");
                }

                break;
            case "DEPARTAMENTO":
                if (resultado[property] == 0) {
                    $('#departamento').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("Departamento no válido.");
                }

                break;
            case "TELEFONO":
                if (resultado[property] == 0) {
                    $('#numero_telefono').css('border-bottom', '1px solid #ff635a')
                    $('#numero_telefono_hotel').css('border-bottom', '1px solid #ff635a')
                    $('#mensaje-error').text("Teléfono no válido.");
                }

                break;
            case "RUT":
                if (resultado[property] == 0) {
                    $('#rutt').css('border-bottom', '1px solid #ff635a')
                    $('#rut_usuario').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("RUT no válido, debe contener 12 caracteres.");
                }
                break;
            case "NOMBRE_COMERCIAL":
                if (resultado[property] == 0) {
                    $('#nombre_comercial').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("Nombre comercial no válido.");
                }

                break;
            case "RAZON_SOCIAL":
                if (resultado[property] == 0) {
                    $('#razon_social').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("Debe seleccionar una razón social.");
                }

                break;
            case "MTOP":
                if (resultado[property] == 0) {
                    $('#numero_mtop').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("N° MTOP no válido.");
                }

                break;
            case "PASSWORD_MTOP":
                if (resultado[property] == 0) {
                    $('#password_mtop').css('border-bottom', '1px solid #ff635a');
                    $('#mensaje-error').text("Contraseña MTOP no válida.");
                }
                break;
        }
        if (resultado['PIN'] == 0) {
            $('#mensaje-error-PIN').show();
            $('#mensaje-error-PIN').text("Los PINS deben coincidir.");
            $('#password').css('border-bottom', '1px solid #ff635a')
        }
        else if (resultado['PIN-MATCH'] == 0) {
            $('#mensaje-error-PIN').show();
            $('#mensaje-error-PIN').text("Los PINS deben coincidir.");
            $('#password').css('border-bottom', '1px solid #ff635a')
            $('#re-password').css('border-bottom', '1px solid #ff635a')
        }
    }
}

function confirmar_ci(validacion) {
    if (validacion != "VALIDO") {
        if (validacion != "Err-1") {
            errores = JSON.parse(validacion);
            if (errores["CI"] == 2) {
                for (const property in errores) {
                    if (errores[property] == 1 && property != "CI") {
                        error = false;
                    } else {
                        if (property != "CI") {
                            error = true;
                            return;
                        }
                    }
                }
            } else {
                error = true;
            }
        } else {
            error = true;
        }
    } else {
        error = true;
    }
    return error;
}

function confirmar_rut(validacion) {
    if (validacion != "VALIDO") {
        if (validacion != "Err-1") {
            errores = JSON.parse(validacion);
            if (errores["RUT"] == 2) {
                for (const property in errores) {
                    if (errores[property] == 1 && property != "RUT") {
                        error = false;
                    } else {
                        if (property != "RUT") {
                            error = true;
                            return;
                        }
                    }
                }
            } else {
                error = true;
            }
        } else {
            error = true;
        }
    } else {
        error = true;
    }
    return error;
}

/*-------------------------------------------------------------------------------------------*/
//                              Manejo de viajes                                             //
/*-------------------------------------------------------------------------------------------*/
function closeModal() {
    $('#modal').hide();
    $('#modal').html("");
}

function eliminar_viajes(id, step) {
    switch (step) {
        case 1:
            $.ajax({
                type: "POST",
                url: "https://www.salioviaje.com.uy/Panel/modal.php",
                data: { opcion: 1, data: id },
                success: function (response) {
                    console.log(response);
                    $('#modal').css('display', 'flex');
                    $('#modal').html(response);
                }
            });
            break;
        case 2:
            $.ajax({
                type: "POST",
                data: { opcion: "eliminar_viajes", id: id },
                url: "https://www.salioviaje.com.uy/PHP/Backend.php",
                success: function (response) {
                    console.log(response);
                    location.reload();
                }
            });
            break;
    }
}

//https://www.salioviaje.com.uy/Editar_Oportunidad/
function abrir_editar_oportunidad(id) {
    window.location = 'https://www.salioviaje.com.uy/Editar_Oportunidad/' + id;
}

function editar_oportunidad(id) {
    let datos = {
        'DESCUENTO': $("#desc_oport2").val(),
        'FECHA': $("#fecha_2").val(),
        'ORIGEN': $("#origen_2").val(),
        'DESTINO': $("#destino_2").val(),
        'PRECIO': $("#precioref_2").val()
    }

    console.log(datos)

    validacion = $.ajax({
        type: 'POST',
        url: "/PHP/Validaciones.php",
        data: { tipo: "E-OPORUTNIDADES", datos: JSON.stringify(datos) },
        global: false,
        async: false,
        success: function (response) {
        }
    }).responseText;

    console.log(validacion)
    if (verificar_fecha(datos['FECHA']) == true) {
        if (validacion == "VALIDO") {
            $.ajax({
                type: "POST",
                data: { opcion: "editar-oportunidad", datos: JSON.stringify(datos), id: id },
                url: "https://www.salioviaje.com.uy/PHP/Backend.php",
                success: function (response) {
                    window.location = 'https://www.salioviaje.com.uy/Dashboard';
                }
            })
        } else {
            console.log("No valido...")
        }
    } else {
        console.log("Fecha no valida")
    }
}

function verificar_fecha(fecha) {
    var fecha = fecha.split("T");
    var hora_salida = fecha[1].split(":");
    fecha = fecha[0].split("-");

    var fecha_actual = new Date();
    var dd = String(fecha_actual.getDate()).padStart(2, '0');
    var mm = String(fecha_actual.getMonth() + 1).padStart(2, '0');
    var yyyy = fecha_actual.getFullYear();
    var hh = String(fecha_actual.getHours());
    var min = String(fecha_actual.getMinutes());
    var fecha_viaje = new Date(fecha[0], fecha[1], fecha[2], hora_salida[0], hora_salida[1])
    var fecha_actual = new Date(yyyy, mm, dd, hh, min)

    if (fecha_viaje > fecha_actual) {
        return true
    } else { return false }
}

function preferenciasVehiculos(id, step, matricula) {
    let data = [id, matricula];
    console.log(data);

    let preferencias = {
        "MATRICULA": matricula,
        "NOCTURNO": $("#preferenciaNocturno").val(),
        "FIESTAS": $("#preferenciaFiestas").val(),
        "DIA_LIBRE": $("#preferenciaDiaLibre").val(),
        "PRECIO": $("#preferenciaPrecioCoche").val()
    }

    console.log(preferencias)

    switch (step) {
        case 1:
            $.ajax({
                type: "POST",
                url: "https://www.salioviaje.com.uy/Panel/modal.php",
                data: { opcion: 2, data: data },
                success: function (response) {
                    console.log(response);
                    $('#modal').css('display', 'flex');
                    $('#modal').html(response);
                }
            });
            break;
        case 2:
            $.ajax({
                type: "POST",
                url: "https://www.salioviaje.com.uy/PHP/procedimientosForm.php",
                data: { tipo: "guardarPreferencias", preferencias: JSON.stringify(preferencias) },
                success: function (response) {
                    console.log(response);
                    closeModal()
                }
            });
            break;
    }
}

/*
    MTOP VIAJES
*/

function mtop_viaje(numero_mtop, pass_mtop, matricula, id_viaje) {

    datos_viaje = {
        "NRO_MTOP": numero_mtop,
        "PASS_MTOP": pass_mtop,
        "MATRICULA": matricula,
        "ID": id_viaje,
        "ORIGEN_TRAMO_1": $("#origen_1").val(),
        "DESTINO_TRAMO_1": $("#destino_1").val(),
        "ORIGEN_TRAMO_2": $("#origen_2").val(),
        "DESTINO_TRAMO_2": $("#destino_2").val(),
        "DISTANCIA": $("#distancia-input").val(),
        "FECHA_SALIDA": $("#fecha_1").val(),
        "FECHA_LLEGADA": $("#fecha_2").val(),
    }
    
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/Mail/mail-ViajeMTOP.php",
        data: { datos_viaje: JSON.stringify(datos_viaje) },
        success: function (response) {
            console.log(response);
        },
        complete: function () {
            actualizar_mtop(1, id_viaje)
            window.location = 'https://www.salioviaje.com.uy/Dashboard';        
        }
    });

}

function estadoMTOP(id) {
    if ($(".select-estado-"+id).val() == 1) {
        actualizar_mtop(3, id)
    } else {
        actualizar_mtop(2, id)
    }
}

function actualizar_mtop(estado, id) {
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/PHP/procedimientosForm.php",
        data: { tipo: "actualizar_mtop", estado: estado, id: id },
        success: function (response) {
            console.log(response);
        }
    });
}

function modal_contacto(nombre_tta, telefono_tta) {
    var data = [nombre_tta, telefono_tta]
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/Panel/modal.php",
        data: { opcion: 4, data: data },
        success: function (response) {
            console.log(response);
            $('#modal').css('display', 'flex');
            $('#modal').html(response);
        }
    });
}

function crear_oportunidad(id) {
    window.location.href = "https://www.salioviaje.com.uy/AddOportunidad/" + id;
}

function agregar_oportunidad_a_viaje(matricula, idviaje_de_solicitud) {
    let datos = {
        "DESCUENTO_OPORTUNIDAD": $("#desc_oport2").val(),
        "FECHA": $("#fecha_2").val().replace("T", " "),
        "ORIGEN": $("#origen_2").val(),
        "DESTINO": $("#destino_2").val(),
        "PRECIO_REFERENCIA": $("#precioref_2").val(),
        "DISTANCIA": $("#distancia_2").val(),
        "CANTIDAD_DE_PASAJEROS": $("#cantidad_pasajeros_2").val(),
        "MATRICULA": matricula
    }

    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/PHP/procedimientosForm.php",
        data: { tipo: "agregar_oportunidad_a_viaje", datos: JSON.stringify(datos) },
        success: function (response) {
            vincular_tramos_agregar_oportunidad(idviaje_de_solicitud, response)
            vincular_tramos_agregar_oportunidad(response, idviaje_de_solicitud)
        }
    });
}

function vincular_tramos_agregar_oportunidad(tramo_vinculado, id) {
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/PHP/procedimientosForm.php",
        data: { tipo: "registrar_tramos_vinculados", id: id, id_tramo_vinculado: tramo_vinculado },
        success: function (response) {
            console.log(response);
        }
    });
}