<?php
/*************************************************************/
/* Archivo:  contacto.php
 * Objetivo: Clase que representa un contacto con métodos
 *           para insertar y modificar en la base de datos.
/*************************************************************/
class Contacto {
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
    private $id_usuario;

    // Constructor
    public function __construct($nombre, $direccion, $telefono, $email, $id_usuario) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->id_usuario = $id_usuario;
    }

    // Guardar nuevo contacto en la base de datos
    public function guardar($conexion) {
        $stmt = $conexion->prepare("INSERT INTO contactos (Nombre, Direccion, Telefono, Email, id_usuario) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $this->nombre, $this->direccion, $this->telefono, $this->email, $this->id_usuario);
        return $stmt->execute();
    }

    // Modificar contacto existente por ID
    public function modificar($conexion, $id_contacto) {
        $stmt = $conexion->prepare("UPDATE contactos SET Nombre = ?, Direccion = ?, Telefono = ?, Email = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $this->nombre, $this->direccion, $this->telefono, $this->email, $id_contacto);
        return $stmt->execute();
    }
}
?>
