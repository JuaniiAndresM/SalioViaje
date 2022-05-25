<?php 

$NRO_RUTA = $_POST['NRO_RUTA'];
$NOMBRE_RUTA = $_POST['NOMBRE_RUTA'];
$BORRAR_RUTA = "'".$_POST['NOMBRE_RUTA']."-".$NRO_RUTA."'";


$NUEVA_EMPRESA_DASHBOARD = '

    <div class="tag" id="R'.$NRO_RUTA.'">
        <p>'.$NOMBRE_RUTA.'</p>
        <button class="button" onclick="borrar_ruta('.$BORRAR_RUTA.')">
            <i class="fas fa-times"></i>
        </button>
    </div>

';

echo $NUEVA_EMPRESA_DASHBOARD;
?> 