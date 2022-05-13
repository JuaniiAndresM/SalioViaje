/*-------------------------------------------------------------------------------------------*/
//                                       Actualizar                                          //
/*-------------------------------------------------------------------------------------------*/

function filtroAgenda() {
    var table, tr, td, i, txtValue;
    table = document.getElementById("search-agendar-table");
    tr = table.getElementsByTagName("tr");

    fecha = $('#date_agenda').val();
    hora = $('#time_agenda').val();
    estado = $('#estado_agenda').val();

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


    if(fecha != "" || hora != "" || estado != null){

        if(estado != null){
            for (i = 0; i < tr.length; i++) {
                var encontrado = false;
    
                td = tr[i].getElementsByTagName("td")[10];
    
                if (td) {
                    txtValue = td.textContent || td.innerText;
    
                    if (txtValue.toUpperCase() == estado.toUpperCase()) {
                        tr[i].style.display = "";
                        encontrado = true;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        if(hora != ""){

            for (i = 0; i < tr.length; i++) {
                var encontrado = false;
    
                td = tr[i].getElementsByTagName("td")[2];
    
                if (td) {
                    txtValue = td.textContent || td.innerText;
    
                    var hora_split = txtValue.split(' ');

                    console.log(hora_split[0]);
                    console.log(hora_split[1]);

                    if(hora_split[1] == "PM"){
                        var time = hora_split[0].split(':');
                        var nueva_hora = (parseInt(time[0]) + 12);

                        nueva_hora = nueva_hora + ":" + time[1];

                        if (nueva_hora == hora) {
                            tr[i].style.display = "";
                            encontrado = true;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }else{
                        if (hora_split[0] == hora) {
                            tr[i].style.display = "";
                            encontrado = true;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }

                    
                }
            }
        }

        if(fecha != ""){
            for (i = 0; i < tr.length; i++) {
                var encontrado = false;
    
                td = tr[i].getElementsByTagName("td")[1];
    
                if (td) {
                    txtValue = td.textContent || td.innerText;
    
                    if (txtValue == dateFormat(fecha, 'dd-MM-yyyy')) {
                        tr[i].style.display = "";
                        encontrado = true;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

    }else{
        for (i = 0; i < tr.length; i++) {
            tr[i].style.display = "";
        }
    }

    
}

function filtroAgenda_reload(){
    $('#date_agenda').val("");
    $('#time_agenda').val("");
    $('#estado_agenda').val(0);

    filtroAgenda();
}