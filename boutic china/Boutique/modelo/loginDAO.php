<?php 
require_once 'conexion.php';

class LoginDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::obtenerConexion();
    }

    // busca usuarios por nombre
    public function obtenerUsuariosPorNombre($nombreUsuario)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :usuario LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':usuario', $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // verifacion de credenciales
    public function verificarCredenciales($nombreUsuario, $password)
    {
        $usuarioDB = $this->obtenerUsuariosPorNombre($nombreUsuario);
        if ($usuarioDB && password_verify($password, $usuarioDB['contraseña'])) {
            return $usuarioDB;
        }
        return false;
    } 
}
