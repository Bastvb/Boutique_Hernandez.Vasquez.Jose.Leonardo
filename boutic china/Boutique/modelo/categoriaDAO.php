<?php
// Incluimos el archivo de conexión para acceder a la base de datos.
require_once 'conexion.php';

class CategoriaDAO {
    // Conexión PDO
    private $con;

    public function __construct() {
        $this->con = Conexion::obtenerConexion();
    }

    // ========================================================
    // AGREGAR CATEGORÍA
    // ========================================================
    public function agregarCategoria($nombre_categoria, $descripcion) {
        // Tabla: categorias(id_categoria, nombre_categoria, descripcion)
        $sql = "INSERT INTO categorias (nombre_categoria, descripcion)
                VALUES (?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre_categoria, $descripcion]);
    }

    // ========================================================
    // OBTENER TODAS LAS CATEGORÍAS
    // ========================================================
    public function obtenerCategorias() {
        $sql = "SELECT * FROM categorias";
        return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ========================================================
    // OBTENER UNA CATEGORÍA POR ID
    // ========================================================
    public function obtenerCategoriaPorId($id) {
        $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ========================================================
    // ACTUALIZAR CATEGORÍA
    // ========================================================
    public function actualizarCategoria($id, $nombre_categoria, $descripcion) {
        $sql = "UPDATE categorias
                SET nombre_categoria = ?, descripcion = ?
                WHERE id_categoria = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre_categoria, $descripcion, $id]);
    }

    // ========================================================
    // ELIMINAR CATEGORÍA
    // ========================================================
    public function eliminarCategoria($id) {
        $sql = "DELETE FROM categorias WHERE id_categoria = ?";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$id]);
    }
}

