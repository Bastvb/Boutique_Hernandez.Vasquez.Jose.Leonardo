<?php
// Incluimos el archivo de conexión para acceder a la base de datos.
require_once 'conexion.php';

// Creamos la clase ProductoDAO (Data Access Object) para manejar la tabla "productos".
class VentaDAO {
    // Atributo que almacenará la conexión.
    private $con;

    // Constructor: obtiene la conexión activa desde la clase Conexion.
    public function __construct() {
        $this->con = Conexion::obtenerConexion();
    }

    // ========================================================
    // MÉTODO: AGREGAR PRODUCTO
    // ========================================================
    public function agregarVenta($nombre, $descripcion, $precio_compra, $precio_venta, $stock, $id_categoria) {
        // Preparamos la consulta SQL con parámetros (?) para evitar inyección SQL.
        $sql = "INSERT INTO ventas (id_venta, fecha_venta, id_cliente, id_empleado, total_venta, metodo_pago)
                VALUES (?, ?, ?, ?, ?, ?)";
        // Preparamos la sentencia.
        $stmt = $this->con->prepare($sql);
        // Ejecutamos la sentencia con los valores proporcionados.
        return $stmt->execute([$nombre, $descripcion, $precio_compra, $precio_venta, $stock, $id_categoria]);
    }

    // ========================================================
    // MÉTODO: OBTENER TODOS LOS PRODUCTOS
    // ========================================================
    public function obtenerVentas() {
        // Consulta con INNER JOIN para traer la categoría de cada producto.
        $sql = "SELECT * FROM ventas";
                
        // Ejecutamos la consulta y devolvemos todos los resultados como un arreglo asociativo.
        return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        
    }

    // ========================================================
    // MÉTODO: ACTUALIZAR PRODUCTO
    // ========================================================
    public function actualizarVenta($id, $nombre, $descripcion, $precio_venta, $stock) {
        // Sentencia SQL con parámetros para actualizar los datos del producto.
        $sql = "UPDATE productos SET nombre_producto=?, descripcion=?, precio_venta=?, stock=? WHERE id_producto=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio_venta, $stock, $id]);
    }

    // ========================================================
    // MÉTODO: ELIMINAR PRODUCTO
    // ========================================================
    public function eliminarVenta($id) {
        // Eliminamos un producto por su ID.
        $sql = "DELETE FROM ventas WHERE id_venta=?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
