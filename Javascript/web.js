$(document).ready(function () {
    $('#header').load('/web/foreman/header.php');
    $('#footer').load('/web/footer.html');
    agregar_visita();
    traer_oportunidades();
    document.getElementById('pre-loader').classList.toggle('load');
    $('#filters').hide();
    $('#filters2').hide();
});

function cerrarsesion(){
    $.ajax({ 
        url: "https://www.salioviaje.com.uy/PHP/cerrarSession.php",
        success: function(response){
            $('#header').load('/web/foreman/header.php');
            location.reload()
        }
    });
}

function dashboard(){
    window.location = "https://www.salioviaje.com.uy/Dashboard";
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
        url: "https://www.salioviaje.com.uy/Mail/mail-Bienvenida.php",
        data: {email: mail},
        success: function (response) {
            console.log(response);
            if(response == 1){
                $('.suscribirse-mail').hide();
                $('.suscrito-mail').show();
                $('#mail-footer').val(" ")
                setTimeout(() => {
                    $('.suscribirse-mail').show();
                    $('.suscrito-mail').hide();
                }, 5000);
            }else{
                console.log(response);
            }
            
        }
    });
}

function comprar_oportunidad(id){
    window.open('/Espera/' + id, '_blank');
    comprar_oportunidad_function(id)
}

function detalles_oportunidad(id){
    
    location.href = "/Oportunidad/" + id;

}

function traer_oportunidades(){
    
     $.ajax({
        type: "POST",
        url: "/PHP/Tablas/oportunidadesIndex.php",
        success: function (response) {
            if (response == ' ' || response == '0') {$('.list-empty').css('display', 'flex')} else {
                $('.list-empty').hide();                
                $('.oportunidades-list').html(response);
                $('.oportunidades-list').show();
            } 
             
        }
    });
}

function traer_cotizacion(){
    $('.list-empty-cotizacion').show();
    $('.Cotizaciones-list').hide();
    //  $.ajax({
    //     type: "POST",
    //     url: "/PHP/Tablas/oportunidadesIndex.php",
    //     success: function (response) {
    //         console.log(response)
    //         if (response == ' ' || response == '0') {$('.list-empty').css('display', 'flex')} else {
    //             $('.list-empty-cotizacion').hide();                
    //             $('.Cotizaciones-list').html(response);
    //             $('.Cotizaciones-list').show();
    //         } 
             
    //     }
    // });
}


function filtros(number){

    switch(number){
        case 1:
            $('#filters').toggle(''); 
            break;

        case 2:
            $('#filters2').toggle(''); 
            break;
    }
     
}