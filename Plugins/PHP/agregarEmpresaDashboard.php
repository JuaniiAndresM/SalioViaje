<?php 

require_once "procedimientosBD.php";

$datos_bd = new procedimientosBD();

$datos = $datos_bd->datos_empresas();

for ($i=0; $i < count($datos); $i++) { 
 $NUEVA_EMPRESA_DASHBOARD = '
                <div class="propietario">
                  <div class="propietario-left">
                    <div class="propietario-icon">
                      <i class="fas fa-building"></i>
                    </div>
                    <div class="propietario-info">
                      <h3>'.$datos[$i]["NOMBRE_EMPRESA"].'</h3>
                      <p><i class="fas fa-bus"></i> 2 Vehiculos</p>
                    </div>
                  </div>
                  <div class="propietario-button">
                    <button id="'.$ID_EMPRESA.'" class="button"><i class="far fa-eye"></i></button>
                    <button id="'.$ID_EMPRESA.'" class="button"><i class="fas fa-edit"></i></button>
                    <button id="'.$ID_EMPRESA.'" class="button"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>

';
}


echo $NUEVA_EMPRESA_DASHBOARD;
?>