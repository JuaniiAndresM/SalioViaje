class llamadas_PHP {
        //realizar llamda
        realizarLlamada(dialago,dateNhoure,id,tel,nombre,msj,idOprt) {
            $.ajax({
                type: "POST",
                url: "../t2voice/comunication_js_php.php",
                //aca mandarias la info necesaria para el xml de llamada
                data: {tipe:0, dialogo:dialago, datenHoure:dateNhoure, id:id, tel:tel, name:nombre, SMS:msj, ID_OPORTUNIDAD:idOprt},
                success: function (response) {
                    console.log(response);
                }
            });
        }

        //muestra estado de la llamda
        estadoLllamda(id){
            $.ajax({
                type: "POST",
                url: "../t2voice/comunication_js_php.php",
                //aca mandarias la info necesaria para el xml de llamada
                data: {tipe:1,id:id},
                success: function (response) {
                    console.log(response);
                }
            });
        }

        //envia SMS
        enviarSMS(phone,schedule,text,uniqueId){
            $.ajax({
                type: "POST",
                url: "../t2voice/comunication_js_php.php",
                //aca mandarias la info necesaria para el xml de llamada
                data: {tipe:2, phone:phone, schedule:schedule, text:text, id:uniqueId},
                success: function (response) {
                    console.log(response);
                }
            });
        }
        
        //muestra respuesta de SMS
        verRespuestaSMS(uniqueId){
            $.ajax({
                type: "POST",
                url: "../t2voice/comunication_js_php.php",
                //aca mandarias la info necesaria para el xml de llamada
                data: {tipe:3,id:uniqueId},
                success: function (response) {
                    console.log(response);
                }
            });
        }

        //muestra estado del SMS
        verEstadoSMS(uniqueId){
            $.ajax({
                type: "POST",
                url: "../t2voice/comunication_js_php.php",
                //aca mandarias la info necesaria para el xml de llamada
                data: {tipe:4,id:uniqueId},
                success: function (response) {
                    console.log(response);
                }
            });
        }
}
