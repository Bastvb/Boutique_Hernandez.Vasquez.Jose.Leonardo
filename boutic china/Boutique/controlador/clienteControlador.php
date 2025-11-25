<?php
// Importamos la clase ProductoDAO para poder interactuar con la base de datos.
require_once __DIR__ . '/../modelo/clienteDAO.php';

// Instanciamos el DAO de productos.
$clienteDAO = new ClienteDAO();

// Obtenemos la acción que el usuario envía desde la URL (por ejemplo: listar, agregar, eliminar).
$accion = $_GET['accion'] ?? ''; // Si no existe, queda vacío.

// Usamos un switch para decidir qué operación realizar según la acción recibida.
switch ($accion) {
    // ========================================================
    // LISTAR PRODUCTOS
    // ========================================================
    case 'listar':
        // Obtenemos todos los productos desde el DAO.
        $clientes = $clienteDAO->obtenerCliente();
        // Cargamos la vista de productos y le pasamos los datos.
        include __DIR__ . '/../vista/cliente.php';
        break;

    // ========================================================
    // AGREGAR PRODUCTO
    // ========================================================
    case 'agregar':
        // Verificamos si se enviaron datos desde un formulario.
        if ($_POST) {
            // Llamamos al método para agregar un nuevo producto.
            $ClienteDAO->agregarCliente(
                $_POST['id_cliente'],
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['telefono'],
                $_POST['email'],
                $_POST['direccion']
            );
            // Redirigimos al listado de productos después de agregarlo.
            header('Location: clienteControlador.php?accion=listar');
        }
        break;

    // ========================================================
    // ELIMINAR PRODUCTO
    // ========================================================
    case 'eliminar':
        // Obtenemos el ID desde la URL y eliminamos el producto.
        $clienteDAO->eliminarCliente($_GET['id']);
        // Redirigimos nuevamente al listado.
        header('Location: productoControlador.php?accion=listar');
        break;
}
?>
