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
                <h3>G<span>1</span></h3>
                <p text="g'.$opcion.'-text">'.$faq[6]['RESPUESTA'].'</p>
            </div>
            <div class="button-wrapper">
                <button onclick="closeGurucuteco()"><i class="fa-solid fa-xmark"></i> Cerrar</button> 
            </div>
        </div>';
        break;
}



echo $gurucuteco_body;
return $gurucuteco_body;
?>