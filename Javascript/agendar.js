$(document).ready(function () {
    select_vehiculos()
    $('.empty-list').show()
    $('.vehicle').hide()
    steps(1);
});

var step = 1;
var count_rutas = 0;

function next(){
    step++;
    steps(step);
  }

function volver(){
    //reset_errores();
    step--;
    steps(step);
  }


function steps(step){
    $("#step_1").hide();
    $("#step_2").hide();
    $("#step_3").hide();
    $("#step_4").hide();

    $('.progress-bar').show();

    $("#button_volver").show();

    $("#descuento1").hide();
    $("#descuento2").hide();

    $('.circle1').css('background-color', '#aaa');
    $('.circle2').css('background-color', '#aaa');
    $('.circle3').css('background-color', '#aaa');

    switch(step){
        case 1:
            $("#step_1").show();
            $("#button_volver").hide();
            
            $('.progress').css('width', '0%');
            $('.circle1').css('background-color', '#2b3179');
            break;

        case 2:
            $("#step_2").show();

            $('.progress').css('width', '50%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');

            precio_referencia();        
            select_tipo(1);       
            select_tipo(2);       
            break;

        case 3:
            $("#step_3").show();

            $('.progress').css('width', '100%');
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;

        case 4:
            $("#step_4").show();

            $('.progress-bar').hide();
            $('.circle1').css('background-color', '#2b3179');
            $('.circle2').css('background-color', '#2b3179');
            $('.circle3').css('background-color', '#2b3179');
            break;
    }
}

function select_tipo(tipo){
    switch(tipo){
        case 1:
            tipo = $("#tipo-select_1").val();
            if(tipo == 2){
                $("#descuento1").show();
            }else{
                $("#descuento1").hide();
            }
            break;
        case 2:
            tipo = $("#tipo-select_2").val();
            if(tipo == 2){
                $("#descuento2").show();
            }else{
                $("#descuento2").hide();
            }
            break;
    }
}

function precio_referencia(){
    var pasajeros = $("#pasajeros-input").val();
    var distancia = $("#distancia-input").val();

    var referencia;

    if(pasajeros >= 4){
        referencia = distancia * 34;
    }else if(pasajeros >= 6){
        referencia = distancia * 56;
    }else if(pasajeros >= 8){
        referencia = distancia * 66;
    }else if(pasajeros >= 11){
        referencia = distancia * 76;
    }else if(pasajeros >= 15){
        referencia = distancia * 88;
    }else if(pasajeros >= 17){
        referencia = distancia * 90;
    }else if(pasajeros >= 22){
        referencia = distancia * 104;
    }else if(pasajeros >= 28){
        referencia = distancia * 110;
    }else if(pasajeros >= 47){
        referencia = distancia * 120;
    }

    $("#precioref_1").attr('placeholder', referencia);
    $("#precioref_2").attr('placeholder', referencia);
}

function select_origen_destino(type){
    switch(type){
        case 1:
            origen = $("#origen_1").val();
            $("#destino_2").val(origen);
            break;

        case 2:
            destino = $("#destino_1").val();
            $("#origen_2").val(destino);
            break;

        case 3:
            origen = $("#origen_2").val();
            $("#destino_1").val(origen);
            break;

        case 4:
            destino = $("#destino_2").val();
            $("#origen_1").val(destino);
            break;
    }   
}

let array_rutas = new Array()

function rutas(){
    ruta = $("#rutas_1").val();
    array_rutas[count_rutas] = ruta
    $.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/Tablas/agregarTag.php",
        data: {NRO_RUTA: count_rutas, NOMBRE_RUTA: ruta},
        success: function (response) {
            $("#tags_1").append(response);
            $("#rutas_1").val("");
        }
    });
    count_rutas++
    console.log(array_rutas)
}

function borrar_ruta(ruta){
    delete array_rutas[ruta]
    $('#R'+ruta).remove();
    console.log(array_rutas)
}

/*-------------------------------------------------------------------------------------------*/
//                                    Formularios Agendar                                    //
/*-------------------------------------------------------------------------------------------*/
let vehiculos_select
let vehiculo_seleccionado
let datos_etapa_1


