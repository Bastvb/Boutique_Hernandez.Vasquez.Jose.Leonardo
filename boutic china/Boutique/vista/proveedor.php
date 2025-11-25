<?php 
// Incluimos el encabezado común a todas las páginas.
include 'includes/header.php'; 
?>

<h2>Gestión de Proveedores</h2>

<!-- Tabla de proveedores -->
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Contacto</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($proveedores as $p): ?>
    <tr>
        <td><?= $p['id_proveedor'] ?></td>
        <td><?= $p['nombre_proveedor'] ?></td>
        <td><?= $p['contacto'] ?></td>
        <td><?= $p['telefono'] ?></td>
        <td><?= $p['email'] ?></td>
        <td><?= $p['direccion'] ?></td>
        <td>
            <a href="../controlador/proveedorControlador.php?accion=eliminar&id=<?= $p['id_proveedor'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php 
// Incluimos el pie de página común.
include 'includes/footer.php'; 
?>

