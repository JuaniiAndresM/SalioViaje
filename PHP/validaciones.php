<?php
/**
 *
 */
class validaciones
{
    private $PATTERN_NOMBRES = "/[^0-9\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
    private $PATTERN_CI = "/^[0-9]{7,8}$/i";
    private $PATTERN_MAIL = "/.+@[a-z]{4,5}.+\.[?=com]\w.+/i";
    private $PATTERN_DIRECCION = "/[^\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/i";
    private $PATTERN_TELEFONO = "/^(?=09[\d]){3}[0-9]{9}$/i";
    private $PATTERN_PIN = "/[0-9]{4}/i";

    private $PATTERN_RUT = "/^[\d]{12}$/i";
    private $PATTERN_NUMERO_MTOP = "/^[\d]{1,}$/i";
    private $PATTERN_PASSWORD_MTOP = "/^([\w\d]){1,}$/i";

    private $PATTERN_MATRICULA = "/^(\w){3}([0-9]){4}$/i";
    private $PATTERN_MARCA = "/[^0-9\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
    private $PATTERN_COMBUSTIBLE = "/^([A-Z][a-z]+([ ]?[a-z]?['-]?[A-Z][a-z]+)*)$/i";
    private $PATTERN_CAPACIDAD_PASAJEROS = "/^[1-9][0-9]{0,2}$/i";
    private $PATTERN_CAPACIDAD_EQUIPAJE = "/[0-9]{0,3}/i";