//agrego vehiculos al select
function select_vehiculos(){
$.ajax({
    type: "POST",
    url: "/SalioViaje/PHP/procedimientosForm.php",
    data: {tipo: "vehiculos"},
    success: function (response) {
        console.log(response)
      vehiculos_select = JSON.parse(response);
      var selectVehiculos = document.getElementById('vehiculos-select');
      $("#vehiculos-select").empty().append($("<option></option>").attr({"value": 0,"selected": true, 'disabled': true, 'hidden': true}).text('Seleccione un vehiculo'));
      for (var i = 0; i < vehiculos_select.length; i++){
        var opt = document.createElement('option');
        opt.value = vehiculos_select[i]["MATRICULA"];
        opt.text = vehiculos_select[i]["MARCA"]+" "+vehiculos_select[i]["MODELO"]+" ("+vehiculos_select[i]["MATRICULA"]+")";
        selectVehiculos.appendChild(opt);
      }
   }
});
}

function actualizar_vista_previa(vehiculo){
    for (var i = 0; i < vehiculos_select.length; i++) {
        if(vehiculos_select[i]['MATRICULA'] == vehiculo){
            $('.empty-list').hide()
            $('.vehicle').show()
            $(".matricula").html('<i class="fas fa-address-card"></i> '+vehiculos_select[i]['MATRICULA'])
            $(".marca").html('<i class="fas fa-car"></i> '+vehiculos_select[i]['MARCA'])
            $(".modelo").html('<i class="fas fa-list"></i> '+vehiculos_select[i]['MODELO'])
            $(".capacidad").html('<i class="fas fa-users"></i> '+vehiculos_select[i]['CAPACIDAD'])
            $(".combustible").html('<i class="fas fa-gas-pump"></i> '+vehiculos_select[i]['COMBUSTIBLE'])
            if (vehiculos_select[i]['CAPACIDAD'] <= 3) { $(".vehicle-icon").html('<i class="fas fa-car"></i>') } else if (vehiculos_select[i]['CAPACIDAD'] > 3 && vehiculos_select[i]['CAPACIDAD'] <= 12) { $(".vehicle-icon").html('<i class="fas fa-shuttle-van"></i>') } else { $(".vehicle-icon").html('<i class="fas fa-bus"></i>') }
            vehiculo_seleccionado = vehiculos_select[i]
        }
    }
}

function mostrar_datos_vehiculo(){
    $(".matricula").html('<i class="fas fa-address-card"></i> '+vehiculo_seleccionado['MATRICULA'])
    $(".marca").html('<i class="fas fa-car"></i> '+vehiculo_seleccionado['MARCA'])
    $(".modelo").html('<i class="fas fa-list"></i> '+vehiculo_seleccionado['MODELO'])
    $(".capacidad").html('<i class="fas fa-users"></i> '+vehiculo_seleccionado['CAPACIDAD'])
    $(".combustible").html('<i class="fas fa-gas-pump"></i> '+vehiculo_seleccionado['COMBUSTIBLE'])
    if (vehiculos_select[i]['CAPACIDAD'] <= 3) { $(".vehicle-icon").html('<i class="fas fa-car"></i>') } else if (vehiculos_select[i]['CAPACIDAD'] > 3 && vehiculos_select[i]['CAPACIDAD'] <= 12) { $(".vehicle-icon").html('<i class="fas fa-shuttle-van"></i>') } else { $(".vehicle-icon").html('<i class="fas fa-bus"></i>') }
}

/*-------------------------------------------------------------------------------------------*/
//                                           Etapa 1                                         //
/*-------------------------------------------------------------------------------------------*/

function etapa_1(){
    datos_etapa_1 = {
        "VEHICULO": vehiculo_seleccionado,
        "CANTIDAD_DE_PASAJEROS": document.getElementById('pasajeros-input').value,
        "DISTANCIA": document.getElementById('distancia-input').value
    }
    if (validacion('AGENDAR-VIAJE-ETAPA-1',datos_etapa_1)) {
        next()
        
        $("#step-next").on('click', function() {
            etapa_2();
        });
    }else{console.log("No valido...")}
}

/*-------------------------------------------------------------------------------------------*/
//                                           Etapa 2                                         //
/*-------------------------------------------------------------------------------------------*/

