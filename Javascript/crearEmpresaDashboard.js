$(document).ready(function () {

    tipo_usuario = $("#tipo_usuario").val();

    console.log(tipo_usuario)
    steps(1,tipo_usuario);    

    $("#finalizar_empresa").on('click', function() {
        crear_empresa()
    });
});


step = 1;

function next(){
    step++;
    steps(step);
}

function volver(){
    step--;
    steps(step);
}

function steps(step, tipo_usuario){
    $("#step_1").hide();
    $("#step_2").hide();
    $("#step_3").hide();

    $("#add-vehicle").hide();
    $("#finalizar_empresa").hide();
    $("#guardar-cambios").hide();

    $("#contratista").hide();
    $("#choferes_sub").hide();

    $(".vehiculos-wrapper").hide();

    switch(step){
        case 1:
            $("#step_1").show();

            if(tipo_usuario == "Anfitrión" || tipo_usuario == "Agente"){
                $(".progress-bar").hide();
            }else{
                $(".progress-bar").show();

                $('.circle1').css('background-color', '#2b3179');
                $('.circle2').css('background-color', '#aaa');
                $('.progress').css('width', '0%');
            }

            if(tipo_usuario == "Chofer"){
                $("#contratista").show();
            }else if(tipo_usuario == "Transportista"){
                $("#choferes_sub").show();
            }

            if(tipo_usuario == "Anfitrión" || tipo_usuario == "Agente"){
                $("#add-vehicle").hide();
                $("#finalizar_empresa").show();
            }else{
                $("#add-vehicle").show();
                $("#finalizar_empresa").hide();
            }

            break;

        case 2:
            $("#step_2").show();
            $(".vehiculos-wrapper").show();

            if(tipo_usuario == "Anfitrión" || tipo_usuario == "Agente"){
                $(".progress-bar").hide();
            }else{
                $(".progress-bar").show();

                $('.circle1').css('background-color', '#2b3179');
                $('.circle2').css('background-color', '#2b3179');
                $('.progress').css('width', '100%');
            }

            break;

        case 3:
            $(".progress-bar").hide();
            $("#step_3").show();

            break;
    }
}

function finalizar_empresa(){
    step++;
    steps(step);
}

function new_company(){
    step = 1;
    steps(step);
}

function finalizar_empresa_total(id){
    $("#add_company_button").hide();
    $("#finalizar-registro-TTA").prop('disabled', true);
    $('#finalizar-registro-TTA').html('<span class="loader-register"><i class="fas fa-spinner"></i></span>');
    console.log(id)
        switch(tipo_usuario){
             case "Transportista":
                     $.ajax({
                        type: "POST",
                        url: "/SalioViaje/PHP/procedimientosForm.php",
                        data: { tipo:"2",idUsuario: id,empresas:JSON.stringify(empresas) },
                        success: function (response) {
                          console.log(response)
                         },
                      });
            break;
        }
    setTimeout(() => {
        location.href = "/SalioViaje/Panel/Success_Empresa"
    }, 2000);
}

function crear_empresa(){
    let datos_Empresa = {
       "RUT": document.getElementById('rutt').value,
       "NOMBRE_COMERCIAL": document.getElementById('nombre_comercial').value,
       "RAZON_SOCIAL": document.getElementById('razon_social').value,
       "NUMERO_MTOP": document.getElementById('numero_mtop').value,
       "PASSWORD_MTOP": document.getElementById('password_mtop').value,
       "CHOFERES_SUB": document.getElementById('choferes_sub_select').value,
       "VEHICULOS": vehiculos
    };
    console.log(datos_Empresa)
if (validacion("EMPRESA",datos_Empresa)) {     
 empresas.push(datos_Empresa)
 datos_Empresa = {};
 vehiculos = [];
 reset_vehicles();
}else{ console.log("No valido...") }

}

function valido_Empresa_sin_crearla(){

      datos_Empresa = {
       "RUT": document.getElementById('rutt').value,
       "NOMBRE_COMERCIAL": document.getElementById('nombre_comercial').value,
       "CHOFERES_SUB": document.getElementById('choferes_sub_select').value,
       "RAZON_SOCIAL": document.getElementById('razon_social').value,
       "NUMERO_MTOP": document.getElementById('numero_mtop').value,
       "PASSWORD_MTOP": document.getElementById('password_mtop').value,
    };

   if (validacion("EMPRESA",datos_Empresa)) {     
      console.log("...")
      next();
   }else{ console.log("No valido...") }
}
