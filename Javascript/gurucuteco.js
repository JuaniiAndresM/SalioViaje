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
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}