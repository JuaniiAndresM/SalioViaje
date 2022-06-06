<?php

require_once "../procedimientosBD.php";

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

$datos = new procedimientosBD();
$datos2 = new procedimientosBD();

$oportunidades = json_decode($datos->traer_oportunidades_por_id_usuario($_SESSION['datos_usuario']['ID']), true);



if ($_SESSION['tipo_usuario'] == "Transportista" || $_SESSION['tipo_usuario'] == "Chofer") {
    $oportunidades = json_decode($datos2->traer_oportunidades_por_id_tta($_SESSION['datos_usuario']['ID']), true);
}

$datos2 = $datos2->traer_agenda_usuario($_SESSION['datos_usuario']['ID']);
$cotizaciones = json_decode($datos->traer_cotizaciones_por_id_comprador($_SESSION['datos_usuario']['ID']),true);

echo json_encode($datos2);

$oportunidades_dashboard = '';

/**
 * 
 * tta y cho
 */
for ($i = 0; $i < count($oportunidades); $i++) {
    $fecha = explode(' ', $oportunidades[$i]['FECHA']);

    if ($i == 0) {
        if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX" && $oportunidades[$i]['MODALIDAD'] == "Oportunidad") {
            if($oportunidades[$i]['ESTADO'] != "Vencida" && $oportunidades[$i]['ESTADO'] != "Vencido" && $oportunidades[$i]['ESTADO'] != "Cancelada" && $oportunidades[$i]['ESTADO'] != "Cancelado" && $oportunidades[$i]['ESTADO'] != "Reconfirmado"){
                $oportunidades_dashboard = '
                <tr>
                    <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                    <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                    <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                    <td data-title="Fecha">' . $fecha[0] . '</td>
                    <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                    <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                    <td>
                        <div class="button-wrapper">
                          <button class="button" onclick="mtop_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-file-contract"></i></button>
                          <button class="button" onclick="abrir_editar_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-edit"></i></button>
                          <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                </tr>
                ';
            }else{
                $oportunidades_dashboard = '
                <tr>
                    <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                    <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                    <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                    <td data-title="Fecha">' . $fecha[0] . '</td>
                    <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                    <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                    <td>
                        <div class="button-wrapper">
                          <button class="button" onclick="mtop_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-file-contract"></i></button>
                          <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                </tr>
                ';
            }
            
        }else if($oportunidades[$i]['MODALIDAD'] == "Oportunidad"){
            $oportunidades_dashboard = '
            <tr>
                <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $fecha[0] . '</td>
                <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td>
                    <div class="button-wrapper">
                    </div>
                  </td>
            </tr>
            ';
        }

    } else {
        if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX" && $oportunidades[$i]['MODALIDAD'] == "Oportunidad") {
            if($oportunidades[$i]['ESTADO'] != "Vencida" && $oportunidades[$i]['ESTADO'] != "Vencido" && $oportunidades[$i]['ESTADO'] != "Cancelada"  && $oportunidades[$i]['ESTADO'] != "Cancelado" && $oportunidades[$i]['ESTADO'] != "Reconfirmado"){
                $oportunidades_dashboard = $oportunidades_dashboard . '
                <tr>
                    <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                    <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                    <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                    <td data-title="Fecha">' . $fecha[0] . '</td>
                    <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                    <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                    <td>
                        <div class="button-wrapper">
                          <button class="button" onclick="mtop_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-file-contract"></i></button>
                          <button class="button" onclick="abrir_editar_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-edit"></i></button>
                          <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                </tr>
                ';
            }else{
                $oportunidades_dashboard = $oportunidades_dashboard . '
            <tr>
                <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $fecha[0] . '</td>
                <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td>
                    <div class="button-wrapper">
                      <button class="button" onclick="mtop_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-file-contract"></i></button>
                      <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
            </tr>
            ';
            }
            
        } elseif ($oportunidades[$i]['MODALIDAD'] == "Oportunidad") {
            $oportunidades_dashboard = $oportunidades_dashboard . '
            <tr>
                <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $fecha[0] . '</td>
                <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td>
                    <div class="button-wrapper">
                    </div>
                  </td>
            </tr>
            ';
        }
    }

}

