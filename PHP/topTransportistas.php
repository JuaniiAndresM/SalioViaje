<?php

require_once 'procedimientosBD.php';

$data = json_decode($_POST['data'], true);

$preferencias_bd = new procedimientosBD();

$transportistas = json_decode($preferencias_bd->traer_tranportistas(), true);

/**
 * obtener hora nocturno, cantidad de pasajeros y tipo = fiesta
 */
$hora = strtotime($data['hora']);
$hora1 = strtotime("22:00");
$hora2 = strtotime("06:00");

if ($data["fiesta"] == 1) {
    $fiesta = 1;
} else { $fiesta = 0;}

if ($data["cantidad_pasajeros"] <= 4) {
    $hasta_4_pax = 1;
} else { $hasta_4_pax = 0;}

if (isset($data["cantidad_pasajeros_vuelta"])) {
    if ($data["cantidad_pasajeros_vuelta"] <= 4) {
        $hasta_4_pax = 1;
    } else { $hasta_4_pax = 0;}
}

if ($hora > $hora1 && $hora < $hora2) {
    $nocturno = 0;
} else { $nocturno = 1;}
/**
 *
 */

/**
 * obtener dia de la semana segun fecha
 */

$dias = array('LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB', 'DOM');

if (isset($data['fecha_vuelta'])) {
    $dia = $dias[(date('N', strtotime($data['fecha']))) - 1];
    $diaVuelta = $dias[(date('N', strtotime($data['fecha_vuelta']))) - 1];
} else {
    $dia = $dias[(date('N', strtotime($data['fecha']))) - 1];
}

/*
VARIABLES:

- $dia / $diaVuelta  ------ DIAS LIBRES
- $nocturno          ------ NOCTURNO
- $hasta_4_pax       ------ CAPACIDAD
- $fiesta            ------ FIESTA

 */

/**
 *
 */

$primer_filtro = array();
$segundo_filtro = array();
$tercer_filtro = array();
$cuarto_filtro = array();
$quinto_filtro = array();
$sexto_filtro = array();
$septimo_filtro = array();

$top = array();

//RECORRE ARRAY DE TRANSPORTISTAS
for ($i = 0; $i < count($transportistas); $i++) {

    //FILTRA LOS MOROSOS
    if ($transportistas[$i]['MOROSO'] != 1) {
        //GUARDA LOS NO MOROSOS
        $primer_filtro[] = $transportistas[$i];
        //$top['Primer filtro'] = $primer_filtro;
    }

}

//RECORRE EL RESULTADO DEL PRIMER FILTRADO
//echo json_encode($primer_filtro);
if ($primer_filtro != []) {
    for ($x = 0; $x < count($primer_filtro); $x++) {

        //FILTRA POR PATA DEL VIAJE
        if ($primer_filtro[$x]['DEPARTAMENTO'] == $data['origen'] || $primer_filtro[$x]['DEPARTAMENTO'] == $data['destino']) {

            //GUARDA LOS TRANSPORTISTAS QUE APRUEBEN EL FILTRO
            $segundo_filtro[] = $primer_filtro[$x];
            //$top['Segundo filtro'] = $segundo_filtro;
        }

    }
}

//RECORRE EL RESULTADO DEL SEGUNDO FILTRO
//echo json_encode($segundo_filtro);
if ($segundo_filtro != []) {
    for ($y = 0; $y < count($segundo_filtro); $y++) {

        $preferencias = json_decode($preferencias_bd->traer_preferencias_por_id_tta($segundo_filtro[$y]['ID']), true);

        if ($preferencias != []) {
            $tercer_filtro[] = $segundo_filtro[$y];
            //$top['Tercer filtro'] = $tercer_filtro;
        } else {
            if (count($top) < 5) {
                $top[] = array(
                    "ID" => $segundo_filtro[$y]['ID'],
                    "MAIL" => $segundo_filtro[$y]['MAIL'],
                );
                $preferencias_bd->guardar_seleccion_de_transportistas_ya_notificados($segundo_filtro[$y]['ID'], intval($_POST['id_viaje']), null);
            }else if(count($top) < 30){
                $preferencias_bd->guardar_seleccion_de_transportistas($segundo_filtro[$y]['ID'], intval($_POST['id_viaje']), null);
            }
        }

    }
}

//RECORRE EL RESUTADO DEL TERCER FILTRO
//echo json_encode($tercer_filtro);
if ($tercer_filtro != []) {
    for ($h = 0; $h < count($tercer_filtro); $h++) {
        //FILTRO NOCTURNO
        $PREFERENCIA_NOCTURNO = json_decode($preferencias_bd->traer_preferencias_por_id_tta($tercer_filtro[$h]['ID']), true)[0]['NOCTURNO'];

        if ($PREFERENCIA_NOCTURNO == $nocturno) {
            $cuarto_filtro[] = $tercer_filtro[$h];
            //$top['Cuarto filtro'] = $cuarto_filtro;
        }
    }
}

