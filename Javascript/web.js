$(document).ready(function () {
    $('#header').load('/SalioViaje/web/header.php');
    $('#footer').load('/SalioViaje/web/footer.html');


    document.getElementById('pre-loader').classList.toggle('load');
});

function cerrarsesion(){
    $.ajax({ 
        url: "PHP/cerrarSession.php",
        success: function(response){
            $('#header').load('/SalioViaje/web/header.php');
        }
    });
}

function dashboard(){
    window.location = "/SalioViaje/Panel/Dashboard.php";
}


function suscripcion(){

    var mail = $('#mail-footer').val();
    
    $.ajax({
        type: "POST",
        url: "/SalioViaje/Mail/mail-Bienvenida.php",
        data: {email: mail},
        success: function (response) {
            if(response == "1"){
                console.log("Mail Envíado.")
            }else{
                console.log(response);
            }
            
        }
    });
}