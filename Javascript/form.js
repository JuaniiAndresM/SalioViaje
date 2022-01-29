$(document).ready(function () {
    $('.progress-bar').hide();
    $('.vehiculos-wrapper').hide();
    steps(1);

    $("#finalizar-registro").on('click', function() {
        register_form($('#select_users').val())
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
    console.log(step);

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

        default:
            step--;
            console.log(step);
            break;
    }
}

/*-------------------------------------------------------------------------------------------*/

let datos_Usuario;
let datos_Empresa;
let datos_Vehiculo;
let vehiculos;

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
          $.ajax({
            type: "POST",
            url: "../PHP/procedimientosForm.php",
            data: { tipo:user, datos:JSON.stringify(datos) },
            success: function (response) {
                console.log(response)
            },
        });
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
            datos_Empresa = {
                "RUT": document.getElementById('CI').value,
                "NOMBRE_COMERCIAL": document.getElementById('correo').value,
                "RAZON_SOCIAL": document.getElementById('nombre').value,
                "NUMERO_MTOP": document.getElementById('apellido').value,
                "PASSWORD_MTOP": document.getElementById('direccion').value,
                "VEHICULOS": vehiculos
            };
            $.ajax({
                type: "POST",
                url: "../PHP/procedimientosForm.php",
                data: { tipo:user, datos:JSON.stringify(datos) },
                success: function (response) {
                    console.log(response)
                },
            });
            break;
        case "3":

            break; 
    }
}

function agregar_vehiculo(){

}

function new_company(){
    step = 3;
    steps(3);

    $('#company_volver').hide();
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