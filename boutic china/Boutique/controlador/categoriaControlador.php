<?php
// Importamos el DAO
require_once __DIR__ . '/../modelo/CategoriaDAO.php';

// Instanciamos el DAO de proveedores
$categoriaDAO = new CategoriaDAO();

// Acción recibida por GET
$accion = $_GET['accion'] ?? '';

switch ($accion) {

    // ========================================================
    // LISTAR PROVEEDORES
    // ========================================================
    case 'listar':
        $categorias = $categoriaDAO->obtenerCategoria();
        include __DIR__ . '/../vista/categoria.php';
        break;

    // ========================================================
    // AGREGAR PROVEEDOR
    // ========================================================
    case 'agregar':
        if ($_POST) {
            $categoriaDAO->agregarCategoria(
                $_POST['nombre_proveedor'],
                $_POST['contacto'],
                $_POST['telefono'],
                $_POST['email'],
                $_POST['direccion']
            );

            header('Location: categoriaControlador.php?accion=listar');
        }
        break;

    // ========================================================
    // EDITAR PROVEEDOR (cargar datos en formulario)
    // ========================================================
    case 'editar':
        $categoria = $categoriaDAO->obtenerCategoria($_GET['id']);
        include __DIR__ . '/../vista/editarCategoria.php';
        break;

    // ========================================================
    // ACTUALIZAR PROVEEDOR
    // ========================================================
    case 'actualizar':
        if ($_POST) {
            $categoriaDAO->actualizarCategoria(
                $_POST['id_proveedor'],
                $_POST['nombre_proveedor'],
                $_POST['contacto'],
                $_POST['telefono'],
                $_POST['email'],
                $_POST['direccion']
            );

            header('Location: categoriaControlador.php?accion=listar');
        }
        break;

    // ========================================================
    // ELIMINAR PROVEEDOR
    // ========================================================
    case 'eliminar':
        $categoriaDAO->eliminarCategoria($_GET['id']);
        header('Location: categoriaControlador.php?accion=listar');
        break;

    // ========================================================
    // ACCIÓN POR DEFECTO
    // ========================================================
    default:
        $categorias = $categoriaDAO->obtenerCategoria();
        include __DIR__ . '/../vista/categoria.php';
        break;
}
?>
