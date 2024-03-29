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
$cotizaciones = json_decode($datos->traer_cotizaciones_por_id_comprador($_SESSION['datos_usuario']['ID']), true);

$fechaActual = new DateTime(date('Y-m-d h:i:s', time()));
$oportunidades_dashboard = '';

/**
 * tta y cho
 */
for ($i = 0; $i < count($oportunidades); $i++) {

    $datos_mtop = array();

    $id_tramo_vinculado = $oportunidades[$i]['ID_VIAJE_VINCULADO'];

    $viaje_vinculado = array_filter(
        $oportunidades,
        function ($e) use (&$id_tramo_vinculado) {
            return $e['ID'] == $id_tramo_vinculado;
        }
    );

    if ($oportunidades[$i]['ID'] > $oportunidades[$i]['ID_VIAJE_VINCULADO'] && $oportunidades[$i]['ID_VIAJE_VINCULADO'] != null) {
        $fechaTramo1 = new DateTime($viaje_vinculado[1]['FECHA']);
        $datos_mtop["FECHA_SALIDA"] = $viaje_vinculado[1]['FECHA'];
        $datos_mtop["FECHA_LLEGADA"] = $oportunidades[$i]['FECHA'];
    } else {
        $fechaTramo1 = new DateTime($oportunidades[$i]['FECHA']);
        $datos_mtop["FECHA_SALIDA"] = $oportunidades[$i]['FECHA'];
        $datos_mtop["FECHA_LLEGADA"] = $viaje_vinculado[0]['FECHA'];
    }

    $datos_mtop["NOMBRE"] = $oportunidades[$i]['NOMBRE'];
    $datos_mtop["APELLIDO"] = $oportunidades[$i]['APELLIDO'];
    $datos_mtop["ORIGEN"] = $oportunidades[$i]['ORIGEN'];
    $datos_mtop["DESTINO"] = $oportunidades[$i]['DESTINO'];
    $datos_mtop["DISTANCIA"] = $oportunidades[$i]['DISTANCIA'];
    $datos_mtop["MATRICULA"] = $oportunidades[$i]['VECHICULO'];

    /**
     * TRAIGO CREDENCIALES DEL MINISTERIO.
     */
    $datos_ministerio_tta = json_decode($datos->datos_mtop_tta($datos_mtop["MATRICULA"]), true);

    $datos_mtop["NRO_MTOP"] = $datos_ministerio_tta[0]['NUMERO_MTOP'];
    $datos_mtop["PASS_MTOP"] = $datos_ministerio_tta[0]['PASS_MTOP'];

    $datos_mtop = json_encode($datos_mtop);

    $intervalo = $fechaTramo1->diff($fechaActual);

    $estado_mtop = $datos->estado_mtop($oportunidades[$i]['ID']);

    if ((int) $intervalo->format('%d') >= 1 && $oportunidades[$i]['ID'] < $oportunidades[$i]['ID_VIAJE_VINCULADO'] || $oportunidades[$i]['ID'] > $oportunidades[$i]['ID_VIAJE_VINCULADO']) {
        switch ($estado_mtop) {
            //amarillo
            case 1:
                $button_mtop = "<button class='amarillo tooltip left' data-tooltip='Permiso MTOP en Proceso'><i class='fas fa-file-contract'></i></button>";
                break;
            //rojo
            case 2:
                $button_mtop = "<button class='rojo tooltip left' data-tooltip='Permiso MTOP Rechazado'><i class='fas fa-file-contract'></i></button>";
                break;
            //verde
            case 3:
                $button_mtop = "<button class='verde tooltip left' data-tooltip='Permiso MTOP Realizado con Exito'><i class='fas fa-file-contract'></i></button>";
                break;
            //azul
            default:
                $link = '"https://www.salioviaje.com.uy/Editar_Viaje/' . $oportunidades[$i]['ID'] . '"';
                $button_mtop = "<button class='button tooltip left' data-tooltip='Permiso MTOP' onclick='window.location.href = " . $link . "'><i class='fas fa-file-contract'></i></button>";
                break;
        }
    } else {
        $button_mtop = '';
    }

    if ($id_tramo_vinculado == "") {
        $button_crear_oportunidad = "<button class='button tooltip left' data-tooltip='Crear Oportunidad' onclick='crear_oportunidad(" . $oportunidades[$i]['ID'] . ")'><i class='fas fa-plus' aria-hidden='true'></i></button>";
    } else {
        $button_crear_oportunidad = " ";
    }

    $fecha = explode(' ', $oportunidades[$i]['FECHA']);

    if ($i == 0) {
        if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX" && $oportunidades[$i]['MODALIDAD'] == "Oportunidad") {
            if ($oportunidades[$i]['ESTADO'] != "Vencida" && $oportunidades[$i]['ESTADO'] != "Vencido" && $oportunidades[$i]['ESTADO'] != "Cancelada" && $oportunidades[$i]['ESTADO'] != "Cancelado" && $oportunidades[$i]['ESTADO'] != "Reconfirmado") {
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
                        ' . $button_crear_oportunidad . $button_mtop . '
                          <button class="button tooltip left" data-tooltip="Editar Oportunidad" onclick="abrir_editar_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-edit"></i></button>
                          <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
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
                        ' . $button_crear_oportunidad . $button_mtop . '
                          <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                </tr>
                ';
            }

        }

    } else {
        if ($_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX" && $oportunidades[$i]['MODALIDAD'] == "Oportunidad") {
            if ($oportunidades[$i]['ESTADO'] != "Vencida" && $oportunidades[$i]['ESTADO'] != "Vencido" && $oportunidades[$i]['ESTADO'] != "Cancelada" && $oportunidades[$i]['ESTADO'] != "Cancelado" && $oportunidades[$i]['ESTADO'] != "Reconfirmado") {
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
                        ' . $button_crear_oportunidad . $button_mtop . '
                          <button class="button tooltip left" data-tooltip="Editar Oportunidad" onclick="abrir_editar_oportunidad(' . $oportunidades[$i]['ID'] . ')"><i class="fas fa-edit"></i></button>
                          <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                </tr>
                ';
            } else {
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
                    ' . $button_crear_oportunidad . $button_mtop . '
                      <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
            </tr>
            ';
            }

        } 
        // elseif ($oportunidades[$i]['MODALIDAD'] == "Oportunidad") {
        //     $oportunidades_dashboard = $oportunidades_dashboard . '
        //     <tr>
        //         <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
        //         <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
        //         <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
        //         <td data-title="Fecha">' . $fecha[0] . '</td>
        //         <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
        //         <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
        //         <td>
        //             <div class="button-wrapper">
        //             </div>
        //           </td>
        //     </tr>
        //     ';
        // }
    }

}

