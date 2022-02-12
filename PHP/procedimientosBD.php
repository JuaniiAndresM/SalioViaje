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

        $conexion->set_charset("utf8");
        if (!$conexion) {
            echo "Error al conectar con la Base de datos.";
            exit();
        } else {
            return $conexion;
        }
    }

    public function register_usuario($tipo,$datos){ 
        $PIN = password_hash($datos['PIN'], PASSWORD_BCRYPT);
    	$conn = $this->conexion();
        $query = "CALL register_usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sissssssissssss", $tipo, $datos["CI"], $datos["CORREO"], $datos["NOMBRE"], $datos["APELLIDO"], $datos["DIRECCION"], $datos["BARRIO"], $datos["DEPARTAMENTO"], $datos["TELEFONO"],$PIN,$datos['AGENCIA_CONTRATISTA'],$datos['RUT'],$datos['SUPERVISOR'], $datos['NOMBRE_HOTEL'],$datos['DIRECCION_HOTEL']);
        if ($stmt->execute()) {
            $this->login($datos['CI'],$datos['PIN']);
            $stmt->store_result();
            $stmt->bind_result($idUsuario);
            while ($stmt->fetch()) {
             return $idUsuario;
         }
     }
     $stmt->close();
 }

 public function register_empresa($contador,$tipo_usuario,$id_usuario,$datos){
    if ($tipo_usuario == "CHO" || !isset($datos['CHOFERES_SUB'])) { $datos['CHOFERES_SUB'] = 0; }
    $conn = $this->conexion();
    $query = "call register_empresa(?,?,?,?,?,?,?,?,?);";
    $stmt = $conn->prepare($query);
    echo "\n".$datos["RUT"]." ".$datos["NOMBRE_COMERCIAL"]." ".$datos["RAZON_SOCIAL"]." ".$datos["NUMERO_MTOP"]." ".$datos["PASSWORD_MTOP"]." ".$tipo_usuario." ".$id_usuario." ".$datos['CHOFERES_SUB']."\n";
    $stmt->bind_param("isssissii", $contador, $datos["RUT"], $datos["NOMBRE_COMERCIAL"], $datos["RAZON_SOCIAL"], $datos["NUMERO_MTOP"], $datos["PASSWORD_MTOP"], $tipo_usuario, $id_usuario, $datos['CHOFERES_SUB']);
    $stmt->execute();
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
        $stmt->bind_result($nombre_empresa,$razon_social,$rut,$acepta_cho);
        while ($stmt->fetch()) {
         $result = array('NOMBRE_COMERCIAL' => $nombre_empresa,'RAZON_SOCIAL' => $razon_social, 'RUT' => $rut, 'CHOFERES_SUB' => $acepta_cho);
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
        $stmt->bind_result($id,$pin_bd,$passwd,$nombre,$apellido,$tipo_usuario,$ci,$telefono,$barrio,$departamento);
        while ($stmt->fetch()) {
            if(password_verify($pin, $pin_bd) || password_verify($pin, $passwd)){
                $datos_usuarios = array('CI' => $ci,'TELEFONO' => $telefono,'BARRIO' => $barrio,'DEPARTAMENTO' => $departamento);
                $usuario = $nombre." ".$apellido;
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
                    $_SESSION['tipo_usuario'] = 'Anfitrion';
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

public function traigo_ci(){
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

public function agrego_visita(){
    $vehiculos = array();
    $conn = $this->conexion();
    $query = "call agrego_visita()";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

public function traigo_visitas(){
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

public function traer_preguntas(){
    $preguntas = array();
    $conn = $this->conexion();
    $query = "SELECT * FROM salioviajeuy_salioviajeuy.faqs";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($id,$pregunta,$respuesta);
        while ($stmt->fetch()) {
         $result = array('ID' => $id,'PREGUNTA' => $pregunta, 'RESPUESTA' => $respuesta);
         $preguntas[] = $result;
     }
 }
 $stmt->close();
 return json_encode($preguntas);
}

public function agregar_pregunta($datos){
    $conn = $this->conexion();
    $query = "call agregar_faq(?,?);";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $datos['PREGUNTA'], $datos["RESPUESTA"]);
    $stmt->execute();
    $stmt->close();
    }

public function traer_pregunta_por_id($id){
    $conn = $this->conexion();
    $query = "SELECT * FROM salioviajeuy_salioviajeuy.faqs WHERE idPregunta = $id";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($id,$pregunta,$respuesta);
        while ($stmt->fetch()) {
         $result = array('ID' => $id,'PREGUNTA' => $pregunta, 'RESPUESTA' => $respuesta);
     }
 }
 $stmt->close();
 return json_encode($result);
}
//UPDATE `salioviajeuy_salioviajeuy`.`faqs` SET `Respuesta` = 'respuesta' WHERE (`idPregunta` = '38');

public function editar_pregunta_FAQ($ID_PREGUNTA,$PREGUNTA,$RESPUESTA){
    $conn = $this->conexion();
    $query = "call editar_pregunta_FAQ(?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $PREGUNTA, $RESPUESTA, $ID_PREGUNTA);
    $stmt->execute();
    $stmt->close();
}

public function borrar_pregunta_FAQ($ID){
    $conn = $this->conexion();
    $query = "DELETE FROM `salioviajeuy_salioviajeuy`.`faqs` WHERE (`idPregunta` = $ID)";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

 public function agendar_viaje($datos){
    $datos = json_decode($datos, true);
    $conn = $this->conexion();
    $query = "call agendar_viaje(?,?,?,?,?,?,?);";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siisssi", $datos['MATRICULA'], $datos["DISTANCIA"], $datos["CANTIDAD_DE_PASAJEROS"], $datos["FECHA"], $datos["ORIGEN"], $datos["DESTINO"], $datos["PRECIO_REFERENCIA"]);
    $stmt->execute();
    $stmt->close();
}

 public function agregar_oportunidad($datos){
    $datos = json_decode($datos, true);
    $conn = $this->conexion();
    $query = "call agregar_oportunidad(?,?,?,?,?,?,?,?);";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isiisssi", $datos['DESCUENTO_OPORTUNIDAD'], $datos['MATRICULA'], $datos["DISTANCIA"], $datos["CANTIDAD_DE_PASAJEROS"], $datos["FECHA"], $datos["ORIGEN"], $datos["DESTINO"], $datos["PRECIO_REFERENCIA"]);
    $stmt->execute();
    $stmt->close();
}

}
?>