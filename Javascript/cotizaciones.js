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
      data: { tipo: 'cambio_estado_cotizacion', idCotizacion: id_cotizacion, estado: estado },
      success: function (response) {
         console.log(response)
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

   if(origen != "" || destino != "" || fecha != ""){

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
        
            format = format.replace("MM", month.toString().padStart(2,"0"));        
   
            if (format.indexOf("yyyy") > -1) {
                format = format.replace("yyyy", year.toString());
            } else if (format.indexOf("yy") > -1) {
                format = format.replace("yy", year.toString().substr(2,2));
            }
   
            format = format.replace("dd", day.toString().padStart(2,"0"));
        
            return format;
        }
   
         var encontrado = false;
   
         for (let x = 0; x < 2; x++) {
            if(datos[x].toLowerCase().includes(origen.toLowerCase()) && origen != ""){
               encontrado_origen.push(datos[6]);
            }
         }
   
         for (let x = 2; x < 5; x++) {
            if(datos[x].toLowerCase().includes(destino.toLowerCase()) && destino != ""){
               encontrado_destino.push(datos[6]);
            }
         }
   
         if(datos[5] == dateFormat(fecha, 'dd-MM-yyyy')){
            encontrado_fecha.push(datos[6]);
         }

      }


      if(encontrado_origen.length != 0 && encontrado_destino.length != 0){
         for(let x = 0; x < encontrado_origen.length; x++){
            for(let a = 0; a < encontrado_destino.length; a++){
               if(encontrado_origen[x] == encontrado_destino[a]){
                  comparacion_1.push(encontrado_destino[a]);
               }
            }
         }
      }else if(encontrado_origen.length == 0 && encontrado_destino.length != 0 && origen == ""){
         comparacion_1 = encontrado_destino;
      }else if(encontrado_origen.length != 0 && encontrado_destino.length == 0 && destino == ""){
         comparacion_1 = encontrado_origen;
      }

      if(encontrado_origen.length != 0 && encontrado_fecha.length != 0){
         for(let x = 0; x < encontrado_origen.length; x++){
            for(let a = 0; a < encontrado_fecha.length; a++){
               if(encontrado_origen[x] == encontrado_fecha[a]){
                  comparacion_2.push(encontrado_fecha[a]);
               }
            }
         }
      }else if(encontrado_origen.length == 0 && encontrado_fecha.length != 0 && origen == ""){
         comparacion_2 = encontrado_fecha;
      }else if(encontrado_origen.length != 0 && encontrado_fecha.length == 0 && fecha == ""){
         comparacion_2 = encontrado_origen;
      }



      if(comparacion_1.length != 0 && comparacion_2.length != 0){
         for(let x = 0; x < comparacion_1.length; x++){
            for(let a = 0; a < comparacion_2.length; a++){
               if(comparacion_1[x] == comparacion_2[a]){
                  comparacion_3.push(comparacion_2[a]);
               }
            }
         }
      }else if(comparacion_1.length == 0 && comparacion_2.length != 0 && origen == "" && destino == ""){
         comparacion_3 = comparacion_2;
      }else if(comparacion_1.length != 0 && comparacion_2.length == 0 && origen == "" && fecha == ""){
         comparacion_3 = comparacion_1;
      }

      for (let i = 0; i < atributos.length; i++) {
         datos = atributos[i].split(',');

         if(comparacion_3.length != 0){
            $(".Cotizaciones-list").show();
            $(".list-empty-cotizacion").css('display','none');
            encontrado_final = false;

            for(let x = 0; x < comparacion_3.length; x++){

               if(datos[6] == comparacion_3[x]){
                  $("#" + datos[6]).show();
                  encontrado_final = true;
               }else{
                  if(encontrado_final != true){
                     $("#" + datos[6]).hide();
                  }
                  
               }
            }
         }else{
            for (let i = 0; i < atributos.length; i++) {
               $("#" + datos[6]).hide();

               $(".Cotizaciones-list").hide();
               $(".list-empty-cotizacion").css('display','flex');
            }
         }
         
      }

      

   }else{
      for (let i = 0; i < atributos.length; i++) {
         datos = atributos[i].split(',');
         $("#" + datos[6]).show();

         $(".Cotizaciones-list").show();
         $(".list-empty-cotizacion").css('display','none');
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