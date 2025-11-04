<?php
// Importamos la clase ProductoDAO para poder interactuar con la base de datos.
require_once __DIR__ . '/../modelo/productoDAO.php';

// Instanciamos el DAO de productos.
$productoDAO = new ProductoDAO();

// Obtenemos la acción que el usuario envía desde la URL (por ejemplo: listar, agregar, eliminar).
$accion = $_GET['accion'] ?? ''; // Si no existe, queda vacío.

// Usamos un switch para decidir qué operación realizar según la acción recibida.
switch ($accion) {
    // ========================================================
    // LISTAR PRODUCTOS
    // ========================================================
    case 'listar':
        // Obtenemos todos los productos desde el DAO.
        $productos = $productoDAO->obtenerProductos();
        // Cargamos la vista de productos y le pasamos los datos.
        include __DIR__ . '/../vista/producto.php';
        break;

    // ========================================================
    // AGREGAR PRODUCTO
    // ========================================================
    case 'agregar':
        // Verificamos si se enviaron datos desde un formulario.
        if ($_POST) {
            // Llamamos al método para agregar un nuevo producto.
            $productoDAO->agregarProducto(
                $_POST['nombre'],
                $_POST['descripcion'],
                $_POST['precio_compra'],
                $_POST['precio_venta'],
                $_POST['stock'],
                $_POST['id_categoria']
            );
            // Redirigimos al listado de productos después de agregarlo.
            header('Location: productoControlador.php?accion=listar');
        }
        break;

    // ========================================================
    // ELIMINAR PRODUCTO
    // ========================================================
    case 'eliminar':
        // Obtenemos el ID desde la URL y eliminamos el producto.
        $productoDAO->eliminarProducto($_GET['id']);
        // Redirigimos nuevamente al listado.
        header('Location: productoControlador.php?accion=listar');
        break;
}
?>
