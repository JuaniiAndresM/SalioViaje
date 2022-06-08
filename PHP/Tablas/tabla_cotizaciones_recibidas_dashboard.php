<?php

require_once "../procedimientosBD.php";

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

$datos = new procedimientosBD();

$datos = json_decode($datos->traer_cotizaciones_recibidas_por_id_solicitante($_SESSION['datos_usuario']['ID']), true);

for ($i = 0; $i < count($datos); $i++) {
    if ($i == 0) {
        
        $tr = '
        <tr>
        <td data-title="ID">'.$datos[$i]["ID"].'</td>
        <td data-title="Reputación">
          <div class="reputacion">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half"></i>
          </div>
        </td>
        <td data-title="Marca / Modelo">'.$datos[$i]["MARCA"].', '.$datos[$i]["MODELO"].'</td>
        <td data-title="Capacidad">'.$datos[$i]["CAPACIDAD"].'</td>
        <td data-title="Precio">$'.$datos[$i]["PRECIO"].'</td>
        <td data-title="ID_VIAJE_COTIZADO">'.$datos[$i]["ID_VIAJE_COTIZADO"].'</td>
        <td>
          <div class="button-wrapper">
            <button class="button" onclick="aceptarCotizacion('.$datos[$i]["ID"].','.$datos[$i]["ID_VIAJE_COTIZADO"].')"><i class="fas fa-dollar-sign"></i></button>
            <button class="button" onclick="rechazarCotizacion('.$datos[$i]["ID"].')"><i class="fas fa-ban"></i></button>
        </td>
      </tr>
';
    } else {
        $tr = $tr . '
        <tr>
        <td data-title="ID">'.$datos[$i]["ID"].'</td>
        <td data-title="Reputación">
          <div class="reputacion">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half"></i>
          </div>
        </td>
        <td data-title="Marca / Modelo">'.$datos[$i]["MARCA"].', '.$datos[$i]["MODELO"].'</td>
        <td data-title="Capacidad">'.$datos[$i]["CAPACIDAD"].'</td>
        <td data-title="Precio">$'.$datos[$i]["PRECIO"].'</td>
        <td data-title="ID_VIAJE_COTIZADO">'.$datos[$i]["ID_VIAJE_COTIZADO"].'</td>
        <td>
          <div class="button-wrapper">
          <button class="button" onclick="aceptarCotizacion('.$datos[$i]["ID"].','.$datos[$i]["ID_VIAJE_COTIZADO"].')"><i class="fas fa-dollar-sign"></i></button>
          <button class="button" onclick="rechazarCotizacion('.$datos[$i]["ID"].')"><i class="fas fa-ban"></i></button>
        </td>
      </tr>
';
    }

}

echo $tr;