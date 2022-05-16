<?php

require_once "../procedimientosBD.php";

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

$datos = new procedimientosBD();

$oportunidades = json_decode($datos->traer_oportunidades_por_id_usuario($_SESSION['datos_usuario']['ID']), true);

$datos2 = new procedimientosBD();

if ($_SESSION['tipo_usuario'] == "Transportista" || $_SESSION['tipo_usuario'] == "Chofer") {
    $oportunidades = json_decode($datos2->traer_oportunidades_por_id_tta($_SESSION['datos_usuario']['ID']), true);
}

$datos2 = $datos2->traer_agenda_usuario($_SESSION['datos_usuario']['ID']);

$oportunidades_dashboard = '';

for ($i = 0; $i < count($oportunidades); $i++) {
    $fecha = explode(' ', $oportunidades[$i]['FECHA']);

    if ($i == 0) {
        if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX" && $oportunidades[$i]['MODALIDAD'] == "Oportunidad") {
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
                      <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
            </tr>
            ';
        } else {
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
                      <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
            </tr>
            ';
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
                          <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
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
                          <button class="button" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                      </div>
                    </td>
              </tr>
      ';
    }

}

echo $oportunidades_dashboard;
