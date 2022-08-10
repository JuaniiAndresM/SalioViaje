<?php

require_once 'procedimientosBD.php';

$data = json_decode($_POST['data'], true);

$preferencias_bd = new procedimientosBD();

$checkFiltros = json_decode($preferencias_bd->get_filtros_activos_admin(), true);
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

echo $data['mascotas'];

$top = array();

if ($checkFiltros['MOROSO'] == 1) {
    $result = array();
    for ($i = 0; $i < count($transportistas); $i++) {
        //FILTRA LOS MOROSOS
        if ($transportistas[$i]['MOROSO'] != 1) {
            //GUARDA LOS NO MOROSOS
            $result[] = $transportistas[$i];
            //$top['Primer filtro'] = $primer_filtro;
        }
    }
    $transportistas = $result;
}

if ($checkFiltros['PATA'] == 1) {
    $result = array();
    for ($x = 0; $x < count($transportistas); $x++) {

        //FILTRA POR PATA DEL VIAJE
        if ($transportistas[$x]['DEPARTAMENTO'] == $data['origen'] || $transportistas[$x]['DEPARTAMENTO'] == $data['destino']) {

            //GUARDA LOS TRANSPORTISTAS QUE APRUEBEN EL FILTRO
            $result[] = $transportistas[$x];
            //$top['Segundo filtro'] = $segundo_filtro;
        }

    }
    $transportistas = $result;
}

if ($transportistas != []) {
    $result = array();
    for ($y = 0; $y < count($transportistas); $y++) {

        $preferencias = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$y]['ID']), true);

        $capacidad_vehiculos = json_decode($preferencias_bd->traer_vehiculos_por_id_tta($transportistas[$y]['ID']), true);

        if ($preferencias != []) {
            $result[] = $transportistas[$y];
            //$top['Tercer filtro'] = $tercer_filtro;
        } elseif ($checkFiltros['CAPACIDAD'] == 1) {
            /**
             * VERIFICAR CAPACIDADES DE VEHICULOS
             */
            $capacidad_valida = false;

            if ($capacidad_vehiculos[$transportistas[$y]['ID']] != null) {

                for ($i = 0; $i < count($capacidad_vehiculos[$transportistas[$y]['ID']]); $i++) {
                    $capacidad = $capacidad_vehiculos[$transportistas[$y]['ID']][$i]['CAPACIDAD'];

                    if (intval($capacidad) >= intval($data["cantidad_pasajeros"])) {
                        $capacidad_valida = true;
                    }
                }

            }

        } else {
            $capacidad_valida = true;
        }


        if ($capacidad_valida == true) {
            /**
             * GUARDAR TRANSPORTISTAS
             */
            if (count($top) < 30) {
                $top[] = array(
                    "ID" => $transportistas[$y]['ID'],
                    "MAIL" => $transportistas[$y]['MAIL'],
                    "ID_VIAJE" => intval($_POST['id_viaje']),
                    "MATRICULA" => null,
                );
            }
        }

    }
    $transportistas = $result;
}

if ($checkFiltros['NOCTURNO'] == 1) {
    $result = array();
    for ($h = 0; $h < count($transportistas); $h++) {
        //FILTRO NOCTURNO
        $PREFERENCIA_NOCTURNO = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$h]['ID']), true)[0]['NOCTURNO'];

        if ($PREFERENCIA_NOCTURNO == $nocturno) {
            $result[] = $transportistas[$h];
            //$top['Cuarto filtro'] = $cuarto_filtro;
        }
    }
    $transportistas = $result;
}

if ($checkFiltros['OCUPADO'] == 1) {
    $result = array();

    if ($data['origen'] == "MONTEVIDEO" || $data['origen'] == "CANELONES" || $data['origen'] == "SAN JOSE" && $data['destino'] == "MONTEVIDEO" || $data['destino'] == "CANELONES" || $data['destino'] == "SAN JOSE") {
        $OCUPADO_IDA = date('Y-m-d h:i', strtotime($data['fecha']." ".$data['hora']." -30 minutes"));
        $OCUPADO_VUELTA = date('Y-m-d h:i', strtotime($data['fecha']." ".$data['hora']." +2 hours"));
    }else{
        $OCUPADO_IDA = date('Y-m-d h:i', strtotime($data['fecha']." ".$data['hora']." -1 hours"));
        $OCUPADO_VUELTA = date('Y-m-d h:i', strtotime($data['fecha']." ".$data['hora']." +5 hours"));
    }

    for ($h = 0; $h < count($transportistas); $h++) {
        //FILTRO OCUPADO
        $OCUPADO = $preferencias_bd->filtrar_ocupados($OCUPADO_IDA, $OCUPADO_VUELTA, $transportistas[$h]['ID']);

        if ($OCUPADO == 0) {
            $result[] = $transportistas[$h];
        }
    }
    $transportistas = $result;
}

