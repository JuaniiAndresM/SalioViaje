$(document).ready(function () {
    $('.progress-bar').hide();
    steps(1);

    $("#pax-register").on('click', function() {
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
            }
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

function register_form(user){
    let datos;

       switch(user){
        case "1":
            datos = {
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
;
            break;
        case "3":
            break; 

    }
}