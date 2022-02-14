<?php 
require_once "procedimientosBD.php";

$datos = new procedimientosBD();

$datos = json_decode($datos->traer_oportunidades(),true);
$contenido_oportunidades = '0';


			for ($i=0; $i < count($datos); $i++) { 
				$fecha = explode(' ', $datos[$i]['FECHA']);
				if ($i==0) {
					$contenido_oportunidades = '
					<div class="oportunidad">

              <div class="oportunidad-left">
                <div class="discount">
                  <h3>'.$datos[$i]['DESCUENTO'].'%</h3>
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
                  <p><i class="fas fa-user-friends"></i> '.$datos[$i]['CANTIDAD_PASAJEROS'].'</p>
                  <p><i class="fas fa-bus"></i> '.$datos[$i]['MARCA'].' '.$datos[$i]['MODELO'].'</p>
                </div>
              </div>

              <div class="oportunidad-right">

                <div class="travel">
                  <p><i class="fas fa-user-tie"></i> '.$datos[$i]['NOMBRE'].' '.$datos[$i]['APELLIDO'].'</p>
                  <p class="calificacion"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p>
                </div>
                
                <div class="button-wrapper">
                  <button class="comprar-button" onclick="comprar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-comments-dollar"></i> Comprar</button>
                  <button><i class="fas fa-info"></i> Detalles</button>
                </div>

              </div>
              </div>
					';

				}else{
					$contenido_oportunidades = $contenido_oportunidades.'
					<div class="oportunidad">

              <div class="oportunidad-left">
                <div class="discount">
                  <h3>'.$datos[$i]['DESCUENTO'].'%</h3>
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
                  <p><i class="fas fa-user-friends"></i> '.$datos[$i]['CANTIDAD_PASAJEROS'].'</p>
                  <p><i class="fas fa-bus"></i> '.$datos[$i]['MARCA'].' '.$datos[$i]['MODELO'].'</p>
                </div>
              </div>

              <div class="oportunidad-right">

                <div class="travel">
                  <p><i class="fas fa-user-tie"></i> '.$datos[$i]['NOMBRE'].' '.$datos[$i]['APELLIDO'].'</p>
                  <p class="calificacion"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></p>
                </div>
                
                <div class="button-wrapper">
                  <button class="comprar-button" onclick="comprar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-comments-dollar"></i> Comprar</button>
                  <button><i class="fas fa-info"></i> Detalles</button>
                </div>

              </div>
              </div>
					';
				}

			}

echo $contenido_oportunidades;


 ?>