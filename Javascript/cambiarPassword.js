$(document).ready(function () {
    steps(1);
});

var step = 1;

function steps(step){
    $('.step_1').hide();
    $('.step_2').hide();
    $('.step_3').hide();

    switch(step){
        case 1:
            $('.step_1').show();
            
            $('.progress').css('width', '0%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 2:
            $('.step_2').show();
                        
            $('.progress').css('width', '50%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 3:
            $('.step_3').show();
                                    
            $('.progress').css('width', '100%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;
    }
}

function cambiar_password_next(){
    step++;
    steps(step);
}

function cambiar_password_volver(){
    step--;
    steps(step);
}

function cambiar_password_finalizar(){
    window.location = "/SalioViaje/Success";
}