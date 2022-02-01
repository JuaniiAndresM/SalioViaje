$(document).ready(function () {
    $('#header').load('/SalioViaje/web/header.php');
    $('#footer').load('/SalioViaje/web/footer.html');

    $(".user").on('click', function() {
        window.location = "/SalioViaje/Panel/Dashboard.html";
    });


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
    window.location = "/SalioViaje/Panel/Dashboard.html";
}