<?php 
/**
 * 
 */
class procedimientosBD
{
	
    private function conexion(){
        //$conexion = mysqli_connect("localhost", "root", "root", "salioviaje");
        //$conexion = mysqli_connect("158.106.136.183", "salioviajeuy", "La_medusa_2022", "salioviajeuy_salioviajeuy");
        $conexion = mysqli_connect("localhost", "root", "root", "salioviajeuy_salioviajeuy");
        if (!$conexion) {
            echo "Error al conectar con la Base de datos.";
            exit();
        } else {
            return $conexion;
        }
    }

    public function register_usuario($tipo,$datos){ 

    	echo "Tipo Usuario: ".$tipo."    Datos:  ".json_encode($datos);
    	$conn = $this->conexion();
        $query = "CALL register_usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sissssssiisssss", $tipo, $datos["CI"], $datos["CORREO"], $datos["NOMBRE"], $datos["APELLIDO"], $datos["DIRECCION"], $datos["BARRIO"], $datos["DEPARTAMENTO"], $datos["TELEFONO"],$datos["PIN"],$datos['AGENCIA_CONTRATISTA'],$datos['RUT'],$datos['SUPERVISOR'], $datos['NOMBRE_HOTEL'],$datos['DIRECCION_HOTEL']);
       	if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($idUsuario);
            while ($stmt->fetch()) {
               return $idUsuario;
            }
         }
        $stmt->close();
    }

    public function register_empresa($tipo_usuario,$id_usuario,$datos){

        $conn = $this->conexion();
        $query = "call salioviajeuy_salioviajeuy.register_empresa(?, ?, ?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($query);

        for ($x=0; $x < count($datos); $x++) {
        echo "\n".$datos[$x]["RUT"]." ".$datos[$x]["NOMBRE_COMERCIAL"]." ".$datos[$x]["RAZON_SOCIAL"]." ".$datos[$x]["NUMERO_MTOP"]." ".$datos[$x]["PASSWORD_MTOP"]." ".$tipo_usuario." ".$id_usuario."\n";
        $stmt->bind_param("sssissi", $datos[$x]["RUT"], $datos[$x]["NOMBRE_COMERCIAL"], $datos[$x]["RAZON_SOCIAL"], $datos[$x]["NUMERO_MTOP"], $datos[$x]["PASSWORD_MTOP"], $tipo_usuario, $id_usuario);
        $stmt->execute();
        }
        
        $stmt->close();
    }

    public function register_vehiculo($rut,$rut_ec,$datos){ 
    	$conn = $this->conexion();
        $query = "CALL register_vehiculo(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssiiiss", $datos["MATRICULA"], $datos["MARCA"], $datos["MODELO"], $datos["COMBUSTIBLE"], $datos["CAPACIDAD_PASAJEROS"], $datos["CAPACIDAD_EQUIPAJE"], $datos["PET_FRIENDLY"], $rut, $rut_ec);
        $stmt->execute();
        $stmt->close();
    }

    public function empresas(){
        $empresas = array();
        $conn = $this->conexion();
        $query = "CALL traigo_empresas()";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($nombre_empresa,$razon_social,$rut);
            while ($stmt->fetch()) {
               $result = array('NOMBRE_COMERCIAL' => $nombre_empresa,'RAZON_SOCIAL' => $razon_social, 'RUT' => $rut);
               $empresas[] = $result;
            }
         }
        $stmt->close();
        return json_encode($empresas);
    }

    public function login($usuario, $pin){
        $conn = $this->conexion();
        $query = "CALL login(?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usuario);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id,$pin_bd,$passwd,$nombre,$apellido,$tipo_usuario);
            while ($stmt->fetch()) {
                if($pin_bd == $pin || $passwd == $pin){
                    $usuario = $nombre." ".$apellido;
                    session_start();
                    $_SESSION['usuario'] = $usuario;
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
                            $_SESSION['tipo_usuario'] = 'Anfitrion';
                            break;
                        case 'HTL':
                            $_SESSION['tipo_usuario'] = 'Hotel';
                            break;
                        case 'ADM':
                            $_SESSION['tipo_usuario'] = 'Administrador';
                            break;
                    }
                    return $_SESSION['usuario'];
                }
            }
         }
        $stmt->close();
    }

    public function datos_usuarios(){
        $usuarios = array();
        $conn = $this->conexion();
        $query = "SELECT ID,Tipo_Usuario,CI,Email,Nombre,Apellido,Direccion,Barrio,Departamento,Telefono,Agencia_C,RUT,Supervisor,Nombre_Hotel,Direccion_Hotel FROM salioviajeuy_salioviajeuy.usuarios";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id_usuario,$tipo_usuario,$ci,$mail,$nombre,$apellido,$direccion,$barrio,$departamento,$telefono,$agencia_contratista,$rut,$supervisor,$nombre_hotel,$direccion_hotel);
            while ($stmt->fetch()) {
               $result = array('ID' => $id_usuario,'TIPO_USUARIO' => $tipo_usuario, 'CI' => $ci, 'EMAIL' => $mail, 'NOMBRE' => $nombre, 'APELLIDO' => $apellido, 'DIRECCION' => $direccion, 'BARRIO' => $barrio, 'DEPARTAMENTO' => $departamento, 'TELEFONO' => $telefono, 'AGENCIA_CONTRATISTA' => $agencia_contratista, 'NOMBRE_HOTEL' => $nombre_hotel, 'DIRECCION_HOTEL' => $direccion_hotel, 'SUPERVISOR' => $supervisor, 'RUT' => $rut);
               $usuarios[] = $result;
            }
         }
        $stmt->close();
        return $usuarios;
    }

    public function datos_empresas(){
        $empresas = array();
        $conn = $this->conexion();
        $query = "SELECT ID,RUT,Nombre_C,Razon_S,Usuario_ID,Tipo_Usuario FROM salioviajeuy_salioviajeuy.empresas";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id,$rut,$nombre_empresa,$razon_social,$id_owner,$tipo_usuario);
            while ($stmt->fetch()) {
               $result = array('ID' => $id, 'RUT' => $rut, 'NOMBRE_EMPRESA' => $nombre_empresa, 'RAZON_SOCIAL' => $razon_social, 'ID_OWNER' => $id_owner, 'TIPO_USUARIO' => $tipo_usuario);
               $empresas[] = $result;
            }
         }
        $stmt->close();
        return $empresas;
    }

    public function datos_vehiculos(){
        $vehiculos = array();
        $conn = $this->conexion();
        $query = "SELECT * FROM salioviajeuy_salioviajeuy.vehiculos";
        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id,$matricula,$marca,$modelo,$combustible,$capacidad,$equipaje,$rut_em,$rut_e,$pet_friendly);
            while ($stmt->fetch()) {
               $result = array('ID' => $id,'MATRICULA' => $matricula, 'MARCA' => $marca, 'MODELO' => $modelo, 'COMBUSTIBLE' => $combustible, 'CAPACIDAD' => $capacidad, 'EQUIPAJE' => $equipaje, 'RUT_E' => $rut_e, 'PET_FRIENDLY' => $pet_friendly,'RUT_EM' => $rut_em);
               $vehiculos[] = $result;
            }
         }
        $stmt->close();
        return $vehiculos;
    }
}
?>