for ($i = 0; $i < count($oportunidades); $i++) {

    $datos_mtop = array();

    $id_tramo_vinculado = $oportunidades[$i]['ID_VIAJE_VINCULADO'];

    $viaje_vinculado = array_filter(
        $oportunidades,
        function ($e) use (&$id_tramo_vinculado) {
            return $e['ID'] == $id_tramo_vinculado;
        }
    );

    if ($oportunidades[$i]['ID'] > $oportunidades[$i]['ID_VIAJE_VINCULADO']) {
        $fechaTramo1 = new DateTime($viaje_vinculado[1]['FECHA']);
        $datos_mtop["FECHA_SALIDA"] = $viaje_vinculado[1]['FECHA'];
        $datos_mtop["FECHA_LLEGADA"] = $oportunidades[$i]['FECHA'];
    } else {
        $fechaTramo1 = new DateTime($oportunidades[$i]['FECHA']);
        $datos_mtop["FECHA_SALIDA"] = $oportunidades[$i]['FECHA'];
        $datos_mtop["FECHA_LLEGADA"] = $viaje_vinculado[0]['FECHA'];
    }

    if ($id_tramo_vinculado == "") {
        $button_crear_oportunidad = "<button class='button tooltip left' data-tooltip='Cear Oportunidad' onclick='crear_oportunidad(" . $oportunidades[$i]['ID'] . ")'><i class='fas fa-plus' aria-hidden='true'></i></button>";
    } else {
        $button_crear_oportunidad = " ";
    }

    $datos_mtop["NOMBRE"] = $oportunidades[$i]['NOMBRE'];
    $datos_mtop["APELLIDO"] = $oportunidades[$i]['APELLIDO'];
    $datos_mtop["ORIGEN"] = $oportunidades[$i]['ORIGEN'];
    $datos_mtop["DESTINO"] = $oportunidades[$i]['DESTINO'];
    $datos_mtop["DISTANCIA"] = $oportunidades[$i]['DISTANCIA'];
    $datos_mtop["MATRICULA"] = $oportunidades[$i]['VECHICULO'];

    /**
     * TRAIGO CREDENCIALES DEL MINISTERIO.
     */
    $datos_ministerio_tta = json_decode($datos->datos_mtop_tta($datos_mtop["MATRICULA"]), true);

    $datos_mtop["NRO_MTOP"] = $datos_ministerio_tta[0]['NUMERO_MTOP'];
    $datos_mtop["PASS_MTOP"] = $datos_ministerio_tta[0]['PASS_MTOP'];

    $datos_mtop = json_encode($datos_mtop);

    $intervalo = $fechaTramo1->diff($fechaActual);

    $estado_mtop = $datos->estado_mtop($oportunidades[$i]['ID']);

    if ((int) $intervalo->format('%d') >= 1 && $oportunidades[$i]['ID'] < $oportunidades[$i]['ID_VIAJE_VINCULADO'] || $oportunidades[$i]['ID'] > $oportunidades[$i]['ID_VIAJE_VINCULADO']) {
        switch ($estado_mtop) {
            //amarillo
            case 1:
                $button_mtop = "<button class='amarillo tooltip left' data-tooltip='Permiso MTOP en Proceso'><i class='fas fa-file-contract'></i></button>";
                break;
            //rojo
            case 2:
                $button_mtop = "<button class='rojo tooltip left' data-tooltip='Permiso MTOP Rechazado'><i class='fas fa-file-contract'></i></button>";
                break;
            //verde
            case 3:
                $button_mtop = "<button class='verde tooltip left' data-tooltip='Permiso MTOP Realizado con Exito'><i class='fas fa-file-contract'></i></button>";
                break;
            //azul
            default:
                $link = '"https://www.salioviaje.com.uy/Editar_Viaje/' . $oportunidades[$i]['ID'] . '"';
                //$button_mtop = "<button class='button tooltip left' data-tooltip='Permiso MTOP' onclick='mtop_viaje(" . $datos_mtop . ",". $oportunidades[$i]['ID'] .")'><i class='fas fa-file-contract'></i></button>";
                $button_mtop = "<button class='button tooltip left' data-tooltip='Permiso MTOP' onclick='window.location.href = " . $link . "'><i class='fas fa-file-contract'></i></button>";
                break;
        }
    } else {
        $button_mtop = '';
    }

    $fecha = explode(' ', $oportunidades[$i]['FECHA']);
    if ($oportunidades[$i]['MODALIDAD'] != "Oportunidad" && $oportunidades_dashboard == null && $_SESSION['datos_usuario']['TIPO_USUARIO'] != "PAX") {
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
                      ' . $button_crear_oportunidad . $button_mtop . '
                          <button class="button tooltip left" data-tooltip="Eliminar Viaje" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                      </div>
                    </td>
              </tr>
      ';
    } elseif ($oportunidades[$i]['MODALIDAD'] != "Oportunidad") {
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
                      ' . $button_crear_oportunidad . $button_mtop . '
                          <button class="button tooltip left" data-tooltip="Eliminar Viaje" onclick="eliminar_viajes(' . $oportunidades[$i]['ID'] . ',1)"><i class="fas fa-trash-alt"></i></button>
                      </div>
                    </td>
              </tr>
      ';
    }

}
/*
pax
 */