function etapa_2(){
    datos_etapa_2_tramo_1 = {
        "TIPO": document.getElementById('tipo-select_1').value,
        "FECHA": document.getElementById('fecha_1').value,
        "ORIGEN": document.getElementById('origen_1').value,
        "DESTINO": document.getElementById('destino_1').value,
        "PRECIO_REFERENCIA": document.getElementById('precioref_1').value
    }

    datos_etapa_2_tramo_2 = {
        "TIPO": document.getElementById('tipo-select_2').value,
        "FECHA": document.getElementById('fecha_2').value,
        "ORIGEN": document.getElementById('origen_2').value,
        "DESTINO": document.getElementById('destino_2').value,
        "PRECIO_REFERENCIA": document.getElementById('precioref_2').value
    }

    if (datos_etapa_2_tramo_1['TIPO'] == 2) { datos_etapa_2_tramo_1['DESCUENTO_OPORTUNIDAD'] = document.getElementById('desc_oport1').value }
    if (datos_etapa_2_tramo_2['TIPO'] == 2) { datos_etapa_2_tramo_2['DESCUENTO_OPORTUNIDAD'] = document.getElementById('desc_oport2').value }    

    if (validacion('AGENDAR-VIAJE-ETAPA-2-TRAMO-1',datos_etapa_2_tramo_1) && validacion('AGENDAR-VIAJE-ETAPA-2-TRAMO-2',datos_etapa_2_tramo_2)){
        next()
    }else{console.log("No valido...")}
}

/*-------------------------------------------------------------------------------------------*/
//                                           Etapa 3                                         //
/*-------------------------------------------------------------------------------------------*/

function verificar_rutas_para_MTOP(){
    if (array_rutas == null) {

        console.log("Para agendar con MTOP debe ingresar almenos una ruta")

    }else{

        datos_etapa_2_tramo_1['FECHA'] = datos_etapa_2_tramo_1['FECHA'].replace("T", " ");
        datos_etapa_2_tramo_2['FECHA'] = datos_etapa_2_tramo_2['FECHA'].replace("T", " ");

            next(2)

        $('.pasajeros').html('<i class="fas fa-user-friends"></i> '+datos_etapa_1['CANTIDAD_DE_PASAJEROS'])
        $('.distancia').html('<i class="fas fa-road"></i> '+datos_etapa_1['DISTANCIA']+" Km")

        if (datos_etapa_2_tramo_1['TIPO'] == 1) { $('.tipo_1').html("Agenda") } else { $('.tipo_1').html("Oportunidad") }
        $('.fecha_1').html(datos_etapa_2_tramo_1['FECHA'])
        $('.origen_1').html(datos_etapa_2_tramo_1['ORIGEN'])
        $('.destino_1').html(datos_etapa_2_tramo_1['DESTINO'])
        $('.precio_1').html("$"+datos_etapa_2_tramo_1['PRECIO_REFERENCIA'])
    
        if (datos_etapa_2_tramo_2['TIPO'] == 1) { $('.tipo_2').html("Agenda") } else { $('.tipo_2').html("Oportunidad") }
        $('.fecha_2').html(datos_etapa_2_tramo_2['FECHA'])
        $('.origen_2i').html(datos_etapa_2_tramo_2['ORIGEN'])
        $('.destino_2').html(datos_etapa_2_tramo_2['DESTINO'])
        $('.precio_2').html("$"+datos_etapa_2_tramo_2['PRECIO_REFERENCIA'])
    }
}

/*-------------------------------------------------------------------------------------------*/
//                                Vista previa de viaje agendado                             //
/*-------------------------------------------------------------------------------------------*/

function cargar_vista_previa(){

    datos_etapa_2_tramo_1['FECHA'] = datos_etapa_2_tramo_1['FECHA'].replace("T", " ");
    datos_etapa_2_tramo_2['FECHA'] = datos_etapa_2_tramo_2['FECHA'].replace("T", " ");

    next(1)

    $('.pasajeros').html('<i class="fas fa-user-friends"></i> '+datos_etapa_1['CANTIDAD_DE_PASAJEROS'])
    $('.distancia').html('<i class="fas fa-road"></i> '+datos_etapa_1['DISTANCIA']+" Km")

    if (datos_etapa_2_tramo_1['TIPO'] == 1) { $('.tipo_1').html("Agenda") } else { $('.tipo_1').html("Oportunidad") }
    $('.fecha_1').html(datos_etapa_2_tramo_1['FECHA'])
    $('.origen_1').html(datos_etapa_2_tramo_1['ORIGEN'])
    $('.destino_1').html(datos_etapa_2_tramo_1['DESTINO'])
    $('.precio_1').html("$"+datos_etapa_2_tramo_1['PRECIO_REFERENCIA'])
    
    if (datos_etapa_2_tramo_2['TIPO'] == 1) { $('.tipo_2').html("Agenda") } else { $('.tipo_2').html("Oportunidad") }
    $('.fecha_2').html(datos_etapa_2_tramo_2['FECHA'])
    $('.origen_2i').html(datos_etapa_2_tramo_2['ORIGEN'])
    $('.destino_2').html(datos_etapa_2_tramo_2['DESTINO'])
    $('.precio_2').html("$"+datos_etapa_2_tramo_2['PRECIO_REFERENCIA'])

    for (var i = 0; i < array_rutas.length; i++) {
        array_rutas[i]
    }
}

