<?php
// Incluimos el encabezado comun a todos los paginas
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
    <?php foreach ($clientes as $c): ?>
    <tr>
        <td><?= $c['id_Cliente'] ?></td>
        <td><?= $c['nombre'] ?></td>
        <td><?= $c['apellido'] ?></td>
        <td><?= $c['telefono'] ?></td>
        <td><?= $c['email'] ?></td>                
        <td><?= $c['direccion'] ?></td>
        <td>
            <!-- Enlace que ejecuta la acción de eliminar -->
            <a href="../controlador/clienteControlador.php?accion=eliminar&id=<?= $p['id_cliente'] ?>">Eliminar</a>
        </td>p
    </tr>
    <?php endforeach; ?>
</table>

<?php 
// Incluimos el pie de página común.
include 'includes/footer.php'; 
?>