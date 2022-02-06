<?php 

$NRO_RUTA = $_POST['NRO_RUTA'];
$NOMBRE_RUTA = $_POST['NOMBRE_RUTA'];


$NUEVA_EMPRESA_DASHBOARD = '

    <div class="tag">
        <p>'.$NRO_RUTA.' - '.$NOMBRE_RUTA.'</p>
        <div class="button">
            <button onlick="borrar_ruta('.$NRO_RUTA.')">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

';

echo $NUEVA_EMPRESA_DASHBOARD;
?>