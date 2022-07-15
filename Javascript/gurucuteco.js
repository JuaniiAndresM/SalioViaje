let closeGurucuteco = opcion =>{
    if(document.getElementById(`check-g-${opcion}`) != null){
        let cookieName = `g${opcion}`
        if(document.getElementById(`check-g-${opcion}`).checked){
            document.cookie = cookieName+'=1';
        }else{
            document.cookie = cookieName+'=0';
        }
    }
    
    $(`#gurucuteco`).css(`display`,`none`);
    $(`#gurucuteco`).html(``);
}

let openGurucuteco = numero => {
    let cookieName = `g${numero}`;
    let cookieValue = getCookie(`${cookieName}`);
    console.log(cookieValue);
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/Panel/Gurucuteco.php",
        data: {opcion: numero},
        success: function (response) {
           $(`#gurucuteco`).html(response);
           $(`#gurucuteco`).css(`display`,`flex`);

            if(cookieValue == 1){
                document.getElementById(`check-g-${numero}`).checked = true;
            }else{
                document.getElementById(`check-g-${numero}`).checked = false;
            }
        }
     });
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}