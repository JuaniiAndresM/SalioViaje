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

    public function register_hotel($datos, $idUsuario)
    {
        $this->idUsuario = $idUsuario;
        $this->registrar_empresa("HTL", $datos);
    }

    private function registrar_empresa($tipoUsuario, $empresa)
    {
        echo json_encode($empresa);
        $x = 0;
        if ($tipoUsuario != "HTL") {
            for ($x = 0; $x < count($empresa); $x++) {
                echo json_encode("EMPRESA: " . $empresa[$x]);
                echo $this->register_empresa($x, $tipoUsuario, $this->idUsuario, $empresa[$x]);

                for ($i = 0; $i < count($empresa[$x]["VEHICULOS"]); $i++) {
                    if ($tipoUsuario == "CHO") {
                        //rut_ec = RUT de la empresa creada por el chofer.
                        //rut = RUT de la agencia contratista del chofer.
                        $rut_ec = $empresa[$x]["CHOFERES_SUB"];
                        $rut = $empresa[$x]["RUT"];
                    } else {
                        $rut = $empresa[$x]["RUT"];
                        $rut_ec = "0";
                    }
                    $this->register_vehiculo($rut, $rut_ec, $empresa[$x]["VEHICULOS"][$i], 0);
                }

            }
        } else {
            $empresa["NUMERO_MTOP"] = 0;
            $empresa["PASSWORD_MTOP"] = 0;
            echo $this->register_empresa($x, $tipoUsuario, $this->idUsuario, $empresa);
        }
    }

    public function guardar_vehiculos($vehiculos, $rut, $id_emp, $rut_agencia_contratista)
    {
        echo json_encode($vehiculos);
        echo $rut;
        for ($x = 0; $x < count($vehiculos); $x++) {
            if ($rut_agencia_contratista != null) {
                $this->register_vehiculo($rut, $rut_agencia_contratista, $vehiculos[$x], $id_emp, $rut_agencia_contratista);
            } else {
                $this->register_vehiculo($rut, 0, $vehiculos[$x], $id_emp, $rut_agencia_contratista);
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
            $procedimientosForm->register_hotel($datos, $_POST['idUsuario']);
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
            echo $procedimientosForm->guardar_vehiculos($datos, $_POST['rut'], $_POST['id_empresa'], $_POST['rut_empresa_contratista']);
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
        case 'agregar_cotizacion':
            session_start();
            $id_solicitante = $_SESSION['datos_usuario']['ID'];
            $id_cotizacion = $procedimientosForm->agregar_cotizacion($_POST['datos'], $_POST['tipo_cotizacion'],$id_solicitante)['ID'];
            $paradas_ida = json_decode($_POST['PARADAS_IDA'], true);
            $paradas_vuelta = json_decode($_POST['PARADAS_VUELTA'], true);
            if ($_POST['PARADAS_VUELTA'] != "0" && $_POST['PARADAS_IDA'] == "0") {
                for ($i = 0; $i < count($paradas_vuelta); $i++) {
                    $procedimientosForm->agregar_paradas($paradas_vuelta[$i], "vuelta", $id_cotizacion);
                }
            } elseif ($_POST['PARADAS_VUELTA'] == "0" && $_POST['PARADAS_IDA'] != "0") {
                for ($i = 0; $i < count($paradas_ida); $i++) {
                    $procedimientosForm->agregar_paradas($paradas_ida[$i], "ida", $id_cotizacion);
                }
            } else {
                for ($i = 0; $i < count($paradas_ida); $i++) {
                    $procedimientosForm->agregar_paradas($paradas_ida[$i], "ida", $id_cotizacion);
                    $procedimientosForm->agregar_paradas($paradas_vuelta[$i], "vuelta", $id_cotizacion);
                }
            }
            echo $id_cotizacion;
            break;

        case 'cambio_estado_cotizacion':
            $procedimientosForm->cambiar_estado_cotizacion($_POST['idCotizacion'], $_POST['estado']);
            break;
    }

}
