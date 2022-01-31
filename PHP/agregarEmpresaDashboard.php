<?php 

$NOMBRE_EMPRESA = $_POST['NOMBRE_EMPRESA'];
$ID_EMPRESA = $_POST['ID_EMPRESA'];

$NUEVA_EMPRESA_DASHBOARD = '

                <div class="propietario">
                  <div class="propietario-left">
                    <div class="propietario-icon">
                      <i class="fas fa-user"></i>
                    </div>
                    <div class="propietario-info">
                      <h3>'.$NOMBRE_EMPRESA.'</h3>
                      <p><i class="fas fa-home"></i> 2 usuarios</p>
                    </div>
                  </div>
                  <div class="propietario-button">
                    <button id="'.$ID_EMPRESA.'">Ver</button>
                  </div>
                </div>

';

echo $NUEVA_EMPRESA_DASHBOARD;
?>