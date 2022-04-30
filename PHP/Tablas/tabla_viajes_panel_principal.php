<?php

require_once "../procedimientosBD.php";

session_start();

$datos = new procedimientosBD();

$oportunidades = json_decode($datos->traer_oportunidades_por_id_usuario($_SESSION['datos_usuario']['ID']), true);

$datos2 = new procedimientosBD();

$datos2 = json_decode($datos2->traer_viajes(), true);

$oportunidades_dashboard = '';

for ($i = 0; $i < count($oportunidades); $i++) {
    $fecha = explode(' ', $oportunidades[$i]['FECHA']);

    if ($i == 0) {
        $oportunidades_dashboard = '
                  <tr>
                      <td>' . $oportunidades[$i]['ID'] . '</td>
                      <td>' . $oportunidades[$i]['ORIGEN'] . '</td>
                      <td>' . $oportunidades[$i]['DESTINO'] . '</td>
                      <td>' . $fecha[0] . '</td>
                      <td>' . $oportunidades[$i]['ESTADO'] . '</td>
                      <td>
                          <div class="button-wrapper">
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
                      <td>
                          <div class="button-wrapper">
                          </div>
                        </td>
                  </tr>
          ';
    }

}
if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX") {
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
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="editar_oportunidad(' . $datos2[$i]['ID'] . ')"><i class="fas fa-pen"></i></button>
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
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="editar_oportunidad(' . $datos2[$i]['ID'] . ')"><i class="fas fa-pen"></i></button>
                              <button class="button" onclick="eliminar_oportunidad(' . $datos2[$i]['ID'] . ')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }
    }
}

echo $oportunidades_dashboard;
