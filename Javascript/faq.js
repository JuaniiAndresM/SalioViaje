let ID_PREGUNTA;
let PREGUNTA;
let RESPUESTA;

$(document).ready(function () {
    traer_preguntas_seccion_admin()
    $('#eliminar-pregunta').hide()
    $('#guardar-pregunta').hide()
    $('#mensaje-error').hide()
});

function desplegar(button){
    button.classList.toggle("active");
    button.nextElementSibling.classList.toggle("show");
}

function crear_pregunta(){
    $('#mensaje-error').hide();
    let valido;
    let pregunta = {
        "PREGUNTA" : document.getElementById('pregunta').value,
        "RESPUESTA" : editor.getData()
    }

    $('#mensaje-error').hide()

    for (const property in pregunta) {
        if (pregunta[property] == null || pregunta[property] == undefined || pregunta[property] == '') { valido = 0 }
    }

    if (valido != 0) {
        pregunta['PREGUNTA'] = verificar_pregunta(pregunta);
        $.ajax({
            type: 'POST',       
            url: "/PHP/Backend.php",
            data: {opcion:"agregarPregunta", datos: pregunta},
            success: function(response) {
                console.log(response)
                traer_preguntas_seccion_admin(response);
            },
            complete: function(){

            }
        })
    } else { $('#mensaje-error').show() } 
}

function traer_datos_preguntas(id){

    $('#crear-pregunta').hide()
    $('#eliminar-pregunta').show()
    $('#guardar-pregunta').show()

    $.ajax({
        type: 'POST',       
        url: "/PHP/Backend.php",
        data: {opcion:"datosPreguntasFAQ", ID:id},
        success: function(response) {
            response = JSON.parse(response)

            ID_PREGUNTA = response['ID']
            PREGUNTA = response['PREGUNTA']
            RESPUESTA = response['RESPUESTA']

            document.getElementById('pregunta').value = response['PREGUNTA']
            editor.setData(response['RESPUESTA']);
        }
    })
}

function traer_preguntas_seccion_admin(){
    $.ajax({
        type: 'POST',       
        url: "/PHP/Backend.php",
        data: {opcion:"mostrarPreguntas"},
        success: function(response) {
            $(".faq-list").html(response)
        },
        complete: function(){
          $(".faq-question").on('click', function() {
            traer_datos_preguntas(this.id);
          });
        }
    })
}

function traer_preguntas_seccion_faq(){
    $.ajax({
        type: 'POST',       
        url: "/PHP/Backend.php",
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

function editar_pregunta(){
    PREGUNTA = document.getElementById('pregunta').value;
    RESPUESTA = editor.getData();
    $.ajax({
        type: 'POST',       
        url: "/PHP/Backend.php",
        data: {opcion:"editarPreguntaFAQ", ID: ID_PREGUNTA,PREGUNTA:PREGUNTA,RESPUESTA:RESPUESTA},
        success: function(response) {
            console.log(response)
            $('#crear-pregunta').show()
            $('#eliminar-pregunta').hide()
            $('#guardar-pregunta').hide()
            document.getElementById('pregunta').value = "";
            editor.setData("");
        },
        complete: function(){
            traer_preguntas_seccion_admin();
        }
    })
}

function borrar_pregunta(){
    $.ajax({
        type: 'POST',       
        url: "/PHP/Backend.php",
        data: {opcion:"borrarPreguntaFAQ", ID: ID_PREGUNTA},
        success: function(response) {
            $('#crear-pregunta').show()
            $('#eliminar-pregunta').hide()
            $('#guardar-pregunta').hide()
            document.getElementById('pregunta').value = "";
            editor.setData("")
        },
        complete: function(){
            traer_preguntas_seccion_admin();
        }
    })
}