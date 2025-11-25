<?php 
// Incluimos el encabezado común a todas las páginas.
include 'includes/header.php'; 
?>

<!-- Título de la sección -->
<h2>Gestión de Clientes</h2>

<!-- Creamos una tabla para mostrar los productos -->
<table border="1" cellpadding="8">
    <tr>
        <!-- Encabezados de columna -->
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Direccion</th>
        <th>Acciones</th>
    </tr>

    <!-- Recorremos el arreglo de productos y generamos una fila por cada uno -->
    <?php foreach ($clientes as $p): ?>
    <tr>
        <td><?= $p['id_cliente'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['apellido'] ?></td>
        <td>$<?= $p['telefono']?></td>
        <td>$<?= $p['email']?></td>
        <td><?= $p['direccion'] ?></td>
        <td>
            <!-- Enlace que ejecuta la acción de eliminar -->
            <a href="../controlador/clienteControlador.php?accion=eliminar&id=<?= $p['id_cliente'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php 
// Incluimos el pie de página común.
include 'includes/footer.php'; 
?>