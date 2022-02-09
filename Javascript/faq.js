$(document).ready(function () {
    traer_preguntas()
});

function desplegar(button){
    button.classList.toggle("active");
    button.nextElementSibling.classList.toggle("show");
}

function crear_pregunta(){
    let valido;
    let pregunta = {
        "PREGUNTA" : document.getElementById('pregunta').value,
        "RESPUESTA" : document.getElementById('respuesta').value
    }

    for (const property in pregunta) {
        if (pregunta[property] == null || pregunta[property] == undefined || pregunta[property] == '') { valido = 0 }
    }

    if (valido != 0) {
        pregunta['PREGUNTA'] = verificar_pregunta(pregunta);
        $.ajax({
            type: 'POST',       
            url: "/SalioViaje/PHP/Backend.php",
            data: {opcion:"agregarPregunta", datos: pregunta},
            success: function(response) {
                console.log(response)
                traer_preguntas(response);
            },
            complete: function(){

            }
        })
    } else { console.log("No pueden haber campos vacios") } 
}

function traer_preguntas(){
    $.ajax({
        type: 'POST',       
        url: "/SalioViaje/PHP/Backend.php",
        data: {opcion:"mostrarPreguntas"},
        success: function(response) {
            $(".faq-list").html(response)
        }
    })
}

function traer_preguntas_seccion_faq(){
    $.ajax({
        type: 'POST',       
        url: "/SalioViaje/PHP/Backend.php",
        data: {opcion:"mostrarPreguntasSeccionFAQ"},
        success: function(response) {
            console.log(response)
            $(".accordion").html(response)
        }
    })
}

function verificar_pregunta(pregunta){

    pregunta = pregunta['PREGUNTA'];
    
    if(pregunta.charAt(pregunta.length - 1) != "?" && pregunta.charAt(0) != "¿"){
        pregunta = "¿" + pregunta + "?"
    } else if(pregunta.charAt(pregunta.length - 1) != "?" && pregunta.charAt(0) == "¿") { 
        pregunta = pregunta + "?"
    } else if(pregunta.charAt(pregunta.length - 1) == "?" && pregunta.charAt(0) != "¿") { 
        pregunta = "¿"+pregunta
    }

    return pregunta;
}