window.addEventListener('load',()=>{
    $('#header').load('/web/foreman/header.php');
    $('#footer').load('/web/footer.html');
    $('#flotant-promo').load('/web/flotant-promo.html');

    agregar_visita();
    traer_oportunidades();

    document.getElementById('pre-loader').classList.toggle('load');

    document.getElementById(`filters`).style.display = 'none';
    document.getElementById(`filters2`).style.display = 'none';

    setTimeout(() => {
        datavalue_oportunidades();
    }, 1000);
    setTimeout(() => {
        flotantPromo();
    }, 3000);
});

function datavalue_oportunidades(){
    var oportunidades = document.getElementsByClassName("oportunidad").length;

    console.log(oportunidades);

    if(oportunidades != 0){
        for(var a = 0; a < oportunidades; a++){
            let data_value_info = $("#Opo-" + a).data('value');
            atributos.push(data_value_info);
        }
    }
}


function cerrarsesion(){
    $.ajax({ 
        url: "https://www.salioviaje.com.uy/PHP/cerrarSession.php",
        success: function(response){
            $('#header').load('/web/foreman/header.php');
            location.reload()
        }
    });
}

function dashboard(){
    window.location = "https://www.salioviaje.com.uy/Dashboard";
}


function agregar_visita(){
    $.ajax({ 
        type: "POST",
        url: "/PHP/procedimientosForm.php",
        data: {tipo:"visita"}
    });
}

function suscripcion(){

    var mail = $('#mail-footer').val();
    
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/Mail/mail-Bienvenida.php",
        data: {email: mail},
        success: function (response) {
            console.log(response);
            if(response == 1){
                $('.suscribirse-mail').hide();
                $('.suscrito-mail').show();
                $('#mail-footer').val(" ")
                setTimeout(() => {
                    $('.suscribirse-mail').show();
                    $('.suscrito-mail').hide();
                }, 5000);
            }else{
                console.log(response);
            }
            
        }
    });
}

function comprar_oportunidad(id){
    abrir_ventana(id);
    comprar_oportunidad_function(id)
}

function abrir_ventana(id) { 
    var features = 'directories=no,menubar=no,status=no,titlebar=no,toolbar=no,width=550,height=700';
    var mypopup = window.open('https://www.salioviaje.com.uy/Espera/' + id, 'mypopup', features);
}

function detalles_oportunidad(id){
    
    location.href = "/Oportunidad/" + id;

}

function traer_oportunidades(){
    
     $.ajax({
        type: "POST",
        url: "/PHP/Tablas/oportunidadesIndex.php",
        success: function (response) {
            if (response == ' ' || response == '0') {$('.list-empty').css('display', 'flex')} else {
                $('.list-empty').hide();                
                $('#oporunidades-tabla').html(response);
                $('#oporunidades-tabla').show();
            } 
             
        }
    });

    setTimeout(() => {
        $("#contador-oportunidades").html(document.getElementsByClassName('oportunidad').length);
    }, 500);
}

function traer_cotizacion(){
    $('.list-empty-cotizacion').show();
    $('.Cotizaciones-list').hide();
    //  $.ajax({
    //     type: "POST",
    //     url: "/PHP/Tablas/oportunidadesIndex.php",
    //     success: function (response) {
    //         console.log(response)
    //         if (response == ' ' || response == '0') {$('.list-empty').css('display', 'flex')} else {
    //             $('.list-empty-cotizacion').hide();                
    //             $('.Cotizaciones-list').html(response);
    //             $('.Cotizaciones-list').show();
    //         } 
             
    //     }
    // });
}


function filtros(number){

    switch(number){
        case 1:
            $('#filters').toggle(''); 
            break;

        case 2:
            $('#filters2').toggle(''); 
            break;
    }
     
}

function filtrar_divs(tipo) {
    var origen;
    switch(tipo){

        case "Oportunidad":
            origen = $("#origen_oportunidad").val();
            var destino = $("#destino_oportunidad").val();
            var fecha = $("#fecha_oportunidad").val();
            break;

    }
 
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

            console.log(origen);

            if(datos[0].toLowerCase().includes(origen.toLowerCase()) && origen != ""){
                encontrado_origen.push(i);
            }
    
            if(datos[1].toLowerCase().includes(destino.toLowerCase()) && destino != ""){
                encontrado_destino.push(i);
            }
    
            if(datos[2] == dateFormat(fecha, 'dd-MM-yyyy')){
                encontrado_fecha.push(i);
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
 
       console.log(comparacion_3);

       for (let i = 0; i < atributos.length; i++) {
          datos = atributos[i].split(',');
 
          if(comparacion_3.length != 0){
             $(".oportunidades-list").show();
             $(".list-empty").css('display','none');
             var encontrado_final = false;

             for(let x = 0; x < comparacion_3.length; x++){

                if(i == comparacion_3[x]){
                   $("#Opo-" + i).show();
                   encontrado_final = true;
                }else{
                   if(encontrado_final != true){
                      $("#Opo-" + i).hide();
                   }
                }
             }
          }else{
             for (let i = 0; i < atributos.length; i++) {
                $("#Opo-" + i).hide();
 
                $(".oportunidades-list").hide();
                $(".list-empty").css('display','flex');
             }
          }
          
       }
 
       
 
    }else{
       for (let i = 0; i < atributos.length; i++) {
          $("#Opo-" + i).show();
 
          $(".oportunidades-list").show();
          $(".list-empty").css('display','none');
       }
    }
 
    
 
    /*
    for(var a = 0; a < (cards - 1); a++){
       console.log($('[data-value="Fecha'+cards+'"]').text()); 
    }
    */
 }

 function eliminar_filtros(tipo) {

    switch(tipo){
        case "Oportunidad":
            $("#origen_oportunidad").val("");
            $("#destino_oportunidad").val("");
            $("#fecha_oportunidad").val("");
            break;
    }
 
    filtrar_divs(tipo);
 }


 function obtenerDiaSemana(fecha){

    const nombreDelDiaSegunFecha = fecha => [
        'DOM',
        'LUN',
        'MAR',
        'MIE',
        'JUE',
        'VIE',
        'SAB',
        'DOM',
      ][new Date(fecha).getDay()];
      
      let fecha_split = fecha.split("-");

      fecha = fecha_split[2]+"-"+fecha_split[1]+"-"+fecha_split[0];
      
      console.log(nombreDelDiaSegunFecha(fecha+" 00:00:00"))
 }

 let flotantPromo = () => {
    const promo = document.getElementById(`flotant-promo`);
    if(promo != null){
        promo.classList.toggle(`active`)
    }
 }