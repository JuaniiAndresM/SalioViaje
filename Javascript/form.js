$(document).ready(function () {
    $('.progress-bar').hide();
    $('#step_2').hide();
});

var step = 0;
function select_user(){

    step++;

    var user = $('#select_users').val();
    console.log(user);

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
            console.log("No Funciona.");
            break;
    }
}

function volver(){
    step--;
    
    $('#step_1').show();
    $('#step_2').hide();
}