if ($checkFiltros['PET_FRIENDLY'] == 1) {
    $result = array();
    for ($h = 0; $h < count($transportistas); $h++) {
        //FILTRO NOCTURNO
        $PREFERENCIA_NOCTURNO = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$h]['ID']), true)[0]['NOCTURNO'];

        if ($PREFERENCIA_NOCTURNO == $nocturno) {
            $result[] = $transportistas[$h];
            //$top['Cuarto filtro'] = $cuarto_filtro;
        }
    }
    $transportistas = $result;
}

if ($checkFiltros['FIESTAS'] == 1) {
    $result = array();
    for ($l = 0; $l < count($transportistas); $l++) {
        //FILTRO FIESTAS
        $PREFERENCIA_FIESTAS = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$l]['ID']), true)[0]['FIESTAS'];

        if ($PREFERENCIA_FIESTAS == $fiesta) {
            $result[] = $transportistas[$l];
            //$top['Quinto filtro'] = $quinto_filtro;
        }
    }
    $transportistas = $result;
}

if ($checkFiltros['DIA_LIBRE'] == 1) {
    $result = array();
    for ($v = 0; $v < count($transportistas); $v++) {
        //FILTRO DIA LIBRE
        $PREFERENCIA_DIA_LIBRE = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$v]['ID']), true)[0]['DIA_LIBRE'];

        if ($PREFERENCIA_DIA_LIBRE != $dia || $PREFERENCIA_DIA_LIBRE != $diaVuelta) {
            $result[] = $transportistas[$v];
            //$top['Sexto filtro'] = $sexto_filtro;
        }
    }
    $transportistas = $result;
}

if ($checkFiltros['PRECIO'] == 1) {
    $result = array();
    for ($m = 0; $m < count($transportistas); $m++) {
        //FILTRO PRECIO
        $PREFERENCIA_PRECIO_COCHE = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$m]['ID']), true)[0]['PRECIO_DE_COCHE'];
        $MATRICULA = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$m]['ID']), true)[0]['MATRICULA'];
        //VERIFICAR CAPACIDAD
        $capacidad_vehiculos = json_decode($preferencias_bd->traer_vehiculos_por_id_tta($transportistas[$m]['ID']), true);

        if ($PREFERENCIA_PRECIO_COCHE == $hasta_4_pax) {
            $result[] = $transportistas[$m];
        }
    }
    $transportistas = $result;
}





/**
 * creo array top
 */
for ($m = 0; $m < count($transportistas); $m++) {

    $MATRICULA = json_decode($preferencias_bd->traer_preferencias_por_id_tta($transportistas[$m]['ID']), true)[0]['MATRICULA'];
    $capacidad_vehiculos = json_decode($preferencias_bd->traer_vehiculos_por_id_tta($transportistas[$m]['ID']), true);
    /**
     * VERIFICAR CAPACIDADES DE VEHICULOS
     */
    if ($checkFiltros['CAPACIDAD'] == 1) {
        $capacidad_valida = false;

        if ($capacidad_vehiculos[$transportistas[$m]['ID']] != null) {

            for ($i = 0; $i < count($capacidad_vehiculos[$transportistas[$m]['ID']]); $i++) {
                $capacidad = $capacidad_vehiculos[$transportistas[$m]['ID']][$i]['CAPACIDAD'];

                if (intval($capacidad) >= intval($data["cantidad_pasajeros"])) {
                    $capacidad_valida = true;
                }
            }

        }
    } else {
        $capacidad_valida = true;
    }

    if ($capacidad_valida == true) {
        /**
         * GUARDAR TRANSPORTISTAS
         */
        if (count($top) < 30) {
            $top[] = array(
                "ID" => $transportistas[$m]['ID'],
                "MAIL" => $transportistas[$m]['MAIL'],
                "ID_VIAJE" => intval($_POST['id_viaje']),
                "MATRICULA" => $MATRICULA,
            );
        }
    }
}

for ($i = 0; $i < count($top); $i++) {
    if ($i < 5) {
        $preferencias_bd->guardar_seleccion_de_transportistas_ya_notificados($top[$i]['ID'], $top[$i]['ID_VIAJE'], $MATRICULA);
    } else {
        $preferencias_bd->guardar_seleccion_de_transportistas($top[$i]['ID'], $top[$i]['ID_VIAJE'], $MATRICULA);
    }
}

echo json_encode($top);

/*

verifico dos situaciones:

1- Dos patas  entre MONTEVIDEO, CANELONES, SAN JOSÉ -> determino un tiempo que empiece 30 minutos antes de que empiece y 2 horas despues de terminado.
2- Si una de las patas esta fuera de las del punto 1 -> 1 horas antes de que empiece y 5 horas despues de terminado.

 */
