$(document).ready(function () {
    $('#mensaje-error1').hide();
    $('#mensaje-error2').hide();
    $('#mensaje-error3').hide();
    $('#mensaje-error4').hide();
    $('#mensaje-error5').hide();
    $('.progress-bar').hide();
    $('.vehiculos-wrapper').hide();
    $('.progress-bar2').hide();

    steps(1);
    Empresas()

    $("#pax-register").on('click', function() {
        register_form($('#select_users').val())
    });
    $("#finalizar-registro-TTA").on('click', function() {
        register_form($('#select_users').val())
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
            $('.progress-bar2').hide();
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
            $('.progress2').css('width', '100%');
            
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');

            $('#step_1').hide();
            $('#step_2').hide();
            $('#step_3').show();
            $('#step_4').hide();
            $('#step_5').hide();
            $('#add-vehicle').show();
            $('#finalizar_empresa').hide();

            var user = $('#select_users').val();

            if(user == 4 || user == 7){
                $('#add-vehicle').hide();
                $('#finalizar_empresa').show();
            }

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
    $('.progress-bar2').hide();

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
            $('.progress-bar2').show();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').hide();
            $('#rut').show();
            $('#contratista').hide();
            
            $('#pax-register').hide();
            $('#step-next').show();
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

        case "6":
            $('.progress-bar').hide();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').show();
            $('#rut').hide();
            $('#contratista').hide();

            $('#pax-register').show();
            $('#step-next').hide();
            break;

        case "7":
            $('.progress-bar').hide();
            $('#step_1').hide();

            $('#step_2').show();
            $('#ci').hide();
            $('#rut').show();
            $('#contratista').hide();
            
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
            if (validacion("USUARIO-PAX-TTA",datos_Usuario) == true) {
                console.log("registra usuario")
                $.ajax({
                    type: "POST",
                    url: "../PHP/procedimientosForm.php",
                    data: { tipo:opcion, datos:JSON.stringify(datos_Usuario) },
                    success: function (response) {
                        console.log(response)
                        window.location = "/SalioViaje/Form/Success.html";
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
            
            $.ajax({
                    type: "POST",
                    url: "../PHP/procedimientosForm.php",
                    data: { tipo:opcion, datos_Usuario:datos_Usuario, empresas:null },
                    success: function (response) {
                        ID_USUARIO = response;
                },
            });

            if (validacion("USUARIO-PAX-TTA",datos_Usuario)) {
                console.log("hola")
                console.log(empresas)
                console.log(vehiculos)
                if (empresas.length != 0 && ID_USUARIO != null) {
                    console.log("hola")
                    $.ajax({
                        type: "POST",
                        url: "../PHP/procedimientosForm.php",
                        data: { tipo:opcion,idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas) },
                        success: function (response) {
                            console.log(response)
                            window.location = "/SalioViaje/Form/Success.html";
                        },
                    });
                } else { next() }
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
                 if (empresas.length != 0  && ID_USUARIO != null) {
                    $.ajax({
                        type: "POST",
                        url: "../PHP/procedimientosForm.php",
                        data: { tipo:opcion,idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas) },
                        success: function (response) {
                            console.log(response)
                            window.location = "/SalioViaje/Form/Success.html";
                        },
                    });
                } else { next() }
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
                if (empresas.length != 0  && ID_USUARIO != null) {
                    $.ajax({
                        type: "POST",
                        url: "../PHP/procedimientosForm.php",
                        data: { tipo:opcion,idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas)  },
                        success: function (response) {
                            console.log(response)
                            window.location = "/SalioViaje/Form/Success.html";
                        },
                    });
                } else { next() }
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
                        window.location = "/SalioViaje/Form/Success.html";
                    },
                });
            }else{ console.log("No valido...") }
            break;
    }

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
        reset_vehicles();
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

function valido_Empresa_sin_crearla(){
    datos_Empresa = {
        "RUT": document.getElementById('rutt').value,
        "NOMBRE_COMERCIAL": document.getElementById('nombre_comercial').value,
        "RAZON_SOCIAL": document.getElementById('razon_social').value,
        "NUMERO_MTOP": document.getElementById('numero_mtop').value,
        "PASSWORD_MTOP": document.getElementById('password_mtop').value,
    };
    if (validacion("EMPRESA",datos_Empresa)) {        
        next();
    }else{ console.log("No valido...") }
}

/*-------------------------------------------------------------------------------------------*/
//                                     Log in                                                //
/*-------------------------------------------------------------------------------------------*/

function login(ADMIN){
    
    let usuario = document.getElementById('usuario').value;
    let pin = document.getElementById('passwd').value;

    $.ajax({
        type: "POST",
        url: "../PHP/procedimientosForm.php",
        data: {tipo:"login", usuario:usuario, pin:pin},
        success: function (response) {
            if (response != '') {
                $("#mensaje-error").text("");
                window.location = "../Panel/Dashboard.php";
            }else{
                $("#mensaje-error").text("Usuario o Contraseña Incorrectos.");
                console.log("Usuario o contraseña incorrectos...");
            }
        },
    });
}

/*-------------------------------------------------------------------------------------------*/
//                                   Validacion                                              //
/*-------------------------------------------------------------------------------------------*/

function validacion(TIPO,DATOS){
    console.log(DATOS)
    let validacion;
    let VALIDO = false;

    reset_errores()

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
                else if(validacion == "Err-1"){
                    $('#mensaje-error1').show();
                    $('#mensaje-error2').show();
                    $('#mensaje-error3').show();
                } else {marcar_errores(validacion)}
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
                else if(validacion == "Err-1"){
                    $('#mensaje-error1').show();
                    $('#mensaje-error2').show();
                    $('#mensaje-error3').show(); 
                } else {marcar_errores(validacion)}
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
                if (validacion == "VALIDO") {VALIDO = true}
                else if(validacion == "Err-1"){
                    $('#mensaje-error1').show();
                    $('#mensaje-error2').show();
                    $('#mensaje-error3').show();
                } else {marcar_errores(validacion)}
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
                if (validacion == "VALIDO") {VALIDO = true}
                else if(validacion == "Err-1"){
                    $('#mensaje-error1').show();
                    $('#mensaje-error2').show();
                    $('#mensaje-error3').show();
                } else {marcar_errores(validacion)}
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
                else if(validacion == "Err-1"){
                    $('#mensaje-error1').show();
                    $('#mensaje-error2').show();
                    $('#mensaje-error3').show();
                } else {marcar_errores(validacion)}
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
                if (validacion == "VALIDO") {VALIDO = true}
                else if(validacion == "Err-1"){
                    $('#mensaje-error1').show();
                    $('#mensaje-error2').show();
                    $('#mensaje-error3').show();
                }
            break;
    }

    return VALIDO
}

