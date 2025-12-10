<?php
// Importamos la clase ReporteDAO para poder interactuar con la base de datos.
require_once __DIR__ . '/../modelo/reporteDAO.php';

// Instanciamos el DAO de reportes.
$reporteDAO = new ReporteDAO();

// Obtenemos la acción que el usuario envía desde la URL (por ejemplo: listar).
$accion = $_GET['accion'] ?? 'listar';

// Usamos un switch para decidir qué operación realizar según la acción recibida.
switch ($accion) {

    // ========================================================
    // LISTAR REPORTE DIARIO
    // ========================================================
    case 'listar':
        // Fecha por GET (reporteControlador.php?accion=listar&fecha=2025-12-01)
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        // Obtenemos ventas diarias agrupadas por producto.
        $ventasDiarias = $reporteDAO->obtenerVentasDiarias($fecha);
        // Obtenemos resumen general del día.
        $resumenDia    = $reporteDAO->obtenerResumenDia($fecha);

        // (Opcional) productos con stock actual.
        // $productosStock = $reporteDAO->obtenerProductosConStock();

        // Cargamos la vista de reporte y le pasamos los datos.
        include __DIR__ . '/../vista/reporte.php';
        break;

    default:
        // Por si quieres manejar otra acción en el futuro.
        $fecha = date('Y-m-d');
        $ventasDiarias = $reporteDAO->obtenerVentasDiarias($fecha);
        $resumenDia    = $reporteDAO->obtenerResumenDia($fecha);
        include __DIR__ . '/../vista/reporte.php';
        break;
}
