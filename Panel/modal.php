<?php 

$opcion = $_POST['opcion'];
$data = $_POST['data'];

switch($opcion){
    case "1":
        $mensaje_1 = "¿Seguro que quiere eliminar este viaje?";
        $mensaje_2 = $data;
        break;
}

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

echo $modal_body;
return $modal_body;
?>