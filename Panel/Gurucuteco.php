<?php
require_once '../PHP/procedimientosBD.php';
$BD = new procedimientosBD();

$faq = json_decode($BD->traer_preguntas(), true);
$opcion = $_POST['opcion'];

switch($opcion){
    case "1":
        $gurucuteco_body = '
        <div class="gurucuteco-container">
            <div class="gurucuteco-body">
                <h3>G<span>'.$opcion.'</span></h3>
                <p text="g'.$opcion.'-text">'.$faq[6]['RESPUESTA'].'</p>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="check-g-'.$opcion.'">No volver a mostrar.
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco('.$opcion.')"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
    case "2":
        $gurucuteco_body = '
        <div class="gurucuteco-container">
            <div class="gurucuteco-body">
                <h3>G<span>'.$opcion.'</span></h3>
                <p text="g'.$opcion.'-text">'.$faq[7]['RESPUESTA'].'</p>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="check-g-'.$opcion.'">No volver a mostrar.
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco('.$opcion.')"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
    case "3":
        $gurucuteco_body = '
        <div class="gurucuteco-container">
            <div class="gurucuteco-body">
                <h3>G<span>'.$opcion.'</span></h3>
                <p text="g'.$opcion.'-text"><b>Oferta de Transporte</b>: Solo incluye el viaje.</p>
                <br>
                <p text="g'.$opcion.'-text"><b>Oferta de Paquete</b>: Oferta que incluye un agregado de valor.</p>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="check-g-'.$opcion.'">No volver a mostrar.
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco('.$opcion.')"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
    case "4":
        $gurucuteco_body = '
        <div class="gurucuteco-container">
            <div class="gurucuteco-body">
                <h3>G<span>'.$opcion.'</span></h3>
                <p text="g'.$opcion.'-text">Elija <b>Fiesta o Evento</b>, complete los datos y viaje feliz.</p>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="check-g-'.$opcion.'">No volver a mostrar.
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco('.$opcion.')"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
    case "5":
        $gurucuteco_body = '
        <div class="gurucuteco-container">
            <div class="gurucuteco-body">
                <h3>G<span>'.$opcion.'</span></h3>
                <p text="g'.$opcion.'-text">Elija si <b>parte o arriva</b>, complete los datos y viaje feliz.</p>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="check-g-'.$opcion.'">No volver a mostrar.
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco('.$opcion.')"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
    case "6":
        $gurucuteco_body = '
        <div class="gurucuteco-container">
            <div class="gurucuteco-body">
                <h3>G<span>'.$opcion.'</span></h3>
                <p text="g'.$opcion.'-text"><b>Tour:</b> Complete los datos y viaje feliz.</p>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="check-g-'.$opcion.'">No volver a mostrar.
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco('.$opcion.')"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
    case "7":
        $gurucuteco_body = '
        <div class="gurucuteco-container">
            <div class="gurucuteco-body">
                <h3>G<span>'.$opcion.'</span></h3>
                <p text="g'.$opcion.'-text"><b>Traslado:</b> Complete los datos y viaje feliz.</p>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="check-g-'.$opcion.'">No volver a mostrar.
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco('.$opcion.')"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
}



echo $gurucuteco_body;
return $gurucuteco_body;
?>