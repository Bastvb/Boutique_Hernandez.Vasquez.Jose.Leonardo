<?php
// Incluimos el archivo de conexión para acceder a la base de datos.
require_once 'conexion.php';

// Creamos la clase ClienteDAO (Data Access Object) para manejar la tabla "clientes".
class ClienteDAO {
    // Atributo que almacenará la conexión.
    private $con;

    // Constructor: obtiene la conexión activa desde la clase Conexion.
    public function __construct() {
        $this->con = Conexion::obtenerConexion();
    }

    // ========================================================
    // MÉTODO: AGREGAR CLIENTE
    // ========================================================
    public function agregarCliente($nombre, $apellido, $telefono, $correo, $direccion) {
        // Preparamos la consulta SQL con parámetros (?) para evitar inyección SQL.
        $sql = "INSERT INTO clientes (nombre, apellido, telefono, correo, direccion)
                VALUES (?, ?, ?, ?, ?)";
        // Preparamos la sentencia.
        $stmt = $this->con->prepare($sql);
        // Ejecutamos la sentencia con los valores proporcionados.
        return $stmt->execute([$nombre, $apellido, $telefono, $correo, $direccion]);
    }

    // ========================================================
    // MÉTODO: OBTENER TODOS LOS CLIENTES
    // ========================================================
    public function obtenerClientes() {
        // Consultamos todos los clientes en la base de datos.
        $sql = "SELECT * FROM clientes";
        // Ejecutamos la consulta y devolvemos todos los resultados como un arreglo asociativo.
        return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ========================================================
    // MÉTODO: OBTENER CLIENTE POR ID (para editar)
    // ========================================================
    public function obtenerClientePorId($id) {
        $sql = "SELECT * FROM clientes WHERE id_cliente=?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ========================================================
    // MÉTODO: ACTUALIZAR CLIENTE
    // ========================================================
    public function editarCliente($id, $nombre, $apellido, $telefono, $correo, $direccion) {
        $sql = "UPDATE clientes SET nombre=?, apellido=?, telefono=?, correo=?, direccion=? 
                WHERE id_cliente=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre, $apellido, $telefono, $correo, $direccion, $id]);
    }

    // ========================================================
    // MÉTODO: ELIMINAR CLIENTE
    // ========================================================
    public function eliminarCliente($id) {
        // Eliminamos un cliente por su ID.
        $sql = "DELETE FROM clientes WHERE id_cliente=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
