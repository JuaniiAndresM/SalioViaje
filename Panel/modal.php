<?php 

$opcion = $_POST['opcion'];
$data = $_POST['data'];
$matricula = "'".$data[1]."'";

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
                        <option value="1" selected>Si</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-champagne-glasses"></i> Fiestas</h5>
                    <p class="input-desc">¿Hace fiestas?</p>
                    <select id="preferenciaFiestas">
                        <option value="1" selected>Si</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-calendar-day"></i> Día Libre</h5>
                    <p class="input-desc">¿Qué día descansa?</p>
                    <select id="preferenciaDiaLibre">
                        <option value="0" selected>Ninguno</option>
                        <option value="DOM">Domingo</option>
                        <option value="LUN">Lunes</option>
                        <option value="MAR">Martes</option>
                        <option value="MIE">Miércoles</option>
                        <option value="JUE">Jueves</option>
                        <option value="VIE">Viernes</option>
                        <option value="SAB">Sábado</option>
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-hand-holding-dollar"></i> Precio de Coche</h5>
                    <p class="input-desc">¿Quiere cotizar para viajes de hasta 4 pasajeros?</p>
                    <select id="preferenciaPrecioCoche">
                        <option value="1" selected>Si</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="button-wrapper">
                    <button class="modal-button" onclick="preferenciasVehiculos('.$data[0].',2,'.$matricula.')">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                    <button class="modal-button" onclick="closeModal()">
                        <i class="fas fa-ban"></i> Cancelar
                    </button>
                </div>
            </div>
        </div>';
        break;
    case 3:
        $mensaje_1 = "¿Son estos los datos de su domicilio?";
        $mensaje_2 = $data[0].', '.$data[1].', '.$data[2];
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
                    <button class="modal-button" onclick="finalizar(1,2,1)">
                    <i class="fa-solid fa-check"></i> Si
                    </button>
                    <button class="modal-button" onclick="finalizar(1,2,0)">
                        <i class="fa-solid fa-xmark"></i> No
                    </button>
                </div>
            </div>
        </div>';
        break;
    case 4:
        $modal_body = '
        <div class="modal-container">
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-xmark"></i></button>
            <div class="modal-img-logo">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="modal-body">
                <p class="msg1">Nombre del Transportista:</p>
                <p class="msg2">John Doe</p>
                <div class="button-wrapper">
                    <a class="modal-button-phone" href="tel:+59898234717">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                    <a class="modal-button-phone" href="https://wa.me/+59898234717" target="_blank">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>';
        break;
}



echo $modal_body;
return $modal_body;
?>