<?php
// Incluimos el archivo de conexión para acceder a la base de datos.
require_once 'conexion.php';

// Creamos la clase ProductoDAO (Data Access Object) para manejar la tabla "productos".
class ProductoDAO {
    // Atributo que almacenará la conexión.
    private $con;

    // Constructor: obtiene la conexión activa desde la clase Conexion.
    public function __construct() {
        $this->con = Conexion::obtenerConexion();
    }

    // ========================================================
    // MÉTODO: AGREGAR PRODUCTO
    // ========================================================
    public function agregarProducto($nombre, $descripcion, $precio_compra, $precio_venta, $stock, $id_categoria) {
        // Preparamos la consulta SQL con parámetros (?) para evitar inyección SQL.
        $sql = "INSERT INTO productos (nombre_producto, descripcion, precio_compra, precio_venta, stock, id_categoria)
                VALUES (?, ?, ?, ?, ?, ?)";
        // Preparamos la sentencia.
        $stmt = $this->con->prepare($sql);
        // Ejecutamos la sentencia con los valores proporcionados.
        return $stmt->execute([$nombre, $descripcion, $precio_compra, $precio_venta, $stock, $id_categoria]);
    }

    // ========================================================
    // MÉTODO: OBTENER TODOS LOS PRODUCTOS
    // ========================================================
    public function obtenerProductos() {
        // Consulta con INNER JOIN para traer la categoría de cada producto.
        $sql = "SELECT p.*, c.nombre_categoria 
                FROM productos p 
                INNER JOIN categorias c ON p.id_categoria = c.id_categoria";
        // Ejecutamos la consulta y devolvemos todos los resultados como un arreglo asociativo.
        return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }




    // ========================================================
    // MÉTODO: ACTUALIZAR PRODUCTO
    // ========================================================
    public function actualizarProducto($id, $nombre, $descripcion, $precio_venta, $stock) {
        // Sentencia SQL con parámetros para actualizar los datos del producto.
        $sql = "UPDATE productos SET nombre_producto=?, descripcion=?, precio_venta=?, stock=? WHERE id_producto=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio_venta, $stock, $id]);
    }

    // ========================================================
    // MÉTODO: ELIMINAR PRODUCTO
    // ========================================================
    public function eliminarProducto($id) {
        // Eliminamos un producto por su ID.
        $sql = "DELETE FROM productos WHERE id_producto=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
