<?php 
/**
 * 
 */
class procedimientosBD
{
	
    private function conexion()
    {
        $conexion = mysqli_connect("localhost", "root", "root", "salioViaje");
        if (!$conexion) {
            echo "Error al conectar con la Base de datos.";
            exit();
        } else {
            return $conexion;
        }
    }
//$tipoUsuario,$datos
    public function register_usuario($tipo,$datos){ 
    	echo "Tipo Usuario: ".$tipo."    Datos:  ".json_encode($datos);
    	$conn = $this->conexion();
        $query = "CALL register_usuario(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sissssssii", $tipo, $datos["CI"], $datos["CORREO"], $datos["NOMBRE"], $datos["APELLIDO"], $datos["DIRECCION"], $datos["BARRIO"], $datos["DEPARTAMENTO"], $datos["TELEFONO"], $datos["PIN"]);
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
    	echo "Empresa: ".$datos["RUT"]." ".$datos["NOMBRE_COMERCIAL"]." ".$datos["RAZON_SOCIAL"]." ".$datos["NUMERO_MTOP"]." ".$datos["PASSWORD_MTOP"]." ".$tipo_usuario." ".$id_usuario."\n";
    	$conn = $this->conexion();
        $query = "CALL register_empresa(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ississi", $datos["RUT"], $datos["NOMBRE_COMERCIAL"], $datos["RAZON_SOCIAL"], $datos["NUMERO_MTOP"], $datos["PASSWORD_MTOP"], $tipo_usuario, $id_usuario);
        $stmt->execute();
        $stmt->close();
    }

    public function register_vehiculo($rut,$datos_vehiculo){ 
    	//echo "El vehiculo es de la empresa: ".$rut."    Datos del vehiculo:  ".json_encode($datos_vehiculo)."\n";
    	/*
    	$conn = $this->conexion();
        $query = "CALL register_vehiculo(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sissssssii", $tipo, $datos["CI"], $datos["CORREO"], $datos["NOMBRE"], $datos["APELLIDO"], $datos["DIRECCION"], $datos["BARRIO"], $datos["DEPARTAMENTO"], $datos["TELEFONO"], $datos["PIN"]);
        $stmt->execute();
        $stmt->close();
        */
    }
}
?>