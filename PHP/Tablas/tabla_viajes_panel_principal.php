<?php 

require_once "../procedimientosBD.php";

$datos = new procedimientosBD();

$datos = json_decode($datos->traer_oportunidades(),true);

$datos2 = new procedimientosBD();

$datos2 = json_decode($datos2->traer_viajes(),true);

$oportunidades_dashboard = '';

for ($i=0; $i < count($datos); $i++) { 
 $fecha = explode(' ', $datos[$i]['FECHA']);

        if ($i==0) {
          $oportunidades_dashboard = '
                  <tr>
                      <td>'.$datos[$i]['ID'].'</td>
                      <td>'.$datos[$i]['ORIGEN'].'</td>
                      <td>'.$datos[$i]['DESTINO'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$datos[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="editar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button" onclick="eliminar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }else{
          $oportunidades_dashboard= $oportunidades_dashboard.' 
                  <tr>
                      <td>'.$datos[$i]['ID'].'</td>
                      <td>'.$datos[$i]['ORIGEN'].'</td>
                      <td>'.$datos[$i]['DESTINO'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$datos[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="editar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button" onclick="eliminar_oportunidad('.$datos[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }

}

for ($i=0; $i < count($datos2); $i++) { 
 $fecha = explode(' ', $datos2[$i]['FECHA']);
        if ($i==0 && $oportunidades_dashboard == null) {
          $oportunidades_dashboard = '
                  <tr>
                      <td>'.$datos2[$i]['ID'].'</td>
                      <td>'.$datos2[$i]['ORIGEN'].'</td>
                      <td>'.$datos2[$i]['DESTINO'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$datos2[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="editar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button" onclick="eliminar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }else{
          $oportunidades_dashboard= $oportunidades_dashboard.'
                  <tr>
                      <td>'.$datos2[$i]['ID'].'</td>
                      <td>'.$datos2[$i]['ORIGEN'].'</td>
                      <td>'.$datos2[$i]['DESTINO'].'</td>
                      <td>'.$fecha[0].'</td>
                      <td>'.$datos2[$i]['ESTADO'].'</td>
                      <td>
                          <div class="button-wrapper">
                              <button class="button" onclick="editar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-pen"></i></button>
                              <button class="button" onclick="eliminar_oportunidad('.$datos2[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </td>
                  </tr>
          ';
        }
}



        if ($i==0) {

        }else{

        }



echo $oportunidades_dashboard;
?>