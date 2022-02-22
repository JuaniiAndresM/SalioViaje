$(document).ready(function () {
    steps(1);
});

var step = 1;
var next = false;

function steps(step){
    switch(step){
        case 1:
            $('.mensaje-error').hide();
            $('.step_2').hide();
            $('.step_3').hide();
            $('.step_1').show();
            
            $('.progress').css('width', '0%');

            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#aaa');
            $('.circle3').css('background-color', '#aaa');
            break;

        case 2:
            $('.mensaje-error').hide();
            validacion = $.ajax({
                type: 'POST',       
                url: "/PHP/Validaciones.php",
                data: {tipo:"USUARIO",datos:JSON.stringify({"CORREO" : document.getElementById("correo").value,"CAMBIARPIN":"NUEVOPIN-1"})},
                global: false,
                async:false,
                success: function(response) {
                  
               }
            }).responseText;
             console.log(validacion)
             if (validacion == "VALIDO") {
                $.ajax({
                    type: "POST",
                    url: "/PHP/llamadosSol.php",
                    //aca mandarias la info necesaria para el xml de llamada
                    data: {tipe:6, CORREO:document.getElementById("correo").value},
                    success: function (response) {
                        if(response != ""){
                            window.id = response;
                            codigo = generadosCodigo();
                            $.ajax({
                                type: "POST",
                                url: "/PHP/llamadosSol.php",
                                //aca mandarias la info necesaria para el xml de llamada
                                data: {tipe:7, CODIGO: codigo, ID:window.id},
                                success: function (response) {
                                    $.ajax({
                                        type: "POST",
                                        url: "/Mail/mail-restablecerpassword.php",
                                        data: { mail_tta:"", PIN: codigo, CORREO:document.getElementById("correo").value},
                                        success: function (response) {
                                            console.log(response);
                                        }
                                    });
                                    next=true;
                                    $('.step_1').hide();
                                    $('.step_2').show();
                                                
                                    $('.progress').css('width', '50%');

                                    $('.circle1').css('background-color', '#2b3179');
                                    $('.circle2').css('background-color', '#2b3179');
                                    $('.circle3').css('background-color', '#aaa');
                                }
                            });
                        }else{
                            next=false;
                            $('.mensaje-error').show();
                            $('.mensaje-error').text("Mail no registrado.");
                        }
                    }
                 });
             }
              else if(validacion == "Err-1"){
                  next=false;
                $('.mensaje-error').show();
                $('.mensaje-error').text("Debe completar todos los campos.");
             } else {marcar_errores(validacion)}
            ;
            break;

        case 3:
            $('.mensaje-error').hide();
            $.ajax({
                type: "POST",
                url: "/PHP/llamadosSol.php",
                //aca mandarias la info necesaria para el xml de llamada
                data: {tipe:8, CODIGO: document.getElementById("codigo").value, ID:window.id},
                success: function (response) {
                    if(response != ""){
                        next=true;
                        $('.step_2').hide();
                        $('.step_3').show();
                                        
                        $('.progress').css('width', '100%');

                        $('.circle1').css('background-color', '#2b3179');
                        $('.circle2').css('background-color', '#2b3179');
                        $('.circle3').css('background-color', '#2b3179');
                    }else{
                        next=false;
                        $('.mensaje-error').show();
                        $('.mensaje-error').text("Codigo incorrecto.");
                    }
                }
             });

            break;
    }
}

function cambiar_password_next(){
    if(next == true  || step ==1){
        step++;
    }
    steps(step);
}

function cambiar_password_finalizar(){
    document.getElementById("password").value;
    document.getElementById("re-password").value;
    validacion = $.ajax({
        type: 'POST',       
        url: "/PHP/Validaciones.php",
        data: {tipo:"USUARIO",datos:JSON.stringify({"PIN" : document.getElementById("password").value, "RE-PIN" : document.getElementById("re-password").value,"CAMBIARPIN":"NUEVOPIN-2"})},
        global: false,
        async:false,
        success: function(response) {
       }
    }).responseText;
     console.log(validacion)
     if (validacion == "VALIDO") { 
         $.ajax({
            type: "POST",
            url: "/PHP/llamadosSol.php",
            //aca mandarias la info necesaria para el xml de llamada
            data: {tipe:1,ID:window.id, PINNUEVO:document.getElementById("password").value},
            success: function (response) {
                window.location = "/Success";
            }
         });
    }else if(validacion == "Err-1"){
        $('.mensaje-error').show();
        $('.mensaje-error').text("Debe completar todos los campos.");
     } else {marcar_errores(validacion)}
    ;
}

function generadosCodigo() {
    return Math.floor(Math.random() * (99999999 - 10000000)) + 10000000;
  }
