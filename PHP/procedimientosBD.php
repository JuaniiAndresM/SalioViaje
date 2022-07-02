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
        echo "\n" . $datos["RUT"] . " " . $datos["NOMBRE_COMERCIAL"] . " " . $datos["RAZON_SOCIAL"] . " " . $datos["NUMERO_MTOP"] . " " . $datos["PASSWORD_MTOP"] . " " . $tipo_usuario . " " . $id_usuario . " " . $datos['CHOFERES_SUB'] . " " . $datos['DIRECCION_HOTEL'] . " " . $contador . "\n";
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
            $stmt->bind_result($nombre_empresa, $razon_social, $rut, $acepta_cho, $tipo_usuario);
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
            $stmt->bind_result($id, $pin_bd, $nombre, $apellido, $tipo_usuario, $ci, $telefono, $direccion, $barrio, $departamento, $mail);
            while ($stmt->fetch()) {
                if (password_verify($pin, $pin_bd)) {
                    $datos_usuarios = array('TIPO_USUARIO' => $tipo_usuario, 'ID' => $id, 'CI' => $ci, 'TELEFONO' => $telefono, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'MAIL' => $mail);
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
        $query = "SELECT ID,Tipo_Usuario,CI,Email,Nombre,Apellido,Direccion,Barrio,Departamento,Telefono,Agencia_C,RUT FROM salioviajeuy_salioviajeuy.usuarios WHERE visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario, $tipo_usuario, $ci, $mail, $nombre, $apellido, $direccion, $barrio, $departamento, $telefono, $agencia_contratista, $rut);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CI' => $ci, 'EMAIL' => $mail, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'TELEFONO' => $telefono, 'AGENCIA_CONTRATISTA' => $agencia_contratista, 'RUT' => $rut);
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
        $query = "SELECT ID,RUT,Nombre_C,Razon_S,Usuario_ID,Tipo_Usuario FROM salioviajeuy_salioviajeuy.empresas where visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $rut, $nombre_empresa, $razon_social, $id_owner, $tipo_usuario);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'RUT' => $rut, 'NOMBRE_EMPRESA' => $nombre_empresa, 'RAZON_SOCIAL' => $razon_social, 'ID_OWNER' => $id_owner, 'TIPO_USUARIO' => $tipo_usuario);
                $empresas[] = $result;
            }
        }
        echo $stmt->error;
        $stmt->close();
        return $empresas;
    }

    public function traigo_ci()
    {
        $ci = array();
        $conn = $this->conexion();
        $query = "SELECT CI FROM salioviajeuy_salioviajeuy.usuarios where visibilidad = 1;";
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
        $query = "SELECT Email FROM salioviajeuy_salioviajeuy.usuarios where visibilidad = 1;";
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
        $query = "SELECT ID,Matricula,Marca,Modelo,Combustible,Capacidad,Equipaje,PetFriendly,RUT_EM,RUT_EC,ID_EMPRESA FROM salioviajeuy_salioviajeuy.vehiculos where visibilidad = 1;";
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
        $query = "SELECT id FROM empresas WHERE Usuario_ID = $id and visibilidad = 1;";
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
        $query = "SELECT ID,Matricula,Marca,Modelo,Combustible,Capacidad,Equipaje,PetFriendly,RUT_EM,RUT_EC,ID_EMPRESA FROM salioviajeuy_salioviajeuy.vehiculos WHERE ID_EMPRESA = $id or RUT_EC = (SELECT RUT FROM empresas where ID = $id) and visibilidad = 1; ";
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

    public function datos_vehiculo_por_matricula($matricula)
    {

        $vehiculo = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Matricula,Marca,Modelo,Combustible,Capacidad,Equipaje,PetFriendly,RUT_EM,RUT_EC,ID_EMPRESA FROM salioviajeuy_salioviajeuy.vehiculos WHERE Matricula = '$matricula' and visibilidad = 1; ";
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
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($last_insert_id);
            while ($stmt->fetch()) {
                $result = $last_insert_id;
            }
        }
        $stmt->close();
        return json_encode($result);
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
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($last_insert_id);
            while ($stmt->fetch()) {
                $result = $last_insert_id;
            }
        }
        $stmt->close();
        return json_encode($result);
    }

    public function registrar_rutas_agenda($rutas, $id_viaje)
    {
        $rutas = json_decode($rutas, true);
        for ($i = 0; $i < count($rutas); $i++) {
            $conn = $this->conexion();
            $query = "call agregar_rutas_agenda(?,?);";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("is", $id_viaje, $rutas[$i]);
            $stmt->execute();
            $stmt->close();
        }
        return $id_viaje;
    }

    public function traer_oportunidades()
    {
        // ORIGEN DESTINO FECHA HORA PASAJEROS MARCA Y MODELO DEL VEHICULO nombre de transportista
        $oportunidades = array();
        $conn = $this->conexion();
        $query = "SELECT idViaje,Descuento,Origen,Destino,Fecha,Nombre,Apellido,Marca,Modelo,Capacidad,Estado,Matricula,Distancia,Precio,CantidadPasajeros FROM viajes,usuarios,vehiculos where idTransportista = usuarios.ID and Vehiculo = Matricula and Modalidad = 'Oportunidad' and visivilidad != 0 ORDER BY Fecha;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $descuento, $origen, $destino, $fecha, $nombre, $apellido, $marca, $modelo, $capacidad_vehiculo, $estado, $matricula, $distancia, $precio, $cantidad_pasajeros);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'DESCUENTO' => $descuento, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'MARCA' => $marca, 'MODELO' => $modelo, 'CAPACIDAD_VEHICULO' => $capacidad_vehiculo, 'ESTADO' => $estado, 'MATRICULA' => $matricula, 'DISTANCIA' => $distancia, 'PRECIO' => $precio, "CANTIDAD_PASAJERO" => $cantidad_pasajeros);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
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
        $query = "SELECT idViaje,Origen,Destino,Fecha,Estado,Precio,CantidadPasajeros,Modalidad,idTransportista,Nombre,Telefono FROM viajes,usuarios where idComprador = $id and usuarios.ID = idTransportista and Modalidad = 'Oportunidad' and visivilidad != 0 ORDER BY Fecha";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $origen, $destino, $fecha, $estado, $precio, $cantidad_pasajeros, $modalidad, $id_tta, $nombre, $telefono);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'ESTADO' => $estado, 'MODALIDAD' => $modalidad, "PRECIO" => $precio, "CANTIDAD_PASAJERO" => $cantidad_pasajeros, "NOMBRE" => $nombre, "TELEFONO" => $telefono);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
                $oportunidades[] = $result;
            }
        }
        $stmt->close();
        return json_encode($oportunidades);
    }

    public function traer_oportunidades_por_id_tta($id)
    {
        // ORIGEN DESTINO FECHA HORA PASAJEROS MARCA Y MODELO DEL VEHICULO nombre de transportista
        $oportunidades = array();
        $conn = $this->conexion();
        $query = "SELECT idViaje,Origen,Destino,Fecha,Estado,Modalidad,id_viaje_vinculado,Distancia,Vehiculo,Nombre,Apellido FROM viajes,usuarios where idTransportista = $id and usuarios.ID = $id and visivilidad != 0 ORDER BY Fecha";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $origen, $destino, $fecha, $estado, $modalidad, $id_viaje_vinculado, $distancia, $vehiculo, $nombre, $apellido/*,$nro_mtop, $pass_mtop*/);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'ESTADO' => $estado, 'MODALIDAD' => $modalidad, 'ID_VIAJE_VINCULADO' => $id_viaje_vinculado, "DISTANCIA" => $distancia, "VECHICULO" => $vehiculo, "NOMBRE" => $nombre, "APELLIDO" => $apellido, "NRO_MTOP" => $nro_mtop, "PASS_MTOP" => $pass_mtop);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
                $oportunidades[] = $result;
            }
        }
        $stmt->close();
        return json_encode($oportunidades);
    }

    public function traer_oportunidades_por_id_tta_seccion_facturacion($id)
    {
        // ORIGEN DESTINO FECHA HORA PASAJEROS MARCA Y MODELO DEL VEHICULO nombre de transportista
        $oportunidades = array();
        $conn = $this->conexion();
        $query = "SELECT idViaje,Destino,Fecha,Modalidad,Precio FROM viajes where idTransportista = $id and visivilidad != 0 and Estado = 'Reconfirmado' and Modalidad = 'Oportunidad';";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $destino, $fecha, $modalidad, $precio);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'DESTINO' => $destino, 'FECHA' => $fecha, 'MODALIDAD' => $modalidad, 'PRECIO' => $precio);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
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
        $query = "SELECT idViaje,Descuento,Origen,Destino,Fecha,Nombre,Apellido,Marca,Modelo,Capacidad,Estado,Matricula,Distancia,Precio,idTransportista,Tipo_Usuario,Telefono,idComprador FROM viajes,usuarios,vehiculos where idTransportista = usuarios.ID and Vehiculo = Matricula and idViaje = $id and Modalidad = 'Oportunidad' and visivilidad != 0;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $descuento, $origen, $destino, $fecha, $nombre, $apellido, $marca, $modelo, $capacidad_vehiculo, $estado, $matricula, $distancia, $precio, $idTransportista, $tipo_usuario, $telefono, $id_comprador);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'DESCUENTO' => $descuento, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'MARCA' => $marca, 'MODELO' => $modelo, 'CAPACIDAD_VEHICULO' => $capacidad_vehiculo, 'ESTADO' => $estado, 'MATRICULA' => $matricula, 'DISTANCIA' => $distancia, 'PRECIO' => $precio, 'ID_TRANSPORTISTA' => $idTransportista, 'TIPO_USUARIO' => $tipo_usuario, 'TELEFONO' => $telefono, 'ID_COMPRADOR' => $id_comprador);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
                $oportunidades[$size] = $result;
                $return = $oportunidades;
                $size++;
            }
        }
        $stmt->close();
        return $return;
    }

    public function traer_viajes_por_id($id)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "SELECT idViaje,Descuento,Origen,Destino,Fecha,Nombre,Apellido,Marca,Modelo,Capacidad,Estado,Matricula,Distancia,Precio,idTransportista,Tipo_Usuario,Telefono,idComprador FROM viajes,usuarios,vehiculos where idTransportista = usuarios.ID and Vehiculo = Matricula and idViaje = $id and visivilidad != 0;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idOportunidad, $descuento, $origen, $destino, $fecha, $nombre, $apellido, $marca, $modelo, $capacidad_vehiculo, $estado, $matricula, $distancia, $precio, $idTransportista, $tipo_usuario, $telefono, $id_comprador);
            while ($stmt->fetch()) {
                $result = array('ID' => $idOportunidad, 'DESCUENTO' => $descuento, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'MARCA' => $marca, 'MODELO' => $modelo, 'CAPACIDAD_VEHICULO' => $capacidad_vehiculo, 'ESTADO' => $estado, 'MATRICULA' => $matricula, 'DISTANCIA' => $distancia, 'PRECIO' => $precio, 'ID_TRANSPORTISTA' => $idTransportista, 'TIPO_USUARIO' => $tipo_usuario, 'TELEFONO' => $telefono, 'ID_COMPRADOR' => $id_comprador);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
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
        $query = "SELECT idViaje,Origen,Destino,Fecha,Nombre,Apellido,Marca,Modelo,CantidadPasajeros,Estado,Matricula,Distancia,Precio FROM viajes,usuarios,vehiculos where idTransportista = usuarios.ID and Vehiculo = Matricula and Modalidad = 'Agendado' and visivilidad != 0;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $origen, $destino, $fecha, $nombre, $apellido, $marca, $modelo, $cantidad_pasajeros, $estado, $matricula, $distancia, $precio);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'FECHA' => $fecha, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'MARCA' => $marca, 'MODELO' => $modelo, 'CANTIDAD_PASAJEROS' => $cantidad_pasajeros, 'ESTADO' => $estado, 'MATRICULA' => $matricula, 'DISTANCIA' => $distancia, 'PRECIO' => $precio);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
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
        $query = "SELECT ID,Tipo_Usuario,CI,Email,Nombre,Apellido,Direccion,Barrio,Departamento,Telefono,Agencia_C,RUT FROM salioviajeuy_salioviajeuy.usuarios where ID = $id and visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario, $tipo_usuario, $ci, $mail, $nombre, $apellido, $direccion, $barrio, $departamento, $telefono, $agencia_contratista, $rut);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CI' => $ci, 'EMAIL' => $mail, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'TELEFONO' => $telefono, 'AGENCIA_CONTRATISTA' => $agencia_contratista, 'RUT' => $rut);
                $usuarios[] = $result;
            }
        }
        $stmt->close();
        return $usuarios;
    }

    public function info_choferes_profile_empresa($id)
    {
        $usuarios = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Tipo_Usuario,CI,Email,Nombre,Apellido,Direccion,Barrio,Departamento,Telefono,Agencia_C,RUT FROM salioviajeuy_salioviajeuy.usuarios where Agencia_C IN (SELECT RUT FROM empresas where ID = $id) and visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario, $tipo_usuario, $ci, $mail, $nombre, $apellido, $direccion, $barrio, $departamento, $telefono, $agencia_contratista, $rut);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CI' => $ci, 'EMAIL' => $mail, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'TELEFONO' => $telefono, 'AGENCIA_CONTRATISTA' => $agencia_contratista, 'RUT' => $rut);
                $usuarios[] = $result;
            }
        }
        $stmt->close();
        return $usuarios;
    }

    public function traer_datos_transportista($id)
    {
        $conn = $this->conexion();
        $query = "SELECT Telefono,Nombre,idViaje,Email from usuarios,viajes where ID = $id and visivilidad != 0;";
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
            $stmt->bind_result($id, $rut, $nombre_c, $razon_social, $nro_mtop, $pass_mtop, $id_usuario, $tipo_usuario, $choferes_sub, $direccion_hotel, $visivilidad);
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
            $stmt->bind_result($id, $rut, $nombre_c, $razon_social, $nro_mtop, $pass_mtop, $usuario_id, $id_usuario, $choferes_sub, $direccion_hotel, $visivilidad);
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
        $query = "SELECT ID,Matricula,Marca,Modelo,Combustible,Capacidad,Equipaje,PetFriendly,RUT_EM,RUT_EC,ID_EMPRESA FROM vehiculos WHERE ID_EMPRESA IN (SELECT ID FROM empresas WHERE Usuario_ID = $id) and visibilidad = 1;";
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
        $query = "SELECT ID,Matricula,Marca,Modelo,Combustible,Capacidad,Equipaje,PetFriendly,RUT_EM,RUT_EC,ID_EMPRESA FROM `vehiculos` WHERE RUT_EM = $rut and ID_EMPRESA = $id and visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $matricula, $marca, $modelo, $combustible, $capacidad, $equipaje, $pet_friendly, $rut_em, $rut_ec, $id_empresa);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'MATRICULA' => $matricula, 'MARCA' => $marca, 'MODELO' => $modelo, 'COMBUSTIBLE' => $combustible, 'CAPACIDAD' => $capacidad, 'EQUIPAJE' => $equipaje, 'PET_FRIENDLY' => $pet_friendly, 'RUT_EM' => $rut_em, 'RUT_EC' => $rut_ec, 'ID_EMPRESA' => $id_empresa);
                $return[] = $result;
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
            $stmt->bind_result($id, $vehiculo, $distancia, $cantidad_pasajeros, $fecha, $origen, $destino, $precio, $estado, $modalidad, $id_transportista, $id_tramo_vinculado, $nombre, $apellido, $telefono, $id_solicitud);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'VEHICULO' => $vehiculo, 'DISTANCIA' => $distancia, 'CANTIDAD_PASAJERO' => $cantidad_pasajeros, 'FECHA' => $fecha, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'PRECIO' => $precio, 'RUTAS' => $rutas, 'ESTADO' => $estado, 'MODALIDAD' => $modalidad, 'ID_TRANSPORTISTA' => $id_transportista, "NOMBRE" => $nombre, "TELEFONO" => $telefono, "ID_SOLICITUD" => $id_solicitud);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i A", $timestamp);
                $result["FECHA"] = $newDate;
                $agenda[$size] = $result;
                $return = $agenda;
                $size++;
            }
        }
        $stmt->close();
        return $return;
    }

