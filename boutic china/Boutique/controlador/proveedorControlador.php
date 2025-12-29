<?php
// Importamos el DAO
require_once __DIR__ . '/../modelo/proveedorDAO.php';

// Instanciamos el DAO de proveedores
$proveedorDAO = new ProveedorDAO();

// Acción recibida por GET
$accion = $_GET['accion'] ?? '';

switch ($accion) {

    // ========================================================
    // LISTAR PROVEEDORES
    // ========================================================
    case 'listar':
        $proveedores = $proveedorDAO->obtenerProveedores();
        include __DIR__ . '/../vista/proveedor.php';
        break;

    // ========================================================
    // AGREGAR PROVEEDOR
    // ========================================================
    case 'agregar':
        if ($_POST) {
            $proveedorDAO->agregarProveedor(
                $_POST['nombre_proveedor'],
                $_POST['contacto'],
                $_POST['telefono'],
                $_POST['email'],
                $_POST['direccion']
            );

            header('Location: proveedorControlador.php?accion=listar');
        }
        break;

    // ========================================================
    // EDITAR PROVEEDOR (cargar datos en formulario)
    // ========================================================
    case 'editar':
        $proveedor = $proveedorDAO->obtenerProveedor($_GET['id']);
        include __DIR__ . '/../vista/editarProveedor.php';
        break;

    // ========================================================
    // ACTUALIZAR PROVEEDOR
    // ========================================================
    case 'actualizar':
        if ($_POST) {
            $proveedorDAO->actualizarProveedor(
                $_POST['id_proveedor'],
                $_POST['nombre_proveedor'],
                $_POST['contacto'],
                $_POST['telefono'],
                $_POST['email'],
                $_POST['direccion']
            );

            header('Location: proveedorControlador.php?accion=listar');
        }
        break;

    // ========================================================
    // ELIMINAR PROVEEDOR
    // ========================================================
    case 'eliminar':
        $proveedorDAO->eliminarProveedor($_GET['id']);
        header('Location: proveedorControlador.php?accion=listar');
        break;

    // ========================================================
    // ACCIÓN POR DEFECTO
    // ========================================================
    default:
        $proveedores = $proveedorDAO->obtenerProveedores();
        include __DIR__ . '/../vista/proveedor.php';
        break;
}
?>
