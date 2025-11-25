<?php
// Conexión
require_once 'conexion.php';

class ProveedorDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::obtenerConexion();
    }

    // ========================================================
    // OBTENER TODOS LOS PROVEEDORES
    // ========================================================
    public function obtenerProveedores() {
        $sql = "SELECT * FROM proveedores";
        return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ========================================================
    // AGREGAR PROVEEDOR
    // ========================================================
    public function agregarProveedor($nombre_proveedor, $contacto, $telefono, $email, $direccion) {
        $sql = "INSERT INTO proveedores (nombre_proveedor, contacto, telefono, email, direccion)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre_proveedor, $contacto, $telefono, $email, $direccion]);
    }

    // ========================================================
    // OBTENER PROVEEDOR POR ID
    // ========================================================
    public function obtenerProveedor($id) {
        $sql = "SELECT * FROM proveedores WHERE id_proveedor=?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ========================================================
    // ACTUALIZAR PROVEEDOR
    // ========================================================
    public function actualizarProveedor($id, $nombre_proveedor, $contacto, $telefono, $email, $direccion) {
        $sql = "UPDATE proveedores 
                SET nombre_proveedor=?, contacto=?, telefono=?, email=?, direccion=?
                WHERE id_proveedor=?";
        $stmt = $this->con->prepare($sql);

        return $stmt->execute([$nombre_proveedor, $contacto, $telefono, $email, $direccion, $id]);
    }

    // ========================================================
    // ELIMINAR PROVEEDOR
    // ========================================================
    public function eliminarProveedor($id) {
        $sql = "DELETE FROM proveedores WHERE id_proveedor=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
