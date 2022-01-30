let NOMBRE_USUARIO;
let orden = 1;
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
//                                     Opciones                                              //
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
    ordenarId(orden,seccion);
}

function ordenarId(orden,seccion){
    console.log(seccion)
    if (orden == 0) {
        for (var i = usuarios.length - 1; i >= 0; i--) {
            switch(seccion){
                case "Dashboard":
                    usuarios_dashboard(usuarios[i])
                break;

                case "usuarios":
                    seccion_usuarios(usuarios[i])
                break;

                case "3":
                    seccion_usuarios(usuarios[i])
                break;

                case "4":
                    seccion_usuarios(usuarios[i])
                break;

                case "5":
                    seccion_usuarios(usuarios[i])
                break;
            }
        }
            
        }else{
        for (var i = 0;i < usuarios.length; i++) {
            switch(seccion){
                case "Dashboard":
                    usuarios_dashboard(usuarios[i])
                break;

                case "usuarios":
                    seccion_usuarios(usuarios[i])
                break;

                case "3":
                    seccion_usuarios(usuarios[i])
                break;

                case "4":
                    seccion_usuarios(usuarios[i])
                break;

                case "5":
                    seccion_usuarios(usuarios[i])
                break;
            }
        }
    }
}



function usuarios_dashboard(usuario){
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

    tabla.appendChild(row);
}

function seccion_usuarios(usuario){
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
    tabla.appendChild(row);
}

function seccion_empresas(){

}

function seccion_vehiculos(){

}

function cambiarOrden(){
    if (orden == 1) {
        orden = 0
    }else{
        orden = 1
    }
    return orden;
}