    public function __construct($tipo, $datos)
    {
        switch ($tipo) {
            case 'USUARIO':
                $validacion = $this->validar_formulario_usuario($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'EMP':
                $validacion = $this->validar_formulario_empresa($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'VIH':
                $validacion = $this->validar_formulario_vehiculo($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'HOTEL':
                $validacion = $this->validar_formulario_hotel($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'ETAPA-1':
                $validacion = $this->validar_formulario_agendar_viaje_etapa_1($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'ETAPA-2-TRAMO-1':
                $validacion = $this->validar_formulario_agendar_viaje_etapa_2_tramo_1($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'ETAPA-2-TRAMO-2':
                $validacion = $this->validar_formulario_agendar_viaje_etapa_2_tramo_2($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'ETAPA-3':
                $validacion = $this->validar_formulario_agendar_viaje_etapa_3($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'Translado':
                $validacion = $this->validar_formulario_translado($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'Tour':
                $validacion = $this->validar_formulario_tour($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'Transfer-in':
                $validacion = $this->validar_formulario_transfer_in($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'Transfer-out':
                $validacion = $this->validar_formulario_transfer_out($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'Fiestas_ida':
                $validacion = $this->validar_formulario_fiestas_y_eventos_ida($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'Fiestas_vuelta':
                $validacion = $this->validar_formulario_fiestas_y_eventos_vuelta($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            case 'Fiestas_ida_vuelta':
                $validacion = $this->validar_formulario_fiestas_y_eventos_ida_y_vuelta($datos);
                if ($validacion == 1) {echo "VALIDO";} else {echo $validacion;}
                break;
            default:
                echo "Esperando para validar...";
                break;
        }
    }

    private function validar_formulario_usuario($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $errores = 0;

        foreach (json_decode($datos) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'CI':
                        $CI = preg_match($this->PATTERN_CI, $valor);
                        if ($this->validar_digito_ci($valor) == 1 && $this->validar_existencia_ci($valor) == 1) {
                            $VALIDACION['CI'] = 1;
                        } else if ($this->validar_digito_ci($valor) == 1 && $this->validar_existencia_ci($valor) == 0) {
                            $VALIDACION['CI'] = 2;
                        } else {
                            $VALIDACION['CI'] = 0;
                        }
                        break;
                    case 'NOMBRE':
                        $NOMBRE = preg_match($this->PATTERN_NOMBRES, $valor);
                        $VALIDACION['NOMBRE'] = $NOMBRE;
                        break;
                    case 'APELLIDO':
                        $APELLIDO = preg_match($this->PATTERN_NOMBRES, $valor);
                        $VALIDACION['APELLIDO'] = $APELLIDO;
                        break;
                    case 'CORREO':
                        $MAIL = preg_match($this->PATTERN_MAIL, $valor);
                        $VALIDACION['MAIL'] = $MAIL;
                        break;
                    case 'DIRECCION':
                        $DIRECCION = preg_match($this->PATTERN_DIRECCION, $valor);
                        $VALIDACION['DIRECCION'] = $DIRECCION;
                        break;
                    case 'BARRIO':
                        $BARRIO = preg_match($this->PATTERN_NOMBRES, $valor);
                        $VALIDACION['BARRIO'] = $BARRIO;
                        break;
                    case 'DEPARTAMENTO':
                        $DEPARTAMENTO = preg_match($this->PATTERN_NOMBRES, $valor);
                        $VALIDACION['DEPARTAMENTO'] = $DEPARTAMENTO;
                        break;
                    case 'TELEFONO':
                        $TELEFONO = preg_match($this->PATTERN_TELEFONO, $valor);
                        $VALIDACION['TELEFONO'] = $TELEFONO;
                        break;
                    case 'PIN':
                        $VALOR_PIN = $valor;
                        $PIN = preg_match($this->PATTERN_PIN, $valor);
                        $VALIDACION['PIN'] = $PIN;
                        break;
                    case 'RE-PIN':
                        $RE_PIN = preg_match($this->PATTERN_PIN, $valor);
                        if ($VALOR_PIN == $valor) {
                            $PIN_MATCH = 1;
                        } else { $PIN_MATCH = 0;}
                        $VALIDACION['PIN-MATCH'] = $PIN_MATCH;
                        break;
                }
            }
        }
        $valor1 = explode("-", $valor);
        if ($valor1[0] == 'NUEVOPIN') {
            if ($valor == 'NUEVOPIN-1') {
                if (count($VALIDACION) != 1) {
                    $DATOS_VACIOS = "Err-1";
                }
            } else {
                if (count($VALIDACION) != 2) {
                    $DATOS_VACIOS = "Err-1";
                }
            }
        } else {
            if (count($VALIDACION) != 10) {
                $DATOS_VACIOS = "Err-1";
            }
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0 || $valor == 2) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_empresa($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $TIENE_MTOP = null;
        $TIENE_CHOFERES_SUB = null;
        $errores = 0;

        foreach (json_decode($datos) as $clave => $valor) {
            if ($valor != null || $valor != '' && $clave != 'VEHICULOS') {
                switch ($clave) {
                    case 'RUT':
                        $RUT = preg_match($this->PATTERN_RUT, $valor);
                        $VALIDACION['RUT'] = $RUT;
                        break;
                    case 'NOMBRE_COMERCIAL':
                        if ($valor != null) {
                            $VALIDACION['NOMBRE_COMERCIAL'] = 1;
                        } else { $VALIDACION['NOMBRE_COMERCIAL'] = 0;}
                        break;
                    case 'RAZON_SOCIAL':
                        if ($valor != null) {
                            $VALIDACION['RAZON_SOCIAL'] = 1;
                        } else { $VALIDACION['RAZON_SOCIAL'] = 0;}
                        break;
                    case 'CHOFERES_SUB':
                        $TIENE_CHOFERES_SUB = 1;
                        if ($valor == "0") {
                            $VALIDACION['CHOFERES_SUB'] = 0;
                        } else { $VALIDACION['CHOFERES_SUB'] = 1;}
                        break;
                    case 'NUMERO_MTOP':
                        if ($valor != null) {
                            $TIENE_MTOP = 1;
                            $MTOP = preg_match($this->PATTERN_NUMERO_MTOP, $valor);
                            $VALIDACION['MTOP'] = $MTOP;
                        } else { $TIENE_MTOP = 0;}
                        break;
                    case 'PASSWORD_MTOP':
                        if ($TIENE_MTOP == 1) {
                            $PASSWORD_MTOP = preg_match($this->PATTERN_PASSWORD_MTOP, $valor);
                            $VALIDACION['PASSWORD_MTOP'] = $PASSWORD_MTOP;
                        }
                        break;
                }
            }
        }

        if (count($VALIDACION) == 3 && $TIENE_MTOP == 0 && $TIENE_CHOFERES_SUB == null || count($VALIDACION) == 4 && $TIENE_MTOP == 0 && $TIENE_CHOFERES_SUB != null) {
            $DATOS_VACIOS = null;
        } else if (count($VALIDACION) != 6 && $TIENE_CHOFERES_SUB != null) {
            $DATOS_VACIOS = "Err-1";
        } else if (count($VALIDACION) != 5 && $TIENE_CHOFERES_SUB == null) {
            $DATOS_VACIOS = "Err-1";
        } else {
            $DATOS_VACIOS = null;
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_hotel($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $TIENE_MTOP = null;
        $TIENE_CHOFERES_SUB = null;
        $errores = 0;

        foreach (json_decode($datos) as $clave => $valor) {
            if ($valor != null || $valor != '' && $clave != 'VEHICULOS') {
                switch ($clave) {
                    case 'RUT':
                        $RUT = preg_match($this->PATTERN_RUT, $valor);
                        $VALIDACION['RUT'] = $RUT;
                        break;
                    case 'NOMBRE_COMERCIAL':
                        $NOMBRE_HOTEL = preg_match($this->PATTERN_NOMBRES, $valor);
                        $VALIDACION['NOMBRE_COMERCIAL'] = $NOMBRE_HOTEL;
                        break;
                    case 'DIRECCION_HOTEL':
                        $DIRECCION_HOTEL = preg_match($this->PATTERN_DIRECCION, $valor);
                        $VALIDACION['DIRECCION_HOTEL'] = $DIRECCION_HOTEL;
                        break;
                    case 'RAZON_SOCIAL':
                        if ($valor == "0") {
                            $VALIDACION['RAZON_SOCIAL'] = 0;
                        } else { $VALIDACION['RAZON_SOCIAL'] = 1;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 4) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_vehiculo($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $errores = 0;

        foreach (json_decode($datos) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'MATRICULA':
                        $MATRICULA = preg_match($this->PATTERN_MATRICULA, $valor);
                        $VALIDACION['MATRICULA'] = $MATRICULA;
                        break;
                    case 'MARCA':
                        $MARCA = preg_match($this->PATTERN_MARCA, $valor);
                        $VALIDACION['MARCA'] = $MARCA;
                        break;
                    case 'MODELO':
                        if ($valor != null) {
                            $VALIDACION['MODELO'] = 1;
                        } else { $VALIDACION['MODELO'] = 0;}
                        break;
                    case 'COMBUSTIBLE':
                        if ($valor == "0") {
                            $VALIDACION['COMBUSTIBLE'] = 0;
                        } else { $VALIDACION['COMBUSTIBLE'] = 1;}
                        break;
                    case 'CAPACIDAD_PASAJEROS':
                        $CAPACIDAD_PASAJEROS = preg_match($this->PATTERN_CAPACIDAD_PASAJEROS, $valor);
                        $VALIDACION['CAPACIDAD_PASAJEROS'] = $CAPACIDAD_PASAJEROS;
                        break;
                    case 'CAPACIDAD_EQUIPAJE':
                        $CAPACIDAD_EQUIPAJE = preg_match($this->PATTERN_CAPACIDAD_EQUIPAJE, $valor);
                        $VALIDACION['CAPACIDAD_EQUIPAJE'] = $CAPACIDAD_EQUIPAJE;
                        break;
                    case 'PET_FRIENDLY':
                        if ($valor == "0") {
                            $VALIDACION['PET_FRIENDLY'] = 0;
                        } else { $VALIDACION['PET_FRIENDLY'] = 1;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 7) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_existencia_ci($ci)
    {
        require_once "procedimientosBD.php";
        $ci_bd = new procedimientosBD();
        $datos_ci = $ci_bd->traigo_ci();
        $encontrado = 1;
        if ($datos_ci != null) {
            for ($i = 0; $i < count($datos_ci); $i++) {
                if ($datos_ci[$i] == $ci) {
                    $encontrado = 0;
                }
            }
        } else {return 1;}

        return $encontrado;

    }

    private function validar_existencia_mail($mail)
    {
        require_once "procedimientosBD.php";
        $mail_bd = new procedimientosBD();
        $datos_mail = $mail_bd->traigo_mail();
        $encontrado = 1;
        if ($datos_mail != null) {
            for ($i = 0; $i < count($datos_mail); $i++) {
                if ($datos_mail[$i] == $mail) {
                    $encontrado = 0;
                }
            }
        } else {return 1;}

        return $encontrado;

    }

    private function validar_formulario_agendar_viaje_etapa_1($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'VEHICULO':
                        if ($valor != null) {
                            $CAPACIDAD_PASAJEROS_VECHICULO = $valor['CAPACIDAD'];
                            $VALIDACION['VEHICULO'] = 1;
                        } else { $VALIDACION['VEHICULO'] = 0;}
                        break;
                    case 'CANTIDAD_DE_PASAJEROS':
                        if ($valor != null && $valor <= $CAPACIDAD_PASAJEROS_VECHICULO) {
                            $VALIDACION['CANTIDAD_DE_PASAJEROS'] = 1;
                        } else { $VALIDACION['CANTIDAD_DE_PASAJEROS'] = 0;}
                        break;
                    case 'DISTANCIA':
                        if ($valor != null) {
                            $VALIDACION['DISTANCIA'] = 1;
                        } else { $VALIDACION['DISTANCIA'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 3) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_agendar_viaje_etapa_2_tramo_1($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $TIENE_DESCUENTO = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach ($datos as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'TIPO':
                        if ($valor != 0 && $valor == 2) {
                            $TIENE_DESCUENTO = 1;
                            $VALIDACION['TIPO'] = 1;
                        } else if ($valor != 0 && $valor == 1) {
                            $VALIDACION['TIPO'] = 1;
                        } else if ($valor == 0) {$VALIDACION['TIPO'] = 0;}
                        break;
                    case 'FECHA':
                        if ($valor != null) {
                            $VALIDACION['FECHA'] = 1;
                        } else { $VALIDACION['FECHA'] = 0;}
                        break;
                    case 'ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['ORIGEN'] = 1;
                        } else { $VALIDACION['ORIGEN'] = 0;}
                        break;
                    case 'DESTINO':
                        if ($valor != null) {
                            $VALIDACION['DESTINO'] = 1;
                        } else { $VALIDACION['DESTINO'] = 0;}
                        break;
                    case 'PRECIO_REFERENCIA':
                        if ($valor != null) {
                            $VALIDACION['PRECIO_REFERENCIA'] = 1;
                        } else { $VALIDACION['PRECIO_REFERENCIA'] = 0;}
                        break;
                    case 'DESCUENTO_OPORTUNIDAD':
                        if ($valor != null && $TIENE_DESCUENTO != null && $valor <= "100" && $valor >= "50") {
                            $VALIDACION['DESCUENTO'] = 1;
                        } else { $VALIDACION['DESCUENTO'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 5 && $TIENE_DESCUENTO == null) {
            $DATOS_VACIOS = "Err-1";
        } else if (count($VALIDACION) != 6 && $TIENE_DESCUENTO != null) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_agendar_viaje_etapa_2_tramo_2($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $TIENE_DESCUENTO = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach ($datos as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'TIPO':
                        if ($valor != 0 && $valor == 2) {
                            $TIENE_DESCUENTO = 1;
                            $VALIDACION['TIPO'] = 1;
                        } else if ($valor != 0 && $valor == 1) {
                            $VALIDACION['TIPO'] = 1;
                        } else if ($valor == 0) {$VALIDACION['TIPO'] = 0;}
                        break;
                    case 'FECHA':
                        if ($valor != null) {
                            $VALIDACION['FECHA'] = 1;
                        } else { $VALIDACION['FECHA'] = 0;}
                        break;
                    case 'ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['ORIGEN'] = 1;
                        } else { $VALIDACION['ORIGEN'] = 0;}
                        break;
                    case 'DESTINO':
                        if ($valor != null) {
                            $VALIDACION['DESTINO'] = 1;
                        } else { $VALIDACION['DESTINO'] = 0;}
                        break;
                    case 'PRECIO_REFERENCIA':
                        if ($valor != null) {
                            $VALIDACION['PRECIO_REFERENCIA'] = 1;
                        } else { $VALIDACION['PRECIO_REFERENCIA'] = 0;}
                        break;
                    case 'DESCUENTO_OPORTUNIDAD':
                        if ($valor != null && $TIENE_DESCUENTO != null && $valor <= "100" && $valor >= "50") {
                            $VALIDACION['DESCUENTO'] = 1;
                        } else { $VALIDACION['DESCUENTO'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 5 && $TIENE_DESCUENTO == null) {
            $DATOS_VACIOS = "Err-1";
        } else if (count($VALIDACION) != 6 && $TIENE_DESCUENTO != null) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_agendar_viaje_etapa_3($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'VEHICULO':
                        if ($valor != null) {
                            $CAPACIDAD_PASAJEROS_VECHICULO = $valor['CAPACIDAD'];
                            $VALIDACION['VEHICULO'] = 1;
                        } else { $VALIDACION['VEHICULO'] = 0;}
                        break;
                    case 'CANTIDAD_DE_PASAJEROS':
                        if ($valor != null && $valor <= $CAPACIDAD_PASAJEROS_VECHICULO) {
                            $VALIDACION['CANTIDAD_DE_PASAJEROS'] = 1;
                        } else { $VALIDACION['CANTIDAD_DE_PASAJEROS'] = 0;}
                        break;
                    case 'DISTANCIA':
                        if ($valor != null) {
                            $VALIDACION['DISTANCIA'] = 1;
                        } else { $VALIDACION['DISTANCIA'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 3) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_translado($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'FECHA_SALIDA':
                        if ($valor != null) {
                            $VALIDACION['FECHA_SALIDA'] = 1;
                        } else { $VALIDACION['FECHA_SALIDA'] = 0;}
                        break;
                    case 'DIRECCION_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_ORIGEN'] = 1;
                        } else { $VALIDACION['DIRECCION_ORIGEN'] = 0;}
                        break;
                    case 'BARRIO_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_ORIGEN'] = 1;
                        } else { $VALIDACION['BARRIO_ORIGEN'] = 0;}
                        break;
                    case 'LOCALIDAD_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_ORIGEN'] = 1;
                        } else { $VALIDACION['LOCALIDAD_ORIGEN'] = 0;}
                        break;
                    case 'DIRECCION_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_DESTINO'] = 1;
                        } else { $VALIDACION['DIRECCION_DESTINO'] = 0;}
                        break;
                    case 'BARRIO_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_DESTINO'] = 1;
                        } else { $VALIDACION['BARRIO_DESTINO'] = 0;}
                        break;
                    case 'LOCALIDAD_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_DESTINO'] = 1;
                        } else { $VALIDACION['LOCALIDAD_DESTINO'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS'] = 0;}
                        break;
                    case 'MASCOTAS':
                        if ($valor != null) {
                            $VALIDACION['MASCOTAS'] = 1;
                        } else { $VALIDACION['MASCOTAS'] = 0;}
                        break;
                    case 'HORA':
                        if ($valor != null) {
                            $VALIDACION['HORA'] = 1;
                        } else { $VALIDACION['HORA'] = 0;}
                        break;
                    case 'OBSERVACIONES':
                        if ($valor != null) {
                            $VALIDACION['OBSERVACIONES'] = 1;
                        } else { $VALIDACION['OBSERVACIONES'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 11) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_tour($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'FECHA_SALIDA':
                        if ($valor != null) {
                            $VALIDACION['FECHA_SALIDA'] = 1;
                        } else { $VALIDACION['FECHA_SALIDA'] = 0;}
                        break;
                    case 'DIRECCION_SALIDA_TOUR':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_SALIDA_TOUR'] = 1;
                        } else { $VALIDACION['DIRECCION_SALIDA_TOUR'] = 0;}
                        break;
                    case 'BARRIO_TOUR':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_TOUR'] = 1;
                        } else { $VALIDACION['BARRIO_TOUR'] = 0;}
                        break;
                    case 'LOCALIDAD_TOUR':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_TOUR'] = 1;
                        } else { $VALIDACION['LOCALIDAD_TOUR'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS'] = 0;}
                        break;
                    case 'HORA':
                        if ($valor != null) {
                            $VALIDACION['HORA'] = 1;
                        } else { $VALIDACION['HORA'] = 0;}
                        break;
                    case 'CIUDAD':
                        if ($valor != null) {
                            $VALIDACION['CIUDAD'] = 1;
                        } else { $VALIDACION['CIUDAD'] = 0;}
                        break;
                    case 'DURACION':
                        if ($valor != null) {
                            $VALIDACION['DURACION'] = 1;
                        } else { $VALIDACION['DURACION'] = 0;}
                        break;
                    case 'MASCOTA':
                        if ($valor != null) {
                            $VALIDACION['MASCOTA'] = 1;
                        } else { $VALIDACION['MASCOTA'] = 0;}
                        break;
                    case 'OBSERVACIONES':
                        if ($valor != null) {
                            $VALIDACION['OBSERVACIONES'] = 1;
                        } else { $VALIDACION['OBSERVACIONES'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 10) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_transfer_in($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'TIPO_TRANSFER':
                        if ($valor != null) {
                            $VALIDACION['TIPO_TRANSFER'] = 1;
                        } else { $VALIDACION['TIPO_TRANSFER'] = 0;}
                        break;
                    case 'FECHA_ARRIBO':
                        if ($valor != null) {
                            $VALIDACION['FECHA_SALIDA'] = 1;
                        } else { $VALIDACION['FECHA_SALIDA'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS'] = 0;}
                        break;
                    case 'HORA':
                        if ($valor != null) {
                            $VALIDACION['HORA'] = 1;
                        } else { $VALIDACION['HORA'] = 0;}
                        break;
                    case 'DIRECCION_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_DESTINO'] = 1;
                        } else { $VALIDACION['DIRECCION_DESTINO'] = 0;}
                        break;
                    case 'BARRIO_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_DESTINO'] = 1;
                        } else { $VALIDACION['BARRIO_DESTINO'] = 0;}
                        break;
                    case 'LOCALIDAD_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_DESTINO'] = 1;
                        } else { $VALIDACION['LOCALIDAD_DESTINO'] = 0;}
                        break;
                    case 'PUNTO_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['PUNTO_ORIGEN'] = 1;
                        } else { $VALIDACION['PUNTO_ORIGEN'] = 0;}
                        break;
                    case 'EQUIPAJE':
                        if ($valor != null) {
                            $VALIDACION['EQUIPAJE'] = 1;
                        } else { $VALIDACION['EQUIPAJE'] = 0;}
                        break;
                    case 'NRO_VUELO_BARCO':
                        if ($valor != null) {
                            $VALIDACION['NRO_VUELO_BARCO'] = 1;
                        } else { $VALIDACION['NRO_VUELO_BARCO'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 10) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_transfer_out($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'TIPO_TRANSFER':
                        if ($valor != null) {
                            $VALIDACION['TIPO_TRANSFER'] = 1;
                        } else { $VALIDACION['TIPO_TRANSFER'] = 0;}
                        break;
                    case 'FECHA_PARTIDA':
                        if ($valor != null) {
                            $VALIDACION['FECHA_PARTIDA'] = 1;
                        } else { $VALIDACION['FECHA_PARTIDA'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS'] = 0;}
                        break;
                    case 'HORA':
                        if ($valor != null) {
                            $VALIDACION['HORA'] = 1;
                        } else { $VALIDACION['HORA'] = 0;}
                        break;
                    case 'DIRECCION_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_ORIGEN'] = 1;
                        } else { $VALIDACION['DIRECCION_ORIGEN'] = 0;}
                        break;
                    case 'BARRIO_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_ORIGEN'] = 1;
                        } else { $VALIDACION['BARRIO_ORIGEN'] = 0;}
                        break;
                    case 'LOCALIDAD_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_ORIGEN'] = 1;
                        } else { $VALIDACION['LOCALIDAD_ORIGEN'] = 0;}
                        break;
                    case 'PUNTO_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['PUNTO_DESTINO'] = 1;
                        } else { $VALIDACION['PUNTO_DESTINO'] = 0;}
                        break;
                    case 'EQUIPAJE':
                        if ($valor != null) {
                            $VALIDACION['EQUIPAJE'] = 1;
                        } else { $VALIDACION['EQUIPAJE'] = 0;}
                        break;
                    case 'NRO_VUELO_BARCO':
                        if ($valor != null) {
                            $VALIDACION['NRO_VUELO_BARCO'] = 1;
                        } else { $VALIDACION['NRO_VUELO_BARCO'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 10) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_fiestas_y_eventos_ida($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'TRAMOS_FIESTA':
                        if ($valor != '0') {
                            $VALIDACION['TRAMOS_FIESTA'] = 1;
                        } else { $VALIDACION['TRAMOS_FIESTA'] = 0;}
                        break;
                    case 'FECHA_SALIDA':
                        if ($valor != null) {
                            $VALIDACION['FECHA_SALIDA'] = 1;
                        } else { $VALIDACION['FECHA_SALIDA'] = 0;}
                        break;
                    case 'DIRECCION_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_ORIGEN'] = 1;
                        } else { $VALIDACION['DIRECCION_ORIGEN'] = 0;}
                        break;
                    case 'BARRIO_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_ORIGEN'] = 1;
                        } else { $VALIDACION['BARRIO_ORIGEN'] = 0;}
                        break;
                    case 'LOCALIDAD_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_ORIGEN'] = 1;
                        } else { $VALIDACION['LOCALIDAD_ORIGEN'] = 0;}
                        break;
                    case 'PUNTO_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['PUNTO_DESTINO'] = 1;
                        } else { $VALIDACION['PUNTO_DESTINO'] = 0;}
                        break;
                    case 'BARRIO_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_DESTINO'] = 1;
                        } else { $VALIDACION['BARRIO_DESTINO'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS_IDA':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS_IDA'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS_IDA'] = 0;}
                        break;
                    case 'HORA':
                        if ($valor != null) {
                            $VALIDACION['HORA'] = 1;
                        } else { $VALIDACION['HORA'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 9) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_fiestas_y_eventos_vuelta($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $CAPACIDAD_PASAJEROS_VECHICULO = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'TRAMOS_FIESTA':
                        if ($valor != '0') {
                            $VALIDACION['TRAMOS_FIESTA'] = 1;
                        } else { $VALIDACION['TRAMOS_FIESTA'] = 0;}
                        break;
                    case 'FECHA_REGRESO':
                        if ($valor != null) {
                            $VALIDACION['FECHA_REGRESO'] = 1;
                        } else { $VALIDACION['FECHA_REGRESO'] = 0;}
                        break;
                    case 'DIRECCION_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_DESTINO'] = 1;
                        } else { $VALIDACION['DIRECCION_DESTINO'] = 0;}
                        break;
                    case 'BARRIO_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_DESTINO'] = 1;
                        } else { $VALIDACION['BARRIO_DESTINO'] = 0;}
                        break;
                    case 'LOCALIDAD_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_DESTINO'] = 1;
                        } else { $VALIDACION['LOCALIDAD_DESTINO'] = 0;}
                        break;
                    case 'PUNTO_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['PUNTO_ORIGEN'] = 1;
                        } else { $VALIDACION['PUNTO_ORIGEN'] = 0;}
                        break;
                    case 'BARRIO_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_ORIGEN'] = 1;
                        } else { $VALIDACION['BARRIO_ORIGEN'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS_VUELTA'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS_VUELTA'] = 0;}
                        break;
                    case 'HORA':
                        if ($valor != null) {
                            $VALIDACION['HORA'] = 1;
                        } else { $VALIDACION['HORA'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 9) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_formulario_fiestas_y_eventos_ida_y_vuelta($datos)
    {

        $VALIDACION = array();
        $DATOS_VACIOS = null;
        $errores = 0;

        foreach (json_decode($datos, true) as $clave => $valor) {
            if ($valor != null || $valor != '') {
                switch ($clave) {
                    case 'TRAMOS_FIESTA':
                        if ($valor != '0') {
                            $VALIDACION['TRAMOS_FIESTA'] = 1;
                        } else { $VALIDACION['TRAMOS_FIESTA'] = 0;}
                        break;
                    case 'FECHA_SALIDA':
                        if ($valor != null) {
                            $VALIDACION['FECHA_SALIDA'] = 1;
                        } else { $VALIDACION['FECHA_SALIDA'] = 0;}
                        break;
                    case 'DIRECCION_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_ORIGEN'] = 1;
                        } else { $VALIDACION['DIRECCION_ORIGEN'] = 0;}
                        break;
                    case 'BARRIO_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_ORIGEN'] = 1;
                        } else { $VALIDACION['BARRIO_ORIGEN'] = 0;}
                        break;
                    case 'LOCALIDAD_ORIGEN':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_ORIGEN'] = 1;
                        } else { $VALIDACION['LOCALIDAD_ORIGEN'] = 0;}
                        break;
                    case 'DIRECCION_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_DESTINO'] = 1;
                        } else { $VALIDACION['DIRECCION_DESTINO'] = 0;}
                        break;
                    case 'BARRIO_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_DESTINO'] = 1;
                        } else { $VALIDACION['BARRIO_DESTINO'] = 0;}
                        break;
                    case 'LOCALIDAD_DESTINO':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_DESTINO'] = 1;
                        } else { $VALIDACION['LOCALIDAD_DESTINO'] = 0;}
                        break;
                    case 'HORA_SALIDA':
                        if ($valor != null) {
                            $VALIDACION['HORA_SALIDA'] = 1;
                        } else { $VALIDACION['HORA_SALIDA'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS_IDA':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS_IDA'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS_IDA'] = 0;}
                        break;
                    case 'FECHA_REGRESO':
                        if ($valor != null) {
                            $VALIDACION['FECHA_REGRESO'] = 1;
                        } else { $VALIDACION['FECHA_REGRESO'] = 0;}
                        break;
                    case 'DIRECCION_ORIGEN_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_ORIGEN_VUELTA'] = 1;
                        } else { $VALIDACION['DIRECCION_ORIGEN_VUELTA'] = 0;}
                        break;
                    case 'BARRIO_ORIGEN_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_ORIGEN_VUELTA'] = 1;
                        } else { $VALIDACION['BARRIO_ORIGEN_VUELTA'] = 0;}
                        break;
                    case 'LOCALIDAD_ORIGEN_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_ORIGEN_VUELTA'] = 1;
                        } else { $VALIDACION['LOCALIDAD_ORIGEN_VUELTA'] = 0;}
                        break;
                    case 'DIRECCION_DESTINO_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['DIRECCION_DESTINO_VUELTA'] = 1;
                        } else { $VALIDACION['DIRECCION_DESTINO_VUELTA'] = 0;}
                        break;
                    case 'BARRIO_DESTINO_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['BARRIO_DESTINO_VUELTA'] = 1;
                        } else { $VALIDACION['BARRIO_DESTINO_VUELTA'] = 0;}
                        break;
                    case 'LOCALIDAD_DESTINO_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['LOCALIDAD_DESTINO_VUELTA'] = 1;
                        } else { $VALIDACION['LOCALIDAD_DESTINO_VUELTA'] = 0;}
                        break;
                    case 'HORA_REGRESO':
                        if ($valor != null) {
                            $VALIDACION['HORA_REGRESO'] = 1;
                        } else { $VALIDACION['HORA_REGRESO'] = 0;}
                        break;
                    case 'CANTIDAD_PASAJEROS_VUELTA':
                        if ($valor != null) {
                            $VALIDACION['CANTIDAD_PASAJEROS_VUELTA'] = 1;
                        } else { $VALIDACION['CANTIDAD_PASAJEROS_VUELTA'] = 0;}
                        break;
                }
            }
        }

        if (count($VALIDACION) != 19) {
            $DATOS_VACIOS = "Err-1";
        }

        foreach ($VALIDACION as $clave => $valor) {
            if ($valor == 0) {
                $errores++;
            }
        }

        if ($DATOS_VACIOS == null && $errores == 0) {return true;} elseif ($DATOS_VACIOS != null) {return $DATOS_VACIOS;} else {return json_encode($VALIDACION);}

    }

    private function validar_digito_ci($ci)
    {

        $lastDigit = substr($ci, -1);

        $ci = str_pad($ci, 7, '0', STR_PAD_LEFT);
        $a = 0;

        $baseNumber = "2987634";
        for ($i = 0; $i < 7; $i++) {
            $baseDigit = $baseNumber[$i];
            $ciDigit = $ci[$i];

            $a += (intval($baseDigit) * intval($ciDigit)) % 10;
        }

        $verify = $a % 10 == 0 ? 0 : 10 - $a % 10;

        if ($lastDigit == $verify) {
            return 1;
        } else {
            return 0;
        }
    }
}
$Validar = new validaciones($_POST['tipo'], $_POST['datos']);
