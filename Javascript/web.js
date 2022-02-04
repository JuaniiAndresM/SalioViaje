$(document).ready(function () {
    $('#header').load('/web/header.php');
    $('#footer').load('/web/footer.html');
    agregar_visita();
    document.getElementById('pre-loader').classList.toggle('load');
});

function cerrarsesion(){
    $.ajax({ 
        url: "PHP/cerrarSession.php",
        success: function(response){
            $('#header').load('/web/header.php');
        }
    });
}

function dashboard(){
    window.location = "https://www.salioviaje.com.uy/Panel/Dashboard.php";
}


function agregar_visita(){
    $.ajax({ 
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: {tipo:"visita"}
    });
}

function suscripcion(){

    var mail = $('#mail-footer').val();
    
    $.ajax({
        type: "POST",
        url: "/Mail/mail-Bienvenida.php",
        data: {email: mail},
        success: function (response) {
            console.log(response);
            if(response == 1){
                $('.suscribirse-mail').hide();
                $('.suscrito-mail').show();
            }else{
                console.log(response);
            }
            
        }
    });
}