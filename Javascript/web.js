$(document).ready(function () {
    $('#header').load('/SalioViaje/web/header.php');
    $('#footer').load('/SalioViaje/web/footer.html');
    agregar_visita();
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

function agregar_visita(){
    $.ajax({ 
        type: "POST",
        url: "PHP/procedimientosForm.php",
        data: {tipo:"visita"}
    });
}