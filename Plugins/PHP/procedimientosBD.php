<?php
/**
 *
 */
class procedimientosBD
{

    private function conexion()
    {
        //$conexion = mysqli_connect("localhost", "root", "root", "salioviaje");
        $conexion = mysqli_connect("158.106.136.183", "salioviajeuy", "SV_debe_salir_ya_2022", "salioviajeuy_salioviajeuy");
        // $conexion = mysqli_connect("localhost", "root", "root", "salioviajeuy_salioviajeuy");

        $conexion->set_charset("utf8");
        if (!$conexion) {
            echo "Error al conectar con la Base de datos.";
            exit();
        } else {
            return $conexion;
        }
    }

    public function register_usuario($tipo, $datos)
    {
        $PIN = password_hash($datos['PIN'], PASSWORD_BCRYPT);
        $conn = $this->conexion();
        $query = "CALL register_usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sissssssissssss", $tipo, $datos["CI"], $datos["CORREO"], $datos["NOMBRE"], $datos["APELLIDO"], $datos["DIRECCION"], $datos["BARRIO"], $datos["DEPARTAMENTO"], $datos["TELEFONO"], $PIN, $datos['CHOFERES_SUB'], $datos['RUT'], $datos['SUPERVISOR'], $datos['NOMBRE_HOTEL'], $datos['DIRECCION_HOTEL']);
        if ($stmt->execute()) {
            $this->login($datos['CI'], $datos['PIN']);
            $stmt->store_result();
            $stmt->bind_result($idUsuario);
            while ($stmt->fetch()) {
                return $idUsuario;
            }
        }
        $stmt->close();
    }

    public function register_empresa($contador, $tipo_usuario, $id_usuario, $datos)
    {
        if ($tipo_usuario == "CHO" || !isset($datos['CHOFERES_SUB'])) {$datos['CHOFERES_SUB'] = 0;}
        $conn = $this->conexion();
        $query = "call register_empresa(?,?,?,?,?,?,?,?,?,?);";
        $stmt = $conn->prepare($query);
        echo "\n" . $datos["RUT"] . " " . $datos["NOMBRE_COMERCIAL"] . " " . $datos["RAZON_SOCIAL"] . " " . $datos["NUMERO_MTOP"] . " " . $datos["PASSWORD_MTOP"] . " " . $tipo_usuario . " " . $id_usuario . " " . $datos['CHOFERES_SUB']. " " . $datos['DIRECCION_HOTEL'] . " " .$contador. "\n";
        $stmt->bind_param("isssissiis", $contador, $datos["RUT"], $datos["NOMBRE_COMERCIAL"], $datos["RAZON_SOCIAL"], $datos["NUMERO_MTOP"], $datos["PASSWORD_MTOP"], $tipo_usuario, $id_usuario, $datos['CHOFERES_SUB'], $datos['DIRECCION_HOTEL']);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function register_vehiculo($rut, $rut_ec, $datos, $id_emp)
    {
        /**
         * pasar id de empresa, por ahora lo registra con el id de otra empresa. esto ocurre desde editar empresa.
         */
        $conn = $this->conexion();
        $query = "CALL register_vehiculo(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssiiissi", $datos["MATRICULA"], $datos["MARCA"], $datos["MODELO"], $datos["COMBUSTIBLE"], $datos["CAPACIDAD_PASAJEROS"], $datos["CAPACIDAD_EQUIPAJE"], $datos["PET_FRIENDLY"], $rut, $rut_ec, $id_emp);
        $stmt->execute();
        $stmt->close();
    }

    public function editar_vehiculo($id_vehiculo, $datos)
    {
        $conn = $this->conexion();
        $query = "call salioviajeuy_salioviajeuy.editar_vehiculo(?,?,?,?,?,?,?,?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issssiii", $id_vehiculo, $datos["MATRICULA"], $datos["MARCA"], $datos["MODELO"], $datos["COMBUSTIBLE"], $datos["CAPACIDAD_PASAJEROS"], $datos["CAPACIDAD_EQUIPAJE"], $datos["PET_FRIENDLY"]);
        $stmt->execute();
        $stmt->close();
    }

    public function empresas()
    {
        $empresas = array();
        $conn = $this->conexion();
        $query = "CALL traigo_empresas()";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($nombre_empresa, $razon_social, $rut, $acepta_cho,$tipo_usuario);
            while ($stmt->fetch()) {
                $result = array('NOMBRE_COMERCIAL' => $nombre_empresa, 'RAZON_SOCIAL' => $razon_social, 'RUT' => $rut, 'CHOFERES_SUB' => $acepta_cho, 'TIPO_USUARIO' => $tipo_usuario);
                $empresas[] = $result;
            }
        }
        $stmt->close();
        return json_encode($empresas);
    }

    public function login($usuario, $pin)
    {
        $conn = $this->conexion();
        $query = "CALL login(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usuario);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $pin_bd, $passwd, $nombre, $apellido, $tipo_usuario, $ci, $telefono, $barrio, $departamento, $mail);
            while ($stmt->fetch()) {
                if (password_verify($pin, $pin_bd) || password_verify($pin, $passwd)) {
                    $datos_usuarios = array('TIPO_USUARIO' => $tipo_usuario, 'ID' => $id, 'CI' => $ci, 'TELEFONO' => $telefono, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'MAIL' => $mail);
                    $usuario = $nombre . " " . $apellido;
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['datos_usuario'] = $datos_usuarios;
                    switch ($tipo_usuario) {
                        case 'PAX':
                            $_SESSION['tipo_usuario'] = 'Pasajero';
                            break;
                        case 'TTA':
                            $_SESSION['tipo_usuario'] = 'Transportista';
                            break;
                        case 'CHO':
                            $_SESSION['tipo_usuario'] = 'Chofer';
                            break;
                        case 'ANF':
                            $_SESSION['tipo_usuario'] = 'Anfitrión';
                            break;
                        case 'HTL':
                            $_SESSION['tipo_usuario'] = 'Hotel';
                            break;
                        case 'ADM':
                            $_SESSION['tipo_usuario'] = 'Administrador';
                            break;
                        case 'ASE':
                            $_SESSION['tipo_usuario'] = 'Asesor';
                            break;
                        case 'AGT':
                            $_SESSION['tipo_usuario'] = 'Agente';
                            break;
                    }
                    return $_SESSION['usuario'];
                }
            }
        }
        $stmt->close();
    }

    public function datos_usuarios()
    {
        $usuarios = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Tipo_Usuario,CI,Email,Nombre,Apellido,Direccion,Barrio,Departamento,Telefono,Agencia_C,RUT,Supervisor,Nombre_Hotel,Direccion_Hotel FROM salioviajeuy_salioviajeuy.usuarios";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario, $tipo_usuario, $ci, $mail, $nombre, $apellido, $direccion, $barrio, $departamento, $telefono, $agencia_contratista, $rut, $supervisor, $nombre_hotel, $direccion_hotel);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CI' => $ci, 'EMAIL' => $mail, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'TELEFONO' => $telefono, 'AGENCIA_CONTRATISTA' => $agencia_contratista, 'NOMBRE_HOTEL' => $nombre_hotel, 'DIRECCION_HOTEL' => $direccion_hotel, 'SUPERVISOR' => $supervisor, 'RUT' => $rut);
                $usuarios[] = $result;
            }
        }
        $stmt->close();
        return $usuarios;
    }

    public function datos_empresas()
    {
        $empresas = array();
        $conn = $this->conexion();
        $query = "SELECT ID,RUT,Nombre_C,Razon_S,Usuario_ID,Tipo_Usuario FROM salioviajeuy_salioviajeuy.empresas";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $rut, $nombre_empresa, $razon_social, $id_owner, $tipo_usuario);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'RUT' => $rut, 'NOMBRE_EMPRESA' => $nombre_empresa, 'RAZON_SOCIAL' => $razon_social, 'ID_OWNER' => $id_owner, 'TIPO_USUARIO' => $tipo_usuario);
                $empresas[] = $result;
            }
        }
        $stmt->close();
        return $empresas;
    }

    public function traigo_ci()
    {
        $ci = array();
        $conn = $this->conexion();
        $query = "SELECT CI FROM salioviajeuy_salioviajeuy.usuarios";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($ci_bd);
            while ($stmt->fetch()) {
                array_push($ci, $ci_bd);
            }
        }
        $stmt->close();
        return $ci;
    }

    public function traigo_mail()
    {
        $mail = array();
        $conn = $this->conexion();
        $query = "SELECT Email FROM salioviajeuy_salioviajeuy.usuarios";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($mail_bd);
            while ($stmt->fetch()) {
                array_push($mail, $mail_bd);
            }
        }
        $stmt->close();
        return $mail;
    }

    public function datos_vehiculos()
    {
        $conn = $this->conexion();
        $query = "SELECT * FROM salioviajeuy_salioviajeuy.vehiculos";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $matricula, $marca, $modelo, $combustible, $capacidad, $equipaje, $pet_friendly, $rut_em, $rut_ec, $id_empresa);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'MATRICULA' => $matricula, 'MARCA' => $marca, 'MODELO' => $modelo, 'COMBUSTIBLE' => $combustible, 'CAPACIDAD' => $capacidad, 'EQUIPAJE' => $equipaje, 'PET_FRIENDLY' => $pet_friendly, 'RUT_EM' => $rut_em, 'RUT_EC' => $rut_ec, 'ID_EMPRESA' => $id_empresa);
                $vehiculos[] = $result;
            }
        }
        $stmt->close();
        return $vehiculos;
    }

    public function traer_id_empresa_por_id_usuario($id)
    {
        $id_empresas = array();
        $conn = $this->conexion();
        $query = "SELECT id FROM empresas WHERE Usuario_ID = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id);
            while ($stmt->fetch()) {
                $result = array('ID' => $id);
                $id_empresas[] = $result;
            }
        }
        $stmt->close();
        return $id_empresas;
    }

    public function datos_vehiculos_por_id($id)
    {

        $vehiculo = array();
        $conn = $this->conexion();
        $query = "SELECT * FROM salioviajeuy_salioviajeuy.vehiculos WHERE ID_EMPRESA = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $matricula, $marca, $modelo, $combustible, $capacidad, $equipaje, $pet_friendly, $rut_em, $rut_e, $id_empresa);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'MATRICULA' => $matricula, 'MARCA' => $marca, 'MODELO' => $modelo, 'COMBUSTIBLE' => $combustible, 'CAPACIDAD' => $capacidad, 'EQUIPAJE' => $equipaje, 'RUT_E' => $rut_e, 'PET_FRIENDLY' => $pet_friendly, 'RUT_EM' => $rut_em, 'ID_EMPRESA' => $id_empresa);
                $vehiculo[] = $result;
            }
        }
        $stmt->close();
        return $vehiculo;

    }

    public function agrego_visita()
    {
        $vehiculos = array();
        $conn = $this->conexion();
        $query = "call agrego_visita()";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $stmt->close();
    }

    public function traigo_visitas()
    {
        $vehiculos = array();
        $conn = $this->conexion();
        $query = "SELECT * FROM salioviajeuy_salioviajeuy.visitas";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($visitas);
            while ($stmt->fetch()) {
                $result = $visitas;
            }
        }
        $stmt->close();
        return $visitas;
    }

    public function traer_preguntas()
    {
        $preguntas = array();
        $conn = $this->conexion();
        $query = "SELECT * FROM salioviajeuy_salioviajeuy.faqs";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $pregunta, $respuesta);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'PREGUNTA' => $pregunta, 'RESPUESTA' => $respuesta);
                $preguntas[] = $result;
            }
        }
        $stmt->close();
        return json_encode($preguntas);
    }

    public function agregar_pregunta($datos)
    {
        $conn = $this->conexion();
        $query = "call agregar_faq(?,?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $datos['PREGUNTA'], $datos["RESPUESTA"]);
        $stmt->execute();
        $stmt->close();
    }

    public function traer_pregunta_por_id($id)
    {
        $conn = $this->conexion();
        $query = "SELECT * FROM salioviajeuy_salioviajeuy.faqs WHERE idPregunta = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $pregunta, $respuesta);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'PREGUNTA' => $pregunta, 'RESPUESTA' => $respuesta);
            }
        }
        $stmt->close();
        return json_encode($result);
    }