if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == "PAX" || $_SESSION['datos_usuario']['TIPO_USUARIO'] == "ANF" || $_SESSION['datos_usuario']['TIPO_USUARIO'] == "AGT") {
    /*
     * agendados
     */
    //
    if ($datos2 != null) {
        for ($i = 0; $i < count($datos2); $i++) {
            $PRECIO_CON_DESCUENTO_APLICADO = round($datos2[$i]['PRECIO'] - $datos2[$i]['PRECIO'] * ($datos2[$i]['DESCUENTO'] / 100));
            $fecha = explode(' ', $datos2[$i]['FECHA']);

            if ($datos2[$i]['MODALIDAD'] != "Agendado" && $datos2[$i]['MODALIDAD'] != "Oportunidad") {
                echo $datos2[$i]['ID_SOLICITUD'] . " ";
                $oportunidades_dashboard = $oportunidades_dashboard . '
                    <tr>
                        <td data-title="ID">' . $datos2[$i]['ID_SOLICITUD'] . '</td>
                        <td data-title="Origen">' . $datos2[$i]['ORIGEN'] . '</td>
                        <td data-title="Destino">' . $datos2[$i]['DESTINO'] . '</td>
                        <td data-title="Fecha">' . $fecha[0] . '</td>
                        <td data-title="Hora">' . $fecha[1] . '</td>
                        <td data-title="CantidadPasajeros">' . $datos2[$i]['CANTIDAD_PASAJERO'] . '</td>
                        <td data-title="Modalidad">' . $datos2[$i]['MODALIDAD'] . '</td>
                        <td data-title="Estado">' . $datos2[$i]['ESTADO'] . '</td>
                        <td data-title="Precio">$' . $PRECIO_CON_DESCUENTO_APLICADO . '</td>
                        <td data-title="Contacto">
                            <div class="button-wrapper">
                                <button class="button tooltip left" data-tooltip="Contacto Transportista" onclick="modal_contacto(\'' . $datos2[$i]['NOMBRE'] . '\',' . $datos2[$i]['TELEFONO'] . ')"><i class="fa-solid fa-address-card"></i></button>
                                <button class="button tooltip left" data-tooltip="Copiar Viaje" onclick="copiar_solicitud(' . $datos2[$i]['ID_SOLICITUD'] . ',1)"><i class="fa-solid fa-copy"></i></button>
                            </div>
                        </td>
                    </tr>
                    ';

            } else if ($datos2[$i]['MODALIDAD'] == "Agendado") {
                $oportunidades_dashboard = $oportunidades_dashboard . '
                    <tr>
                        <td data-title="ID">' . $datos2[$i]['ID'] . '</td>
                        <td data-title="Origen">' . $datos2[$i]['ORIGEN'] . '</td>
                        <td data-title="Destino">' . $datos2[$i]['DESTINO'] . '</td>
                        <td data-title="Fecha">' . $fecha[0] . '</td>
                        <td data-title="Hora">' . $fecha[1] . '</td>
                        <td data-title="CantidadPasajeros">' . $datos2[$i]['CANTIDAD_PASAJERO'] . '</td>
                        <td data-title="Modalidad">' . $datos2[$i]['MODALIDAD'] . '</td>
                        <td data-title="Estado">' . $datos2[$i]['ESTADO'] . '</td>
                        <td data-title="Precio">$' . $PRECIO_CON_DESCUENTO_APLICADO . '</td>
                        <td data-title="Contacto">
                            <div class="button-wrapper">
                                <button class="button tooltip left" data-tooltip="Contacto Transportista" onclick="modal_contacto(\'' . $datos2[$i]['NOMBRE'] . '\',' . $datos2[$i]['TELEFONO'] . ')"><i class="fa-solid fa-address-card"></i></button>
                            </div>
                        </td>
                    </tr>
                    ';
            }
        }
    }

    /*
     * oportunidades compradas
     */
    for ($i = 0; $i < count($oportunidades); $i++) {
        $PRECIO_CON_DESCUENTO_APLICADO = round($oportunidades[$i]['PRECIO'] - $oportunidades[$i]['PRECIO'] * ($oportunidades[$i]['DESCUENTO'] / 100));
        $fecha = explode(' ', $oportunidades[$i]['FECHA']);
        $oportunidades_dashboard = $oportunidades_dashboard . '
            <tr>
                <td data-title="ID">' . $oportunidades[$i]['ID'] . '</td>
                <td data-title="Origen">' . $oportunidades[$i]['ORIGEN'] . '</td>
                <td data-title="Destino">' . $oportunidades[$i]['DESTINO'] . '</td>
                <td data-title="Fecha">' . $fecha[0] . '</td>
                <td data-title="Hora">' . $fecha[1] . '</td>
                <td data-title="CantidadPasajeros">' . $oportunidades[$i]['CANTIDAD_PASAJERO'] . '</td>
                <td data-title="Modalidad">' . $oportunidades[$i]['MODALIDAD'] . '</td>
                <td data-title="Estado">' . $oportunidades[$i]['ESTADO'] . '</td>
                <td data-title="Precio">$' . $PRECIO_CON_DESCUENTO_APLICADO . '</td>
                <td data-title="Contacto">
                    <div class="button-wrapper">
                        <button class="button tooltip left" data-tooltip="Contacto Transportista" onclick="modal_contacto(\'' . $oportunidades[$i]['NOMBRE'] . '\',' . $oportunidades[$i]['TELEFONO'] . ')"><i class="fa-solid fa-address-card"></i></button>
                    </div>
                </td>
            </tr>
            ';
    }
    /*
     * cotizaciones
     */
    for ($i = 0; $i < count($cotizaciones); $i++) {
        $fecha = explode(' ', $cotizaciones[$i]['FECHA']);
        if ($cotizaciones[$i]['ESTADO'] == "Cotizando") {
            $oportunidades_dashboard = $oportunidades_dashboard . '
            <tr>
            <td data-title="ID">' . $cotizaciones[$i]['ID'] . '</td>
            <td data-title="Origen">' . $cotizaciones[$i]['ORIGEN'] . '</td>
            <td data-title="Destino">' . $cotizaciones[$i]['DESTINO'] . '</td>
            <td data-title="Fecha">' . $cotizaciones[$i]['FECHA'] . '</td>
            <td data-title="Hora">' . $cotizaciones[$i]['HORA'] . '</td>
            <td data-title="CantidadPasajeros">' . $cotizaciones[$i]['CANTIDAD_PASAJEROS'] . '</td>
            <td data-title="Modalidad">' . $cotizaciones[$i]['MODALIDAD'] . '</td>
            <td data-title="Estado">' . $cotizaciones[$i]['ESTADO'] . '</td>
            <td data-title="Precio">-</td>
                <td data-title="Contacto">
                <div class="button-wrapper">
                <button class="button tooltip left" data-tooltip="Copiar Viaje" onclick="copiar_solicitud(' . $cotizaciones[$i]['ID'] . ',1)"><i class="fa-solid fa-copy"></i></button>
                </div>
                </td>
            </tr>
            ';
        }
    }
}

if ($_SESSION['datos_usuario']['TIPO_USUARIO'] == "TTA") {
    for ($i = 0; $i < count($cotizaciones); $i++) {
        $oportunidades_dashboard = $oportunidades_dashboard . '
        <tr>
            <td data-title="ID">' . $cotizaciones[$i]['ID'] . '</td>
            <td data-title="Origen">' . $cotizaciones[$i]['ORIGEN'] . '</td>
            <td data-title="Destino">' . $cotizaciones[$i]['DESTINO'] . '</td>
            <td data-title="Fecha">' . $cotizaciones[$i]['FECHA'] . '</td>
            <td data-title="Estado">' . $cotizaciones[$i]['ESTADO'] . '</td>
            <td data-title="Modalidad">' . $cotizaciones[$i]['MODALIDAD'] . '</td>
        </tr>
        ';
    }
}

echo $oportunidades_dashboard;
