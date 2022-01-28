$(document).ready(function () {
    $('.progress-bar').hide();
    $('#step_2').hide();
});

function select_user(){
    var user = $('#select_users').val();
    console.log(user);

    switch(user){
        case "1":
            $('.progress-bar').hide();
            $('#step_1').hide();
            $('#step_2').show();
            break;

        default:
            console.log("No Funciona.");
            break;
    }
}