/*-------------------------------------------------------------------------------------------*/
//                                         Agendar Viaje                                     //
/*-------------------------------------------------------------------------------------------*/

function finalizar(){

    let datos = {}
    let tipos_tramo = {}

    if (datos_etapa_2_tramo_1['TIPO'] == 1) {tipos_tramo['TIPO_TRAMO_1'] = 1} else if (datos_etapa_2_tramo_1['TIPO'] == 2) { tipos_tramo['TIPO_TRAMO_1'] = 2 }
    if (datos_etapa_2_tramo_2['TIPO'] == 1) {tipos_tramo['TIPO_TRAMO_2'] = 1} else if (datos_etapa_2_tramo_2['TIPO'] == 2) { tipos_tramo['TIPO_TRAMO_2'] = 2 }

    for (const property in tipos_tramo) {

        switch(property){
                case "TIPO_TRAMO_1":
                console.log(tipos_tramo['TIPO_TRAMO_1'])
                datos = datos_etapa_2_tramo_1;
                datos['MATRICULA'] = vehiculo_seleccionado['MATRICULA']
                datos['DISTANCIA'] = datos_etapa_1['DISTANCIA']
                datos['CANTIDAD_DE_PASAJEROS'] = datos_etapa_1['CANTIDAD_DE_PASAJEROS']
                switch(tipos_tramo['TIPO_TRAMO_1']){
                    case 1:
                        console.log("Registro tramo 1 como... Agenda")
                            console.log(datos)
                            $.ajax({
                                type: "POST",
                                url: "/SalioViaje/PHP/Backend.php",
                                data: { opcion:"agendarViaje",datos:JSON.stringify(datos) },
                                success: function (response) {
                                    console.log(response)
                                },
                            });
                        break;

                        case 2:
                            console.log("Registro tramo 1 como... Oportunidad")
                            console.log(datos)
                            $.ajax({
                                type: "POST",
                                url: "/SalioViaje/PHP/Backend.php",
                                data: { opcion:"agregarOportunidad",datos:JSON.stringify(datos) },
                                success: function (response) {
                                    console.log(response)
                                },
                            });
                            break;
                        }
                        break;

                    case "TIPO_TRAMO_2":
                    datos = datos_etapa_2_tramo_2;
                    datos['MATRICULA'] = vehiculo_seleccionado['MATRICULA']
                    datos['DISTANCIA'] = datos_etapa_1['DISTANCIA']
                    datos['CANTIDAD_DE_PASAJEROS'] = datos_etapa_1['CANTIDAD_DE_PASAJEROS']
                    switch(tipos_tramo['TIPO_TRAMO_2']){
                        case 1:
                            console.log("Registro tramo 2 como... Agenda")
                            console.log(datos)
                            $.ajax({
                                type: "POST",
                                url: "/SalioViaje/PHP/Backend.php",
                                data: { opcion:"agendarViaje",datos:JSON.stringify(datos) },
                                success: function (response) {
                                    console.log(response)
                                },
                            });
                        break;

                        case 2:
                            console.log("Registro tramo 2 como... Oportunidad")
                            console.log(datos)
                            $.ajax({
                                type: "POST",
                                url: "/SalioViaje/PHP/Backend.php",
                                data: { opcion:"agregarOportunidad",datos:JSON.stringify(datos) },
                                success: function (response) {
                                    console.log(response)
                                },
                            });
                            break;
                        break;
            }
        }
    }
}

/*-------------------------------------------------------------------------------------------*/
//                                          Validacion                                       //
/*-------------------------------------------------------------------------------------------*/

