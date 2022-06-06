<?php
include "wsdl_comunication.php";
$llamarFunction = new notifyMeActions();

switch ($_POST["tipe"]) {
    case 0:
        echo json_encode($llamarFunction->callClient($_POST["dialogo"],$_POST["datenHoure"],$_POST["id"],$_POST["tel"],$_POST["name"],$_POST["SMS"],$_POST['ID_OPORTUNIDAD'],0,null));
    break;
    case 1:
        echo json_encode($llamarFunction->watchCall($_POST["id"]));
    break;
    case 2:
        echo json_encode($llamarFunction->sendMsj($_POST["phone"],$_POST["schedule"],$_POST["text"],$_POST["id"]));
    break;
    case 3:
        echo json_encode($llamarFunction->watchMsjResponse($_POST["id"]));
    break;
    case 4:
        echo json_encode($llamarFunction->watchMsjStatus($_POST["id"]));
    break;
    case 5:
        echo json_encode($llamarFunction->callClient($_POST["dialogo"],$_POST["datenHoure"],$_POST["id"],$_POST["tel"],$_POST["name"],$_POST["SMS"],$_POST['ID_COT'],1,$_POST['id_viaje_cotizado']));
    break;
}

?>