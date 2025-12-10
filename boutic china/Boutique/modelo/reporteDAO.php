<?php
require_once 'conexion.php';

class ReporteDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::obtenerConexion();
    }

    // ==============================
    // VENTAS DIARIAS POR PRODUCTO
    // ==============================
    public function obtenerVentasDiarias($fecha = null) {
        $fecha = $fecha ?: date('Y-m-d');

        $sql = "SELECT 
                    p.id_producto, -- id de producto 
                    p.nombre_producto, -- nombre del producto
                    p.codigo_barras, -- 
                    c.nombre_categoria,
                    p.stock,
                    SUM(dv.cantidad)  AS cantidad_vendida, -- total de piezas vendidas en el dia 
                    SUM(dv.subtotal)  AS total_vendido -- total de dinero gando en el dia
                -- tabla donde viene la informacion    
                FROM detalle_ventas dv
                -- unimos con la tabla ventas para poder filtrar por fecha de venta
                INNER JOIN ventas v ON dv.id_venta   = v.id_venta
                -- unimos con la tabla productos para traer la informacion del producto (nombre, codigo, stock)
                INNER JOIN productos p ON dv.id_producto = p.id_producto
                -- unimos con la categoria para obtener el nombre de la categoria (puede existir o no por eso se pone el LEFT)
                LEFT JOIN categorias c ON p.id_categoria = c.id_categoria

                -- filtro para la fecha, el ? se cambia por la facha que le mandes desde el php
                WHERE DATE(v.fecha_venta) = ?
                -- agrupamos lo que queremos sumar 
                GROUP BY 
                    p.id_producto,
                    p.nombre_producto,
                    p.codigo_barras,
                    c.nombre_categoria,
                    p.stock
                -- ordenamos alfabeticamente
                ORDER BY p.nombre_producto ASC";

        $stmt = $this->con->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==============================
    // RESUMEN DEL DÍA
    // ==============================
    public function obtenerResumenDia($fecha = null) {
        $fecha = $fecha ?: date('Y-m-d');

        $sql = "SELECT 
                    COUNT(DISTINCT v.id_venta) AS total_tickets, -- nose w
                    SUM(dv.cantidad) AS total_articulos,
                    SUM(dv.subtotal) AS total_venta
                FROM detalle_ventas dv
                INNER JOIN ventas v ON dv.id_venta = v.id_venta
                WHERE DATE(v.fecha_venta) = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->execute([$fecha]);
        $resumen = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'total_tickets'   => (int) ($resumen['total_tickets']   ?? 0), 
            'total_articulos' => (int) ($resumen['total_articulos'] ?? 0), // 
            'total_venta'     => (float)($resumen['total_venta']    ?? 0),
        ];
    }
}
?>
