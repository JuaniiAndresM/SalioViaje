$(document).ready(function () {
    $('.progress-bar').hide();
    $('.vehiculos-wrapper').hide();
    steps(1);
    Empresas()

    $("#pax-register").on('click', function() {
        register_form($('#select_users').val())
    });
    $("#finalizar-registro-TTA").on('click', function() {
        register_form($('#select_users').val())
    });
    $("#finalizar_empresa").on('click', function() {
        crear_empresa();
        reset_vehicles();
    });
    $("#step-next").on('click', function() {
        register_form($('#select_users').val())
    });

    let inputs = document.querySelectorAll("input");
        inputs.forEach(box => {
        box.addEventListener('keyup', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();

                switch(step){
                    case 2:
                        document.getElementById("step-next").click();
                        break;

                    case 3:
                        document.getElementById("add-vehicle").click();
                        break;
                }
                
            }
        });
    });
});

var step = 1;



function volver(){
    step--;
    steps(step);
}

function next(){
    step++;
    steps(step);
}

function steps(step){

    switch(step){
        case 1:         
            $('.progress-bar').hide();
            $('#step_1').show();
            $('#step_2').hide();
            $('#step_3').hide();
            $('#step_4').hide();
            $('#step_5').hide();

            $('.vehiculos-wrapper').hide();
            break;

        case 2:
            $('.progress').css('width', '0%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');

            var user = $('#select_users').val();
            select_user(user);

            if(user != null){
                $('#step_1').hide();
                $('#step_2').show();
                $('#step_3').hide();
                $('#step_4').hide();
                $('#step_5').hide();
            }

            $('.vehiculos-wrapper').hide();
            break;

        case 3:
            $('.progress').css('width', '50%');
            
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');

            $('#step_1').hide();
            $('#step_2').hide();
            $('#step_3').show();
            $('#step_4').hide();
            $('#step_5').hide();

            $('.vehiculos-wrapper').hide();
            break;

        case 4:
            $('.progress').css('width', '100%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');

            $('#step_1').hide();
            $('#step_2').hide();
            $('#step_3').hide();
            $('#step_4').show();
            $('#step_5').hide();

            $('.vehiculos-wrapper').show();
            break;

        case 5:
            $('.progress').css('width', '100%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');

            $('#step_1').hide();
            $('#step_2').hide();
            $('#step_3').hide();
            $('#step_4').hide();
            $('#step_5').show();

            $('.vehiculos-wrapper').hide();
            break;
    }
}

function select_user(user){

    $('.progress-bar').hide();
    var user = $('#select_users').val();

    $('#telefono-hotel').hide();
    $('#supervisor').hide();
    $('#nombrehotel').hide();
    $('#direccionhotel').hide();

    $('#direccion-input').show();
    $('#barrio-input').show();
    $('#departamento-input').show();
    $('#telefono-input').show();

    switch(user){
        case "1":
            $('.progress-bar').hide();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').show();
            $('#rut').hide();
            $('#contratista').hide();

            $('#pax-register').show();
            $('#step-next').hide();
            break;

        case "2":
            $('.progress-bar').show();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').show();
            $('#rut').hide();
            $('#contratista').hide();

            $('#pax-register').hide();
            $('#step-next').show();
            break;

        case "3":
            $('.progress-bar').show();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').hide();
            $('#rut').show();
            $('#contratista').show();
            
            $('#pax-register').hide();
            $('#step-next').show();
            break;

        case "4":
            $('.progress-bar').hide();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').hide();
            $('#rut').show();
            $('#contratista').hide();
            
            $('#pax-register').show();
            $('#step-next').hide();
            break;

        case "5":
            $('.progress-bar').hide();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').show();
            $('#rut').hide();
            $('#contratista').hide();
            
            $('#telefono-hotel').show();
            $('#supervisor').show();
            $('#nombrehotel').show();
            $('#direccionhotel').show();
            $('#direccion-input').hide();
            $('#barrio-input').hide();
            $('#departamento-input').hide();
            $('#telefono-input').hide();
            
            $('#pax-register').show();
            $('#step-next').hide();
            break;

        default:
            step--;
            break;
    }
}

