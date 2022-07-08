let closeGurucuteco = () =>{
    $(`#gurucuteco`).css(`display`,`none`);
    $(`#gurucuteco`).html(``);
}

let openGurucuteco = numero => {
    $.ajax({
        type: "POST",
        url: "https://www.salioviaje.com.uy/Panel/Gurucuteco.php",
        data: {opcion: numero},
        success: function (response) {
           $(`#gurucuteco`).html(response);
           $(`#gurucuteco`).css(`display`,`flex`);
        }
     });
}