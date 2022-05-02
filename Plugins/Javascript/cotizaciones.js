function cambiar_estado_cotizacion_panel_admin(id_cotizacion) {
    console.log("Cotizacion ID: "+id_cotizacion+" Nuevo estado: "+$("#estado-cotizacion").val())
    let estado = $("#estado-cotizacion").val()
    $.ajax({
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: { tipo: 'cambio_estado_cotizacion', idCotizacion: id_cotizacion, estado:estado},
        success: function (response) {
           console.log(response)
        },
     });
}