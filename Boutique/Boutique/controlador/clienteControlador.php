<?php
// Importamos la clase ClienteDAO para poder interactuar con la base de datos.
require_once __DIR__ . '/../modelo/clienteDAO.php';

// Instanciamos el DAO de clientes.
$clienteDAO = new ClienteDAO();

// Obtenemos la acción que el usuario envía desde la URL (por ejemplo: listar, agregar, eliminar).
$accion = $_GET['accion'] ?? ''; // Si no existe, queda vacío.

// Dependiendo de la acción recibida, ejecutamos la operación correspondiente
switch ($accion) {

    // ========================================================
    // LISTAR CLIENTES
    // ========================================================
    case 'listar':
        // Obtenemos todos los clientes desde el DAO.
        $clientes = $clienteDAO->obtenerClientes();
        // Cargamos la vista de clientes y le pasamos los datos.
        include __DIR__ . '/../vista/cliente.php';
        break;

    // ========================================================
    // AGREGAR CLIENTE
    // ========================================================
    case 'agregar':
        // Verificamos si se enviaron datos desde un formulario.
        if ($_POST) {
            // Llamamos al método para agregar un nuevo cliente.
            $clienteDAO->agregarCliente(
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['direccion']
            );
            // Redirigimos al listado de clientes después de agregarlo.
            header('Location: clienteControlador.php?accion=listar');
        } else {
            // Cargamos la vista del formulario para registrar cliente
            include __DIR__ . '/../vista/clienteAgregar.php';
        }
        break;

    // ========================================================
    // ELIMINAR CLIENTE
    // ========================================================
    case 'eliminar':
        // Obtenemos el ID desde la URL y eliminamos el cliente.
        if (isset($_GET['id'])) {
            $clienteDAO->eliminarCliente($_GET['id']);
        }
        // Redirigimos nuevamente al listado.
        header('Location: clienteControlador.php?accion=listar');
        break;

    // ========================================================
    // EDITAR CLIENTE
    // ========================================================
    case 'editar':
        if ($_POST) {
            // Guardamos los cambios realizados
            $clienteDAO->editarCliente(
                $_POST['id'],
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['direccion']
            );
            header('Location: clienteControlador.php?accion=listar');
        } else {
            // Cargamos datos del cliente a editar
            $cliente = $clienteDAO->obtenerClientePorId($_GET['id']);
            include __DIR__ . '/../vista/clienteEditar.php';
        }
        break;

    // ========================================================
    // SI NO HAY ACCIÓN, REDIRIGIR A LISTAR
    // ========================================================
    default:
        header('Location: clienteControlador.php?accion=listar');
        break;
}
?>
