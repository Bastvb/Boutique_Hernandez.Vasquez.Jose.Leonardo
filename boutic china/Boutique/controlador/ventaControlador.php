<?php
// Importamos la clase ProductoDAO para poder interactuar con la base de datos.
require_once __DIR__ . '/../modelo/ventaDAO.php';

// Instanciamos el DAO de productos.
$ventaDAO = new VentaDAO();

// Obtenemos la acción que el usuario envía desde la URL (por ejemplo: listar, agregar, eliminar).
$accion = $_GET['accion'] ?? ''; // Si no existe, queda vacío.

// Usamos un switch para decidir qué operación realizar según la acción recibida.
switch ($accion) {
    // ========================================================
    // LISTAR PRODUCTOS
    // ========================================================
    case 'listar':
        // Obtenemos todos los productos desde el DAO.
        $ventas = $ventaDAO->obtenerVentas();
        // Cargamos la vista de productos y le pasamos los datos.
        include __DIR__ . '/../vista/ventas.php';
        break;

    // ========================================================
    // AGREGAR PRODUCTO
    // ========================================================
    case 'agregar':
        // Verificamos si se enviaron datos desde un formulario.
        if ($_POST) {
            // Llamamos al método para agregar un nuevo producto.
            $ventaDAO->agregarVenta(
                $_POST['id_venta'],
                $_POST['fecha_venta'],
                $_POST['id_cliente'],
                $_POST['id_empleado'],
                $_POST['total_venta'],
                $_POST['metodo_pago']
            );
            // Redirigimos al listado de productos después de agregarlo.
            header('Location: ventaControlador.php?accion=listar');
        }
        break;

    // ========================================================
    // ELIMINAR PRODUCTO
    // ========================================================
    case 'eliminar':
        // Obtenemos el ID desde la URL y eliminamos el producto.
        $ventaDAO->eliminarVenta($_GET['id']);
        // Redirigimos nuevamente al listado.
        header('Location: ventaControlador.php?accion=listar');
        break;
}
?>