function marcar_errores(resultado_validacion){

    console.log(resultado_validacion)
    let resultado = JSON.parse(resultado_validacion)

    for (const property in resultado) {
        switch(property){
        case "CI":
                if (resultado[property] == 0) {$('#CI').css('border-bottom', '1px solid #ff635a') }       
                
            break;
        case "NOMBRE":
                if (resultado[property] == 0) {$('#nombre').css('border-bottom', '1px solid #ff635a')} 
                 
            break;
        case "APELLIDO":
                if (resultado[property] == 0) {$('#apellido').css('border-bottom', '1px solid #ff635a') } 
                 
            break;
        case "MAIL":
                if (resultado[property] == 0) {$('#correo').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "DIRECCION":
                if (resultado[property] == 0) {$('#direccion').css('border-bottom', '1px solid #ff635a') } 
                 
            break;
        case "BARRIO":
                if (resultado[property] == 0) { $('#barrio').css('border-bottom', '1px solid #ff635a')} 
                 
            break;
        case "DEPARTAMENTO":
                if (resultado[property] == 0) { $('#departamento').css('border-bottom', '1px solid #ff635a') } 
                
            break;
        case "TELEFONO":
                if (resultado[property] == 0) { 
                $('#numero_telefono').css('border-bottom', '1px solid #ff635a') 
                $('#numero_telefono_hotel').css('border-bottom', '1px solid #ff635a')
                } 

            break;
        case "RUT":
                if (resultado[property] == 0) {
                $('#rutt').css('border-bottom', '1px solid #ff635a') 
                $('#rut_usuario').css('border-bottom', '1px solid #ff635a')
                }  
            break;
        case "AGENCIA_CONTRATISTA":
                if (resultado[property] == 0) { $('#empresas').css('border-bottom', '1px solid #ff635a') } 
                 
            break;
        case "NOMBRE_HOTEL":
                if (resultado[property] == 0) { $('#nombre-hotel').css('border-bottom', '1px solid #ff635a') } 
                 
            break;
        case "DIRECCION_HOTEL":
                if (resultado[property] == 0) { $('#direccion-hotel').css('border-bottom', '1px solid #ff635a') } 
                 
            break;
        case "SUPERVISOR":
                if (resultado[property] == 0) {$('#es_supervisor').css('border-bottom', '1px solid #ff635a') } 
                
            break;
        case "NOMBRE_COMERCIAL":
                if (resultado[property] == 0) { $('#nombre_comercial').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "RAZON_SOCIAL":
                if (resultado[property] == 0) { $('#razon_social').css('border-bottom', '1px solid #ff635a') } 
                
            break;
        case "MTOP":
                if (resultado[property] == 0) { $('#numero_mtop').css('border-bottom', '1px solid #ff635a') } 
                
            break;
        case "PASSWORD_MTOP":
                if (resultado[property] == 0) {$('#password_mtop').css('border-bottom', '1px solid #ff635a') } 
                
            break;
        case "MATRICULA":
                if (resultado[property] == 0) { $('#matricula').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "MARCA":
                if (resultado[property] == 0) { $('#marca').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "MODELO":
                if (resultado[property] == 0) { $('#modelo').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "COMBUSTIBLE":
                if (resultado[property] == 0) { $('#combustible').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "CAPACIDAD_PASAJEROS":
                if (resultado[property] == 0) { $('#capacidad_pasajeros').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "CAPACIDAD_EQUIPAJE":
                if (resultado[property] == 0) { $('#capacidad_equipaje').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        case "PET_FRIENDLY":
                if (resultado[property] == 0) { $('#pet_friendly').css('border-bottom', '1px solid #ff635a')  } 
                
            break;
        }   
    }

    if (resultado['PIN'] == 0) { 
        $('#mensaje-error4').show();
        $('#password').css('border-bottom', '1px solid #ff635a') 
    }
    else if (resultado['PIN-MATCH'] == 0) { 
        $('#mensaje-error5').show(); 
        $('#password').css('border-bottom', '1px solid #ff635a') 
        $('#re-password').css('border-bottom', '1px solid #ff635a') 
    }
}

function reset_errores(){

    $('#mensaje-error1').hide();
    $('#mensaje-error2').hide();
    $('#mensaje-error3').hide();
    $('#mensaje-error4').hide();
    $('#mensaje-error5').hide();

    $('#CI').css('border-bottom', '1px solid #aaaaaa')
    $('#nombre').css('border-bottom', '1px solid #aaaaaa')
    $('#apellido').css('border-bottom', '1px solid #aaaaaa')
    $('#correo').css('border-bottom', '1px solid #aaaaaa')
    $('#direccion').css('border-bottom', '1px solid #aaaaaa')
    $('#barrio').css('border-bottom', '1px solid #aaaaaa')
    $('#departamento').css('border-bottom', '1px solid #aaaaaa')
    $('#numero_telefono').css('border-bottom', '1px solid #aaaaaa')
    $('#numero_telefono_hotel').css('border-bottom', '1px solid #aaaaaa')
    $('#direccion-hotel').css('border-bottom', '1px solid #aaaaaa')
    $('#password').css('border-bottom', '1px solid #aaaaaa')
    $('#re-password').css('border-bottom', '1px solid #aaaaaa')
    $('#rutt').css('border-bottom', '1px solid #aaaaaa')
    $('#rut_usuario').css('border-bottom', '1px solid #aaaaaa')
    $('#es_supervisor').css('border-bottom', '1px solid #aaaaaa')
    $('#nombre-hotel').css('border-bottom', '1px solid #aaaaaa')
    $('#matricula').css('border-bottom', '1px solid #aaaaaa')
    $('#marca').css('border-bottom', '1px solid #aaaaaa')
    $('#pet_friendly').css('border-bottom', '1px solid #aaaaaa')
    $('#empresas').css('border-bottom', '1px solid #aaaaaa')
    $('#modelo').css('border-bottom', '1px solid #aaaaaa')
    $('#razon_social').css('border-bottom', '1px solid #aaaaaa')
    $('#nombre_comercial').css('border-bottom', '1px solid #aaaaaa')
    $('#numero_mtop').css('border-bottom', '1px solid #aaaaaa')
    $('#password_mtop').css('border-bottom', '1px solid #aaaaaa')
    $('#combustible').css('border-bottom', '1px solid #aaaaaa')

}