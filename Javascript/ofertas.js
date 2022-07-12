let fechasArray_Transporte = [], fechasArray_Paquetes = [];

window.addEventListener(`load`, () =>{
    hideForm();
    updateFechaList('Transporte');
    updateFechaList('Paquetes');
});

let hideForm = () => {
    document.querySelector(`.transporte`).style.display = `none`;
    document.querySelector(`.paquetes`).style.display = `none`;
}

let selectType = () => {
    hideForm();
    let type = document.getElementById(`ofertaType`).value;
    if(type == 1){
        document.querySelector(`.transporte`).style.display = `block`;
    }else if(type == 2){
        document.querySelector(`.paquetes`).style.display = `block`;
    }
}

let addFecha = type => {
    switch(type){
        case 'Transporte':
            let fechaIn_Transporte = document.getElementById(`fechaPromocion_1`).value;
            let find_Transporte = false;
            if(fechasArray_Transporte.length > 0){
                for(fecha of fechasArray_Transporte){
                    if(fecha == fechaIn_Transporte){
                        find_Transporte = true;
                    }
                }
            }

            if(find_Transporte == false){
                fechasArray_Transporte.push(fechaIn_Transporte);
                updateFechaList('Transporte');
            }else{
                document.querySelector(`#info_Transporte`).classList.replace(`error`,`info`)
                document.querySelector(`#info_Transporte`).innerHTML = `<i class="fa-solid fa-circle-info"></i> La fecha ya ha sido añadida.`;
            }

            break;

        case 'Paquetes':
            let fechaIn_Paquetes = document.getElementById(`fechaPromocion_2`).value;
            let find_Paquetes = false;
            if(fechasArray_Paquetes.length > 0){
                for(fecha of fechasArray_Paquetes){
                    if(fecha == fechaIn_Paquetes){
                        find_Paquetes = true;
                    }
                }
            }

            if(find_Paquetes == false){
                fechasArray_Paquetes.push(fechaIn_Paquetes);
                updateFechaList('Paquetes');
            }else{
                document.querySelector(`#info_Paquetes`).classList.replace(`error`,`info`)
                document.querySelector(`#info_Paquetes`).innerHTML = `<i class="fa-solid fa-circle-info"></i> La fecha ya ha sido añadida.`;
            }

            break;
    }
    
    

}

let updateFechaList = type => {
    switch(type){
        case 'Transporte':
            document.querySelector(`#info_Transporte`).innerHTML = ``;
            let fragment_Transporte = document.createDocumentFragment();
            let container_Transporte = document.querySelector(`#date_Transporte`);
            if(fechasArray_Transporte.length > 0){
                for(fecha of fechasArray_Transporte){
                    const div_Transporte = document.createElement(`div`);
                    let fechaSplit = fecha.split(`-`)
                    div_Transporte.classList.add(`label`);
                    div_Transporte.innerHTML = `
                        <p>${fechaSplit[2]}/${fechaSplit[1]}/${fechaSplit[0]}</p>
                        <button onclick="deleteFecha('${fecha}')"><i class="fa-solid fa-xmark"></i></button>
                    `;
                    fragment_Transporte.appendChild(div_Transporte);
                }
                container_Transporte.innerHTML = ``;
                container_Transporte.appendChild(fragment_Transporte);
            }else{
                container_Transporte.innerHTML = `
                <div class="empty">
                    <p>No hay fechas de promoción agregadas.</p>
                </div>`;
            }
            break;

        case 'Paquetes':
            document.querySelector(`#info_Paquetes`).innerHTML = ``;
            let fragment_Paquetes = document.createDocumentFragment();
            let container_Paquetes = document.querySelector(`#date_Paquetes`);
            if(fechasArray_Paquetes.length > 0){
                for(fecha of fechasArray_Paquetes){
                    const div_Paquetes = document.createElement(`div`);
                    let fechaSplit = fecha.split(`-`)
                    div_Paquetes.classList.add(`label`);
                    div_Paquetes.innerHTML = `
                        <p>${fechaSplit[2]}/${fechaSplit[1]}/${fechaSplit[0]}</p>
                        <button onclick="deleteFecha('${fecha}')"><i class="fa-solid fa-xmark"></i></button>
                    `;
                    fragment_Paquetes.appendChild(div_Paquetes);
                }
                container_Paquetes.innerHTML = ``;
                container_Paquetes.appendChild(fragment_Paquetes);
            }else{
                container_Paquetes.innerHTML = `
                <div class="empty">
                    <p>No hay fechas de promoción agregadas.</p>
                </div>`;
            }
            break;
    }
     
}

let deleteFecha = (fechaText,type) => {
    switch(type){
        case 'Transporte':
            for(fecha in fechasArray_Transporte){
                if(fechasArray_Transporte[fecha] == fechaText){
                    fechasArray_Transporte.splice(fecha,1);
                    updateFechaList('Transporte');
                }
            }
            break;

        case 'Paquetes':
            for(fecha in fechasArray_Paquetes){
                if(fechasArray_Paquetes[fecha] == fechaText){
                    fechasArray_Paquetes.splice(fecha,1);
                    updateFechaList('Paquetes');
                }
            }
            break;
    }
    
}