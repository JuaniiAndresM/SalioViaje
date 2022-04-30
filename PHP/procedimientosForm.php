<?php
require 'procedimientosBD.php';
/**
 *
 */
class procedimientosForm extends procedimientosBD
{
    private $idUsuario = null;

    public function registrar_usuarios($tipo, $datos)
    {
        return $this->register_usuario($tipo, $datos);
    }

    public function register_transportista($empresa, $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $this->registrar_empresa("TTA", $empresa);
    }

    public function register_chofer($empresa, $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $this->registrar_empresa("CHO", $empresa);
    }

    public function register_anfitrion($empresa, $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $this->registrar_empresa("ANF", $empresa);
    }

    public function register_agente($empresa, $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $this->registrar_empresa("AGT", $empresa);
    }

    public function register_hotel($datos)
    {
        //$this->registrar_usuarios("HTL", $datos);
    }

    private function registrar_empresa($tipoUsuario, $empresa)
    {

        for ($x = 0; $x < count($empresa); $x++) {
            echo json_encode($empresa[$x]);
            echo $this->register_empresa($x, $tipoUsuario, $this->idUsuario, $empresa[$x]);
            for ($i = 0; $i < count($empresa[$x]["VEHICULOS"]); $i++) {
                if ($tipoUsuario == "CHO") {
                    //rut_ec = RUT de la empresa creada por el chofer.
                    //rut = RUT de la agencia contratista del chofer.
                    $rut_ec = $empresa[$x]["RUT"];
                    $rut = $empresa[$x]["CHOFERES_SUB"];
                } else {
                    $rut = $empresa[$x]["RUT"];
                    $rut_ec = "0";
                }
                $this->register_vehiculo($rut, $rut_ec, $empresa[$x]["VEHICULOS"][$i],0);
            }
        }
    }

    public function guardar_vehiculos($vehiculos, $rut,$id_emp,$rut_agencia_contratista)
    {
        echo json_encode($vehiculos);
        echo $rut;
        for ($x = 0; $x < count($vehiculos); $x++) {
            if ($rut_agencia_contratista != null) {
                $this->register_vehiculo($rut, $rut_agencia_contratista, $vehiculos[$x],$id_emp,$rut_agencia_contratista);
            } else {
                $this->register_vehiculo($rut, 0, $vehiculos[$x],$id_emp,$rut_agencia_contratista);
            }
        }
    }

    public function editar_vehiculos($id_vehiculo, $datos)
    {
        $this->editar_vehiculo($id_vehiculo, $datos);
    }

    public function traer_id_empresas($id)
    {
        return $this->traer_id_empresa_por_id_usuario($id);
    }
}

$procedimientosForm = new procedimientosForm();

if ($_POST['tipo'] == 1) {
    $datos = json_decode($_POST["datos"], true);
    echo $procedimientosForm->registrar_usuarios($_POST["tipoUsuario"], $datos);
    unset($_POST['tipo']);
} else {

    switch ($_POST['tipo']) {

        case '2':
            $empresa = json_decode($_POST["empresas"], true);
            $procedimientosForm->register_transportista($empresa, $_POST['idUsuario']);
            break;
        case '3':
            $empresa = json_decode($_POST["empresas"], true);
            echo json_encode($empresa);
            echo $procedimientosForm->register_chofer($empresa, $_POST['idUsuario']);
            break;
        case '4':
            $empresa = json_decode($_POST["empresas"], true);
            $procedimientosForm->register_anfitrion($empresa, $_POST['idUsuario']);
            break;
        case '5':
            $datos = json_decode($_POST["datos"], true);
            $procedimientosForm->register_hotel($datos);
            break;
        case '6':
            $datos = json_decode($_POST["datos"], true);
            $procedimientosForm->registrar_usuarios("ASE", $datos);
            break;
        case '7':
            $empresa = json_decode($_POST["empresas"], true);
            $procedimientosForm->register_agente($empresa, $_POST['idUsuario']);
            break;
        case 'empresas':
            echo $procedimientosForm->empresas();
            break;
        case 'vehiculos':
            echo json_encode($procedimientosForm->datos_vehiculos());
            break;
        case 'guardar-vehiculos':
            $datos = json_decode($_POST["vehiculos"], true);
            echo $procedimientosForm->guardar_vehiculos($datos, $_POST['rut'],$_POST['id_empresa'],$_POST['rut_empresa_contratista']);
            break;
        case 'editar-vehiculos':
            $datos = json_decode($_POST["datos"], true);
            echo $procedimientosForm->editar_vehiculos($_POST['id_vehiculo'], $datos);
            break;
        case 'id-empresas':
            session_start();
            echo json_encode($procedimientosForm->traer_id_empresas($_SESSION['datos_usuario']['ID']));
            break;
        case 'vehiculos-agenda':
            echo json_encode($procedimientosForm->datos_vehiculos_por_id($_POST['id_empresa']));
            break;
        case 'login':
            echo $procedimientosForm->login($_POST['usuario'], $_POST['pin']);
            break;
        case 'visita':
            echo $procedimientosForm->agrego_visita();
            break;
    }

}
