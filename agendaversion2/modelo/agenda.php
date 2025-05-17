
<?php


include_once('conexion.php');

class Agenda {

    // Función para insertar un nuevo contacto
    public static function insertar($nombre, $direccion, $telefono, $email) {
        $conexion = Conexion::conectar();
        $query = "INSERT INTO contactos (nombre, direccion, telefono, email) VALUES ('$nombre', '$direccion', '$telefono', '$email')";
        return $conexion->query($query);
    }

  
    // Función para eliminar un contacto por ID
public static function eliminarPorID($id) {
    $conexion = Conexion::conectar();
    $query = "DELETE FROM contactos WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}


    // Función para modificar un contacto
    public static function modificar($nombreBuscar, $nombreNuevo, $direccion, $telefono, $email) {
        $conexion = Conexion::conectar();
        $query = "UPDATE contactos SET nombre='$nombreNuevo', direccion='$direccion', telefono='$telefono', email='$email' WHERE nombre='$nombreBuscar'";
        return $conexion->query($query);
    }

    // Función para mostrar todos los contactos
    public static function mostrar() {
        $conexion = Conexion::conectar();
        $query = "SELECT * FROM contactos";
        return $conexion->query($query);
    }

    // Función para buscar un contacto por nombre
    public static function buscar($nombre) {
        $conexion = Conexion::conectar();
        $query = "SELECT * FROM contactos WHERE nombre LIKE '%$nombre%'";
        return $conexion->query($query);
    }

    
    
}
?>


