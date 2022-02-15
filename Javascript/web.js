$(document).ready(function () {
    $('#header').load('/SalioViaje/web/header.php');
    $('#footer').load('/SalioViaje/web/footer.html');
    agregar_visita();
    traer_oportunidades();
    document.getElementById('pre-loader').classList.toggle('load');
});

function cerrarsesion(){
    $.ajax({ 
        url: "/SalioViaje/PHP/cerrarSession.php",
        success: function(response){
            $('#header').load('/SalioViaje/web/header.php');
        }
    });
}

function dashboard(){
    window.location = "/SalioViaje/Dashboard";
}


function agregar_visita(){
    $.ajax({ 
        type: "POST",
        url: "PHP/procedimientosForm.php",
        data: {tipo:"visita"}
    });
}

function suscripcion(){

    var mail = $('#mail-footer').val();
    
    $.ajax({
        type: "POST",
        url: "/SalioViaje/Mail/mail-Bienvenida.php",
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

function comprar_oportunidad(id){

    window.open('/SalioViaje/Espera/' + id, '_blank');
}

function detalles_oportunidad(id){
    
    location.href = "/SalioViaje/Oportunidad/" + id;

}

function traer_oportunidades(){
    
     $.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/Tablas/oportunidadesIndex.php",
        success: function (response) {
            console.log(response);
            if (response == '0') {$('.list-empty').show()} else {
                $('.list-empty').hide()
                $('.oportunidades-list').html(response)
            } 
             
        }
    });
}
