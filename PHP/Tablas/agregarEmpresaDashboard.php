<?php 

require_once "../procedimientosBD.php";

$datos_bd = new procedimientosBD();

$datos = $datos_bd->datos_empresas();
echo "hola";

for ($i=0; $i < count($datos); $i++) { 
  $vehiculos =  json_decode($datos_bd->traer_datos_vehiculo_por_empresa($datos[$i]["RUT"],$datos[$i]["ID"]),true);
  echo json_encode($vehiculos);
  $NUEVA_EMPRESA_DASHBOARD = '
                <div class="propietario">
                  <div class="propietario-left">
                    <div class="propietario-icon">
                      <i class="fas fa-building"></i>
                    </div>
                    <div class="propietario-info">
                      <h3>'.$datos[$i]["NOMBRE_EMPRESA"].'</h3>';
                      if(count($vehiculos) != 0){
                        $NUEVA_EMPRESA_DASHBOARD .= '<p><i class="fas fa-bus"></i>'.count($vehiculos).' Vehículos</p>';
                      }
                      $NUEVA_EMPRESA_DASHBOARD .= '
                    </div>
                  </div>
                  <div class="propietario-button">
                      <button id="'.$datos[$i]["ID"].'" onclick="verEmpresa('.$datos[$i]['ID'].')"><i class="far fa-eye"></i></button>
                      <button id="'.$datos[$i]["ID"].'" onclick="editarEmpresa('.$datos[$i]['ID'].')"><i class="fas fa-edit"></i></button>
                      <button id="'.$datos[$i]["ID"].'" onclick="eliminarEmpresa('.$datos[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>

';
}

echo $NUEVA_EMPRESA_DASHBOARD;
?>