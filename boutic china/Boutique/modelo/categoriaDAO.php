<?php
// Incluimos el archivo de conexión para acceder a la base de datos.
require_once 'conexion.php';

// Creamos la clase ProductoDAO (Data Access Object) para manejar la tabla "productos".
class CategoriaDAO {
    // Atributo que almacenará la conexión.
    private $con;

    // Constructor: obtiene la conexión activa desde la clase Conexion.
    public function __construct() {
        $this->con = Conexion::obtenerConexion();
    }

    // ========================================================
    // MÉTODO: AGREGAR PRODUCTO
    // ========================================================
    public function agregarCategoria($id_cliente, $nombre, $apellido, $telefono, $email, $direccion) {
        // Preparamos la consulta SQL con parámetros (?) para evitar inyección SQL.
        $sql = "INSERT INTO cliente (id_cliente, nombre, apellido, email, direccion)
                VALUES (?, ?, ?, ?, ?, ?)";
        // Preparamos la sentencia.
        $stmt = $this->con->prepare($sql);
        // Ejecutamos la sentencia con los valores proporcionados.
        return $stmt->execute([$id_cliente, $nombre, $apellido, $telefono, $email, $direccion]);
    }

    // ========================================================
    // MÉTODO: OBTENER TODOS LOS PRODUCTOS
    // ========================================================
    public function obtenerCategoria() {
        // Consulta con INNER JOIN para traer la categoría de cada producto.
        $sql = "SELECT * FROM clientes";
        // Ejecutamos la consulta y devolvemos todos los resultados como un arreglo asociativo.
        return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ========================================================
    // MÉTODO: ACTUALIZAR PRODUCTO
    // ========================================================
    public function actualizarCategoria($id, $nombre, $descripcion, $precio_venta, $stock) {
        // Sentencia SQL con parámetros para actualizar los datos del producto.
        $sql = "UPDATE clientes SET nombre_producto=?, descripcion=?, precio_venta=?, stock=? WHERE id_producto=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio_venta, $stock, $id]);
    }

    // ========================================================
    // MÉTODO: ELIMINAR PRODUCTO
    // ========================================================
    public function eliminarCategoria($id) {
        // Eliminamos un producto por su ID.
        $sql = "DELETE FROM clientes WHERE id_cliente=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
