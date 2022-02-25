$(document).ready(function () {

    tipo_usuario = $("#tipo_usuario").val();

    steps(1,tipo_usuario);    
});

step = 1;

function next(){
    step++;
    steps(step);
}

function volver(){
    step--;
    steps(step);
}

function steps(step, tipo_usuario){
    $("#step_1").hide();
    $("#step_2").hide();
    $("#step_3").hide();

    $("#add-vehicle").hide();
    $("#finalizar_empresa").hide();
    $("#guardar-cambios").hide();

    $("#contratista").hide();
    $("#choferes_sub").hide();

    $(".vehiculos-wrapper").hide();

    switch(step){
        case 1:
            $("#step_1").show();

            if(tipo_usuario == "Anfitrión" || tipo_usuario == "Agente"){
                $(".progress-bar").hide();
            }else{
                $(".progress-bar").show();

                $('.circle1').css('background-color', '#2b3179');
                $('.circle2').css('background-color', '#aaa');
                $('.progress').css('width', '0%');
            }

            if(tipo_usuario == "Chofer"){
                $("#contratista").show();
            }else if(tipo_usuario == "Transportista"){
                $("#choferes_sub").show();
            }

            if(tipo_usuario == "Anfitrión" || tipo_usuario == "Agente"){
                $("#add-vehicle").hide();
                $("#finalizar_empresa").show();
            }else{
                $("#add-vehicle").show();
                $("#finalizar_empresa").hide();
            }

            break;

        case 2:
            $("#step_2").show();
            $(".vehiculos-wrapper").show();

            if(tipo_usuario == "Anfitrión" || tipo_usuario == "Agente"){
                $(".progress-bar").hide();
            }else{
                $(".progress-bar").show();

                $('.circle1').css('background-color', '#2b3179');
                $('.circle2').css('background-color', '#2b3179');
                $('.progress').css('width', '100%');
            }

            break;

        case 3:
            $("#step_3").show();
            $(".progress-bar").hide();

            break;
    }
}

function finalizar_empresa(){
    step++;
    steps(step);
}

function new_company(){
    step = 1;
    steps(step);
}

function finalizar_empresa_total(){
    $("#add_company_button").hide();
    $("#finalizar-registro-TTA").prop('disabled', true);
    $('#finalizar-registro-TTA').html('<span class="loader-register"><i class="fas fa-spinner"></i></span>');

    setTimeout(() => {
        location.href = "/SalioViaje/Panel/Success_Empresa"
    }, 2000);
}