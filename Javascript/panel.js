let NOMBRE_USUARIO;
$(document).ready(function () {
    let list = document.querySelectorAll('#panel-navbar li');

    function activateLink(){
        list.forEach((item) => 
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }

    NOMBRE_USUARIO = sessionStorage.getItem('usuario');
    $(".user").html(`<h2>${NOMBRE_USUARIO}</h2> <p><i class="fas fa-user-tie"></i> Administrador</p>`)


    $("#ID").on('click', function() {
        console.log(cambiarOrden(orden))
        ordenarId(orden)
    });

    $("#cerrar_session_dashboard").on('click', function() {
        $.ajax({ 
            url: "../PHP/cerrarSession.php",
            success: function(response){
                window.location = "/SalioViaje/";
            }
        });
    });

    list.forEach((item) => 
    item.addEventListener('mouseover', activateLink));
    $('#panel-navbar').load('/SalioViaje/web/panel-navbar.html');
});

function navbar(){
    let navbar = document.getElementById('panel-navbar');
    let header = document.getElementById('header');
    let panel = document.getElementById('panel');
    
    navbar.classList.toggle('active');
    header.classList.toggle('active');
    panel.classList.toggle('active');
}

function buscarUsuarios() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchbar");
    filter = input.value.toUpperCase();
    
    table = document.getElementById("search-table");
    tr = table.getElementsByTagName("tr");
    

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
        }while(a != 4 && encontrado == false);            
            
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
                        url: "../PHP/Backend.php",
                        data: {opcion:"usr"},
                        global: false,
                        async:false,
                        success: function(response) {
                            return response;
                        }
                    }).responseText;

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

function tabla_usuarios_dashboard(usuario){
    $("#cantidad-usuarios").html('<h2>'+usuarios.length+'</h2><i class="fas fa-user-friends"></i>')
    var tabla = document.getElementById('tbody')
    var row = document.createElement("tr")
    let ID_USUARIO;


    for (const property in usuario) {
        let td = document.createElement("td");

        if (property == "NOMBRE" || property == "APELLIDO" || property == "TIPO_USUARIO" || property == "DEPARTAMENTO" || property == "TELEFONO") {
           td.innerHTML = usuario[property]
           row.appendChild(td);
        }else if(property == "ID"){
            ID_USUARIO = usuario[property]
        }
    }

    let td = document.createElement("td");
    td.innerHTML += '<button id="'+ID_USUARIO+'">Ver</button>'
    row.appendChild(td);
    //
    //agrego la fila a la tabla
    //
    tabla.appendChild(row);
}

function tabla_seccion_usuarios(usuario){

    var tabla = document.getElementById('tbody')
    var row = document.createElement("tr")
    let contador = 0;

    for (const property in usuario) {
        let td = document.createElement("td");
        if (contador != 14) {
            console.log(usuario[property])
            if (usuario[property] == null || usuario[property] == '' || usuario[property] == undefined) {
                td.innerHTML = "-"
            }else if(property == "ID"){
                ID_USUARIO = usuario[property]
                td.innerHTML = usuario[property]
            }else if( property != "RUT"){
                td.innerHTML = usuario[property]
            }
            row.appendChild(td);
        }
        contador++
    }

    let td = document.createElement("td");
    td.innerHTML += '<button id="'+ID_USUARIO+'">Ver</button>'
    row.appendChild(td);
    //
    //agrego la fila a la tabla
    //
    tabla.appendChild(row);
}
/*-------------------------------------------------------------------------------------------*/
//                                     Empresas                                              //
/*-------------------------------------------------------------------------------------------*/
let empresas

function traerEmpresas(seccion){
    empresas = $.ajax({
                        type: 'POST',       
                        url: "../PHP/Backend.php",
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

function tabla_empresas_dashboard(empresa){
    $.ajax({
        type: 'POST',       
        url: "../PHP/agregarEmpresaDashboard.php",
        data: {NOMBRE_EMPRESA:empresa['NOMBRE_EMPRESA'], ID_EMPRESA:empresa['ID']},
        success: function(response) {
            $(".propietarios").append(response);
        }
    })
}

function tabla_seccion_empresas(empresa){
    var tabla = document.getElementById('tbody')
    var row = document.createElement("tr")
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
                        url: "../PHP/Backend.php",
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
