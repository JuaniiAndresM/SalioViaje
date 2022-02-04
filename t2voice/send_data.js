$(document).ready(function () {
    //cuando apreta el boton manda la info
    $("#send_data").on('click', function() {

        //aca guardarias la info necesaria para el xml de llamada
        var user = $('#user').val();
        var pwd = $('#pwd').val();
        
        $.ajax({
            type: "POST",
            url: "wsdl_comunication.php",
            //aca mandarias la info necesaria para el xml de llamada
            data: {usuario: user, contra: pwd},
            success: function (response) {
                console.log(response);
            }
        });
    });
});