//

    public function traer_agenda_usuario_no_tta($id)
    {
        $return = null;
        $size = 0;
        $conn = $this->conexion();
        $query = "SELECT idViaje,Vehiculo,Distancia,CantidadPasajeros,Fecha,Origen,Destino,Precio,Estado,Modalidad,idTransportista,id_viaje_vinculado FROM viajes WHERE $id = idTransportista OR $id = idComprador and visivilidad = 1 ORDER BY Fecha;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $vehiculo, $distancia, $cantidad_pasajeros, $fecha, $origen, $destino, $precio, $estado, $modalidad, $id_transportista, $id_tramo_vinculado);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'VEHICULO' => $vehiculo, 'DISTANCIA' => $distancia, 'CANTIDAD_PASAJERO' => $cantidad_pasajeros, 'FECHA' => $fecha, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'PRECIO' => $precio, 'RUTAS' => $rutas, 'ESTADO' => $estado, 'MODALIDAD' => $modalidad, 'ID_TRANSPORTISTA' => $id_transportista);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i A", $timestamp);
                $result["FECHA"] = $newDate;
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
            $stmt->bind_result($id, $descuento, $vehiculo, $distancia, $cantidad_pasajeros, $fecha, $origen, $destino, $precio, $estado, $id_transportista, $id_comprador, $modalidad);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'DESCUENTO' => $descuento, 'VEHICULO' => $vehiculo, 'DISTANCIA' => $distancia, 'CANTIDAD_PASAJERO' => $cantidad_pasajeros, 'FECHA' => $fecha, 'ORIGEN' => $origen, 'DESTINO' => $destino, 'PRECIO' => $precio, 'RUTAS' => $rutas, 'ESTADO' => $estado, 'ID_TRANSPORTISTA' => $id_transportista, 'ID_COMPRADOR' => $id_comprador, 'MODALIDAD' => $modalidad);
                $fecha = $result["FECHA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y H:i", $timestamp);
                $result["FECHA"] = $newDate;
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

    public function traer_empresas_choferes_por_tta_id($id)
    {
        $empresas_choferes = array();
        $conn = $this->conexion();
        $query = "SELECT * FROM `empresas` WHERE Usuario_ID IN (SELECT ID FROM usuarios WHERE Agencia_C IN (SELECT RUT FROM empresas where Usuario_ID = $id)) and  visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $rut, $nombre_c, $razon_social, $nro_mtop, $pass_mtop, $id_usuario, $tipo_usuario, $choferes_sub, $direccion_hotel, $visivilidad);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'RUT' => $rut, 'NOMBRE_COMERCIAL' => $nombre_c, 'RAZON_SOCIAL' => $razon_social, 'NRO_MTOP' => $nro_mtop, 'PASS_MTOP' => $pass_mtop, 'ID_USUARIO' => $id_usuario, 'TIPO_USUARIO' => $tipo_usuario, 'CHOFERES_SUB' => $choferes_sub, 'DIRECCION_HOTEL' => $direccion_hotel);
                $empresas_choferes[] = $result;
            }
        }
        $stmt->close();
        return json_encode($empresas_choferes);
    }

    //SELECT * from vehiculos where RUT_EM IN(SELECT RUT FROM `empresas` WHERE Usuario_ID IN (SELECT ID FROM usuarios WHERE Agencia_C IN (SELECT RUT FROM empresas where Usuario_ID = 435)))

    public function traer_vehiculos_empresas_choferes_por_tta_id($id)
    {
        $vehiculos_choferes = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Matricula,Marca,Modelo,Combustible,Capacidad,Equipaje,PetFriendly,RUT_EM,RUT_EC,ID_EMPRESA from vehiculos where RUT_EM IN(SELECT RUT FROM `empresas` WHERE Usuario_ID IN (SELECT ID FROM usuarios WHERE Agencia_C IN (SELECT RUT FROM empresas where Usuario_ID = $id) and visibilidad = 1)) and visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $matricula, $marca, $modelo, $combustible, $capacidad, $equipaje, $pet_friendly, $rut_em, $rut_ec, $id_empresa);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'MATRICULA' => $matricula, 'MARCA' => $marca, 'MODELO' => $modelo, 'COMBUSTIBLE' => $combustible, 'CAPACIDAD' => $capacidad, 'EQUIPAJE' => $equipaje, 'PET_FRIENDLY' => $pet_friendly, 'RUT_EM' => $rut_em, 'RUT_EC' => $rut_ec, 'ID_EMPRESA' => $id_empresa);
                $vehiculos_choferes[] = $result;
            }
        }
        $stmt->close();
        return json_encode($vehiculos_choferes);
    }

    public function agregar_cotizacion($datos, $tipo, $id_solicitante)
    {
        $datos = json_decode($datos, true);
        $datos['ID_SOLICITANTE'] = $id_solicitante;
        $conn = $this->conexion();
        $query = "CALL agregar_cotizacion(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        switch ($tipo) {
            case "traslados":
                $datos["TIPO"] = "Traslados";
                $stmt->bind_param("ssssssssssssiisssisisssisii", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos["TIPO"], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['ID_SOLICITANTE']);
                break;
            case 'tour':
                $datos["TIPO"] = "Tour";
                $stmt->bind_param("ssssssssssssiisssisisssisii", $datos["DIRECCION_SALIDA_TOUR"], $datos["BARRIO_TOUR"], $datos["LOCALIDAD_TOUR"], $datos["NULL"], $datos["CIUDAD"], $datos["LOCALIDAD_DESTINO"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["MASCOTA"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'], $datos['DURACION'], $datos['NULL'], $datos['NULL'], $datos["TIPO"], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['ID_SOLICITANTE']);
                break;
            case 'transferIn':
                $stmt->bind_param("ssssssssssssiisssisisssisii", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["PUNTO_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_ARRIBO'], $datos['NULL'], $datos['NRO_VUELO_BARCO'], $datos['EQUIPAJE'], $datos['TIPO_TRANSFER'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['ID_SOLICITANTE']);
                break;
            case 'transferOut':
                $stmt->bind_param("ssssssssssssiisssisisssisii", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["PUNTO_DESTINO"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_PARTIDA'], $datos['NULL'], $datos['NRO_VUELO_BARCO'], $datos['EQUIPAJE'], $datos['TIPO_TRANSFER'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['ID_SOLICITANTE']);
                break;
            case 'fiestasIda':
                $stmt->bind_param("ssssssssssssiisssisisssisii", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["PUNTO_DESTINO"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS_IDA"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['TRAMOS_FIESTA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['ID_SOLICITANTE']);
                break;
            case 'fiestasVuelta':
                $stmt->bind_param("ssssssssssssiisssisisssisii", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["PUNTO_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["NULL"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS_VUELTA"], $datos["HORA"], $datos["OBSERVACIONES"], $datos['FECHA_REGRESO'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['TRAMOS_FIESTA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['ID_SOLICITANTE']);
                break;
            case 'fiestasIdaVuelta':
                $stmt->bind_param("ssssssssssssiisssisisssisii", $datos["DIRECCION_ORIGEN"], $datos["BARRIO_ORIGEN"], $datos["LOCALIDAD_ORIGEN"], $datos["DIRECCION_DESTINO"], $datos["BARRIO_DESTINO"], $datos["LOCALIDAD_DESTINO"], $datos["DIRECCION_ORIGEN_VUELTA"], $datos["BARRIO_ORIGEN_VUELTA"], $datos["LOCALIDAD_ORIGEN_VUELTA"], $datos["DIRECCION_DESTINO_VUELTA"], $datos["BARRIO_DESTINO_VUELTA"], $datos["LOCALIDAD_DESTINO_VUELTA"], $datos["MASCOTAS"], $datos["CANTIDAD_PASAJEROS_IDA"], $datos["HORA_SALIDA"], $datos["OBSERVACIONES"], $datos['FECHA_SALIDA'], $datos['NULL'], $datos['NULL'], $datos['NULL'], $datos['TRAMOS_FIESTA'], $datos['PUNTO_DESTINO'], $datos['PUNTO_SALIDA'], $datos['CANTIDAD_PASAJEROS_VUELTA'], $datos['HORA_REGRESO'], $datos['FECHA_REGRESO'], $datos['ID_SOLICITANTE']);
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
        //UPDATE cotizaciones SET ESTADO = 5 WHERE FECHA_SALIDA < CURRENT_DATE or (FECHA_SALIDA = CURRENT_DATE and HORA < CURRENT_TIME) and ESTADO = 1;
        $cotizaciones = array();
        $conn = $this->conexion();
        $query = "SELECT ID,DIRECCION_ORIGEN,BARRIO_ORIGEN,LOCALIDAD_ORIGEN,DIRECCION_DESTINO,BARRIO_DESTINO,LOCALIDAD_DESTINO,FECHA_SALIDA,ESTADO,HORA,CANTIDAD_PASAJEROS,MASCOTAS,TIPO,ID_TTA_RESPONSABLE FROM `cotizaciones` ORDER BY FECHA_SALIDA, HORA";
        $query2 = "UPDATE cotizaciones SET ESTADO = 5 WHERE FECHA_SALIDA < CURRENT_DATE or (FECHA_SALIDA = CURRENT_DATE and HORA < CURRENT_TIME) and ESTADO = 1;";

        $stmt = $conn->prepare($query);
        $update_cotizaciones_vencidas = $conn->prepare($query2);
        $update_cotizaciones_vencidas->execute();

        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_cotizacion, $direccion_origen, $barrio_origen, $localidad_origen, $direccion_destino, $barrio_destino, $localidad_destino, $fecha_salida, $estado, $hora, $cantidad_pasajeros, $mascotas, $tipo, $id_tta_responsable);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_cotizacion, 'DIRECCION_ORIGEN' => $direccion_origen, 'BARRIO_ORIGEN' => $barrio_origen, 'LOCALIDAD_ORIGEN' => $localidad_origen, 'DIRECCION_DESTINO' => $direccion_destino, 'BARRIO_DESTINO' => $barrio_destino, 'LOCALIDAD_DESTINO' => $localidad_destino, 'FECHA_SALIDA' => $fecha_salida, 'ESTADO' => $estado, 'HORA' => $hora, 'CANTIDAD_PASAJEROS' => $cantidad_pasajeros, 'MASCOTAS' => $mascotas, 'TIPO' => $tipo, 'ID_RESPONSABLE' => $id_tta_responsable);
                $fecha = $result["FECHA_SALIDA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y", $timestamp);
                $result["FECHA_SALIDA"] = $newDate;
                $cotizaciones[] = $result;
            }
        }
        $stmt->close();
        return json_encode($cotizaciones);
    }

    public function traer_viajes_cotizando_por_id($id)
    {
        $conn = $this->conexion();
        $query = "SELECT * FROM `cotizaciones` WHERE ID = $id";
        $query2 = "UPDATE cotizaciones SET ESTADO = 5 WHERE FECHA_SALIDA < CURRENT_DATE or (FECHA_SALIDA = CURRENT_DATE and HORA < CURRENT_TIME) and ESTADO = 1;";

        $stmt = $conn->prepare($query);

        $update_cotizaciones_vencidas = $conn->prepare($query2);
        $update_cotizaciones_vencidas->execute();

        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_cotizacion, $tipo, $dir_origen, $bar_origen, $loc_origen, $dir_destino, $bar_destino, $loc_destino, $dir_origen_vuelta, $bar_origen_vuelta, $loc_origen_vuelta, $dir_destino_vuelta, $bar_destino_vuelta, $loc_destino_vuelta, $dest_salida_eventos, $ori_salida_eventos, $mascotas, $cantidad_pasajeros, $cant_pasajeros_regreso, $len, $hora, $hr_regreso, $nro_b_v, $nro_equi, $obs, $fechaSalida, $fechaRegreso, $estado, $id_soli, $id_tta_responsable);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_cotizacion, 'DIRECCION_ORIGEN' => $dir_origen, 'BARRIO_ORIGEN' => $bar_origen, 'LOCALIDAD_ORIGEN' => $loc_origen, 'DIRECCION_DESTINO' => $dir_destino, 'BARRIO_DESTINO' => $bar_destino, 'LOCALIDAD_DESTINO' => $loc_destino, 'FECHA_SALIDA' => $fechaSalida, 'ESTADO' => $estado, 'HORA' => $hora, 'CANTIDAD_PASAJEROS' => $cantidad_pasajeros, 'MASCOTAS' => $mascotas, 'TIPO' => $tipo, 'OBSERVACIONES' => $obs, 'MASCOTAS' => $mascotas, 'DURACION' => $len, 'NRO_BARCO_VUELO' => $nro_b_v, 'EQUIPAJE' => $nro_equi, 'HORA_REGRESO' => $hr_regreso, 'FECHA_REGRESO' => $fechaRegreso, 'ID_SOLICITANTE' => $id_soli, 'LOCALIDAD_ORIGEN_VUELTA' => $loc_origen_vuelta, 'BARRIO_ORIGEN_VUELTA' => $bar_origen_vuelta, 'DIRECCION_ORIGEN_VUELTA' => $dir_origen_vuelta, 'LOCALIDAD_DESTINO_VUELTA' => $loc_destino_vuelta, 'BARRIO_DESTINO_VUELTA' => $bar_destino_vuelta, 'DIRECCION_DESTINO_VUELTA' => $dir_destino_vuelta);
                $fecha = $result["FECHA_SALIDA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y", $timestamp);
                $result["FECHA_SALIDA"] = $newDate;
                $cotizaciones[] = $result;
            }
        }
        $stmt->close();
        return json_encode($cotizaciones);
    }

    public function cambiar_estado_cotizacion($id, $estado)
    {
        $conn = $this->conexion();
        $query = "CALL cambiar_estado_cotizacion(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id, $estado);
        $stmt->execute();
        $stmt->close();
    }

    public function cambiar_responsable_cotizacion($id, $responsable)
    {
        $conn = $this->conexion();
        $query = "CALL cambio_responsable_cotizacion(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id, $responsable);
        $stmt->execute();
        $stmt->close();
    }

    public function traer_paradas_viajes_cotizando_por_id($id)
    {
        $conn = $this->conexion();
        $query = "SELECT ID,CONTENIDO,TRAMO FROM `paradas` WHERE ID_COTIZACION = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_parada, $contenido, $tramo);
            while ($stmt->fetch()) {
                $result = array('ID' => $id_parada, 'CONTENIDO' => $contenido, 'TRAMO' => $tramo);
                $paradas[] = $result;
            }
        }
        $stmt->close();
        return json_encode($paradas);
    }

    public function traer_regiones_mtop()
    {
        $conn = $this->conexion();
        $query = "SELECT pais,dpto,localidad FROM `regiones-mtop`";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($pais, $dpto, $region);
            while ($stmt->fetch()) {
                $result = array('PAIS' => $pais, 'DPTO' => $dpto, 'REGION' => $region);
                $regiones[] = $result;
            }
        }
        $stmt->close();
        return json_encode($regiones);
    }

    public function traer_rutas_mtop()
    {
        $conn = $this->conexion();
        $query = "SELECT * FROM `rutas_mtop`";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $ruta);
            while ($stmt->fetch()) {
                $result = array('ID' => $id, 'RUTA' => $ruta);
                $rutas[] = $result;
            }
        }
        $stmt->close();
        return json_encode($rutas);
    }

    public function existencia_matricula($matr)
    {
        //SELECT Matricula FROM `vehiculos` WHERE Matricula = $matr
        $conn = $this->conexion();
        $query = "SELECT 1 FROM `vehiculos` WHERE `Matricula` = '$matr'";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($existencia);
            while ($stmt->fetch()) {
                $result = $existencia;
            }
        }
        $stmt->close();
        return $existencia;
    }

    public function existencia_matricula_por_id($matr, $id)
    {
        //SELECT Matricula FROM `vehiculos` WHERE Matricula = $matr
        $conn = $this->conexion();
        $query = "SELECT 1 FROM `vehiculos` WHERE `Matricula` = '$matr' AND `ID` != $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($existencia);
            while ($stmt->fetch()) {
                $result = $existencia;
            }
        }
        $stmt->close();
        return $existencia;
    }

    public function traer_id_viajes_cotizando()
    {
        $id = array($id);
        $conn = $this->conexion();
        $query = "SELECT ID FROM `cotizaciones` WHERE ESTADO = '1';";
        $query2 = "UPDATE cotizaciones SET ESTADO = 5 WHERE FECHA_SALIDA < CURRENT_DATE or (FECHA_SALIDA = CURRENT_DATE and HORA < CURRENT_TIME) and ESTADO = 1;";

        $stmt = $conn->prepare($query);

        $update_cotizaciones_vencidas = $conn->prepare($query2);
        $update_cotizaciones_vencidas->execute();

        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_cotizacion);
            while ($stmt->fetch()) {
                $id[] = $id_cotizacion;
            }
        }
        $stmt->close();
        return json_encode($id);
    }

    public function traer_barrios()
    {
        $barrio = array();
        $conn = $this->conexion();
        $query = "SELECT * FROM `barrios`";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($barrios);
            while ($stmt->fetch()) {
                $barrio[] = $barrios;
            }
        }
        $stmt->close();
        return json_encode($barrio);
    }

    public function registrar_tramos_vinculados($id_tramo_vinculado, $id)
    {
        $conn = $this->conexion();
        $query = "CALL registrar_tramos_vinculados(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id, $id_tramo_vinculado);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminar_viajes($id)
    {
        $conn = $this->conexion();
        $query = "CALL eliminar_viaje(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function editar_oportunidades($id, $datos)
    {
        $datos = json_decode($datos, true);
        $datos['FECHA'] = str_replace("T", " ", $datos['FECHA']);

        $conn = $this->conexion();
        $query = "CALL editar_oportunidad(?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisssi", $id, $datos['DESCUENTO'], $datos['ORIGEN'], $datos['DESTINO'], $datos['FECHA'], $datos['PRECIO']);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function cambiarIdComprador($id_oportunidad)
    {
        session_start();
        $id_usuario = $_SESSION['datos_usuario']['ID'];
        $conn = $this->conexion();
        $query = "UPDATE viajes SET idComprador = $id_usuario, Estado = 'Comprada' WHERE idViaje = $id_oportunidad;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function obtener_id_comprador($id)
    {
        $conn = $this->conexion();
        $query = "SELECT idComprador FROM `viajes` where idViaje = $id;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_comprador);
            while ($stmt->fetch()) {
                $comprador[] = $id_comprador;
            }
        }
        $stmt->close();
        return json_encode($comprador);
    }

    public function guardarPreferencias($datos)
    {
        session_start();
        $id = $_SESSION['datos_usuario']['ID'];
        $datos = json_decode($datos, true);
        $conn = $this->conexion();
        $query = "CALL setPreferenciasVehiculos(?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sisiii", $datos['MATRICULA'], $datos['FIESTAS'], $datos['DIA_LIBRE'], $datos['PRECIO'], $datos['NOCTURNO'], $id);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function presentarCotizacion($matricula, $precio, $senia, $id_viaje_cotizado, $id_tta)
    {
        $conn = $this->conexion();
        $query = "call presentar_cotizacion(?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siiii", $matricula, $precio, $senia, $id_viaje_cotizado, $id_tta);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function traer_cotizaciones_presentadas_por_id_tta($id)
    {
        $cotizaciones = array();
        $conn = $this->conexion();
        $query = "SELECT `cotizaciones_presentadas`.ID,MATRICULA,DIRECCION_ORIGEN,BARRIO_ORIGEN,LOCALIDAD_ORIGEN,DIRECCION_DESTINO,BARRIO_DESTINO,LOCALIDAD_DESTINO,ESTADO,FECHA_SALIDA,COMPRADA,ID_VIAJE_COTIZADO,PRECIO,SENIA FROM `cotizaciones_presentadas`,`cotizaciones` where id_tta = $id and visibilidad = 1 and `cotizaciones_presentadas`.ID_VIAJE_COTIZADO = `cotizaciones`.ID;";
        $query2 = "UPDATE cotizaciones_presentadas SET visibilidad = 0 WHERE (SELECT FECHA_SALIDA FROM cotizaciones WHERE ID = ID_VIAJE_COTIZADO) < CURRENT_DATE or ((SELECT FECHA_SALIDA FROM cotizaciones WHERE ID = ID_VIAJE_COTIZADO) = CURRENT_DATE and (SELECT HORA FROM cotizaciones WHERE ID = ID_VIAJE_COTIZADO) < CURRENT_TIME) and (SELECT ESTADO FROM cotizaciones WHERE ID = ID_VIAJE_COTIZADO) = 1;";
        
        $stmt = $conn->prepare($query);
        $stmt2 = $conn->prepare($query2);
        $stmt2->execute();
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $matricula, $direccion_origen, $barrio_origen, $localidad_origen, $direccion_destino, $barrio_destino, $localidad_destino, $estado, $fecha_salida, $comprada, $id_viaje_cotizado,$precio, $senia);
            while ($stmt->fetch()) {
                $result = array("ID" => $id, "MATRICULA" => $matricula, "DIRECCION_ORIGEN" => $direccion_origen, "BARRIO_ORIGEN" => $barrio_origen, "LOCALIDAD_ORIGEN" => $localidad_origen, "DIRECCION_DESTINO" => $direccion_destino, "BARRIO_DESTINO" => $barrio_destino, "LOCALIDAD_DESTINO" => $localidad_destino, "ESTADO" => $estado, "FECHA_SALIDA" => $fecha_salida, "COMPRADA" => $comprada, "ID_VIAJE_COTIZADO" => $id_viaje_cotizado, "PRECIO" => $precio, "SENIA" => $senia);
                $fecha = $result["FECHA_SALIDA"];
                $timestamp = strtotime($fecha);
                $newDate = date("d-m-Y", $timestamp);
                $result["FECHA_SALIDA"] = $newDate;
                $cotizaciones[] = $result;
            }
        }
        $stmt->close();
        return json_encode($cotizaciones);
    }

    public function traer_cotizaciones_recibidas_por_id_solicitante($id)
    {
        $cotizaciones = array();
        $conn = $this->conexion();
        $query = "SELECT `cotizaciones_presentadas`.ID,Marca,Modelo,Capacidad,PRECIO,ID_VIAJE_COTIZADO,SENIA FROM `cotizaciones_presentadas`,`vehiculos` where `cotizaciones_presentadas`.MATRICULA = `vehiculos`.Matricula AND ID_VIAJE_COTIZADO in (select ID from `cotizaciones` where ID_SOLICITANTE = $id and ESTADO = 1) and `cotizaciones_presentadas`.visibilidad = 1;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $marca, $modelo, $capacidad, $precio, $id_viaje_cotizado, $senia);
            while ($stmt->fetch()) {
                $result = array("ID" => $id, "MARCA" => $marca, "MODELO" => $modelo, "CAPACIDAD" => $capacidad, "PRECIO" => $precio, "ID_VIAJE_COTIZADO" => $id_viaje_cotizado, "SENIA" => $senia);
                $cotizaciones[] = $result;
            }
        }
        $stmt->close();
        return json_encode($cotizaciones);
    }

    public function aceptarCotizacion($id, $id_viaje_cot)
    {
        $conn = $this->conexion();
        $query = "call aprobar_cotizacion(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id, $id_viaje_cot);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($TELEFONO_TTA, $MAIL_TTA);
            while ($stmt->fetch()) {
                $result = $TELEFONO_TTA."-".$MAIL_TTA;
            }
        }
        echo $stmt->error;
        $stmt->close();
        return $result;
    }

    public function reconfirmarCotizacion($id, $id_viaje_cot)
    {
        $conn = $this->conexion();
        $query = "call reconfirmar_cotiazcion(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id, $id_viaje_cot);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function rechazarCotizacion($id, $id_viaje_cot)
    {
        echo $id . "     " . $id_viaje_cot;
        $conn = $this->conexion();
        $query = "call rechazar_cotizacion(?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id, $id_viaje_cot);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    /*
    TODO: hacer el eliminar cotizacion que reemplaza al rechazar cotizacion anterior
     */
    public function eliminarCotizacion($id)
    {
        $conn = $this->conexion();
        $query = "call eliminar_cotizacion(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function obtener_nombre_chofer_tta_por_id($id)
    {
        $conn = $this->conexion();
        $query = "SELECT NOMBRE,APELLIDO FROM `usuarios` where ID in (select Usuario_ID from empresas where ID = $id);";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($nombre, $apellido);
            while ($stmt->fetch()) {
                $nombre = $nombre . " " . $apellido;
            }
        }
        $stmt->close();
        return $nombre;
    }

    //SELECT NOCTURNO,FIESTAS,DIA_LIBRE,PRECIO_DE_COCHE FROM prefecrenciasVehiculos where MATRICULA = $mat;

    public function traer_preferencias_vehiculos($mat)
    {
        $preferencias = array();
        $conn = $this->conexion();
        $query = "SELECT NOCTURNO,FIESTAS,DIA_LIBRE,PRECIO_DE_COCHE FROM `prefecrenciasVehiculos` where `prefecrenciasVehiculos`.MATRICULA = $mat;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($nocturno, $fiestas, $dia_libre, $precio_coche);
            while ($stmt->fetch()) {
                $result = array(
                    "NOCTURNO" => $nocturno,
                    "FIESTAS" => $fiestas,
                    "DIA_LIBRE" => $dia_libre,
                    "PRECIO_DE_COCHE" => $precio_coche,
                );
                $preferencias[] = $result;
            }
        }
        echo $stmt->error;
        $stmt->close();

        return json_encode($preferencias);
    }

    public function traer_preferencias()
    {
        $preferencias = array();
        $conn = $this->conexion();
        $query = "SELECT NOCTURNO,FIESTAS,DIA_LIBRE,PRECIO_DE_COCHE,id_tta FROM `prefecrenciasVehiculos`;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($nocturno, $fiestas, $dia_libre, $precio_coche, $idtta);
            while ($stmt->fetch()) {
                $result = array(
                    "NOCTURNO" => $nocturno,
                    "FIESTAS" => $fiestas,
                    "DIA_LIBRE" => $dia_libre,
                    "PRECIO_DE_COCHE" => $precio_coche,
                    "TRANSPORTISTA" => $idtta,
                );
                $preferencias[] = $result;
            }
        }
        echo $stmt->error;
        $stmt->close();

        return json_encode($preferencias);
    }

    public function traer_tranportistas()
    {
        $transportistas = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Email,Departamento,moroso FROM `usuarios` where Tipo_Usuario = 'TTA';";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $email, $departamento, $moroso);
            while ($stmt->fetch()) {
                $result = array(
                    "ID" => $id,
                    "MAIL" => $email,
                    "DEPARTAMENTO" => $departamento,
                    "MOROSO" => $moroso,
                );
                $transportistas[] = $result;
            }
        }
        echo $stmt->error;
        $stmt->close();

        return json_encode($transportistas);
    }

    public function traer_cotizaciones_por_id_comprador($id)
    {
        $cotizaciones = array();
        $conn = $this->conexion();
        $query = "SELECT ID,DIRECCION_ORIGEN,BARRIO_ORIGEN,LOCALIDAD_ORIGEN,DIRECCION_DESTINO,BARRIO_DESTINO,LOCALIDAD_DESTINO,FECHA_SALIDA,ESTADO,TIPO,HORA,CANTIDAD_PASAJEROS FROM cotizaciones WHERE ID_SOLICITANTE = $id;";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $dir_origen, $bar_origen, $loc_origen, $dir_destino, $bar_destino, $loc_destino, $fecha, $estado, $tipo, $hora, $cantidad_pasajeros);
            while ($stmt->fetch()) {
                $origen = $dir_origen . ", " . $bar_origen . ", " . $loc_origen;
                $destino = $dir_destino . ", " . $bar_destino . ", " . $loc_destino;
                if ($estado == 1 || $estado == 4) {
                    $estado = ($estado == 1) ? "Cotizando" : "Cotizado";
                    $result = array("ID" => $id, "ORIGEN" => $origen, "DESTINO" => $destino, "FECHA" => $fecha, "ESTADO" => $estado, "MODALIDAD" => $tipo, "HORA" => $hora, "CANTIDAD_PASAJEROS" => $cantidad_pasajeros);
                    if ($result["FECHA"] != null) {
                        $fecha = $result["FECHA"];
                        $timestamp = strtotime($fecha);
                        $newDate = date("d-m-Y", $timestamp);
                        $result["FECHA"] = $newDate;
                    }
                    $cotizaciones[] = $result;
                }
            }
        }
        $stmt->close();
        return json_encode($cotizaciones);
    }

    public function copiar_solicitud_viaje($id)
    {
        $conn = $this->conexion();
        $query = "call copiar_solicitud_cotizacion(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public function datos_mtop_tta($matricula)
    {
        $datos_mtop = array();
        $conn = $this->conexion();
        $query = "SELECT Nro_MTOP,Pass_MTOP FROM empresas WHERE RUT = (select RUT_EM from vehiculos where Matricula = '$matricula')";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($numero_mtop, $pass_mtop);
            while ($stmt->fetch()) {
                $result = array("NUMERO_MTOP" => $numero_mtop, "PASS_MTOP" => $pass_mtop);
                $datos_mtop[] = $result;
            }
        }
        $stmt->close();
        return json_encode($datos_mtop);
    }

    public function estado_mtop($id)
    {
        $estado;
        $conn = $this->conexion();
        $query = "SELECT ESTADO_MTOP FROM viajes WHERE idViaje = $id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($estado_mtop);
            while ($stmt->fetch()) {
                $estado = $estado_mtop;
            }
        }
        $stmt->close();
        return $estado;
    }

    public function actualizar_estado_mtop($estado,$id)
    {
        $conn = $this->conexion();
        $query = "UPDATE `viajes` SET `ESTADO_MTOP` = $estado WHERE idViaje = $id or id_viaje_vinculado = $id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $stmt->close();
    }

    public function actualizar_direccion_usuario($direccion, $barrio, $localidad)
    {
        session_start();
        $id_usuario = $_SESSION['datos_usuario']['ID'];
        $conn = $this->conexion();
        $query = "UPDATE usuarios SET Direccion = $direccion, Barrio = $barrio, Departamento = $localidad WHERE ID = $id_usuario;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }
}
