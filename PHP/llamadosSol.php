<?php
include "procedimientosBD.php";
$llamarFunction = new procedimientosBD();

switch ($_POST["tipe"]) {
    case 0:
        echo json_encode($llamarFunction->editar_usuario($_POST["ID"],$_POST["CI"],$_POST["NOMBRE"],$_POST["APELLIDO"],$_POST["CORREO"],$_POST["DEPARTAMENTO"],$_POST['BARRIO'],$_POST["DIRECCION"],$_POST["TEL"]));
    break;
    case 1:
        echo json_encode($llamarFunction->cambiar_password($_POST["ID"],$_POST["PINNUEVO"]));
    break;
    case 2:
        echo $llamarFunction->confirmar_password($_POST["ID"],$_POST["PIN"]);
    break;
    case 3:
        echo $llamarFunction->eliminar_empresa($_POST["RUT"]);
    break;
    case 4:
        echo $llamarFunction->eliminar_usuario($_POST["ID"]);
    break;
    case 5:
        echo $llamarFunction->editar_empresa($_POST['RUTANTERIOR'],$_POST["RUT"],$_POST["NOMBRE"],$_POST["RS"],$_POST["CA"],$_POST["NM"],$_POST['CM']);
    break;
}

?>