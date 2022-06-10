let id_cotizaciones;
let atributos = new Array()

$(document).ready(function () {
   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: "traer_id_cotizaciones" },
      success: function (response) {
         id_cotizaciones = JSON.parse(response)
         for (let i = 0; i < id_cotizaciones.length; i++) {
            if (id_cotizaciones[i] != null) {
               let data_value_info = $("#" + id_cotizaciones[i]).data('value') + "," + id_cotizaciones[i];
               atributos.push(data_value_info)
            }
         }
         console.log(atributos)
      }
   });
});


function cambiar_estado_cotizacion_panel_admin(id_cotizacion) {
   console.log("Cotizacion ID: " + id_cotizacion + " Nuevo estado: " + $("#estado-cotizacion-" + id_cotizacion).val())
   let estado = $("#estado-cotizacion-" + id_cotizacion).val()
   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'cambiar_estado_cotizacion_panel_admin', idCotizacion: id_cotizacion, estado: estado },
      success: function (response) {
         console.log(response)
         var estado = "";

         switch ($("#estado-cotizacion-" + id_cotizacion).val()) {
            case "1":
               estado = "Cotizando";
               break;
            case "2":
               estado = "Cotizado";
               break;
            case "3":
               estado = "Aceptado";
               break;
            case "4":
               estado = "Reconfirmado";
               break;
         }
         $("#value-estado-" + id_cotizacion).html(estado);
      },
   });
}

function update_responsable(id_cotizacion) {
   var responsable_text = $("select#tta-responsable-" + id_cotizacion + " option").filter(":selected").text();
   var responsable = $("#tta-responsable-" + id_cotizacion).val();

   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'cambiar_responsable_cotizacion_panel_admin', idCotizacion: id_cotizacion, responsable: responsable },
      success: function (response) {
         console.log(response)
         $("#value-responsable-" + id_cotizacion).html(responsable_text);
      },
   });
}

function filtros_cotizaciones() {
   $('#filters').toggle('');

   // $(".filter-wrapper").toggleClass("filtrar");

   // if($(".filter-wrapper").hasClass("filtrar")){
   //    filtrar();
   // }
}

function filtrar() {
   var origen = $("#origen_cotizacion").val();
   var destino = $("#destino_cotizacion").val();
   var fecha = $("#fecha_cotizacion").val();

   //var cards = document.getElementsByClassName("Cotizaciones").length;

   if (origen != "" || destino != "" || fecha != "") {

      var encontrado_origen = [];
      var encontrado_destino = [];
      var encontrado_fecha = [];

      var comparacion_1 = [];
      var comparacion_2 = [];
      var comparacion_3 = [];

      for (let i = 0; i < atributos.length; i++) {
         datos = atributos[i].split(',')

         function dateFormat(inputDate, format) {
            const date = new Date(inputDate);

            const day = date.getDate() + 1;
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            format = format.replace("MM", month.toString().padStart(2, "0"));

            if (format.indexOf("yyyy") > -1) {
               format = format.replace("yyyy", year.toString());
            } else if (format.indexOf("yy") > -1) {
               format = format.replace("yy", year.toString().substr(2, 2));
            }

            format = format.replace("dd", day.toString().padStart(2, "0"));

            return format;
         }

         var encontrado = false;

         for (let x = 0; x < 2; x++) {
            if (datos[x].toLowerCase().includes(origen.toLowerCase()) && origen != "") {
               encontrado_origen.push(datos[6]);
            }
         }

         for (let x = 2; x < 5; x++) {
            if (datos[x].toLowerCase().includes(destino.toLowerCase()) && destino != "") {
               encontrado_destino.push(datos[6]);
            }
         }

         if (datos[5] == dateFormat(fecha, 'dd-MM-yyyy')) {
            encontrado_fecha.push(datos[6]);
         }

      }


      if (encontrado_origen.length != 0 && encontrado_destino.length != 0) {
         for (let x = 0; x < encontrado_origen.length; x++) {
            for (let a = 0; a < encontrado_destino.length; a++) {
               if (encontrado_origen[x] == encontrado_destino[a]) {
                  comparacion_1.push(encontrado_destino[a]);
               }
            }
         }
      } else if (encontrado_origen.length == 0 && encontrado_destino.length != 0 && origen == "") {
         comparacion_1 = encontrado_destino;
      } else if (encontrado_origen.length != 0 && encontrado_destino.length == 0 && destino == "") {
         comparacion_1 = encontrado_origen;
      }

      if (encontrado_origen.length != 0 && encontrado_fecha.length != 0) {
         for (let x = 0; x < encontrado_origen.length; x++) {
            for (let a = 0; a < encontrado_fecha.length; a++) {
               if (encontrado_origen[x] == encontrado_fecha[a]) {
                  comparacion_2.push(encontrado_fecha[a]);
               }
            }
         }
      } else if (encontrado_origen.length == 0 && encontrado_fecha.length != 0 && origen == "") {
         comparacion_2 = encontrado_fecha;
      } else if (encontrado_origen.length != 0 && encontrado_fecha.length == 0 && fecha == "") {
         comparacion_2 = encontrado_origen;
      }



      if (comparacion_1.length != 0 && comparacion_2.length != 0) {
         for (let x = 0; x < comparacion_1.length; x++) {
            for (let a = 0; a < comparacion_2.length; a++) {
               if (comparacion_1[x] == comparacion_2[a]) {
                  comparacion_3.push(comparacion_2[a]);
               }
            }
         }
      } else if (comparacion_1.length == 0 && comparacion_2.length != 0 && origen == "" && destino == "") {
         comparacion_3 = comparacion_2;
      } else if (comparacion_1.length != 0 && comparacion_2.length == 0 && origen == "" && fecha == "") {
         comparacion_3 = comparacion_1;
      }

      for (let i = 0; i < atributos.length; i++) {
         datos = atributos[i].split(',');

         if (comparacion_3.length != 0) {
            $(".Cotizaciones-list").show();
            $(".list-empty-cotizacion").css('display', 'none');
            encontrado_final = false;

            for (let x = 0; x < comparacion_3.length; x++) {

               if (datos[6] == comparacion_3[x]) {
                  $("#" + datos[6]).show();
                  encontrado_final = true;
               } else {
                  if (encontrado_final != true) {
                     $("#" + datos[6]).hide();
                  }

               }
            }
         } else {
            for (let i = 0; i < atributos.length; i++) {
               $("#" + datos[6]).hide();

               $(".Cotizaciones-list").hide();
               $(".list-empty-cotizacion").css('display', 'flex');
            }
         }

      }



   } else {
      for (let i = 0; i < atributos.length; i++) {
         datos = atributos[i].split(',');
         $("#" + datos[6]).show();

         $(".Cotizaciones-list").show();
         $(".list-empty-cotizacion").css('display', 'none');
      }
   }



   /*
   for(var a = 0; a < (cards - 1); a++){
      console.log($('[data-value="Fecha'+cards+'"]').text()); 
   }
   */
}

