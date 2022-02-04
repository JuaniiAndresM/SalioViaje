$(document).ready(function () {
    $('#mensaje-error1').hide();
    $('#mensaje-error2').hide();
    $('#mensaje-error3').hide();
    $('#mensaje-error4').hide();
    $('#mensaje-error5').hide();

    $('.progress-bar').hide();
    $('.vehiculos-wrapper').hide();
    $('.progress-bar2').hide();

    $('#add_company_button').show();
    $('#finalizar-registro-TTA').attr('disabled', false);
    $('#finalizar-registro-TTA').html('<i class="fas fa-check"></i> Finalizar');

    steps(1);
    Empresas();

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
    reset_errores();
    step--;
    steps(step);
}

function next(){
    step++;
    steps(step);
}

function steps(step){

    var user = $('#select_users').val();

    $('#step_1').hide();
    $('#step_2').hide();
    $('#step_3').hide();
    $('#step_4').hide();
    $('#step_5').hide();
    $('#step_hotel').hide();

    $('.vehiculos-wrapper').hide();
    
    $('#button_next_step').hide();
    $('#finalizar_empresa').hide();

    $('#add-vehicle').hide();
    $('.vehiculos-wrapper').hide();    

    $('.progress-bar').show();
    $('.progress-bar2').show();

    switch(step){

        case 1:
            $('#step_1').show();
            
            $('.progress-bar').hide();
            $('.progress-bar2').hide();
            break;

        case 2:
            

            $('#step_1').hide();
            $('#step_2').show();

            $('.progress').css('width', '0%');
            $('.progress2').css('width', '0%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');

            switch(user){
                case "1": case "6":
                    $('#pax-register').show();
                    $('#step-next').hide();

                    $('.progress-bar').hide();
                    $('.progress-bar2').hide();
                    break;
                case "2": case "3":
                    $('#pax-register').hide();
                    $('#step-next').show();

                    $('.progress-bar').show();
                    $('.progress-bar2').hide();
                    break;
                
                case "4": case "5": case "7":
                    $('#pax-register').hide();
                    $('#step-next').show();

                    $('.progress-bar').hide();
                    $('.progress-bar2').show();
                    break;

                default:
                    console.log("Error");
            }

            break;
            
        case 3:
            $('.progress-bar').show();
            $('.progress-bar2').show();

            $('.progress').css('width', '50%');
            $('.progress2').css('width', '100%');
            
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');

            switch(user){
                case "2":
                    $('#step_3').show();

                    $('#contratista').hide();
                    $('#choferes_sub').show();
                    $('#add-vehicle').show();

                    $('.progress-bar').show();
                    $('.progress-bar2').hide();
                    break;

                case "3":
                    $('#step_3').show();

                    $('#contratista').show();
                    $('#choferes_sub').hide();
                    $('#add-vehicle').show();

                    $('.progress-bar').show();
                    $('.progress-bar2').hide();
                    break;

                case "4": case "7":
                    $('#step_3').show();
                    $('#contratista').hide();
                    $('#choferes_sub').hide();

                    $('#add-vehicle').hide();
                    $('#finalizar_empresa').show();
                    
                    $('.progress-bar').hide();
                    $('.progress-bar2').show();
                    break;

                case "5":
                    $('#step_hotel').show();

                    $('.progress-bar').hide();
                    $('.progress-bar2').show();
                    break;

                default:
                    console.log("Error");
            }
            break;

        case 4:
            $('.progress').css('width', '100%');
            
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');

            $('.progress-bar').show();
            $('.progress-bar2').hide();
            
            $('#step_4').show();
            $('.vehiculos-wrapper').show();
            break;

        case 5:
            $('.progress-bar').hide();
            $('.progress-bar2').hide();

            $('.progress').css('width', '100%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');

            $('#step_5').show();

            $('.vehiculos-wrapper').hide();
            break;
    }
}

function select_usuario(){
    var user = $('#select_users').val();

    $('#button_next_step').click();
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
    $('#combustible').val('0');
    $('#capacidad_pasajeros').val('');
    $('#capacidad_equipaje').val('');
    $('#pet_friendly').val('0');
}

function reset_vehicle_inputs(){
    $('#matricula').val('');
    $('#marca').val('');
    $('#modelo').val('');
    $('#combustible').val('0');
    $('#capacidad_pasajeros').val('');
    $('#capacidad_equipaje').val('');
    $('#pet_friendly').val('0');
}

function reset_vehicles(){
    $('.vehiculos').html('<div id="no-vehicle"><p>No hay vehiculos agregados.</p></div>');
    $('#no-vehicle').show();
}

function passwd(tipo){

    switch(tipo){
        // Login
        case 1:
            if($('#passeye').hasClass('show')){
                $('#passwd').attr('type', 'password');
                $('#passeye').html('<i class="fas fa-eye-slash"></i>');
                $('#passeye').attr('class','hidden');
            }else{
                $('#passwd').attr('type', 'text');
                $('#passeye').html('<i class="fas fa-eye"></i>');
                $('#passeye').attr('class','show');
            }
            break;

        // PIN 1
        case 2:
            if($('#passeye').hasClass('show')){
                $('#password').attr('type', 'password');
                $('#passeye').html('<i class="fas fa-eye-slash"></i>');
                $('#passeye').attr('class','hidden');
            }else{
                $('#password').attr('type', 'text');
                $('#passeye').html('<i class="fas fa-eye"></i>');
                $('#passeye').attr('class','show');
            }
            break;

        // PIN 2
        case 3:
            if($('#passeye2').hasClass('show')){
                $('#re-password').attr('type', 'password');
                $('#passeye2').html('<i class="fas fa-eye-slash"></i>');
                $('#passeye2').attr('class','hidden');
            }else{
                $('#re-password').attr('type', 'text');
                $('#passeye2').html('<i class="fas fa-eye"></i>');
                $('#passeye2').attr('class','show');
            }
            break;

        // PASSWORD MTOP
        case 4:
            if($('#passeye3').hasClass('show')){
                $('#password_mtop').attr('type', 'password');
                $('#passeye3').html('<i class="fas fa-eye-slash"></i>');
                $('#passeye3').attr('class','hidden');
            }else{
                $('#password_mtop').attr('type', 'text');
                $('#passeye3').html('<i class="fas fa-eye"></i>');
                $('#passeye3').attr('class','show');
            }
            break;


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

       switch(opcion){
        case "1":
            if (validacion("USUARIO",datos_Usuario) == true) {
                registrar_usuario("PAX");
                //window.location = "/SalioViaje/Success";
            }else{ console.log("No valido...") }
            break;
        case "2":
            if (validacion("USUARIO",datos_Usuario)) {
                if (empresas.length != 0) {
                    registrar_usuario("TTA");

                    $('#add_company_button').hide();
                    $('#finalizar-registro-TTA').attr('disabled', true);
                    $('#finalizar-registro-TTA').html('<span class="loader-register"><i class="fas fa-spinner"></i></span>');

                    setTimeout(function() {
                        $.ajax({
                        type: "POST",
                        url: "/SalioViaje/PHP/procedimientosForm.php",
                        data: { tipo:"2",idUsuario: ID_USUARIO,empresas:JSON.stringify(empresas) },
                        success: function (response) {
                            console.log(response)
                            window.location = "/SalioViaje/Success";
                            },
                        });

                    }, 1000);
                } else { next() }
            }else{ console.log("No valido...") }
            break;
        case "3":
            if (validacion("USUARIO",datos_Usuario)) {
                 if (empresas.length != 0  && ID_USUARIO != null) {
                    ID_USUARIO = registrar_usuario("CHO");
                    $.ajax({
                        type: "POST",
                        url: "/SalioViaje/PHP/procedimientosForm.php",
                        data: { tipo:'3',idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas) },
                        success: function (response) {
                            //window.location = "/SalioViaje/Success";
                        },
                    });
                } else { next() }
            }else{ console.log("No valido...") }
            break;
        case "4":
            if (validacion("USUARIO",datos_Usuario)) {
                if (empresas.length != 0  && ID_USUARIO != null) {
                    ID_USUARIO = registrar_usuario("ANF");
                    $.ajax({
                        type: "POST",
                        url: "/SalioViaje/PHP/procedimientosForm.php",
                        data: { tipo:'4',idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas)  },
                        success: function (response) {
                            console.log(response)
                            //window.location = "/SalioViaje/Success";
                        },
                    });
                } else { next() }
            }else{ console.log("No valido...") }
            break;
        case "5":
            if (validacion("USUARIO",datos_Usuario)) {
                if (empresas.length != 0 && ID_USUARIO != null) {
                    registrar_usuario("HTL");
                    $.ajax({
                        type: "POST",
                        url: "/SalioViaje/PHP/procedimientosForm.php",
                        data: { tipo:'5', datos:JSON.stringify(datos_Usuario) },
                        success: function (response) {
                            //window.location = "/SalioViaje/Success";
                        },
                    });
                } else { next() }
            }else{ console.log("No valido...") }
            break;
        case "6":
            if (validacion("USUARIO",datos_Usuario) == true) {
                ID_USUARIO = registrar_usuario("ASE");
                $.ajax({
                    type: "POST",
                    url: "/SalioViaje/PHP/procedimientosForm.php",
                    data: { tipo:'6', datos:JSON.stringify(datos_Usuario) },
                    success: function (response) {
                        //window.location = "/SalioViaje/Success";
                    },
                });
            }else{ console.log("No valido...") }
            break;
        case "7":
            if (validacion("USUARIO",datos_Usuario)) {
                if (empresas.length != 0  && ID_USUARIO != null) {
                    ID_USUARIO = registrar_usuario("AGT");
                    $.ajax({
                        type: "POST",
                        url: "/SalioViaje/PHP/procedimientosForm.php",
                        data: { tipo:'7',idUsuario: ID_USUARIO, datos_Usuario:JSON.stringify(datos_Usuario), empresas:JSON.stringify(empresas)  },
                        success: function (response) {
                            //window.location = "/SalioViaje/Success";
                        },
                    });
                } else { next() }
            }else{ console.log("No valido...") }
            break;
    }
}

