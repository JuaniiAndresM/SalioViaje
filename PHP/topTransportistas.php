<?php

require_once 'procedimientosBD.php';

$data = json_decode($_POST['data'], true);


$preferencias_bd = new procedimientosBD();
//traer_tranportistas

$transportistas = json_decode($preferencias_bd->traer_tranportistas(), true);
/**
 * obtener hora nocturno, cantidad de pasajeros y tipo = fiesta
 */
$hora = strtotime($data['hora']);
$hora1 = strtotime( "22:00" );
$hora2 = strtotime( "06:00" );

if (strpos($TIPO_VIAJE, "Fiesta o Evento")) {
  $fiesta = 0;
}else{ $fiesta = 1; }

if ($cotizaciones[0]["CANTIDAD_PASAJEROS"] <= 4) {
  $hasta_4_pax = 0;
}else{ $hasta_4_pax = 1; }

if ($hora > $hora1 || $hora < $hora2) {
  $nocturno = 1;
}else{ $nocturno = 0; }
/**
 * 
 */


/**
 * obtener dia de la semana segun fecha
 */

$dias = array('LUN','MAR','MIE','JUE','VIE','SAB','DOM');

if(isset($data['fecha_vuelta'])) {
    $dia = $dias[(date('N', strtotime($data['fecha']))) - 1];
    $diaVuelta = $dias[(date('N', strtotime($data['fecha_vuelta']))) - 1];
}else{
    $dia = $dias[(date('N', strtotime($data['fecha']))) - 1];
}

/**
 * 
 */

$transportistas_ya_evaluados = array();
$top = array();

if ($_POST['fiesta_ida_vuelta']) {

    $RAW_PREFERENCIAS = $preferencias_bd->traer_preferencias();
    $PREFERENCIAS = json_decode($RAW_PREFERENCIAS,true);

    for ($i=0; $i < count($PREFERENCIAS); $i++) { 

        /*
        if ($RAW_PREFERENCIAS != "[]" && $PREFERENCIAS[$i]["NOCTURNO"] == $nocturno && $PREFERENCIAS[$i]["FIESTAS"] == $fiesta && $PREFERENCIAS[$i]["DIA_LIBRE"] != $dia && $PREFERENCIAS[$i]["PRECIO_DE_COCHE"] == $hasta_4_pax) {
          //encaja
          $encaja_en_preferencias = 1;
        }else if($RAW_PREFERENCIAS != "[]" && $PREFERENCIAS[$i]["NOCTURNO"] == 1 &&  $PREFERENCIAS[$i]["FIESTAS"] == 1 && $PREFERENCIAS[$i]["DIA_LIBRE"] != $dia && $PREFERENCIAS[$i]["PRECIO_DE_COCHE"] == 1){
          //encaja
          $encaja_en_preferencias = 1;
        }else{
          //no encaja
          $encaja_en_preferencias = 0;
        }
        */

        $encaja_en_preferencias = 1;

        if ($RAW_PREFERENCIAS == "[]" || $encaja_en_preferencias == 1) {
            $transportistas_ya_evaluados[] = $PREFERENCIAS[$i]['TRANSPORTISTA'];
            for ($i=0; $i < count($transportistas); $i++) { 
                if ($transportistas[$i]['ID'] == $PREFERENCIAS[$i]['TRANSPORTISTA']) {
                    if ($transportistas[$i]['DEPARTAMENTO'] == $data['origen'] || $transportistas[$i]['DEPARTAMENTO'] == $data['destino'] && $transportistas[$i]['MOROSO'] == 0) {
                        
                        $result = array(
                            "ID" => $transportistas[$i]['ID'], 
                            "MAIL" => $transportistas[$i]['MAIL'] 
                        );

                        $top[] = $result;
                    
                    
                    }
                }
            }
        }else{
            echo  $PREFERENCIAS[$i]['TRANSPORTISTA']." no puede hacer el viaje.";
            $transportistas_ya_evaluados[] = $PREFERENCIAS[$i]['TRANSPORTISTA'];
        }
      
    }

}

for ($i=0; $i < count($transportistas); $i++) { 
    if (!in_array($transportistas[$i]['ID'], $transportistas_ya_evaluados)) {
        if ($transportistas[$i]['DEPARTAMENTO'] == $data['origen'] || $transportistas[$i]['DEPARTAMENTO'] == $data['destino'] && $transportistas[$i]['MOROSO'] == 0) {
            
            
            $result = array(
                "ID" => $transportistas[$i]['ID'], 
                "MAIL" => $transportistas[$i]['MAIL'] 
            );

            $top[] = $result;
        
        
        }
    }
}


echo json_encode($top);