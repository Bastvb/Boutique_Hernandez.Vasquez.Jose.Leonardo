
<!-- ======================================================
     SECCIÓN PRINCIPAL DEL MENÚ
     ====================================================== -->
<section class="dashboard">
    <h2>Panel de Gestión - Boutique Moda Urbana</h2>
    <p>
        Desde este panel puedes acceder a los módulos principales del sistema.
        Cada sección permite realizar operaciones básicas de CRUD: Crear, Leer,
        Actualizar y Eliminar registros según corresponda.
    </p>

    <!-- ======================================================
         TARJETAS DE ACCESO RÁPIDO A LOS CRUD
         ====================================================== -->
    <div class="modulos">

        <!-- Productos -->
        <div class="tarjeta">
            <h3>Productos</h3>
            <p>Gestiona el catálogo de productos, stock, precios y categorías.</p>
            <a class="boton" href="../controlador/productoControlador.php?accion=listar">Administrar</a>
        </div>

        <!-- Categorías -->
        <div class="tarjeta">
            <h3>Categorías</h3>
            <p>Alta, modificación y eliminación de categorías de productos.</p>
            <a class="boton" href="../controlador/categoriaControlador.php?accion=listar">Administrar</a>
        </div>

        <!-- Clientes -->
        <div class="tarjeta">
            <h3>Clientes</h3>
            <p>Gestión de información de clientes y historial de compras.</p>
            <a class="boton" href="../controlador/clienteControlador.php?accion=listar">Administrar</a>
        </div>

        <!-- Ventas -->
        <div class="tarjeta">
            <h3>Ventas</h3>
            <p>Registrar ventas, consultar historial y generar tickets.</p>
            <a class="boton" href="../controlador/ventaControlador.php?accion=listar">Administrar</a>
        </div>

        <!-- Reportes -->
        <div class="tarjeta">
            <h3>Reportes</h3>
            <p>Genera reportes de inventario, ventas diarias y desempeño.</p>
            <a class="boton" href="../controlador/reporteControlador.php?accion=generar">Generar</a>
        </div>

    </div>
</section>
