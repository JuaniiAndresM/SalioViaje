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

   inuputPrecio();
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
   let senia;
   
   if($("#senia").val() == '') senia = parseInt(document.getElementById('senia').getAttribute('placeholder'));
   else senia = $("#senia").val();
   

   $.ajax({
      type: "POST",
      url: "/PHP/procedimientosForm.php",
      data: { tipo: 'presentarCotizacion', matricula: matricula, precio: precio, senia: senia, id_viaje_cotizado: id_viaje_cotizado, id_tta: id_tta },
      success: function (response) {
         console.log(response)
      },
      complete: function () {
         location.href = "https://www.salioviaje.com.uy/Panel/Success/Cotizacion";
      }
   });
}

function mostrar_cotizaciones_presentadas_dashboard_tta() {
   $.ajax({
      type: "POST",
      url: "/PHP/Tablas/tabla_cotizaciones_presentadas_dashboard.php",
      success: function (response) {
         if (response != null && response != '') {
            $("#empty-cotiz-pres").hide()
            $("#tbody-cotizaciones-dashboard").html(response)
            $(".usuarios-table").show()
         } else {
            setTimeout(() => {
               $("#cotz-pres").hide()
               $("#empty-cotiz-pres").show()
               }, 100);
         }
      },
   });
}

function mostrar_cotizaciones_recibidas_dashboard() {
   $.ajax({
      type: "POST",
      url: "/PHP/Tablas/tabla_cotizaciones_recibidas_dashboard.php",
      success: function (response) {
         if (response != null && response != '') {
            $("#empty-cotiz-reci").hide()
            $(".cotizaciones_recibidas").html(response)
            $(".usuarios-table").show()
         } else {
            
            setTimeout(() => {
            $("#cotz-reci").hide()
            $("#empty-cotiz-reci").show()
            }, 100);
         }
      },
   });
}

function aceptarCotizacion(id, id_viaje_cotizado,step) {
   if(step == 1){
      $.ajax({
         type: "POST",
         url: "https://www.salioviaje.com.uy/Panel/modal.php",
         data: { opcion: 7, data: {id, id_viaje_cotizado} },
         success: function (response) {
             console.log(response);
             document.getElementById('modal').style.display = 'flex';
             $('#modal').html(response);
         }
     });
   }else{
      id_llamada = Math.floor(Math.random() * 100000);
      $.ajax({
         type: "POST",
         url: "/PHP/procedimientosForm.php",
         data: { tipo: 'aceptar_cotizacion', idCotizacion: id, id_viaje_cotizado: id_viaje_cotizado },
         success: function (response) {
            response = response.split("-");
            reconfirmar_cotizacion_llamada(id, id_viaje_cotizado, response[0], response[1]);
            closeModal();
         },
         complete: function () {
         }
      });
   }
   
}

function rechazarCotizacion(id) {
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

function reconfirmar_cotizacion_llamada(id, id_viaje_cotizado, telefono_tta, mail_tta) {
   console.log(id)
   let id_llamada = Math.floor(Math.random() * 100000);
   let send = new llamadas_PHP();
   let mensaje = `Han escogido tu cotizacion!  Aceptar:  https://www.salioviaje.com.uy/Solicitud_C/${id}_${id_viaje_cotizado}A Rechazar: https://www.salioviaje.com.uy/Solicitud_C/${id}_${id_viaje_cotizado}R`;
   send.realizarLlamadaReconfirmarCotizacion("tpc_notificacion_opciones", "2022-02-07T15:00:00+03:00", id_llamada, telefono_tta, "Transportista", "Han escogido tu cotizacion para el viaje numero #" + id_viaje_cotizado + ". Presione 1 para aceptar, 3 para rechazar", id_viaje_cotizado, id_viaje_cotizado);
   send.enviarSMS(telefono_tta,"2022-02-04T15:00:00+03:00",mensaje,id_llamada);
   console.log(mail_tta)
   mail_aprobar_rechazar_cotizacion(id, id_viaje_cotizado, mail_tta)

   var features = 'directories=no,menubar=no,status=no,titlebar=no,toolbar=no,width=550,height=700';
   window.open("https://www.salioviaje.com.uy/Espera/"+id+'C', 'mypopup', features);
}

function mail_aprobar_rechazar_cotizacion(id, id_viaje_cotizado, mail) {
   $.ajax({
      type: "POST",
      url: "/Mail/mail-Cotizacion-Aceptada.php",
      data: { id: id, id_viaje_cotizado: id_viaje_cotizado, mail: mail },
      success: function (response) {
         console.log(response)
      }
  });
}

function copiar_solicitud(id_solicitud, step) {
   switch(step){
      case 1:
         $.ajax({
            type: "POST",
            url: "/Panel/modal.php",
            data: { data: id_solicitud, opcion: 5 },
            success: function (response) {
               console.log(response);
                    $('#modal').css('display','flex');
                    $('#modal').html(response); 
            }
        });
        break;

      case 2:

         let nueva_fecha = $('#fecha_copia').val();
         let hora_copia = $('#hora_copia').val();

         $.ajax({
            type: "POST",
            url: "/PHP/procedimientosForm.php",
            data: { tipo:"copiar_solicitud_viaje", id_solicitud : id_solicitud , nueva_fecha : nueva_fecha , hora_copia : hora_copia},
            success: function (response) {
               if (response.includes("@")) {
                  enviarMail(response);
               }else{
                  console.log(response)
               }
            },
            complete: function () {
               location.reload()
            }
        });
        break;
   }
}

function enviarMail(mail) {
   $.ajax({
      type: "POST",
      url: "/Mail/mail-Oportunidad-Reconfirmada-Rechazada.php",
      data: { mail: mail },
      success: function (response) {
         console.log(response);
      }
  });
}

const inuputPrecio = () => {
   let precio = document.getElementById('precio');
   let seniaInput = document.getElementById('senia-input');

   if(precio.value != '' && precio.value != 0){
      seniaInput.style.display = '';
      let calculatedSenia = Math.round(precio.value * 0.20);
      seniaInput.querySelectorAll('#senia')[0].setAttribute('placeholder',calculatedSenia);
   }else{
      seniaInput.style.display = 'none';
   }
}

/*

1) moroso (no paga)
2) capacidad de asientos
3) que una pataq este en el recorrido
4) que no este ocupado
5) es pet friendly

*/