for ($i = 0; $i < count($oportunidades); $i++) {
    $fecha = explode(' ', $oportunidades[$i]['FECHA']);
    if ($oportunidades[$i]['MODALIDAD'] == "Agendado" && $oportunidades_dashboard == null && $_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX") {
        $oportunidades_dashboard = '
              <tr>
                  <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                  <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                  <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                  <td data-title="Fecha">' . $fecha[0] . '</td>
                  <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                  <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                  <td>
                      <div class="button-wrapper">
                          <button class="button" onclick="mtop_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-file-contract"></i></button>
                          <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                      </div>
                    </td>
              </tr>
      ';
    } elseif ($oportunidades[$i]['MODALIDAD'] == "Agendado") {
        $oportunidades_dashboard = $oportunidades_dashboard . '
              <tr>
                  <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                  <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                  <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                  <td data-title="Fecha">' . $fecha[0] . '</td>
                  <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                  <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                  <td>
                      <div class="button-wrapper">
                          <button class="button" onclick="mtop_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-file-contract"></i></button>
                          <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                      </div>
                    </td>
              </tr>
      ';
    }

}
/*
pax
*/
if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == "PAX") {
    /*
     * agendados
     */
    if ($datos2 != null) {
        for ($i=0; $i < count($datos2); $i++) { 
            $fecha = explode(' ', $datos2[$i]['FECHA']);
            if ($i == 0) {
                $oportunidades_dashboard = '
                <tr>
                    <td data-title="ID">' . $datos2[$i]['ID'] . '</td>
                    <td data-title="Origen">' . $datos2[$i]['ORIGEN'] . '</td>
                    <td data-title="Destino">' . $datos2[$i]['DESTINO'] . '</td>
                    <td data-title="Fecha">' . $fecha[0] . '</td>
                    <td data-title="Estado">' . $datos2[$i]['ESTADO'] . '</td>
                    <td data-title="Modalidad">' . $datos2[$i]['MODALIDAD'] . '</td>
                </tr>
                ';
            } else {
                $oportunidades_dashboard = $oportunidades_dashboard.'
                <tr>
                    <td data-title="ID">' . $datos2[$i]['ID'] . '</td>
                    <td data-title="Origen">' . $datos2[$i]['ORIGEN'] . '</td>
                    <td data-title="Destino">' . $datos2[$i]['DESTINO'] . '</td>
                    <td data-title="Fecha">' . $fecha[0] . '</td>
                    <td data-title="Estado">' . $datos2[$i]['ESTADO'] . '</td>
                    <td data-title="Modalidad">' . $datos2[$i]['MODALIDAD'] . '</td>
                </tr>
                ';
            }
            
        }
    }

    /*
     * oportunidades compradas
     */
    for ($i=0; $i < count($oportunidades); $i++) { 
        $fecha = explode(' ', $oportunidades[$i]['FECHA']);
        if ($i == 0 && $oportunidades_dashboard != " ") {
            $oportunidades_dashboard = '
            <tr>
                <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $fecha[0] . '</td>
                <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
            </tr>
            ';
        } else {
            $oportunidades_dashboard = $oportunidades_dashboard.'
            <tr>
                <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $fecha[0] . '</td>
                <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
            </tr>
            ';
        }
        
    }
    /*
     * cotizaciones
     */
    for ($i=0; $i < count($cotizaciones); $i++) { 
        echo $i;
        /*
        if ($i == 0 && $oportunidades_dashboard != " ") {
            $oportunidades_dashboard = '
            <tr>
                <td data-title="ID">' . $cotizaciones[$i]['ID'] . '</td>
                <td data-title="Origen">' . $cotizaciones[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $cotizaciones[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $cotizaciones[$i]['FECHA'] . '</td>
                <td data-title="Estado">' . $cotizaciones[$i]['ESTADO'] . '</td>
                <td data-title="Modalidad">' . $cotizaciones[$i]['MODALIDAD'] . '</td>
            </tr>
            ';
        } else {
            */
            $oportunidades_dashboard = $oportunidades_dashboard.'
            <tr>
                <td data-title="ID">' . $cotizaciones[$i]['ID'] . '</td>
                <td data-title="Origen">' . $cotizaciones[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $cotizaciones[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $cotizaciones[$i]['FECHA'] . '</td>
                <td data-title="Estado">' . $cotizaciones[$i]['ESTADO'] . '</td>
                <td data-title="Modalidad">' . $cotizaciones[$i]['MODALIDAD'] . '</td>
            </tr>
            ';
        //}
        
    }
}

echo $oportunidades_dashboard;
