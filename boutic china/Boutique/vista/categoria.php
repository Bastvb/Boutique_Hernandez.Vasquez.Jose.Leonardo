<?php 
// Incluimos el encabezado común a todas las páginas.
include 'includes/header.php'; 
?>

<h2>Gestión de categorias</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Acciones</th>
    </tr>

    <!-- Recorremos el arreglo y generamos una fila por cada categoría -->
    <?php foreach ($categorias as $p): ?>
    <tr>
        <td><?= $p['id_categoria'] ?></td>
        <td><?= $p['nombre_categoria'] ?></td>
        <td><?= $p['descripcion'] ?></td>
        <td>
            <a href="../controlador/categoriaControlador.php?accion=eliminar&id=<?= $p['id_categoria'] ?>">
                Eliminar
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php 
include 'includes/footer.php'; 
?>
