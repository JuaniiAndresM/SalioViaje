<?php 
require_once "../procedimientosBD.php";

$datos = new procedimientosBD();

$datos = json_decode($datos->traer_oportunidades(),true);
$contenido_oportunidades = ' ';


			for ($i=0; $i < count($datos); $i++) { 
				$fecha = explode(' ', $datos[$i]['FECHA']);
        $PRECIO_CON_DESCUENTO_APLICADO =  round($datos[$i]['PRECIO'] - $datos[$i]['PRECIO'] * ($datos[$i]['DESCUENTO']/100));
				if ($i==0 && $datos[$i]['ESTADO'] == 'En venta') {

					$contenido_oportunidades = '
					<div class="oportunidad">

              <div class="oportunidad-left">
                <div class="discount">
                  <h3>'.$datos[$i]['DESCUENTO'].'%</h3>
                  <div class="precio">
                    <p class="precio_total">$'.number_format($datos[$i]['PRECIO']).'</p>
                    <p class="precio_desc">$'.number_format($PRECIO_CON_DESCUENTO_APLICADO).'</p>
                  </div>
                </div>
                <div class="travel">
                  <p><i class="fas fa-map-marker-alt"></i> Origen: '.$datos[$i]['ORIGEN'].'.</p>
                  <p><i class="fas fa-route"></i> Destino: '.$datos[$i]['DESTINO'].'.</p>
                </div>
                <div class="travel">
                  <p><i class="far fa-calendar-alt"></i> '.$fecha[0].'</p>
                  <p><i class="far fa-clock"></i> '.$fecha[1].'</p>
                </div>
                <div class="travel">
                  <p><i class="fas fa-user-friends"></i> '.$datos[$i]['CAPACIDAD_VEHICULO'].'</p>
                  <p><i class="fas fa-bus"></i> '.$datos[$i]['MARCA'].' '.$datos[$i]['MODELO'].'</p>
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
                  <button class="comprar-button" type="submit" onclick="comprar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-comments-dollar"></i> Comprar</button>
                  <button onclick="detalles_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-info"></i> Detalles</button>
                </div>

              </div>
              </div>
					';

				}else if ($datos[$i]['ESTADO'] == 'En venta'){
					$contenido_oportunidades = $contenido_oportunidades.'
					<div class="oportunidad">

              <div class="oportunidad-left">
                <div class="discount">
                  <h3>'.$datos[$i]['DESCUENTO'].'%</h3>
                  <div class="precio">
                  '.$datos[$i]['PRECIO'].'
                  </div>
                </div>
                <div class="travel">
                  <p><i class="fas fa-map-marker-alt"></i> Origen: '.$datos[$i]['ORIGEN'].'.</p>
                  <p><i class="fas fa-route"></i> Destino: '.$datos[$i]['DESTINO'].'.</p>
                </div>
                <div class="travel">
                  <p><i class="far fa-calendar-alt"></i> '.$fecha[0].'</p>
                  <p><i class="far fa-clock"></i> '.$fecha[1].'</p>
                </div>
                <div class="travel">
                  <p><i class="fas fa-user-friends"></i> '.$datos[$i]['CAPACIDAD_VEHICULO'].'</p>
                  <p><i class="fas fa-bus"></i> '.$datos[$i]['MARCA'].' '.$datos[$i]['MODELO'].'</p>
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
                    <button class="comprar-button" type="submit" onclick="comprar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-comments-dollar"></i> Comprar</button>               
                    <button onclick="detalles_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-info"></i> Detalles</button>
                </div>

              </div>
              </div>
					';
				}

			}

echo $contenido_oportunidades;


 ?>