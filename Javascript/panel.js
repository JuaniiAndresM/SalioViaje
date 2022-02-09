let NOMBRE_USUARIO;
$(document).ready(function () {
    let list = document.querySelectorAll('#panel-navbar li');

    function activateLink(){
        list.forEach((item) => 
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }

    traigoVisitas();

    $("#ID").on('click', function() {
        console.log(cambiarOrden(orden))
        ordenarId(orden)
    });

    $("#actualizar_panel").on('click', function() {
        actualizar_panel()
    });

    $('#vehiculos-select').on('change', function (){
        let matricula = document.getElementById('vehiculos-select').value;
        actualizar_vista_previa(matricula);
    });

    $("#cerrar_session_dashboard").on('click', function() {
        $.ajax({ 
            url: "/PHP/cerrarSession.php",
            success: function(response){
                window.location = "https://www.salioviaje.com.uy";
            }
        });
    });

    list.forEach((item) => 
    item.addEventListener('mouseover', activateLink));
    $('#panel-navbar').load('/web/panel-navbar.php');


    $('#select_actualizar').change(function(){
        actualizar_panel($(this).children('option:selected').val());
    });
});

function navbar(){
    let navbar = document.getElementById('panel-navbar');
    let header = document.getElementById('header');
    let panel = document.getElementById('panel');
    
    navbar.classList.toggle('active');
    header.classList.toggle('active');
    panel.classList.toggle('active');
}

function buscarUsuarios(buscador) {
    var input, filter, table, tr, td, i, txtValue, tdlength;
    input = document.getElementById("searchbar");
    filter = input.value.toUpperCase();

    switch(buscador){
        case 1:
            table = document.getElementById("search-table");
            tdlength = 5;
            break;
        case 2:
            table = document.getElementById("search-table-usuarios");
            tdlength = 14;
            break;
        case 3:
            table = document.getElementById("search-table-empresas");
            tdlength = 6;
            break;
    }

    tr = table.getElementsByTagName("tr");
    console.log(tr);
    

    for (i = 0; i < tr.length; i++) {

        a = 0;
        encontrado = false;

        do{
            td = tr[i].getElementsByTagName("td")[a];
            
            if (td) {
                txtValue = td.textContent || td.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    encontrado = true;
                } else {
                    tr[i].style.display = "none";
                }
            }

            a++;
        }while(a != tdlength && encontrado == false);            
            
    }
}
/*-------------------------------------------------------------------------------------------*/
//                                       TABLAS                                              //
/*-------------------------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------*/
//                                     Usuarios                                              //
/*-------------------------------------------------------------------------------------------*/
let usuarios