function eliminar_filtros() {
   $("#origen_cotizacion").val("")
   $("#destino_cotizacion").val("")
   $("#fecha_cotizacion").val("")

   filtrar();
}

function presentarCotizacion(id_viaje_cotizado, id_tta) {
   let matricula = $("#vehiculosCotizar").val();
   let precio = $("#precio").val();
   let senia = $("#senia").val();

   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'presentarCotizacion', matricula: matricula, precio: precio, senia: senia, id_viaje_cotizado: id_viaje_cotizado, id_tta: id_tta },
      success: function (response) {
         console.log(response)
         location.href = "https://www.salioviaje.com.uy/Central";
      },
   });
}

function mostrar_cotizaciones_presentadas_dashboard_tta() {
   $.ajax({
      type: "POST",
      url: "/PHP/Tablas/tabla_cotizaciones_presentadas_dashboard.php",
      success: function (response) {
         if (response != null) {
            $("#empty-cotiz-pres").hide()
            $("#tbody-cotizaciones-dashboard").html(response)
            $(".usuarios-table").show()
         } else {
            $("#empty-cotiz-pres").show()
         }
      },
   });
}

function mostrar_cotizaciones_recibidas_dashboard() {
   $.ajax({
      type: "POST",
      url: "/PHP/Tablas/tabla_cotizaciones_recibidas_dashboard.php",
      success: function (response) {
         if (response != null) {
            $("#empty-cotiz-reci").hide()
            $(".cotizaciones_recibidas").html(response)
            $(".usuarios-table").show()
         } else {
            $("#empty-cotiz-reci").show()
         }
      },
   });
}

function aceptarCotizacion(id, id_viaje_cotizado) {
   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'aceptar_cotizacion', idCotizacion: id, id_viaje_cotizado: id_viaje_cotizado },
      success: function (response) {
         reconfirmar_cotizacion_llamada(id, id_viaje_cotizado, response)
      },
      complete: function () {
         setTimeout(() => {
            location.reload()
         }, 1000);
      }
   });
}

function rechazarCotizacion(id) {
   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'rechazar_cotizacion', idCotizacion: id },
      success: function (response) {
         console.log(response)
      },
      complete: function () {
         location.reload()
      }
   });
}

function eliminarCotizacion(id) {
   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'eliminar_cotizacion', idCotizacion: id },
      success: function (response) {
         console.log(response)
      },
      complete: function () {
         location.reload()
      }
   });
}

function reconfirmarCotizacion(id) {
   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'reconfirmar_cotizacion', idCotizacion: id },
      success: function (response) {
         console.log(response)
      },
      complete: function () {
         location.reload()
      }
   });
}


function reconfirmar_cotizacion_llamada(id, id_viaje_cotizado, telefono_tta) {
   let send = new llamadas_PHP();
   console.log(id+"   "+id_viaje_cotizado+"   "+telefono_tta)
   let id_llamada = Math.floor(Math.random() * 100000);
   let mensaje = `Han escogido tu cotizacion para el viaje numero #${id}!  Aceptar:  https://www.salioviaje.com.uy/Solicitud/${id}A Rechazar: https://www.salioviaje.com.uy/Solicitud/${id}R`;
   send.realizarLlamadaReconfirmarCotizacion("tpc_notificacion_opciones", "2022-02-07T15:00:00+03:00", id_llamada, telefono_tta, "Transportista", "Han escogido tu cotizacion para el viaje numero #" + id + ". Presione 1 para aceptar, 3 para rechazar", id, id_viaje_cotizado);
   send.enviarSMSReconfirmarCotizacion(telefono_tta, "2022-02-04T15:00:00+03:00", mensaje, id_llamada);
   //mail_aprobar_rechazar_cotizacion(id)
}

function mail_aprobar_rechazar_cotizacion() {
   $.ajax({
      type: "POST",
      url: "/Mail/mail-Oportunidades-Aceptado.php",
      data: { mail_tta:JSON.parse(mail_tta)['MAIL'], id_viaje: id},
      success: function (response) {
         console.log(response)
      }
  });
}

/*

1) moroso (no paga)
2) capacidad de asientos
3) que una pataq este en el recorrido
4) que no este ocupado
5) es pet friendly

*/