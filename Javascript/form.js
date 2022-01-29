$(document).ready(function () {
    $('.progress-bar').hide();
    $('.vehiculos-wrapper').hide();
    steps(1);

    $("#pax-register").on('click', function() {
        register_form($('#select_users').val())
    });
    $("#finalizar-registro-TTA").on('click', function() {
        //register_form($('#select_users').val())
    });
    $("#finalizar_empresa").on('click', function() {
        crear_empresa();
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
                "TELEFONO": document.getElementById('telefono').value,
                "PIN": document.getElementById('password').value,
                "RE-PIN": document.getElementById('re-password').value
            };
            /*
            $.ajax({
                type: "POST",
                url: "../PHP/procedimientosForm.php",
                data: { tipo:opcion, datos:JSON.stringify(datos) },
                success: function (response) {
                    console.log(response)
                },
            });
            */
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
                "TELEFONO": document.getElementById('telefono').value,
                "PIN": document.getElementById('password').value,
                "RE-PIN": document.getElementById('re-password').value
            };
            /*
            $.ajax({
                type: "POST",
                url: "../PHP/procedimientosForm.php",
                data: { tipo:user, datos:JSON.stringify(datos) },
                success: function (response) {
                    console.log(response)
                },
            });
            */
            break;
        case "3":

            break; 
    }
}

function add_vehicle(){
    datos_Vehiculo = {
        "MATRICULA": document.getElementById('matricula').value,
        "MARCA": document.getElementById('marca').value,
        "MODELO": document.getElementById('modelo').value,
        "COMBUSTIBLE": document.getElementById('combustible').value,
        "CAPACIDAD_PASAJEROS": document.getElementById('capacidad_pasajeros').value,
        "CAPACIDAD_EQUIPAJE": document.getElementById('capacidad_equipaje').value,
        "PET_FRIENDLY": document.getElementById('pet_friendly').value
    };

    vehiculos.push(datos_Vehiculo)
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

    empresas.push(datos_Empresa)
    datos_Empresa = {};
    vehiculos = [];
}

function mostrar_Empresas(){
    console.log(empresas)
}
