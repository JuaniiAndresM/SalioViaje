<?php 

$datos = json_decode($_POST['datos']);
$matricula = $datos->{'MATRICULA'};

if (isset($datos->{'CAPACIDAD'})) {
  $capacidad = $datos->{'CAPACIDAD'};
} else {
  $capacidad = $datos->{'CAPACIDAD_PASAJEROS'};
}



if ($capacidad == "3" || $capacidad < "3") {
	$vehiculo = '
          
            <div class="vehiculo" id="'.$matricula.'">

              <div class="vehiculo-left">
                <div class="vehiculo-icon">
                  <i class="fas fa-car"></i>
                </div>
                <div class="vehiculo-info">
                  <h3 class="matricula">'.$matricula.'</h3>
                  <p><i class="fas fa-users"></i>'.$capacidad.'</p>
                </div>
              </div>
              
              <div class="edit-button">
                <button class="editar_vehiculo" onclick="formulario_editar_vehiculo(`'.$matricula.'`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="eliminar_vehiculo" onclick="eliminar_vehiculo(`'.$matricula.'`)"><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>

';
echo $vehiculo;
}elseif ($capacidad == "12" || $capacidad < "12" && $capacidad > "3") {
	$vehiculo = '
          
            <div class="vehiculo" id="'.$matricula.'">

              <div class="vehiculo-left">
                <div class="vehiculo-icon">
                  <i class="fas fa-car"></i>
                </div>
                <div class="vehiculo-info">
                  <h3 class="matricula">'.$matricula.'</h3>
                  <p><i class="fas fa-users"></i>'.$capacidad.'</p>
                </div>
              </div>

              <div class="edit-button">
                <button class="editar_vehiculo" onclick="formulario_editar_vehiculo(`'.$matricula.'`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="eliminar_vehiculo" onclick="eliminar_vehiculo(`'.$matricula.'`)"><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>

';
echo $vehiculo;
}else{
	$vehiculo = '
          
            <div class="vehiculo" id="'.$matricula.'">

              <div class="vehiculo-left">
                <div class="vehiculo-icon">
                  <i class="fas fa-car"></i>
                </div>
                <div class="vehiculo-info">
                  <h3 class="matricula">'.$matricula.'</h3>
                  <p><i class="fas fa-users"></i>'.$capacidad.'</p>
                </div>
              </div>
              
              <div class="edit-button">
                <button class="editar_vehiculo" onclick="formulario_editar_vehiculo(`'.$matricula.'`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="eliminar_vehiculo" onclick="eliminar_vehiculo(`'.$matricula.'`)"><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>

';
echo $vehiculo;
}



 ?>