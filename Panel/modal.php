<?php 

$opcion = $_POST['opcion'];
$data = $_POST['data'];

switch($opcion){
    case "1":
        $mensaje_1 = "¿Seguro que quiere eliminar este viaje?";
        $mensaje_2 = $data;
        $modal_body = '
        <div class="modal-container">
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-xmark"></i></button>
            <div class="modal-img-logo">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="modal-body">
                <p class="msg1">'.$mensaje_1.'</p>
                <p class="msg2">'.$mensaje_2.'</p>
                <div class="button-wrapper">
                    <button class="modal-button" onclick="eliminar_viajes('.$data.',2)">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                    <button class="modal-button" onclick="closeModal()">
                        <i class="fas fa-ban"></i> Cancelar
                    </button>
                </div>
            </div>
        </div>';
        break;

    case "2":
        $modal_body = '
        <div class="modal-container">
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-xmark"></i></button>
            <div class="modal-body">
                <h3 class="title"><i class="fa-solid fa-sliders"></i> Preferencias</h3>
                <p class="msg1">Vehiculo: '.$data[1].'</p>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-cloud-moon"></i> Nocturno</h5>
                    <p class="input-desc">¿Trabaja de 22:00hs a 06:00hs?</p>
                    <select id="preferenciaNocturno">
                        <option value="0" selected>Si</option>
                        <option value="1">No</option>
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-champagne-glasses"></i> Fiestas</h5>
                    <p class="input-desc">¿Hace fiestas?</p>
                    <select id="preferenciaFiestas">
                        <option value="0" selected>Si</option>
                        <option value="1">No</option>
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-calendar-day"></i> Día Libre</h5>
                    <p class="input-desc">¿Qué día descansa?</p>
                    <select id="preferenciaDiaLibre">
                        <option value="0" selected>Ninguno</option>
                        <option value="1">Domingo</option>
                        <option value="2">Lunes</option>
                        <option value="3">Martes</option>
                        <option value="4">Miércoles</option>
                        <option value="5">Jueves</option>
                        <option value="6">Viernes</option>
                        <option value="7">Sábado</option>
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-hand-holding-dollar"></i> Precio de Coche</h5>
                    <p class="input-desc">¿Quiere cotizar para viajes de hasta 4 pasajeros?</p>
                    <select id="preferenciaPrecioCoche">
                        <option value="0" selected>Si</option>
                        <option value="1">No</option>
                    </select>
                </div>

                <div class="button-wrapper">
                    <button class="modal-button" onclick="preferenciasVehiculos('.$data[0].',2)">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                    <button class="modal-button" onclick="closeModal()">
                        <i class="fas fa-ban"></i> Cancelar
                    </button>
                </div>
            </div>
        </div>';
}



echo $modal_body;
return $modal_body;
?>