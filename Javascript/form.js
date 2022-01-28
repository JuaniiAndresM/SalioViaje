$(document).ready(function () {
    $('.progress-bar').hide();
    $('#step_2').hide();

    $("#pax-register").on('click', function() {
       register_form($('#select_users').val())
    });
});

function select_user(){

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
            console.log("No Funciona.");
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