function validacion(TIPO,DATOS){
  console.log(DATOS)
  let validacion;
  let VALIDO = false;

  reset_errores()

  switch(TIPO){
    case "AGENDAR-VIAJE-ETAPA-1":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"ETAPA-1",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    console.log(validacion)
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;
        case "AGENDAR-VIAJE-ETAPA-2-TRAMO-1":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"ETAPA-2-TRAMO-1",datos:DATOS},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;
    case "AGENDAR-VIAJE-ETAPA-2-TRAMO-2":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"ETAPA-2-TRAMO-2",datos:DATOS},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;
        case "AGENDAR-VIAJE-ETAPA-3":
    validacion = $.ajax({
       type: 'POST',       
       url: "/SalioViaje/PHP/Validaciones.php",
       data: {tipo:"ETAPA-3",datos:JSON.stringify(DATOS)},
       global: false,
       async:false,
       success: function(response) {
         return response;
      }
   }).responseText;
    if (validacion == "VALIDO") {VALIDO = true}
     else if(validacion == "Err-1"){
       $('.mensaje-error').show();
       $('.mensaje-error').text("Debe completar todos los campos.");
    } else {marcar_errores(validacion)}
    break;
 }

 return VALIDO
}

function marcar_errores(resultado_validacion){

   $('.mensaje-error').show();

  console.log(resultado_validacion)
  /*let resultado = JSON.parse(resultado_validacion)

  for (const property in resultado) {
    switch(property){
       case "CI":
       if (resultado[property] == 0) {
          $('#CI').css('border-bottom', '1px solid #ff635a');
          $('.mensaje-error').text("C.I ya registrada o no válida.");
         }    

         break;
      case "NOMBRE":
      if (resultado[property] == 0) {
         $('#nombre').css('border-bottom', '1px solid #ff635a');
         $('.mensaje-error').text("El nombre no debe contener espacios ni caracteres especiales.");
      } 

         break;
      case "APELLIDO":
      if (resultado[property] == 0) {
         $('#apellido').css('border-bottom', '1px solid #ff635a');
         $('.mensaje-error').text("El apellido no debe contener espacios ni caracteres especiales.");
       } 

         break;
      case "MAIL":
      if (resultado[property] == 0) {
         $('#correo').css('border-bottom', '1px solid #ff635a');
         $('.mensaje-error').text("Correo Electrónico no válido.");
        } 

         break;
      case "DIRECCION":
      if (resultado[property] == 0) {
         $('#direccion').css('border-bottom', '1px solid #ff635a');
         $('.mensaje-error').text("Dirección no válida.");
      } 

         break;
      case "BARRIO":
      if (resultado[property] == 0) {
          $('#barrio').css('border-bottom', '1px solid #ff635a');
          $('.mensaje-error').text("Barrio no válido.");
         } 

         break;
      case "DEPARTAMENTO":
      if (resultado[property] == 0) {
          $('#departamento').css('border-bottom', '1px solid #ff635a');
          $('.mensaje-error').text("Departamento no válido."); 
         } 

         break;
      case "TELEFONO":
      if (resultado[property] == 0) { 
        $('#numero_telefono').css('border-bottom', '1px solid #ff635a') 
        $('#numero_telefono_hotel').css('border-bottom', '1px solid #ff635a')
        $('.mensaje-error').text("Teléfono no válido.");
     } 

     break;
     case "RUT":
     if (resultado[property] == 0) {
        $('#rutt').css('border-bottom', '1px solid #ff635a') 
        $('#rut_usuario').css('border-bottom', '1px solid #ff635a');
        $('.mensaje-error').text("RUT no válido, debe contener 12 caracteres.");
     }  
     break;
     case "AGENCIA_CONTRATISTA":
     if (resultado[property] == 0) {
         $('#empresas').css('border-bottom', '1px solid #ff635a');
         $('.mensaje-error').text("Debe seleccionar una Agencia Contratista.");
      } 

      break;
   case "NOMBRE_HOTEL":
   if (resultado[property] == 0) {
       $('#nombre-hotel').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Nombre del hotel no válido.");
      } 

      break;
   case "DIRECCION_HOTEL":
   if (resultado[property] == 0) {
       $('#direccion-hotel').css('border-bottom', '1px solid #ff635a')
       $('.mensaje-error').text("Dirección del hotel no válida.");
      } 

      break;
   case "SUPERVISOR":
   if (resultado[property] == 0) {
      $('#es_supervisor').css('border-bottom', '1px solid #ff635a')
      $('.mensaje-error').text("Debe seleccionar si es o no supervisor.");
   } 

      break;
   case "NOMBRE_COMERCIAL":
   if (resultado[property] == 0) {
       $('#nombre_comercial').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Nombre comercial no válido.");
      } 

      break;
   case "RAZON_SOCIAL":
   if (resultado[property] == 0) {
       $('#razon_social').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Debe seleccionar una razón social.");
      } 

      break;
   case "MTOP":
   if (resultado[property] == 0) {
       $('#numero_mtop').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("N° MTOP no válido.");
       } 

      break;
   case "PASSWORD_MTOP":
   if (resultado[property] == 0) {
      $('#password_mtop').css('border-bottom', '1px solid #ff635a');
      $('.mensaje-error').text("Contraseña MTOP no válida."); 
   } 

      break;
   case "MATRICULA":
   if (resultado[property] == 0) { 
      $('#matricula').css('border-bottom', '1px solid #ff635a');
      $('.mensaje-error').text("Matrícula no válida.");
    } 

      break;
   case "MARCA":
   if (resultado[property] == 0) {
       $('#marca').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Marca no válida.");
       } 

      break;
   case "MODELO":
   if (resultado[property] == 0) {
       $('#modelo').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Modelo no válido.");
       } 

      break;
   case "COMBUSTIBLE":
   if (resultado[property] == 0) {
       $('#combustible').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Debe seleccionar el tipo de combustible.");
      } 

      break;
   case "CAPACIDAD_PASAJEROS":
   if (resultado[property] == 0) {
       $('#capacidad_pasajeros').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Capacidad de pasajeros no válida.");
      } 

      break;
   case "CAPACIDAD_EQUIPAJE":
   if (resultado[property] == 0) {
       $('#capacidad_equipaje').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Capacidad de equipaje no válida.");
        } 

      break;
   case "PET_FRIENDLY":
   if (resultado[property] == 0) {
       $('#pet_friendly').css('border-bottom', '1px solid #ff635a');
       $('.mensaje-error').text("Debe definir si su vehiculo es Pet Friendly o no.");
        } 

      break;

}   

}
*/
}

