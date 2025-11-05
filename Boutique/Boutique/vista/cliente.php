<?php
?>
    <!-- ======================================================
         TARJETAS DE ACCESO RÁPIDO A LOS CRUD
         ====================================================== -->
    <div class="modulos">
        // ...existing code...
    </div>

    <!-- ======================================================
         TABLAS RESUMEN
         ====================================================== -->
    <div class="resumen-tablas">
        <!-- Tabla Resumen de Clientes -->
        <div class="tabla-resumen">
            <h3>Clientes Recientes</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Última Compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir la conexión a la base de datos
                    require_once('../modelo/Conexion.php');
                    
                    // Consulta para obtener los últimos 5 clientes
                    $sql = "SELECT id, nombre, email, ultima_compra FROM clientes ORDER BY ultima_compra DESC LIMIT 5";
                    $resultado = $conexion->query($sql);
                    
                    while($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['nombre']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['ultima_compra']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla Resumen de Productos -->
        <div class="tabla-resumen">
            <h3>Productos con Bajo Stock</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener productos con stock bajo (menos de 10 unidades)
                    $sql = "SELECT id, nombre, stock, precio FROM productos WHERE stock < 10 ORDER BY stock ASC LIMIT 5";
                    $resultado = $conexion->query($sql);
                    
                    while($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['nombre']."</td>";
                        echo "<td>".$row['stock']."</td>";
                        echo "<td>$".$row['precio']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>