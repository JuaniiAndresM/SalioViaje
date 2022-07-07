<?php 

require_once "../procedimientosBD.php";

$datos = new procedimientosBD();

$datos = json_decode($datos->traer_oportunidades(),true);

$datos2 = new procedimientosBD();

$datos2 = json_decode($datos2->traer_viajes(),true);

$oportunidades_dashboard = '';

for ($i=0; $i < count($datos); $i++) { 
 $PRECIO_CON_DESCUENTO_APLICADO = round($datos[$i]['PRECIO'] - $datos[$i]['PRECIO'] * ($datos[$i]['DESCUENTO'] / 100));
 $fecha = explode(' ', $datos[$i]['FECHA']);

        if ($i==0) {
          if($datos[$i]['DESCUENTO'] != ""){
            $datos[$i]['DESCUENTO'] = $datos[$i]['DESCUENTO'].'%';
          }else{
            $datos[$i]['DESCUENTO'] = '-';
          }
          $oportunidades_dashboard = '
                  <tr>
                      <td>'.$datos[$i]['ID'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$fecha[1].'</td>
                      <td>'.$datos[$i]['MATRICULA'].'</td>
                      <td>'.$datos[$i]['ORIGEN'].'</td>
                      <td>'.$datos[$i]['DESTINO'].'</td>
                      <td>'.$datos[$i]['DISTANCIA'].' km</td>
                      <td>'.$datos[$i]['CANTIDAD_PASAJEROS'].'</td>
                      <td>'.$PRECIO_CON_DESCUENTO_APLICADO.'</td>
                      <td>'.$datos[$i]['DESCUENTO'].'
                      </td>
                      <td>'.$datos[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button tooltip left" data-tooltip="Editar Oportunidad" onclick="editar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr> 
          ';
        }else{
          if($datos[$i]['DESCUENTO'] != ""){
            $datos[$i]['DESCUENTO'] = $datos[$i]['DESCUENTO'].'%';
          }else{
            $datos[$i]['DESCUENTO'] = '-';
          }
          $oportunidades_dashboard= $oportunidades_dashboard.'
                  <tr>
                      <td>'.$datos[$i]['ID'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$fecha[1].'</td>
                      <td>'.$datos[$i]['MATRICULA'].'</td>
                      <td>'.$datos[$i]['ORIGEN'].'</td>
                      <td>'.$datos[$i]['DESTINO'].'</td>
                      <td>'.$datos[$i]['DISTANCIA'].' km</td>
                      <td>'.$datos[$i]['CANTIDAD_PASAJEROS'].'</td>
                      <td>'.$PRECIO_CON_DESCUENTO_APLICADO.'</td>
                      <td>'.$datos[$i]['DESCUENTO'].'
                      </td>
                      <td>'.$datos[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button tooltip left" data-tooltip="Editar Oportunidad" onclick="editar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }

}

for ($i=0; $i < count($datos2); $i++) { 
 $PRECIO_CON_DESCUENTO_APLICADO = round($datos2[$i]['PRECIO'] - $datos2[$i]['PRECIO'] * ($datos2[$i]['DESCUENTO'] / 100));
 $fecha = explode(' ', $datos2[$i]['FECHA']);
        if ($i==0 && $oportunidades_dashboard == null) {
          $oportunidades_dashboard = '
                  <tr>
                      <td>'.$datos2[$i]['ID'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$fecha[1].'</td>
                      <td>'.$datos2[$i]['MATRICULA'].'</td>
                      <td>'.$datos2[$i]['ORIGEN'].'</td>
                      <td>'.$datos2[$i]['DESTINO'].'</td>
                      <td>'.$datos2[$i]['DISTANCIA'].' km</td>
                      <td>'.$datos2[$i]['CANTIDAD_PASAJEROS'].'</td>
                      <td>'.$PRECIO_CON_DESCUENTO_APLICADO.'</td>
                      <td>-</td>
                      <td>'.$datos2[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button tooltip left" data-tooltip="Editar Oportunidad" onclick="editar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }else{
          $oportunidades_dashboard= $oportunidades_dashboard.'
                  <tr>
                      <td>'.$datos2[$i]['ID'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$fecha[1].'</td>
                      <td>'.$datos2[$i]['MATRICULA'].'</td>
                      <td>'.$datos2[$i]['ORIGEN'].'</td>
                      <td>'.$datos2[$i]['DESTINO'].'</td>
                      <td>'.$datos2[$i]['DISTANCIA'].' km</td>
                      <td>'.$datos2[$i]['CANTIDAD_PASAJEROS'].'</td>
                      <td>'.$PRECIO_CON_DESCUENTO_APLICADO.'</td>
                      <td>-</td>
                      <td>'.$datos2[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button tooltip left" data-tooltip="Editar Oportunidad" onclick="editar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button tooltip left" data-tooltip="Eliminar Oportunidad" onclick="eliminar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }
}

echo $oportunidades_dashboard;
?>