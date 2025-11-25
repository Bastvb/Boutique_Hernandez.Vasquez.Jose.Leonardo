<?php 
// ========================================================
// index.php
// --------------------------------------------------------
// Punto de entrada del sistema Boutique Moda Urbana.
// Contiene la bienvenida al usuario y el panel central de menú.
// ========================================================

// Incluimos el encabezado estándar (HTML <head>, CSS y menú superior)
include 'includes/header.php';
?>

<!-- ======================================================
     SECCIÓN PRINCIPAL DE BIENVENIDA
     ====================================================== -->
<main class="container">
    <section class="bienvenida">
        <h2>Bienvenido al Sistema de Información <br> Boutique Moda Urbana</h2>
        <p>
            Este sistema permite administrar la boutique de manera integral:
            gestión de productos, control de inventario, registro de clientes,
            ventas y generación de reportes. Utiliza el panel de menú
            para acceder a cada módulo.
        </p>
    </section>

    <!-- ======================================================
         INTEGRACIÓN DEL PANEL DE MENÚ
         ====================================================== -->
    <?php 
    // Incluimos el menú central con acceso a todos los CRUDs
    include 'menu.php'; 
    ?>

</main>

<?php 
// ========================================================
// Incluimos el pie de página común (cierra <body> y <html>)
// ========================================================
include 'includes/footer.php';
?>