function new_company(){
    step = 3;
    steps(3);

    $('#company_volver').hide();
    $('#rutt').val('');
    $('#nombre_comercial').val('');
    $('#razon_social').val('');
    $('#numero_mtop').val('');
    $('#password_mtop').val('');
    $('#matricula').val('');
    $('#marca').val('');
    $('#modelo').val('');
    $('#combustible').val('');
    $('#capacidad_pasajeros').val('');
    $('#capacidad_equipaje').val('');
    $('#pet_friendly').val('0');
}

function reset_vehicle_inputs(){
    $('#matricula').val('');
    $('#marca').val('');
    $('#modelo').val('');
    $('#combustible').val('');
    $('#capacidad_pasajeros').val('');
    $('#capacidad_equipaje').val('');
    $('#pet_friendly').val('0');
}

function reset_vehicles(){
    $('.vehiculos').html('<div id="no-vehicle"><p>No hay vehiculos agregados.</p></div>');
    $('#no-vehicle').show();
}

function passwd(){

    if($('#passeye').hasClass('show')){
        $('#passwd').attr('type', 'password');
        $('#passeye').html('<i class="fas fa-eye-slash"></i>');
        $('#passeye').attr('class','hidden');
    }else{
        $('#passwd').attr('type', 'text');
        $('#passeye').html('<i class="fas fa-eye"></i>');
        $('#passeye').attr('class','show');
    }
    
}
function passwd2(){

    if($('#passeye2').hasClass('show')){
        $('#passwd2').attr('type', 'password');
        $('#passeye2').html('<i class="fas fa-eye-slash"></i>');
        $('#passeye2').attr('class','hidden');
    }else{
        $('#passwd2').attr('type', 'text');
        $('#passeye2').html('<i class="fas fa-eye"></i>');
        $('#passeye2').attr('class','show');
    }
    
} 

/*-------------------------------------------------------------------------------------------*/
//                                     Register                                              //
/*-------------------------------------------------------------------------------------------*/

let ID_USUARIO;
let datos_Usuario;
let datos_Empresa;
let datos_Vehiculo;
let empresas = new Array();
let vehiculos = new Array();

