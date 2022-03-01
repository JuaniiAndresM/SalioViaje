function guardar_cambios_vehiculos_panel(rut){
	console.log(vehiculos)
	console.log(" rut:"+rut)
	$.ajax({
        type: "POST",
        url: "/SalioViaje/PHP/procedimientosForm.php",
        data: {tipo:'guardar-vehiculos' ,vehiculos:JSON.stringify(vehiculos),rut:rut },
          success: function (response) {
  			console.log(response)
          },
    });
}

function vehiculos_vista_previa(vehiculo){
	vehiculos.push(vehiculo)
    $.ajax({
      type: "POST",
      url: "/SalioViaje/PHP/Tablas/agregarVehiculo.php",
      data: {datos:JSON.stringify(vehiculo) },
      success: function (response) {
        console.log(response);
        $('.vehiculos-wrapper').show();
        $('.vehiculos').append(response);
        $('#no-vehicle').hide();
        reset_vehicle_inputs();
     },
  });
}