function traerUsuarios(seccion){
         
        usuarios = $.ajax({
                        type: 'POST',       
                        url: "/PHP/Backend.php",
                        data: {opcion:"usr"},
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;
                    console.log("Usuarios: " + usuarios);
    usuarios = JSON.parse(usuarios)
    
    tablas_usuarios(seccion);
}

function tablas_usuarios(seccion){
    console.log(seccion)

    for (var i = 0;i < usuarios.length; i++) {
        switch(seccion){
            case "Dashboard":
                    tabla_usuarios_dashboard(usuarios[i])
                break;

            case "usuarios":
                    tabla_seccion_usuarios(usuarios[i])
                break;
        }
    }
}

function tabla_usuarios_dashboard(){

        $.ajax({ 
            type: "POST",
            data: {opcion:"tab_dashboard_usuarios"},
            url: "/SalioViaje/PHP/Backend.php",
            success: function(response){
                let numero_usuarios
                if(response != 0){
                  numero_usuarios = $("#tbody-usuarios tr").length
                  $("#tbody-usuarios").html(response)
                }else{
                  numero_usuarios = 0
                  $("#tbody-usuarios").html("")
                }
            },
            complete: function() {
                let usuarios_total = $(".usuarios-table > tbody").children().length;
                if (usuarios_total == 1) {
                    $("#cantidad-usuarios").html('<h2>0</h2><i class="fas fa-user-friends"></i>')
                }else{
                    usuarios_total = usuarios_total-1
                    $("#cantidad-usuarios").html('<h2>'+usuarios_total+'</h2><i class="fas fa-user-friends"></i>')
                }

                $('.ADM').hide()
            }
        })
}

function actualizar_tablas(){
    tabla_usuarios_dashboard()
    tabla_empresas_dashboard()
}


function tabla_seccion_usuarios(usuario){

    var tabla = document.getElementById('tbody')
    if (usuario['TIPO_USUARIO'] != "ADM") {
        var row = document.createElement("tr")
        row.setAttribute('class',usuario['TIPO_USUARIO'])
    let contador = 0;

    for (const property in usuario) {
        let td = document.createElement("td");
        if (contador != 14) {
            if (usuario[property] == null || usuario[property] == '' || usuario[property] == undefined ) {
                td.innerHTML = "-"
            }else if(property == "ID"){
                ID_USUARIO = usuario[property]
                td.innerHTML = usuario[property]
            }else if( property != "RUT"){
                td.innerHTML = usuario[property]
            }

            if(property == "NOMBRE_HOTEL" || property == "DIRECCION_HOTEL" || property == "SUPERVISOR"){
                td.setAttribute('class', "HTL");
            }
            else if(property == "AGENCIA_CONTRATISTA"){
                td.setAttribute('class', "CHO");
            }
            row.appendChild(td);
        }
        contador++
    }

    let td = document.createElement("td");
    td.innerHTML += '<div class="button-wrapper"><button id="'+ID_USUARIO+'" class="button" disabled><i class="far fa-eye"></i></button><button id="'+ID_USUARIO+'" class="button" disabled><i class="fas fa-edit"></i></button><button id="'+ID_USUARIO+'" class="button" disabled><i class="fas fa-trash-alt"></i></button></div>'
    row.appendChild(td);
    //
    //agrego la fila a la tabla
    //
    console.log(row)
    if (row != " ") {tabla.appendChild(row);}
}
}
/*-------------------------------------------------------------------------------------------*/
//                                     Empresas                                              //
/*-------------------------------------------------------------------------------------------*/
let empresas

function traerEmpresas(seccion){
    empresas = $.ajax({
                        type: 'POST',       
                        url: "/PHP/Backend.php",
                        data: {opcion:"emp"},
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;
    empresas = JSON.parse(empresas)
    tablas_empresas(seccion);
}

function tablas_empresas(seccion){
    console.log(seccion)
    for (var i = 0;i < empresas.length; i++) {
        switch(seccion){
            case "Dashboard":
                    tabla_empresas_dashboard(empresas[i])
                break;

            case "empresas":
                    tabla_seccion_empresas(empresas[i])
                break;
        }
    }
}

function tabla_empresas_dashboard(){
    $.ajax({ 
        type: "POST",
        data: {opcion:"tab_dashboard_empresas"},
        url: "/SalioViaje/PHP/Backend.php",
        success: function(response){
            if(response != 0){
                $(".propietarios").html(response)
            }else{
                $(".propietarios").html("")
            } 

        }
    })
}

function tabla_seccion_empresas(empresa){
    var tabla = document.getElementById('tbody')
    var row = document.createElement("tr")
    row.setAttribute('class',empresa['TIPO_USUARIO'])
    let contador = 0;

    for (const property in empresa) {
        let td = document.createElement("td");
            console.log(empresa[property])
        if(property == "ID"){
                ID_EMPRESA = empresa[property]
                td.innerHTML = empresa[property]
        }else{
                td.innerHTML = empresa[property]
        }
            row.appendChild(td);
        contador++
    }
    /*
    let td = document.createElement("td");
    td.innerHTML += '<button id="'+ID_EMPRESA+'">Ver</button>'
    row.appendChild(td);
    */
    //
    //agrego la fila a la tabla
    //
    tabla.appendChild(row);
}
/*-------------------------------------------------------------------------------------------*/
//                                     Vehiculos                                             //
/*-------------------------------------------------------------------------------------------*/
let vehiculos

function traerVehiculos(){
    vehiculos = $.ajax({
                        type: 'POST',       
                        url: "/PHP/Backend.php",
                        data: {opcion:"vih"},
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;
    vehiculos = JSON.parse(vehiculos)
     console.log(vehiculos)
    tablas_vehiculos();
}

function tablas_vehiculos(){
    for (var i = 0;i < vehiculos.length; i++) {
        tabla_seccion_vehiculos(vehiculos[i])
    }
}

function tabla_seccion_vehiculos(vehiculo){
    var tabla = document.getElementById('tbody')
    var row = document.createElement("tr")
    let contador = 0;
    let ID_VEHICULO

    for (const property in vehiculo) {
        let td = document.createElement("td"); 

        if(property == "ID"){
                ID_VEHICULO = vehiculo[property]
                td.innerHTML = vehiculo[property]
        }else if(property == "RUT_EM" && vehiculo[property] == "1"){
                td.innerHTML = "NO"
        }else if(property == "RUT_EM" && vehiculo[property] == "2"){
                td.innerHTML = "SI"
        }else{
            td.innerHTML = vehiculo[property]
        }

        row.appendChild(td);
        contador++
    }
    /*
    let td = document.createElement("td");
    td.innerHTML += '<button id="'+ID_EMPRESA+'">Ver</button>'
    row.appendChild(td);
    */
    //
    //agrego la fila a la tabla
    //
    tabla.appendChild(row);
}

function filtros(){
    $(".checkboxs").on('click', function() {
        if(!$("#pax").prop("checked")){ $(".PAX").hide() }else{ $(".PAX").show() }
        if(!$("#tta").prop("checked")){ $(".TTA").hide() }else{ $(".TTA").show() }
        if(!$("#cho").prop("checked")){ $(".CHO").hide() }else{ $(".CHO").show() }
        if(!$("#anf").prop("checked")){ $(".ANF").hide() }else{ $(".ANF").show() }
        if(!$("#htl").prop("checked")){ $(".HTL").hide() }else{ $(".HTL").show() }
        if(!$("#ase").prop("checked")){ $(".ASE").hide() }else{ $(".ASE").show() }
        if(!$("#agt").prop("checked")){ $(".AGT").hide() }else{ $(".AGT").show() }
        //if(!$("#").prop("checked")){ console.log("Oculto") }else{ console.log("Muestro") }
    });
}

/*-------------------------------------------------------------------------------------------*/
//                                       Visitas                                             //
/*-------------------------------------------------------------------------------------------*/

function traigoVisitas(){
        visitas = $.ajax({
                        type: 'POST',       
                        url: "/PHP/Backend.php",
                        data: {opcion:"visitas"},
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
        }).responseText;
        if (visitas == "null") {
            $('#visitas_hoy').html("0")  
        }else { $('#visitas_hoy').html(visitas) }

}

/*-------------------------------------------------------------------------------------------*/
//                                       Actualizar                                          //
/*-------------------------------------------------------------------------------------------*/
 var actualizar
function actualizar_panel(opc){
    switch(opc){
        case '0':
        console.log("parar")
            clearInterval(actualizar)
            break;
        case '1':
            crear_intervalo(1000)
            break;
        case '2':
            crear_intervalo(5000)
            break;
        case '3':
            crear_intervalo(10000)
            break;
        case '4':
            crear_intervalo(15000)
            break;
    }


}

function crear_intervalo(tiempo){
    actualizar = setInterval(function(){
        traigoVisitas()
        actualizar_tablas()
    },tiempo)
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
        opt.text = vehiculos_select[i]["MARCA"]+" "+vehiculos_select[i]["MODELO"]+" - "+vehiculos_select[i]["MATRICULA"];
        selectVehiculos.appendChild(opt);
      }
   }
});
}

function actualizar_vista_previa(vehiculo){
    for (var i = 0; i < vehiculos_select.length; i++) {
        if(vehiculos_select[i]['MATRICULA'] == vehiculo){
            /*
            <p id="matricula"><i class="fas fa-address-card"></i> STU6574</p>
            <p id="marca"><i class="fas fa-car"></i> Hyundai</p>
            <p id="modelo"><i class="fas fa-list"></i> H1 2001</p>
            <p id="capacidad"><i class="fas fa-users"></i> 12</p>
            <p id="combustible"><i class="fas fa-gas-pump"></i> Diesel</p>
            */
            $("#matricula").html('<i class="fas fa-address-card"></i> '+vehiculos_select[i]['MATRICULA'])
            $("#marca").html('<i class="fas fa-car"></i> '+vehiculos_select[i]['MARCA'])
            $("#modelo").html('<i class="fas fa-list"></i> '+vehiculos_select[i]['MODELO'])
            $("#capacidad").html('<i class="fas fa-users"></i> '+vehiculos_select[i]['CAPACIDAD'])
            $("#combustible").html('<i class="fas fa-gas-pump"></i> '+vehiculos_select[i]['COMBUSTIBLE'])
            vehiculo_seleccionado = vehiculos_select[i]
        }
    }
}

function etapa_1(){
    datos_etapa_1 = {
        
    }
}