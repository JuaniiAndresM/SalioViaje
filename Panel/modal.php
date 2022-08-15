<?php 

require_once '../PHP/procedimientosBD.php';
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

        $preferencias = new procedimientosBD();

        $preferencias = json_decode($preferencias->obtener_preferencias_vehiculo($data[1]), true);

        if($preferencias != "null"){
            /**
             * SELECT NOCTURNO
             */
            if ($preferencias['NOCTURNO'] != 1) {
                $select_nocturno = '<option value="1" selected>Si</option>
                                    <option value="0">No</option>';
            }else{
                $select_nocturno = '<option value="1">Si</option>
                                    <option value="0" selected>No</option>';
            }
            /**
             * SELECT FIESTAS
             */
            if ($preferencias['FIESTAS'] != 1) {
                $select_fiestas = '<option value="1" selected>Si</option>
                <option value="0">No</option>';
            }else{
                $select_fiestas = '<option value="1">Si</option>
                <option value="0" selected>No</option>';
            }
            /**
             * SELECT DIA LIBRE
             */
            switch ($preferencias['DIA_LIBRE']) {
                case 'DOM':
                    $select_dia_libre = '<option value="0" >Ninguno</option>
                    <option value="DOM" selected>Domingo</option>
                    <option value="LUN">Lunes</option>
                    <option value="MAR">Martes</option>
                    <option value="MIE">Miércoles</option>
                    <option value="JUE">Jueves</option>
                    <option value="VIE">Viernes</option>
                    <option value="SAB">Sábado</option>';
                    break;
                case 'LUN':
                    $select_dia_libre = '<option value="0" >Ninguno</option>
                    <option value="DOM">Domingo</option>
                    <option value="LUN" selected>Lunes</option>
                    <option value="MAR">Martes</option>
                    <option value="MIE">Miércoles</option>
                    <option value="JUE">Jueves</option>
                    <option value="VIE">Viernes</option>
                    <option value="SAB">Sábado</option>';
                    break;                
                case 'MAR':
                    $select_dia_libre = '<option value="0" >Ninguno</option>
                    <option value="DOM">Domingo</option>
                    <option value="LUN">Lunes</option>
                    <option value="MAR" selected>Martes</option>
                    <option value="MIE">Miércoles</option>
                    <option value="JUE">Jueves</option>
                    <option value="VIE">Viernes</option>
                    <option value="SAB">Sábado</option>';
                    break;                
                case 'MIE':
                    $select_dia_libre = '<option value="0" >Ninguno</option>
                    <option value="DOM">Domingo</option>
                    <option value="LUN">Lunes</option>
                    <option value="MAR">Martes</option>
                    <option value="MIE" selected>Miércoles</option>
                    <option value="JUE">Jueves</option>
                    <option value="VIE">Viernes</option>
                    <option value="SAB">Sábado</option>';
                    break;                
                case 'JUE':
                    $select_dia_libre = '<option value="0" >Ninguno</option>
                    <option value="DOM">Domingo</option>
                    <option value="LUN">Lunes</option>
                    <option value="MAR">Martes</option>
                    <option value="MIE">Miércoles</option>
                    <option value="JUE" selected>Jueves</option>
                    <option value="VIE">Viernes</option>
                    <option value="SAB">Sábado</option>';
                    break;                
                case 'VIE':
                    $select_dia_libre = '<option value="0" >Ninguno</option>
                    <option value="DOM">Domingo</option>
                    <option value="LUN">Lunes</option>
                    <option value="MAR">Martes</option>
                    <option value="MIE">Miércoles</option>
                    <option value="JUE">Jueves</option>
                    <option value="VIE" selected>Viernes</option>
                    <option value="SAB">Sábado</option>';
                    break;
                default:
                $select_dia_libre = '<option value="0" selected>Ninguno</option>
                <option value="DOM">Domingo</option>
                <option value="LUN">Lunes</option>
                <option value="MAR">Martes</option>
                <option value="MIE">Miércoles</option>
                <option value="JUE">Jueves</option>
                <option value="VIE">Viernes</option>
                <option value="SAB">Sábado</option>';
                    break;
            }
            /**
             * SELECT PRECIO COCHE
             */
            if ($preferencias['PRECIO_COCHE'] == 1) {
                $select_precio_coche = '<option value="1" selected>Si</option>
                                    <option value="0">No</option>';
            }else{
                $select_precio_coche = '<option value="1">Si</option>
                                    <option value="0" selected>No</option>';
            }

        }else{
            $select_nocturno = '<option value="1" selected>Si</option>
                                <option value="0">No</option>';

            $select_dia_libre = '<option value="0" selected>Ninguno</option>
                                <option value="DOM">Domingo</option>
                                <option value="LUN">Lunes</option>
                                <option value="MAR">Martes</option>
                                <option value="MIE">Miércoles</option>
                                <option value="JUE">Jueves</option>
                                <option value="VIE">Viernes</option>
                                <option value="SAB">Sábado</option>';

            $select_fiestas = '<option value="1" selected>Si</option>
                                <option value="0">No</option>';

            $select_precio_coche = '<option value="1">Si</option>
                                <option value="0" selected>No</option>';
        }

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
                        '.$select_nocturno.'
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-champagne-glasses"></i> Fiestas</h5>
                    <p class="input-desc">¿Hace fiestas?</p>
                    <select id="preferenciaFiestas">
                        '.$select_fiestas.'
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-calendar-day"></i> Día Libre</h5>
                    <p class="input-desc">¿Qué día descansa?</p>
                    <select id="preferenciaDiaLibre">
                        '.$select_dia_libre.'
                    </select>
                </div>

                <div class="input">
                    <h5 class="input-title"><i class="fa-solid fa-hand-holding-dollar"></i> Precio de Coche</h5>
                    <p class="input-desc">¿Quiere cotizar para viajes de hasta 4 pasajeros?</p>
                    <select id="preferenciaPrecioCoche">
                        '.$select_precio_coche.'
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
                <p class="msg2">'.$data[0].'</p>
                <div class="button-wrapper">
                    <a class="modal-button-phone" href="tel:+598'.$data[1].'">
                        <i class="fa-solid fa-phone"></i>
                    </a>
                    <a class="modal-button-phone" href="https://wa.me/+598'.$data[1].'" target="_blank">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>';
        break;
    case 5:
        $modal_body = '
        <div class="modal-container">
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-xmark"></i></button>
            <div class="modal-img-logo">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="modal-body">
                <p class="msg1">¿Para cuando deseas copiar el viaje?</p>
                <div class="input">
                    <input type="date" id="fecha_copia"/>
                </div>
                <div class="input">
                    <input type="time" id="hora_copia"/>
                </div>
                <div class="input pasajeros">
                    <p class="input-desc">Cantidad de Pasajeros:</p>
                    <input type="number" id="cant_pasaj"/>
                </div>
                <div class="button-wrapper">
                    <button class="modal-button" onclick="copiar_solicitud('.$data.',2)">
                        <i class="fa-solid fa-check"></i> Copiar Viaje
                    </button>
                    <button class="modal-button" onclick="closeModal()">
                        <i class="fa-solid fa-xmark"></i> Cancelar
                    </button>
                </div>
            </div>
        </div>';
        break;
    case 6:
        $modal_body = '
        <div class="modal-container">
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-xmark"></i></button>
            <div class="modal-img-logo">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="modal-body">
                <p class="msg1">¿Seguro que quiere comprar la siguiente oportunidad?</p>
                <p class="msg2">#'.$data.'</p>
                <div class="button-wrapper">
                    <button class="modal-button" onclick="comprar_oportunidad('.$data.',2)">
                    <i class="fa-solid fa-check"></i> Si
                    </button>
                    <button class="modal-button" onclick="closeModal()">
                        <i class="fa-solid fa-xmark"></i> No
                    </button>
                </div>
            </div>
        </div>';
        break;
    case 7:
        $modal_body = '
        <div class="modal-container">
            <button class="close-modal" onclick="closeModal()"><i class="fas fa-xmark"></i></button>
            <div class="modal-img-logo">
                <img src="https://www.salioviaje.com.uy/media/svg/Logo-SalioViaje.svg" alt="Logo SalióViaje">
            </div>
            <div class="modal-body">
                <p class="msg1">¿Seguro que quiere aceptar la siguiente cotizacion?</p>
                <p class="msg2">#'.$data['id'].'</p>
                <div class="button-wrapper">
                    <button class="modal-button" onclick="aceptarCotizacion('.$data['id'].','.$data['id_viaje_cotizado'].',2)">
                    <i class="fa-solid fa-check"></i> Si
                    </button>
                    <button class="modal-button" onclick="closeModal()">
                        <i class="fa-solid fa-xmark"></i> No
                    </button>
                </div>
            </div>
        </div>';
        break;
}



echo $modal_body;
return $modal_body;
?>