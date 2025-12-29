<?php
// Importamos el DAO
require_once __DIR__ . '/../modelo/categoriaDAO.php';

$categoriaDAO = new CategoriaDAO();

// Acción recibida por GET
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {

    // ========================================================
    // LISTAR CATEGORÍAS
    // ========================================================
    case 'listar':
        $categorias = $categoriaDAO->obtenerCategorias();
        include __DIR__ . '/../vista/categoria.php';
        break;

    // ========================================================
    // AGREGAR CATEGORÍA
    // (muestra formulario o guarda, según método)
    // ========================================================
    case 'agregar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoriaDAO->agregarCategoria(
                $_POST['nombre_categoria'],
                $_POST['descripcion']
            );
            header('Location: categoriaControlador.php?accion=listar');
            exit;
        } else {
            include __DIR__ . '/../vista/agregarCategoria.php';
        }
        break;

    // ========================================================
    // EDITAR CATEGORÍA (cargar datos en formulario)
    // ========================================================
    case 'editar':
        $categoria = $categoriaDAO->obtenerCategoriaPorId($_GET['id']);
        include __DIR__ . '/../vista/editarCategoria.php';
        break;

    // ========================================================
    // ACTUALIZAR CATEGORÍA
    // ========================================================
    case 'actualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoriaDAO->actualizarCategoria(
                $_POST['id_categoria'],
                $_POST['nombre_categoria'],
                $_POST['descripcion']
            );
            header('Location: categoriaControlador.php?accion=listar');
            exit;
        }
        break;

    // ========================================================
    // ELIMINAR CATEGORÍA
    // ========================================================
    case 'eliminar':
        $categoriaDAO->eliminarCategoria($_GET['id']);
        header('Location: categoriaControlador.php?accion=listar');
        exit;

    // ========================================================
    // ACCIÓN POR DEFECTO
    // ========================================================
    default:
        $categorias = $categoriaDAO->obtenerCategorias();
        include __DIR__ . '/../vista/categoria.php';
        break;
}
