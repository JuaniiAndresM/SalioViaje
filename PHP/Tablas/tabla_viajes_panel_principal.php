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
        if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX") {
            $oportunidades_dashboard = '
            <tr>
                <td>' . $oportunidades[$i]['ID'] . '</td>
                <td>' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td>' . $oportunidades[$i]['DESTINO'] . '</td>
                <td>' . $fecha[0] . '</td>
                <td>' . $oportunidades[$i]['ESTADO'] . '</td>
                <td>' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td>
                    <div class="button-wrapper">
                      <button class="button" onclick="eliminar_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
            </tr>
    ';
        } else {
            $oportunidades_dashboard = '
            <tr>
                <td>' . $oportunidades[$i]['ID'] . '</td>
                <td>' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td>' . $oportunidades[$i]['DESTINO'] . '</td>
                <td>' . $fecha[0] . '</td>
                <td>' . $oportunidades[$i]['ESTADO'] . '</td>
                <td>' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td>
                    <div class="button-wrapper">
                    </div>
                  </td>
            </tr>
    ';
        }

    } else {
          if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX") {
            $oportunidades_dashboard = $oportunidades_dashboard . '
            <tr>
                <td>' . $oportunidades[$i]['ID'] . '</td>
                <td>' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td>' . $oportunidades[$i]['DESTINO'] . '</td>
                <td>' . $fecha[0] . '</td>
                <td>' . $oportunidades[$i]['ESTADO'] . '</td>
                <td>' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td>
                    <div class="button-wrapper">
                      <button class="button" onclick="eliminar_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
            </tr>
    ';
        } else {
            $oportunidades_dashboard = $oportunidades_dashboard . '
            <tr>
                <td>' . $oportunidades[$i]['ID'] . '</td>
                <td>' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td>' . $oportunidades[$i]['DESTINO'] . '</td>
                <td>' . $fecha[0] . '</td>
                <td>' . $oportunidades[$i]['ESTADO'] . '</td>
                <td>' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td>
                    <div class="button-wrapper">
                    </div>
                  </td>
            </tr>
    ';
        }
    }

}
if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX" && $datos2 != null) {
    for ($i = 0; $i < count($datos2); $i++) {
        $fecha = explode(' ', $datos2[$i]['FECHA']);
        if ($i == 0 && $oportunidades_dashboard == null) {
            $oportunidades_dashboard = '
                  <tr>
                      <td>' . $datos2[$i]['ID'] . '</td>
                      <td>' . $datos2[$i]['ORIGEN'] . '</td>
                      <td>' . $datos2[$i]['DESTINO'] . '</td>
                      <td>' . $fecha[0] . '</td>
                      <td>' . $datos2[$i]['ESTADO'] . '</td>
                      <td>' . $datos2[$i]['MODALIDAD'] . '</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="eliminar_oportunidad(' . $datos2[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        } else {
            $oportunidades_dashboard = $oportunidades_dashboard . '
                  <tr>
                      <td>' . $datos2[$i]['ID'] . '</td>
                      <td>' . $datos2[$i]['ORIGEN'] . '</td>
                      <td>' . $datos2[$i]['DESTINO'] . '</td>
                      <td>' . $fecha[0] . '</td>
                      <td>' . $datos2[$i]['ESTADO'] . '</td>
                      <td>' . $datos2[$i]['MODALIDAD'] . '</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="eliminar_oportunidad(' . $datos2[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }
    }
}

echo $oportunidades_dashboard;
