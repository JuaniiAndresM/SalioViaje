<?php
require_once "../procedimientosBD.php";

$ttl = (60 * 60 * 24); # 1 día
session_set_cookie_params($ttl);
session_start();

$datos = new procedimientosBD();

$datos = json_decode($datos->traer_oportunidades(), true);

$contenido_oportunidades = ' ';

for ($i = 0; $i < count($datos); $i++) {
    if (isset($_SESSION['usuario'])) {
      if($_SESSION['datos_usuario']['TIPO_USUARIO'] != "CHO"){
        $boton = '<button class="comprar-button" type="submit" onclick="comprar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-comments-dollar"></i> Comprar</button>';
      }
    } else if (!isset($_SESSION['usuario'])) {
        $boton = '<button class="comprar-button" type="submit" onclick="location.href=\'https://www.salioviaje.com.uy/Login\'"><i class="fas fa-comments-dollar"></i> Comprar</button>';
    } else {
        $boton = ' ';
    }
    $fecha = explode(' ', $datos[$i]['FECHA']);
    $PRECIO_CON_DESCUENTO_APLICADO = round($datos[$i]['PRECIO'] - $datos[$i]['PRECIO'] * ($datos[$i]['DESCUENTO'] / 100));
    if ($i == 0 && $datos[$i]['ESTADO'] == 'En venta') {
        $contenido_oportunidades = '
					<div class="oportunidad" id="Opo-'.$i.'" data-value="'.$datos[$i]['ORIGEN'].','.$datos[$i]['DESTINO'].','.$fecha[0].'">

              <div class="oportunidad-left">
                <div class="discount">
                  <h3>' . $datos[$i]['DESCUENTO'] . '%</h3>
                  <div class="precio">
                    <p class="precio_total">$' . number_format($datos[$i]['PRECIO']) . '</p>
                    <p class="precio_desc">$' . number_format($PRECIO_CON_DESCUENTO_APLICADO) . '</p>
                  </div>
                </div>
                <div class="travel">
                  <p><i class="fas fa-map-marker-alt"></i> Origen: ' . $datos[$i]['ORIGEN'] . '.</p>
                  <p><i class="fas fa-route"></i> Destino: ' . $datos[$i]['DESTINO'] . '.</p>
                </div>
                <div class="travel">
                  <p><i class="far fa-calendar-alt"></i> ' . $fecha[0] . '</p>
                  <p><i class="far fa-clock"></i> ' . $fecha[1] . '</p>
                </div>
                <div class="travel">
                  <p><i class="fas fa-user-friends"></i> ' . $datos[$i]['CAPACIDAD_VEHICULO'] . '</p>
                  <p><i class="fas fa-bus"></i> ' . $datos[$i]['MARCA'] . ' ' . $datos[$i]['MODELO'] . '</p>
                </div>
              </div>

              <div class="oportunidad-right">

                <div class="travel">
                  <p class="calificacion">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half"></i>
                  </p>
                </div>

                <div class="button-wrapper">
                  ' . $boton . '
                  <button onclick="detalles_oportunidad(' . $datos[$i]['ID'] . ')"><i class="fas fa-info"></i> Detalles</button>
                </div>

              </div>
              </div>
					';

    } else if ($datos[$i]['ESTADO'] == 'En venta') {
        $contenido_oportunidades = $contenido_oportunidades . '
					<div class="oportunidad" id="Opo-'.$i.'" data-value="'.$datos[$i]['ORIGEN'].','.$datos[$i]['DESTINO'].','.$fecha[0].'">

              <div class="oportunidad-left">
                <div class="discount">
                  <h3>' . $datos[$i]['DESCUENTO'] . '%</h3>
                  <div class="precio">
                    <p class="precio_total">$' . number_format($datos[$i]['PRECIO']) . '</p>
                    <p class="precio_desc">$' . number_format($PRECIO_CON_DESCUENTO_APLICADO) . '</p>
                  </div>
                </div>
                <div class="travel">
                  <p><i class="fas fa-map-marker-alt"></i> Origen: ' . $datos[$i]['ORIGEN'] . '.</p>
                  <p><i class="fas fa-route"></i> Destino: ' . $datos[$i]['DESTINO'] . '.</p>
                </div>
                <div class="travel">
                  <p><i class="far fa-calendar-alt"></i> ' . $fecha[0] . '</p>
                  <p><i class="far fa-clock"></i> ' . $fecha[1] . '</p>
                </div>
                <div class="travel">
                  <p><i class="fas fa-user-friends"></i> ' . $datos[$i]['CAPACIDAD_VEHICULO'] . '</p>
                  <p><i class="fas fa-bus"></i> ' . $datos[$i]['MARCA'] . ' ' . $datos[$i]['MODELO'] . '</p>
                </div>
              </div>

              <div class="oportunidad-right">

                <div class="travel">
                  <p class="calificacion">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half"></i>
                  </p>
                </div>

                <div class="button-wrapper">
                    ' . $boton . '
                    <button onclick="detalles_oportunidad(' . $datos[$i]['ID'] . ')"><i class="fas fa-info"></i> Detalles</button>
                </div>

              </div>
              </div>
					';
    }

}

echo $contenido_oportunidades;