function register_form(opcion){

       switch(opcion){
        case "1":
            datos_Usuario = {
                "CI": document.getElementById('CI').value,
                "CORREO": document.getElementById('correo').value,
                "NOMBRE": document.getElementById('nombre').value,
                "APELLIDO": document.getElementById('apellido').value,
                "DIRECCION": document.getElementById('direccion').value,
                "BARRIO": document.getElementById('barrio').value,
                "DEPARTAMENTO": document.getElementById('departamento').value,
                "TELEFONO": document.getElementById('numero_telefono').value,
                "PIN": document.getElementById('password').value,
                "RE-PIN": document.getElementById('re-password').value
            };
            if (validacion("USUARIO-PAX-TTA",datos_Usuario)) {
                $.ajax({
                    type: "POST",
                    url: "../PHP/procedimientosForm.php",
                    data: { tipo:opcion, datos:JSON.stringify(datos_Usuario) },
                    success: function (response) {
                        console.log(response)
                        ID_USUARIO = response;
                    },
                });
            }else{ console.log("No valido...") }
            break;
        case "2":
            datos_Usuario = {
                "CI": document.getElementById('CI').value,
                "CORREO": document.getElementById('correo').value,
                "NOMBRE": document.getElementById('nombre').value,
                "APELLIDO": document.getElementById('apellido').value,
                "DIRECCION": document.getElementById('direccion').value,
                "BARRIO": document.getElementById('barrio').value,
                "DEPARTAMENTO": document.getElementById('departamento').value,
                "TELEFONO": document.getElementById('numero_telefono').value,
                "PIN": document.getElementById('password').value,
                "RE-PIN": document.getElementById('re-password').value
            };
            
            if (validacion("USUARIO-PAX-TTA",datos_Usuario)) {
                if (empresas.length != 0) {
                    console.log("valido...")
                    $.ajax({
                        type: "POST",
                        url: "../PHP/procedimientosForm.php",
                        data: { tipo:opcion,idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas) },
                        success: function (response) {
                            console.log(response)
                        },
                    });
                } else {next()}
            }else{ console.log("No valido...") }
            break;
        case "3":
            datos_Usuario = {
                "RUT": document.getElementById('rut_usuario').value,
                "CORREO": document.getElementById('correo').value,
                "NOMBRE": document.getElementById('nombre').value,
                "APELLIDO": document.getElementById('apellido').value,
                "DIRECCION": document.getElementById('direccion').value,
                "AGENCIA_CONTRATISTA": document.getElementById('empresas').value,
                "BARRIO": document.getElementById('barrio').value,
                "DEPARTAMENTO": document.getElementById('departamento').value,
                "TELEFONO": document.getElementById('numero_telefono').value,
                "PIN": document.getElementById('password').value,
                "RE-PIN": document.getElementById('re-password').value
            };
            if (validacion("USUARIO-CHO",datos_Usuario)) {
                 if (empresas.length != 0) {
                    $.ajax({
                        type: "POST",
                        url: "../PHP/procedimientosForm.php",
                        data: { tipo:opcion,idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas) },
                        success: function (response) {
                            console.log(response)
                        },
                    });
                } else {next()}
            }else{ console.log("No valido...") }
            break;
        case "4":
            datos_Usuario = {
                "RUT": document.getElementById('rut_usuario').value,
                "CORREO": document.getElementById('correo').value,
                "NOMBRE": document.getElementById('nombre').value,
                "APELLIDO": document.getElementById('apellido').value,
                "DIRECCION": document.getElementById('direccion').value,
                "BARRIO": document.getElementById('barrio').value,
                "DEPARTAMENTO": document.getElementById('departamento').value,
                "TELEFONO": document.getElementById('numero_telefono').value,
                "PIN": document.getElementById('password').value,
                "RE-PIN": document.getElementById('re-password').value
            };
            if (validacion("USUARIO-ANF",datos_Usuario)) {
                $.ajax({
                    type: "POST",
                    url: "../PHP/procedimientosForm.php",
                    data: { tipo:opcion, datos:JSON.stringify(datos_Usuario) },
                    success: function (response) {
                        console.log(response)
                },
            });
            }else{ console.log("No valido...") }
            break;
        case "5":
            datos_Hotel = {
                "CI": document.getElementById('CI').value,
                "CORREO": document.getElementById('correo').value,
                "NOMBRE": document.getElementById('nombre').value,
                "APELLIDO": document.getElementById('apellido').value,
                "TELEFONO": document.getElementById('numero_telefono_hotel').value,
                "SUPERVISOR": document.getElementById('es_supervisor').value,
                "NOMBRE_HOTEL": document.getElementById('nombre-hotel').value,
                "DIRECCION_HOTEL": document.getElementById('direccion-hotel').value,
                "PIN": document.getElementById('password').value,
                "RE-PIN": document.getElementById('re-password').value
            };
            if (validacion("USUARIO-HTL",datos_Hotel)) {
                $.ajax({
                    type: "POST",
                    url: "../PHP/procedimientosForm.php",
                    data: { tipo:opcion, datos:JSON.stringify(datos_Hotel) },
                    success: function (response) {
                        console.log(response)
                    },
                });
            }else{ console.log("No valido...") }
            break;
    }
    window.location = "/SalioViaje/Form/Success.html";
}

function add_vehicle(){
    datos_Vehiculo = {
        "MATRICULA": document.getElementById('matricula').value.toUpperCase(),
        "MARCA": document.getElementById('marca').value,
        "MODELO": document.getElementById('modelo').value,
        "COMBUSTIBLE": document.getElementById('combustible').value,
        "CAPACIDAD_PASAJEROS": document.getElementById('capacidad_pasajeros').value,
        "CAPACIDAD_EQUIPAJE": document.getElementById('capacidad_equipaje').value,
        "PET_FRIENDLY": document.getElementById('pet_friendly').value
    };

    if (validacion("VEHICULO",datos_Vehiculo)) {        
        vehiculos.push(datos_Vehiculo)
        $.ajax({
            type: "POST",
            url: "../PHP/agregarVehiculo.php",
            data: {datos:JSON.stringify(datos_Vehiculo) },
            success: function (response) {
                $('.vehiculos').append(response);
                $('#no-vehicle').hide();
                reset_vehicle_inputs();
            },
        });
    }else{ console.log("No valido...") }

    /*

    */
}

