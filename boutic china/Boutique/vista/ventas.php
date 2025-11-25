<?php 
// Incluimos el encabezado común a todas las páginas.
include 'includes/header.php'; 
?>

<!-- Título de la sección -->
<h2>Gestión de Ventas</h2>

<!-- Creamos una tabla para mostrar los productos -->
<table border="1" cellpadding="8">
    <tr>
        <!-- Encabezados de columna -->
        <th>ID</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Empleado</th>
        <th>Total de venta</th>
        <th>Metodo de pago</th>
        <th>Acciones</th>
    </tr>

    <!-- Recorremos el arreglo de productos y generamos una fila por cada uno -->
    <?php foreach ($ventas as $p): ?>
    <tr>
        <td><?= $p['id_venta'] ?></td>
        <td><?= $p['fecha_venta'] ?></td>
        <td><?= $p['id_cliente'] ?></td>
        <td>$<?=$p['id_empleado'] ?></td>
        <td><?= number_format($p['total_venta']) ?></td>
        <td><?= $p['metodo_pago'] ?></td>
        <td>
            <!-- Enlace que ejecuta la acción de eliminar -->
            <a href="../controlador/ventaControlador.php?accion=eliminar&id=<?= $p['id_venta'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php 
// Incluimos el pie de página común.
include 'includes/footer.php'; 
?>