//UPDATE `salioviajeuy_salioviajeuy`.`faqs` SET `Respuesta` = 'respuesta' WHERE (`idPregunta` = '38');

    public function editar_pregunta_FAQ($ID_PREGUNTA, $PREGUNTA, $RESPUESTA)
    {
        $conn = $this->conexion();
        $query = "call editar_pregunta_FAQ(?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $PREGUNTA, $RESPUESTA, $ID_PREGUNTA);
        $stmt->execute();
        $stmt->close();
    }

    public function borrar_pregunta_FAQ($ID)
    {
        $conn = $this->conexion();
        $query = "DELETE FROM `salioviajeuy_salioviajeuy`.`faqs` WHERE (`idPregunta` = $ID)";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $stmt->close();
    }

    public function agendar_viaje($datos)
    {
        session_start();
        $id = $_SESSION['datos_usuario']['ID'];
        $datos = json_decode($datos, true);
        $conn = $this->conexion();
        $query = "call agendar_viaje(?,?,?,?,?,?,?,?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siisssii", $datos['MATRICULA'], $datos["DISTANCIA"], $datos["CANTIDAD_DE_PASAJEROS"], $datos["FECHA"], $datos["ORIGEN"], $datos["DESTINO"], $datos["PRECIO_REFERENCIA"], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function agregar_oportunidad($datos)
    {
        session_start();
        $id = $_SESSION['datos_usuario']['ID'];
        $datos = json_decode($datos, true);
        $conn = $this->conexion();
        $query = "call agregar_oportunidad(?,?,?,?,?,?,?,?,?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isiisssii", $datos['DESCUENTO_OPORTUNIDAD'], $datos['MATRICULA'], $datos["DISTANCIA"], $datos["CANTIDAD_DE_PASAJEROS"], $datos["FECHA"], $datos["ORIGEN"], $datos["DESTINO"], $datos["PRECIO_REFERENCIA"], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function traer_oportunidades()
    {
        // ORIGEN DESTINO FECHA HORA PASAJEROS MARCA Y MODELO DEL VEHICULO nombre de transportista
        $oportunidades = array();
        $conn = $this->conexion();
        $query = "SELECT idOportunidad,Descuento,Origen,Destino,Fecha,Nombre,Apellido,Marca,Modelo,Capacidad,Estado,Matricula,Distancia,Precio FROM oportunidades,usuarios,vehiculos where idTransportista = usuarios.ID and Vehiculo = Matricula;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $descuento, $origen, $destino, $fecha, $nombre, $apellido, $marca, $modelo, $capacidad_vehiculo, $estado, $matricula, $distancia, $precio);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'DESCUENTO' => $descuento, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'MARCA' => $marca, 'MODELO' => $modelo, 'CAPACIDAD_VEHICULO' => $capacidad_vehiculo, 'ESTADO' => $estado, 'MATRICULA' => $matricula, 'DISTANCIA' => $distancia, 'PRECIO' => $precio);
                $oportunidades[] = $result;
            }
        }
        $stmt->close();
        return json_encode($oportunidades);
    }

    public function traer_oportunidades_por_id_usuario($id)
    {
        // ORIGEN DESTINO FECHA HORA PASAJEROS MARCA Y MODELO DEL VEHICULO nombre de transportista
        $oportunidades = array();
        $conn = $this->conexion();
        $query = "SELECT idOportunidad,Origen,Destino,Fecha,Estado FROM oportunidades where idComprador = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $origen, $destino, $fecha, $estado);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'ESTADO' => $estado);
                $oportunidades[] = $result;
            }
        }
        $stmt->close();
        return json_encode($oportunidades);
    }

    public function traer_oportunidades_por_id($id)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "SELECT idOportunidad,Descuento,Origen,Destino,Fecha,Nombre,Apellido,Marca,Modelo,Capacidad,Estado,Matricula,Distancia,Precio,idTransportista,Tipo_Usuario FROM oportunidades,usuarios,vehiculos where idTransportista = usuarios.ID and Vehiculo = Matricula and idOportunidad = $id;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $descuento, $origen, $destino, $fecha, $nombre, $apellido, $marca, $modelo, $capacidad_vehiculo, $estado, $matricula, $distancia, $precio, $idTransportista, $tipo_usuario);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'DESCUENTO' => $descuento, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'MARCA' => $marca, 'MODELO' => $modelo, 'CAPACIDAD_VEHICULO' => $capacidad_vehiculo, 'ESTADO' => $estado, 'MATRICULA' => $matricula, 'DISTANCIA' => $distancia, 'PRECIO' => $precio, 'ID_TRANSPORTISTA' => $idTransportista, 'TIPO_USUARIO' => $tipo_usuario);
                $oportunidades[$size] = $result;
                $return = $oportunidades;
                $size++;
            }
        }
        $stmt->close();
        return $return;
    }

    public function traer_viajes()
    {
        $viajes = array();
        $conn = $this->conexion();
        $query = "SELECT idViaje,Origen,Destino,Fecha,Nombre,Apellido,Marca,Modelo,CantidadPasajeros,Estado,Matricula,Distancia,Precio FROM agenda,usuarios,vehiculos where idTransportista = usuarios.ID and Vehiculo = Matricula;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $origen, $destino, $fecha, $nombre, $apellido, $marca, $modelo, $cantidad_pasajeros, $estado, $matricula, $distancia, $precio);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'MARCA' => $marca, 'MODELO' => $modelo, 'CANTIDAD_PASAJEROS' => $cantidad_pasajeros, 'ESTADO' => $estado, 'MATRICULA' => $matricula, 'DISTANCIA' => $distancia, 'PRECIO' => $precio);
                $viajes[] = $result;
            }
        }
        $stmt->close();
        return json_encode($viajes);
    }

    public function info_usuario_profile($id)
    {
        $usuarios = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Tipo_Usuario,CI,Email,Nombre,Apellido,Direccion,Barrio,Departamento,Telefono,Agencia_C,RUT,Supervisor,Nombre_Hotel,Direccion_Hotel FROM salioviajeuy_salioviajeuy.usuarios where ID = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario, $tipo_usuario, $ci, $mail, $nombre, $apellido, $direccion, $barrio, $departamento, $telefono, $agencia_contratista, $rut, $supervisor, $nombre_hotel, $direccion_hotel);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CI' => $ci, 'EMAIL' => $mail, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'TELEFONO' => $telefono, 'AGENCIA_CONTRATISTA' => $agencia_contratista, 'NOMBRE_HOTEL' => $nombre_hotel, 'DIRECCION_HOTEL' => $direccion_hotel, 'SUPERVISOR' => $supervisor, 'RUT' => $rut);
                $usuarios[] = $result;
            }
        }
        $stmt->close();
        return $usuarios;
    }

    public function traer_datos_transportista($id)
    {
        $conn = $this->conexion();
        $query = "SELECT Telefono,Nombre,idOportunidad,Email from usuarios,oportunidades where ID = $id;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($telefono, $nombre, $idOportunidad, $mail);
            while ($stmt->fetch()) {
                $result = array('TELEFONO' => $telefono, 'NOMBRE' => $nombre, 'ID_OPORTUNIDAD' => $idOportunidad, 'MAIL' => $mail);
            }
        }
        $stmt->close();
        return json_encode($result);
    }

    public function cambio_estado_oportunidad($estado, $id, $id_comprador)
    {
        $conn = $this->conexion();
        $query = "call cambio_estado_oportunidad(?,?,?)";
        $stmt = $conn->prepare($query);
        if (isset($id_comprador)) {
            $stmt->bind_param("sii", $estado, $id, $id_comprador);
        } else {
            $stmt->bind_param("sii", $estado, $id, null);
        }
        $stmt->execute();
        $stmt->close();
    }

    public function traer_datos_empresa($RUT)
    {
        $empresa = array();
        $conn = $this->conexion();
        $query = "CALL traigo_empresa(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $RUT);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $rut, $nombre_c, $razon_social, $nro_mtop, $pass_mtop, $id_usuario, $tipo_usuario, $choferes_sub, $direccion_hotel);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'RUT' => $rut, 'NOMBRE_COMERCIAL' => $nombre_c, 'RAZON_SOCIAL' => $razon_social, 'NRO_MTOP' => $nro_mtop, 'PASS_MTOP' => $pass_mtop, 'ID_USUARIO' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CHOFERES_SUB' => $choferes_sub, 'DIRECCION_HOTEL' => $direccion_hotel);
                $empresa[] = $result;
            }
        }
        $stmt->close();
        return $empresa;
    }

    public function traer_empresas_usuario($ID)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "CALL traigo_empresas_usuario(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ID);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $rut, $nombre_c, $razon_social, $nro_mtop, $pass_mtop, $usuario_id, $id_usuario, $choferes_sub, $direccion_hotel);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'RUT' => $rut, 'NOMBRE_COMERCIAL' => $nombre_c, 'RAZON_SOCIAL' => $razon_social, 'NRO_MTOP' => $nro_mtop, 'PASS_MTOP' => $pass_mtop, 'ID_USUARIO' => $usuario_id, 'TIPO_USUARIO' => $id_usuario, 'CHOFERES_SUB' => $choferes_sub, 'DIRECCION_HOTEL' => $direccion_hotel);
                $empresa[$size] = $result;
                $return = $empresa;
                $size++;
            }
        }
        $stmt->close();
        return $return;
    }

    public function traer_datos_vehiculo($id)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "SELECT * FROM vehiculos WHERE ID_EMPRESA IN (SELECT ID FROM empresas WHERE Usuario_ID = $id)";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $matricula, $marca, $modelo, $combustible, $capacidad, $equipaje, $pet_friendly, $rut_em, $rut_ec, $id_empresa);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'MATRICULA' => $matricula, 'MARCA' => $marca, 'MODELO' => $modelo, 'COMBUSTIBLE' => $combustible, 'CAPACIDAD' => $capacidad, 'EQUIPAJE' => $equipaje, 'PET_FRIENDLY' => $pet_friendly, 'RUT_EM' => $rut_em, 'RUT_EC' => $rut_ec, 'ID_EMPRESA' => $id_empresa);
                $vehiculo[$size] = $result;
                $return = $vehiculo;
                $size++;
            }
        }
        $stmt->close();
        return json_encode($return);
    }

    public function traer_datos_vehiculo_por_empresa($rut, $id)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "SELECT * FROM `vehiculos` WHERE RUT_EM = $rut and ID_EMPRESA = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $matricula, $marca, $modelo, $combustible, $capacidad, $equipaje, $pet_friendly, $rut_em, $rut_ec, $id_empresa);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'MATRICULA' => $matricula, 'MARCA' => $marca, 'MODELO' => $modelo, 'COMBUSTIBLE' => $combustible, 'CAPACIDAD' => $capacidad, 'EQUIPAJE' => $equipaje, 'PET_FRIENDLY' => $pet_friendly, 'RUT_EM' => $rut_em, 'RUT_EC' => $rut_ec, 'ID_EMPRESA' => $id_empresa);
                $vehiculo[$size] = $result;
                $return = $vehiculo;
                $size++;
            }
        }
        $stmt->close();
        return json_encode($return);
    }

    public function editar_usuario($id, $ci, $nombre, $apellido, $mail, $departamento, $barrio, $direccion, $telefono)
    {
        $ID = intval($id);
        $conn = $this->conexion();
        $query = "call editar_usuario(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issssssss", $ID, $ci, $nombre, $apellido, $mail, $departamento, $barrio, $direccion, $telefono);
        if ($stmt->execute()) {
            $stmt->close();
        } else {
            throw new Exception('Error en prepare: ' . $conn->error);
        }
    }

    public function editar_empresa($rut_e, $rut_nuevo, $nombre_c, $razon_social, $cho_sub, $nro_mtop, $pass_mtop)
    {
        $choferes_sub = intval($cho_sub);
        $conn = $this->conexion();
        $query = "call editar_empresa(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssiss", $rut_e, $rut_nuevo, $nombre_c, $razon_social, $choferes_sub, $nro_mtop, $pass_mtop);
        if ($stmt->execute()) {
            $stmt->close();
        } else {
            throw new Exception('Error en prepare: ' . $conn->error);
        }
    }

    public function eliminar_usuario($id)
    {
        $ID = intval($id);
        $conn = $this->conexion();
        $query = "call eliminar_usuario(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminar_empresa($rut)
    {
        $conn = $this->conexion();
        $query = "call eliminar_empresa(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $rut);
        $stmt->execute();
        $stmt->close();
    }

    public function traer_agenda_usuario($id)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "CALL traigo_agenda(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $vehiculo, $distancia, $cantidad_pasajeros, $fecha, $origen, $destino, $precio, $rutas, $estado, $id_transportista);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'VEHICULO' => $vehiculo, 'DISTANCIA' => $distancia, 'CANTIDAD_PASAJERO' => $cantidad_pasajeros, 'FECHA' => $fecha, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'PRECIO' => $precio, 'RUTAS' => $rutas, 'ESTADO' => $estado, 'ID_TRANSPORTISTA' => $id_transportista);
                $agenda[$size] = $result;
                $return = $agenda;
                $size++;
            }
        }
        $stmt->close();
        return $return;
    }

    public function traer_oportunidades_usuario($id)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "CALL traigo_oportunidades(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $descuento, $vehiculo, $distancia, $cantidad_pasajeros, $fecha, $origen, $destino, $precio, $rutas, $estado, $id_transportista, $id_comprador);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'DESCUENTO' => $descuento, 'VEHICULO' => $vehiculo, 'DISTANCIA' => $distancia, 'CANTIDAD_PASAJERO' => $cantidad_pasajeros, 'FECHA' => $fecha, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'PRECIO' => $precio, 'RUTAS' => $rutas, 'ESTADO' => $estado, 'ID_TRANSPORTISTA' => $id_transportista, 'ID_COMPRADOR' => $id_comprador);
                $agenda[$size] = $result;
                $return = $agenda;
                $size++;
            }
        }
        $stmt->close();
        return $return;
    }

    public function confirmar_mail($mail)
    {
        $result = null;
        $conn = $this->conexion();
        $query = "CALL confirmo_mail(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $mail);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id);
            while ($stmt->fetch()) {
                $result = array('ID' => $id);
                $usuario[] = $result;
            }
        }
        $stmt->close();
        if ($result != null) {
            return $result["ID"];
        } else {
            return null;
        }

    }

    public function cambiar_password($id, $pin_nuevo)
    {
        $PIN = password_hash($pin_nuevo, PASSWORD_BCRYPT);
        $ID = intval($id);
        $conn = $this->conexion();
        $query = "call cambiar_password(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $ID, $PIN);
        $stmt->execute();
        $stmt->close();
    }

    public function codigo_cambiar_password($id, $codigo)
    {
        $conn = $this->conexion();
        $query = "call codigo_cambiar_password(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $id, $codigo);
        $stmt->execute();
        $stmt->close();
    }

    public function confirmar_password($id, $pin)
    {
        $ID = intval($id);
        $conn = $this->conexion();
        $query = "CALL confirmo_password(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($PIN);
            while ($stmt->fetch()) {
                $result = array('PIN' => $PIN);
                if (password_verify($pin, $PIN)) {
                    $usuario[] = $result;
                } else {
                    $result = null;
                }
            }
        }
        $stmt->close();
        return json_encode($result);
    }

    public function confirmar_codigo_password($id, $codigo_u)
    {
        $result = null;
        $conn = $this->conexion();
        $query = "CALL confirmo_cambio_password(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $id, $codigo_u);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($codigo);
            while ($stmt->fetch()) {
                $result = array('CODIGO' => $codigo);
                $usuario[] = $result;
            }
        }
        $stmt->close();
        if ($result != null) {
            return $result['CODIGO'];
        } else {
            return null;
        }

    }

    public function traer_choferes($rut_em)
    {
        $choferes = array();
        $conn = $this->conexion();
        $query = "CALL traigo_choferes(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $rut_em);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_usuario);
                $choferes[] = $result;
            }
        }
        $stmt->close();
        return $choferes;
    }

    public function traer_choferes_por_tta_id($id)
    {
        $choferes = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Tipo_Usuario,CI,Email,Nombre,Apellido,Direccion,Barrio,Departamento,Telefono,Agencia_C,RUT FROM `usuarios` WHERE Agencia_C IN (SELECT RUT FROM empresas WHERE Usuario_ID = $id)";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario, $tipo_usuario, $ci, $mail, $nombre, $apellido, $direccion, $barrio, $departamento, $telefono, $agencia_contratista, $rut);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CI' => $ci, 'EMAIL' => $mail, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'TELEFONO' => $telefono, 'AGENCIA_CONTRATISTA' => $agencia_contratista, 'RUT' => $rut);
                $choferes[] = $result;
            }
        }
        $stmt->close();
        return json_encode($choferes);
    }

    public function agregar_cotizacion($datos, $tipo)
    {

        $datos = json_decode($datos, true);
        $conn = $this->conexion();
        $query = "CALL agregar_cotizacion(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        switch ($tipo) {
            case "traslados":
                $datos["TIPO"] = "Traslados";
                $stmt->bind_param("ssssssiisssiiisssiss", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos["TIPO"], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL']);
                break;
            case 'tour':
                $datos["TIPO"] = "Tour";
                $stmt->bind_param("ssssssiisssiiisssiss", $datos["DIRECCION_SALIDA_TOUR"], $datos["BARRIO_TOUR"], $datos["LOCALIDAD_TOUR"], $datos["NULL"], $datos["CIUDAD"], $datos["LOCALIDAD_DESTINO"], $datos["MASCOTA"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'], $datos['DURACION'], $datos['NULL'], $datos['NULL'], $datos["TIPO"], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL']);
                break;
            case 'transferIn':
                $stmt->bind_param("ssssssiisssiiisssiss", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["PUNTO_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_ARRIBO'], $datos['NULL'], $datos['NRO_VUELO_BARCO'], $datos['EQUIPAJE'], $datos['TIPO_TRANSFER'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL']);
                break;
            case 'transferOut':
                $stmt->bind_param("ssssssiisssiiisssiss", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["PUNTO_DESTINO"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_PARTIDA'], $datos['NULL'], $datos['NRO_VUELO_BARCO'], $datos['EQUIPAJE'], $datos['TIPO_TRANSFER'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL']);
                break;
            case 'fiestasIda':
                $stmt->bind_param("ssssssiisssiiisssiss", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["PUNTO_DESTINO"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS_IDA"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['TRAMOS_FIESTA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL']);
                break;
            case 'fiestasVuelta':
                $stmt->bind_param("ssssssiisssiiisssiss", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["PUNTO_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS_VUELTA"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_REGRESO'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['TRAMOS_FIESTA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL']);
                break;
            case 'fiestasIdaVuelta':
                $stmt->bind_param("ssssssiisssiiisssiss", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS_IDA"], $datos["HORA_SALIDA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'],$datos['NULL'],$datos['NULL'],$datos['NULL'],$datos['TRAMOS_FIESTA'],$datos['PUNTO_DESTINO'],$datos['PUNTO_SALIDA'],$datos['CANTIDAD_PASAJEROS_VUELTA'],$datos['HORA_REGRESO'],$datos['FECHA_REGRESO']);
                break;
        }
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_cotizacion);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_cotizacion);
            }
        }
        $stmt->close();
        return $result;
    }

    public function agregar_paradas($contenido, $tramo, $id_cotizacion)
    {
        $conn = $this->conexion();
        $query = "CALL agregar_parada(?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $contenido, $tramo, $id_cotizacion);
        $stmt->execute();
        $stmt->close();
        return "insertado";
    }

    public function traer_viajes_cotizando_panel_admin()
    {
        $choferes = array();
        $conn = $this->conexion();
        $query = "SELECT ID,DIRECCION_ORIGEN,BARRIO_ORIGEN,LOCALIDAD_ORIGEN,DIRECCION_DESTINO,BARRIO_DESTINO,LOCALIDAD_DESTINO,FECHA_SALIDA,ESTADO,HORA,CANTIDAD_PASAJEROS,MASCOTAS,TIPO FROM `cotizaciones` ";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_cotizacion, $direccion_origen, $barrio_origen, $localidad_origen, $direccion_destino, $barrio_destino, $localidad_destino, $fecha_salida, $estado,$hora,$cantidad_pasajeros,$mascotas,$tipo);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_cotizacion, 'DIRECCION_ORIGEN' => $direccion_origen, 'BARRIO_ORIGEN' => $barrio_origen, 'LOCALIDAD_ORIGEN' => $localidad_origen, 'DIRECCION_DESTINO' => $direccion_destino, 'BARRIO_DESTINO' => $barrio_destino, 'LOCALIDAD_DESTINO' => $localidad_destino, 'FECHA_SALIDA' => $fecha_salida, 'ESTADO' => $estado, 'HORA' => $hora, 'CANTIDAD_PASAJEROS' => $cantidad_pasajeros, 'MASCOTAS' => $mascotas,'TIPO' => $tipo);
                $cotizaciones[] = $result;
            }
        }
        $stmt->close();
        return json_encode($cotizaciones);
    }

    public function traer_viajes_cotizando_por_id($id)
    {
        $choferes = array();
        $conn = $this->conexion();
        $query = "SELECT ID,DIRECCION_ORIGEN,BARRIO_ORIGEN,LOCALIDAD_ORIGEN,DIRECCION_DESTINO,BARRIO_DESTINO,LOCALIDAD_DESTINO,FECHA_SALIDA,ESTADO,HORA,CANTIDAD_PASAJEROS,MASCOTAS,TIPO FROM `cotizaciones` WHERE ID = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_cotizacion, $direccion_origen, $barrio_origen, $localidad_origen, $direccion_destino, $barrio_destino, $localidad_destino, $fecha_salida, $estado,$hora,$cantidad_pasajeros,$mascotas,$tipo);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_cotizacion, 'DIRECCION_ORIGEN' => $direccion_origen, 'BARRIO_ORIGEN' => $barrio_origen, 'LOCALIDAD_ORIGEN' => $localidad_origen, 'DIRECCION_DESTINO' => $direccion_destino, 'BARRIO_DESTINO' => $barrio_destino, 'LOCALIDAD_DESTINO' => $localidad_destino, 'FECHA_SALIDA' => $fecha_salida, 'ESTADO' => $estado, 'HORA' => $hora, 'CANTIDAD_PASAJEROS' => $cantidad_pasajeros, 'MASCOTAS' => $mascotas,'TIPO' => $tipo);
                $cotizaciones[] = $result;
            }
        }
        $stmt->close();
        return json_encode($cotizaciones);
    }

    public function cambiar_estado_cotizacion($id,$estado)
    {
        $conn = $this->conexion();
        $query = "CALL cambiar_estado_cotizacion(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $id, $estado);
        $stmt->execute();
        $stmt->close();
    }

}