function crear_empresa(){
    datos_Empresa = {
        "RUT": document.getElementById('rutt').value,
        "NOMBRE_COMERCIAL": document.getElementById('nombre_comercial').value,
        "RAZON_SOCIAL": document.getElementById('razon_social').value,
        "NUMERO_MTOP": document.getElementById('numero_mtop').value,
        "PASSWORD_MTOP": document.getElementById('password_mtop').value,
        "VEHICULOS": vehiculos
    };
    if (validacion("EMPRESA",datos_Empresa)) {        
        empresas.push(datos_Empresa)
        datos_Empresa = {};
        vehiculos = [];
        next();
    }else{ console.log("No valido...") }
}

function Empresas(){
    $.ajax({
        type: "POST",
        url: "../PHP/procedimientosForm.php",
        data: {tipo: "empresas"},
        success: function (response) {
            let empresas = JSON.parse(response);
            var selectEmpresas = document.getElementById('empresas');
            $("#empresas").empty().append($("<option></option>").attr({"value": 0,"selected": true, 'disabled': true, 'hidden': true}).text('Agencia Contratista'));
            for (var i = 0; i < empresas.length; i++){
            var opt = document.createElement('option');
            opt.value = empresas[i]["RUT"];
            opt.text = empresas[i]["NOMBRE_COMERCIAL"]+" "+empresas[i]["RAZON_SOCIAL"];
            selectEmpresas.appendChild(opt);
            }
        }
    });
}

/*-------------------------------------------------------------------------------------------*/
//                                     Log in                                                //
/*-------------------------------------------------------------------------------------------*/

function login(){

    let usuario = document.getElementById('usuario').value;
    let pin = document.getElementById('passwd').value;

    $.ajax({
        type: "POST",
        url: "../PHP/procedimientosForm.php",
        data: {tipo:"login", usuario:usuario, pin:pin},
        success: function (response) {
            if (response != '') {
                sessionStorage.setItem('usuario', response);
                window.location = "../Panel/Dashboard.html";
            }else{
                console.log("Usuario o contraseña incorrectos...");
            }
        },
    });
}

/*-------------------------------------------------------------------------------------------*/
//                                   Validacion                                              //
/*-------------------------------------------------------------------------------------------*/

function validacion(TIPO,DATOS){
    let validacion;
    let VALIDO = false;

    switch(TIPO){
        case "USUARIO-PAX-TTA":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "../PHP/Validaciones.php",
                                data: {tipo:"PAX-TTA",datos:JSON.stringify(DATOS)},
                                global: false,
                                async:false,
                                success: function(response) {
                                    return response;
                                }
                            }).responseText;
                console.log(validacion)
                if (validacion == "VALIDO") {VALIDO = true}
            break;
        case "USUARIO-CHO":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "../PHP/Validaciones.php",
                                data: {tipo:"CHO",datos:JSON.stringify(DATOS)},
                                global: false,
                                async:false,
                                success: function(response) {
                                    return response;
                                }
                            }).responseText;
                if (validacion == "VALIDO") {VALIDO = true}
            break;
        case "EMPRESA":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "../PHP/Validaciones.php",
                                data: {tipo:"EMP",datos:JSON.stringify(DATOS)},
                                global: false,
                                async:false,
                                success: function(response) {
                                    return response;
                                }
                            }).responseText;
                console.log(validacion)
                if (validacion == "VALIDO") {VALIDO = true}
            break;
        case "VEHICULO":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "../PHP/Validaciones.php",
                                data: {tipo:"VIH",datos:JSON.stringify(DATOS)},
                                global: false,
                                async:false,
                                success: function(response) {
                                    return response;
                                }
                            }).responseText;
                console.log(validacion)
                if (validacion == "VALIDO") {VALIDO = true}
            break;
        case "USUARIO-HTL":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "../PHP/Validaciones.php",
                                data: {tipo:"HTL",datos:JSON.stringify(DATOS)},
                                global: false,
                                async:false,
                                success: function(response) {
                                    return response;
                                }
                            }).responseText;
                if (validacion == "VALIDO") {VALIDO = true}
            break;
        case "USUARIO-ANF":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "../PHP/Validaciones.php",
                                data: {tipo:"ANF",datos:JSON.stringify(DATOS)},
                                global: false,
                                async:false,
                                success: function(response) {
                                    return response;
                                }
                            }).responseText;
                console.log(validacion)
                if (validacion == "VALIDO") {VALIDO = true}
            break;
    }

    return VALIDO
}