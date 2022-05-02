function settings(setting_name){

    document.getElementById('settings-menu').classList.toggle('active');

    console.log(setting_name);

    $('#editar-info').hide();
    $('#editar-contra').hide();
    $('#administrar-usuarios').hide();
    $('#editar-idioma').hide();
    $('#configuracion-panel').hide();

    switch(setting_name){
        case 1:
            $('#editar-info').show();
            break;

        case 2:
            $('#editar-contra').show();

            $('#passwd1').val("");
            $('#passwd2').val("");
            $('#passwd3').val("");

            //Reset Inputs and Password Eye.

            $('#passwd1').attr('type', 'password');
            $('#passeye1').html('<i class="fas fa-eye-slash"></i>');
            $('#passeye1').attr('class','hidden');

            $('#passwd2').attr('type', 'password');
            $('#passeye2').html('<i class="fas fa-eye-slash"></i>');
            $('#passeye2').attr('class','hidden');

            $('#passwd3').attr('type', 'password');
            $('#passeye3').html('<i class="fas fa-eye-slash"></i>');
            $('#passeye3').attr('class','hidden');
            break;

        case 3:
            $('#administrar-usuarios').show();
            break;

        case 4:;
            $('#editar-idioma').show();
            break;

        case 5:
            $('#configuracion-panel').show();
            break;
        
        default:
            $('#editar-info').hide();
            $('#editar-contra').hide();
            $('#administrar-usuarios').hide();
            $('#editar-idioma').hide();
            $('#configuracion-panel').hide();
            break;

    }
}

function close_settings(){
    document.getElementById('settings-menu').classList.toggle('active');
}

function passwd(num_input){
    switch(num_input){
        case 1:
            if($('#passeye1').hasClass('show')){
                $('#passwd1').attr('type', 'password');
                $('#passeye1').html('<i class="fas fa-eye-slash"></i>');
                $('#passeye1').attr('class','hidden');
            }else{
                $('#passwd1').attr('type', 'text');
                $('#passeye1').html('<i class="fas fa-eye"></i>');
                $('#passeye1').attr('class','show');
            }
            break;
        case 2:
            if($('#passeye2').hasClass('show')){
                $('#passwd2').attr('type', 'password');
                $('#passeye2').html('<i class="fas fa-eye-slash"></i>');
                $('#passeye2').attr('class','hidden');
            }else{
                $('#passwd2').attr('type', 'text');
                $('#passeye2').html('<i class="fas fa-eye"></i>');
                $('#passeye2').attr('class','show');
            }
            break;
        case 3:
            if($('#passeye3').hasClass('show')){
                $('#passwd3').attr('type', 'password');
                $('#passeye3').html('<i class="fas fa-eye-slash"></i>');
                $('#passeye3').attr('class','hidden');
            }else{
                $('#passwd3').attr('type', 'text');
                $('#passeye3').html('<i class="fas fa-eye"></i>');
                $('#passeye3').attr('class','show');
            }
            break;
    }
}