$(document).ready(function () {
    $('#header').load('/web/header.php');
    $('#footer').load('/web/footer.html');


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
    window.location = "/Dashboard";
}