//RECORRE EL RESUTADO DEL CUARTO FILTRO
//echo json_encode($cuarto_filtro);
if ($cuarto_filtro != []) {
    for ($l = 0; $l < count($cuarto_filtro); $l++) {
        //FILTRO FIESTAS
        $PREFERENCIA_FIESTAS = json_decode($preferencias_bd->traer_preferencias_por_id_tta($cuarto_filtro[$l]['ID']), true)[0]['FIESTAS'];

        if ($PREFERENCIA_FIESTAS == $fiesta) {
            $quinto_filtro[] = $cuarto_filtro[$l];
            //$top['Quinto filtro'] = $quinto_filtro;
        }
    }
}

//RECORRE EL RESUTADO DEL QUINTO FILTRO
//echo json_encode($quinto_filtro);
if ($quinto_filtro != []) {
    for ($v = 0; $v < count($quinto_filtro); $v++) {
        //FILTRO DIA LIBRE
        $PREFERENCIA_DIA_LIBRE = json_decode($preferencias_bd->traer_preferencias_por_id_tta($quinto_filtro[$v]['ID']), true)[0]['DIA_LIBRE'];

        if ($PREFERENCIA_DIA_LIBRE != $dia || $PREFERENCIA_DIA_LIBRE != $diaVuelta) {
            $sexto_filtro[] = $quinto_filtro[$v];
            //$top['Sexto filtro'] = $sexto_filtro;
        }
    }
}

//RECORRE EL RESUTADO DEL SEXTO FILTRO
//echo json_encode($sexto_filtro);
if ($sexto_filtro != []) {
    for ($m = 0; $m < count($sexto_filtro); $m++) {
        //FILTRO PRECIO
        $PREFERENCIA_PRECIO_COCHE = json_decode($preferencias_bd->traer_preferencias_por_id_tta($sexto_filtro[$m]['ID']), true)[0]['PRECIO_DE_COCHE'];
        $MATRICULA = json_decode($preferencias_bd->traer_preferencias_por_id_tta($sexto_filtro[$m]['ID']), true)[0]['MATRICULA'];

        if ($PREFERENCIA_PRECIO_COCHE == $hasta_4_pax) {

            $septimo_filtro[] = $sexto_filtro[$m];
            //$top['Septimo filtro'] = $septimo_filtro;
            //temporal
            if (count($top) < 5) {
                $top[] = array(
                    "ID" => $sexto_filtro[$m]['ID'],
                    "MAIL" => $sexto_filtro[$m]['MAIL'],
                );
                $preferencias_bd->guardar_seleccion_de_transportistas_ya_notificados($sexto_filtro[$m]['ID'], intval($_POST['id_viaje']), $MATRICULA);
            }else if(count($top) < 30){
                $preferencias_bd->guardar_seleccion_de_transportistas($sexto_filtro[$m]['ID'], intval($_POST['id_viaje']), $MATRICULA);
            }
        }
    }
}

echo json_encode($top);

/*
//RECORRE EL RESUTADO DEL SEPTIMO FILTRO
if (isset($sexto_filtro)) {
    for ($j = 0; $j < count($sexto_filtro); $j++) {
        //FILTRO CAPACIDAD
        $PREFERENCIA_PRECIO_COCHE = json_decode($preferencias_bd->traer_preferencias_por_id_tta($sexto_filtro[$j]['ID']), true)[0]['PRECIO_DE_COCHE'];

        if ($PREFERENCIA_PRECIO_COCHE == $hasta_4_pax) {
            $septimo_filtro[] = $sexto_filtro[$j];
        }
    }
}

echo json_encode($top);

/*

if ($i <= 5) {
$preferencias_bd->guardar_seleccion_de_transportistas_ya_notificados($transportistas[$i]['ID'], intval($_POST['id_viaje']), null);
} else {
$preferencias_bd->guardar_seleccion_de_transportistas($transportistas[$i]['ID'], intval($_POST['id_viaje']), null);
}

$preferencias_bd->traer_tranportistas()

$result = array(
"ID" => $transportistas[$i]['ID'],
"MAIL" => $transportistas[$i]['MAIL']
);

$top[] = $result;

verifico dos situaciones:

1- Dos patas  entre MONTEVIDEO, CANELONES, SAN JOSÉ -> determino un tiempo que empiece 30 minutos antes de que empiece y 2 horas despues de terminado.
2- Si una de las patas esta fuera de las del punto 1 -> 1 horas antes de que empiece y 5 horas despues de terminado.

 */
