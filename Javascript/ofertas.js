let fechasArray = [];

window.addEventListener(`load`, () =>{
    hideForm();
    updateFechaList();
});

let hideForm = () => {
    document.querySelector(`.transporte`).style.display = `none`;
    // document.querySelector(`.paquetes`).style.display = `none`;
}

let selectType = () => {
    hideForm();
    let type = document.getElementById(`ofertaType`).value;
    if(type == 1){
        document.querySelector(`.transporte`).style.display = `block`;
    }else if(type == 2){
        // document.querySelector(`.paquetes`).style.display = `block`;
    }
}

let addFecha = () => {
    let fechaIn = document.getElementById(`fechaPromocion`).value;
    let find = false;
    if(fechasArray.length > 0){
        for(fecha of fechasArray){
            if(fecha == fechaIn){
                find = true;
            }
        }
    }

    if(find == false){
        fechasArray.push(fechaIn);
        updateFechaList();
    }else{
        document.querySelector(`.info-msg`).classList.replace(`error`,`info`)
        document.querySelector(`.info-msg`).innerHTML = `<i class="fa-solid fa-circle-info"></i> La fecha ya ha sido añadida.`;
    }
    

}

let updateFechaList = () => {
    document.querySelector(`.info-msg`).innerHTML = ``;
    let fragment = document.createDocumentFragment();
    let container = document.querySelector(`.date-container`);
    if(fechasArray.length > 0){
        for(fecha of fechasArray){
            const div = document.createElement(`div`);
            let fechaSplit = fecha.split(`-`)
            div.classList.add(`label`);
            div.innerHTML = `
                <p>${fechaSplit[2]}/${fechaSplit[1]}/${fechaSplit[0]}</p>
                <button onclick="deleteFecha('${fecha}')"><i class="fa-solid fa-xmark"></i></button>
            `;
            fragment.appendChild(div);
        }
        container.innerHTML = ``;
        container.appendChild(fragment);
    }else{
        container.innerHTML = `
        <div class="empty">
            <p>No hay fechas de promoción agregadas.</p>
        </div>`;
    }    
}

let deleteFecha = fechaText => {
    for(fecha in fechasArray){
        if(fechasArray[fecha] == fechaText){
            fechasArray.splice(fecha,1);
            updateFechaList();
        }
    }
}