function reset_errores(){

  $('.mensaje-error').hide();

  $('#CI').css('border-bottom', '1px solid #aaaaaa')
  $('#nombre').css('border-bottom', '1px solid #aaaaaa')
  $('#apellido').css('border-bottom', '1px solid #aaaaaa')
  $('#correo').css('border-bottom', '1px solid #aaaaaa')
  $('#direccion').css('border-bottom', '1px solid #aaaaaa')
  $('#barrio').css('border-bottom', '1px solid #aaaaaa')
  $('#departamento').css('border-bottom', '1px solid #aaaaaa')
  $('#numero_telefono').css('border-bottom', '1px solid #aaaaaa')
  $('#numero_telefono_hotel').css('border-bottom', '1px solid #aaaaaa')
  $('#direccion-hotel').css('border-bottom', '1px solid #aaaaaa')
  $('#password').css('border-bottom', '1px solid #aaaaaa')
  $('#re-password').css('border-bottom', '1px solid #aaaaaa')
  $('#rutt').css('border-bottom', '1px solid #aaaaaa')
  $('#rut_usuario').css('border-bottom', '1px solid #aaaaaa')
  $('#es_supervisor').css('border-bottom', '1px solid #aaaaaa')
  $('#nombre-hotel').css('border-bottom', '1px solid #aaaaaa')
  $('#matricula').css('border-bottom', '1px solid #aaaaaa')
  $('#marca').css('border-bottom', '1px solid #aaaaaa')
  $('#pet_friendly').css('border-bottom', '1px solid #aaaaaa')
  $('#empresas').css('border-bottom', '1px solid #aaaaaa')
  $('#modelo').css('border-bottom', '1px solid #aaaaaa')
  $('#razon_social').css('border-bottom', '1px solid #aaaaaa')
  $('#nombre_comercial').css('border-bottom', '1px solid #aaaaaa')
  $('#numero_mtop').css('border-bottom', '1px solid #aaaaaa')
  $('#password_mtop').css('border-bottom', '1px solid #aaaaaa')
  $('#combustible').css('border-bottom', '1px solid #aaaaaa')
}