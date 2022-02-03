$(document).ready(function () {
    $('#header').load('https://www.salioviaje.com.uy/web/header.php');
    $('#footer').load('https://www.salioviaje.com.uy/web/footer.html');


    document.getElementById('pre-loader').classList.toggle('load');
});

function cerrarsesion(){
    $.ajax({ 
        url: "PHP/cerrarSession.php",
        success: function(response){
            $('#header').load('https://www.salioviaje.com.uy/web/header.php');
        }
    });
}

function dashboard(){
    window.location = "https://www.salioviaje.com.uy/Panel/Dashboard.php";
}


function suscripcion(){

    var mail = $('#mail-footer').val();
    
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/Mail/mail-Bienvenida.php",
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