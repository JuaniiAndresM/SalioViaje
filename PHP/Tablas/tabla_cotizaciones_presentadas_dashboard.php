<?php

require_once "../procedimientosBD.php";

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

$datos = new procedimientosBD();

$datos = json_decode($datos->traer_cotizaciones_presentadas_por_id_solicitante($_SESSION['datos_usuario']['ID']), true);
//tbody-cotizaciones-dashboard

for ($i = 0; $i < count($datos); $i++) {
    if ($i == 0) {
        
        $tr = '
<tr>
<td data-title="ID">'.$datos[$i]["ID"].'</td>
<td data-title="Origen">'.$datos[$i]["DIRECCION_ORIGEN"].','.$datos[$i]["BARRIO_ORIGEN"].','.$datos[$i]["LOCALIDAD_ORIGEN"].'.</td>
<td data-title="Destino">'.$datos[$i]["DIRECCION_DESTINO"].','.$datos[$i]["BARRIO_DESTINO"].','.$datos[$i]["LOCALIDAD_DESTINO"].'.</td>
<td data-title="Fecha">'.$datos[$i]["FECHA_SALIDA"].'</td>
<td data-title="Estado">Cotizando</td>
    <td data-title="Estado">Cotizando</td>
    <td>
        <div class="button-wrapper">
            <button class="button"><i class="fas fa-ban"></i></button>
    </td>
</tr>
';
    } else {
        $tr = $tr . '
<tr>
<td data-title="ID">'.$datos[$i]["ID"].'</td>
    <td data-title="Origen">Example, Example 2</td>
    <td data-title="Destino">Example 3, Example 4</td>
    <td data-title="Fecha">dd/mm/aaaa</td>
    <td data-title="Estado">Cotizando</td>
    <td>
        <div class="button-wrapper">
            <button class="button"><i class="fas fa-ban"></i></button>
    </td>
</tr>
';
    }

}

echo $tr;