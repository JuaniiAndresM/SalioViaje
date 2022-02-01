$(document).ready(function () {
    $('#header').load('/SalioViaje/web/header.php');
    $('#footer').load('/SalioViaje/web/footer.html');

    document.getElementById('pre-loader').classList.toggle('load');
});

function cerrarsesion(){
    $.ajax({ 
        url: "PHP/cerrarSession.php",
        success: function(response){
            location.reload();
        }
    });
}