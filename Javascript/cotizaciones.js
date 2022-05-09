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

// function filtros_cotizaciones(){
//    $('#filters').toggle('');
//    $(".filter-wrapper").toggleClass("filtrar");

//    if($(".filter-wrapper").hasClass("filtrar")){
//       filtrar();
//    }
// }

function filtrar(){
   var origen = $("#origen_cotizacion").val();
   var destino = $("#destino_cotizacion").val();
   var fecha = $("#fecha_cotizacion").val();

   console.log("Origen: " + origen + " Destino: " + destino + " Fecha: " + fecha);

   var cards = document.getElementsByClassName("Cotizaciones").length;

}

function eliminar_filtros(){
   $("#origen_cotizacion").val("")
   $("#destino_cotizacion").val("")
   $("#fecha_cotizacion").val("")

   filtrar();
}