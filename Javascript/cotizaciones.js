let id_cotizaciones;
$(document).ready(function () {
   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: {tipo:"traer_id_cotizaciones"},
      success: function (response) {
         id_cotizaciones = JSON.parse(response)
      }
   });
});


function cambiar_estado_cotizacion_panel_admin(id_cotizacion) {
    console.log("Cotizacion ID: "+id_cotizacion+" Nuevo estado: "+$("#estado-cotizacion-" + id_cotizacion).val())
    let estado = $("#estado-cotizacion-" + id_cotizacion).val()
    $.ajax({
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: { tipo: 'cambio_estado_cotizacion', idCotizacion: id_cotizacion, estado:estado},
        success: function (response) {
           console.log(response)
        },
     });
}

function filtros_cotizaciones(){
   $('#filters').toggle('');
   $(".filter-wrapper").toggleClass("filtrar");

   if($(".filter-wrapper").hasClass("filtrar")){
      filtrar();
   }else{
      eliminar_filtros();
   }
}

function filtrar(){
   var origen = $("#origen_cotizacion").val();
   var destino = $("#destino_cotizacion").val();
   var fecha = $("#fecha_cotizacion").val();

   console.log("Origen: " + origen + " Destino: " + destino + " Fecha: " + fecha);

   var cards = document.getElementsByClassName("Cotizaciones").length;

   

   for (let i = 0; i < id_cotizaciones.length; i++) {
      if (id_cotizaciones[i] != null) {
         console.log($("#"+id_cotizaciones[i]).data('value'))
      }
   }

   for(var a = 0; a < (cards - 1); a++){
      console.log($('[data-value="Fecha'+cards+'"]').text()); 
   }

}

function eliminar_filtros(){
   console.log("Hola");
   $("#origen_cotizacion").val("")
   $("#destino_cotizacion").val("")
   $("#fecha_cotizacion").val("")

   filtrar();
}