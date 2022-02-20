<?php 

$NRO_PARADA = $_POST['NRO_PARADA'];
$NOMBRE_PARADA = $_POST['NOMBRE_PARADA'];
$TIPO = $_POST['TIPO'];


$NUEVA_PARADA = '

    <div class="tag" id="R'.$NRO_PARADA.'">
        <p>'.$NOMBRE_PARADA.'</p>
        <button class="button" onclick="borrar_parada('.$NRO_PARADA.','.$TIPO.')">
            <i class="fas fa-times"></i>
        </button>
    </div>

';

echo $NUEVA_PARADA;
?> 