function registrar_usuario(tipoUsuario){
    $.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/procedimientosForm.php",
        data: { tipo:"1",tipoUsuario:tipoUsuario, datos:JSON.stringify(datos_Usuario) },
        success: function (response) {
            ID_USUARIO = response;
            console.log("ID usuario:  "+response)
        },
        complete: function(){
            return ID_USUARIO;
        }
    });
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
            url: "/SalioViaje/PHP/agregarVehiculo.php",
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

        var user = $('#select_users').val();

        if(user == 4 || user == 7){
            step = 5;
            steps(5);
            
        }else{
            next();
        }
        
    }else{ console.log("No valido...") }
}

function Empresas(){
    $.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/procedimientosForm.php",
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

    if (usuario.length >= 8) {
        $.ajax({
            type: "POST",
            url: "/SalioViaje/PHP/procedimientosForm.php",
            data: {tipo:"login", usuario:usuario, pin:pin},
            success: function (response) {
                if (response != '') {
                    $("#mensaje-error").text("");
                    window.location = "/SalioViaje/Dashboard";
                }else{
                    $("#mensaje-error").text("Usuario o Contraseña Incorrectos.");
                    console.log("Usuario o contraseña incorrectos...");
                }
            },
        });
    }else{ $("#mensaje-error").text("Usuario o Contraseña Incorrectos."); }

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
        case "USUARIO":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "/SalioViaje/PHP/Validaciones.php",
                                data: {tipo:"USUARIO",datos:JSON.stringify(DATOS)},
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
                                url: "/SalioViaje/PHP/Validaciones.php",
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
                                url: "/SalioViaje/PHP/Validaciones.php",
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
                                url: "/SalioViaje/PHP/Validaciones.php",
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
                                url: "/SalioViaje/PHP/Validaciones.php",
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
        case "USUARIO-ANF-AGT":
                validacion = $.ajax({
                                type: 'POST',       
                                url: "/SalioViaje/PHP/Validaciones.php",
                                data: {tipo:"ANF-AGT",datos:JSON.stringify(DATOS)},
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