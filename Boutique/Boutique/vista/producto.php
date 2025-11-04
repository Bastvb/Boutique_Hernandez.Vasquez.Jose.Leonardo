<?php 
// Incluimos el encabezado común a todas las páginas.
include 'includes/header.php'; 
?>

<!-- Título de la sección -->
<h2>Gestión de Productos</h2>

<!-- Creamos una tabla para mostrar los productos -->
<table border="1" cellpadding="8">
    <tr>
        <!-- Encabezados de columna -->
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Precio Venta</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>

    <!-- Recorremos el arreglo de productos y generamos una fila por cada uno -->
    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= $p['id_producto'] ?></td>
        <td><?= $p['nombre_producto'] ?></td>
        <td><?= $p['nombre_categoria'] ?></td>
        <td>$<?= number_format($p['precio_venta'], 2) ?></td>
        <td><?= $p['stock'] ?></td>
        <td>
            <!-- Enlace que ejecuta la acción de eliminar -->
            <a href="../controlador/productoControlador.php?accion=eliminar&id=<?= $p['id_producto'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php 
// Incluimos el pie de página común.
include 'includes/footer.php'; 
?>
