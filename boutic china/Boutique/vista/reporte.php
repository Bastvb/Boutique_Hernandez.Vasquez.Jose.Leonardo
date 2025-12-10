<?php
// Por si no vienen definidas las variables (seguridad mínima)
$fecha        = $fecha        ?? date('Y-m-d');
$ventasDiarias = $ventasDiarias ?? [];
$resumenDia   = $resumenDia   ?? ['total_tickets' => 0, 'total_articulos' => 0, 'total_venta' => 0];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas Diarias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">

    <h1 class="mb-4">Reporte de ventas diarias</h1>

    <!-- Filtro por fecha -->
    <form class="row g-3 mb-4" method="GET" action="../controlador/reporteControlador.php">
        <input type="hidden" name="accion" value="listar">
        <div class="col-auto">
            <label for="fecha" class="col-form-label">Fecha:</label>
        </div>
        <div class="col-auto">
            <input type="date" id="fecha" name="fecha" class="form-control"
                   value="<?php echo htmlspecialchars($fecha); ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Ver reporte</button>
        </div>
    </form>

    <!-- Resumen del día -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Resumen del día (<?php echo htmlspecialchars($fecha); ?>)</h5>
            <p><strong>Tickets (ventas):</strong> <?php echo (int)$resumenDia['total_tickets']; ?></p>
            <p><strong>Artículos vendidos:</strong> <?php echo (int)$resumenDia['total_articulos']; ?></p>
            <p><strong>Total vendido:</strong> $<?php echo number_format((float)$resumenDia['total_venta'], 2); ?></p>
        </div>
    </div>

    <!-- Tabla de ventas diarias por producto -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Productos vendidos</h5>

            <?php if (empty($ventasDiarias)): ?>
                <p>No hay ventas registradas para esta fecha.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Producto</th>
                                <th>Código barras</th>
                                <th>Categoría</th>
                                <th>Stock actual</th>
                                <th>Cantidad vendida</th>
                                <th>Total vendido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventasDiarias as $fila): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['id_producto']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['nombre_producto']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['codigo_barras']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['nombre_categoria']); ?></td>
                                    <td><?php echo (int)$fila['stock']; ?></td>
                                    <td><?php echo (int)$fila['cantidad_vendida']; ?></td>
                                    <td>$<?php echo number_format((float)$fila['total_vendido'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
