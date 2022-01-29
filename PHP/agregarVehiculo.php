<?php 

$datos = json_decode($_POST['datos']);
$matricula = $datos->{'MATRICULA'};
$capacidad = $datos->{'CAPACIDAD_PASAJEROS'};

if ($capacidad == "3" || $capacidad < "3") {
	$vehiculo = '
          
            <div class="vehiculo">
              <div class="vehiculo-icon">
                <i class="fas fa-car"></i>
              </div>
              <div class="vehiculo-info">
                <h3 class="matricula">'.$matricula.'</h3>
                <p><i class="fas fa-users"></i>'.$capacidad.'</p>
              </div>
              <div class="edit-button">
                <button><i class="fas fa-pencil-alt"></i></button>
                <button><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>

';
echo $vehiculo;
}elseif ($capacidad == "12" || $capacidad < "12" && $capacidad > "3") {
	$vehiculo = '
          
            <div class="vehiculo">
              <div class="vehiculo-icon">
                <i class="fas fa-shuttle-van"></i>
              </div>
              <div class="vehiculo-info">
                <h3 class="matricula">'.$matricula.'</h3>
                <p><i class="fas fa-users"></i>'.$capacidad.'</p>
              </div>
              <div class="edit-button">
                <button><i class="fas fa-pencil-alt"></i></button>
                <button><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>

';
echo $vehiculo;
}else{
	$vehiculo = '
          
            <div class="vehiculo">
              <div class="vehiculo-icon">
                <i class="fas fa-bus"></i>
              </div>
              <div class="vehiculo-info">
                <h3 class="matricula">'.$matricula.'</h3>
                <p><i class="fas fa-users"></i>'.$capacidad.'</p>
              </div>
              <div class="edit-button">
                <button><i class="fas fa-pencil-alt"></i></button>
                <button><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>

';
echo $vehiculo;
}



 ?>