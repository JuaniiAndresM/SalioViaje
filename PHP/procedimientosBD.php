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
    public function register($tipo,$datos){ 
    	//echo "Tipo Usuario: ".$tipo."    Datos:  ".json_encode($datos);
    	$conn = $this->conexion();
        $query = "CALL register(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sissssssii", $tipo, $datos["CI"], $datos["CORREO"], $datos["NOMBRE"], $datos["APELLIDO"], $datos["DIRECCION"], $datos["BARRIO"], $datos["DEPARTAMENTO"], $datos["TELEFONO"], $datos["PIN"]);
        $stmt->execute();
        $stmt->close();
    }
}
?>