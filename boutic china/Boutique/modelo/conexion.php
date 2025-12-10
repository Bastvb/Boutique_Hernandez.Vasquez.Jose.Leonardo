<?php
// Incluimos el archivo de configuración donde están las constantes de conexión.
require_once __DIR__ . '/../config/config.php';

// Creamos una clase llamada "Conexion" para manejar la conexión a la base de datos.
class Conexion {
    // Atributo estático para mantener una sola instancia (patrón Singleton).
    private static $instancia = null;
    
    // Variable que almacenará el objeto PDO.
    private $conexion;

    // Constructor privado para que nadie más pueda crear una instancia directamente.
    private function __construct() {
        try {
            // Creamos la conexión usando PDO con los parámetros definidos en config.php.
            $this->conexion = new PDO(
                "mysql:host=" . SERVIDOR . ";port=3306;dbname=" . BD, // se esecifico el puerto 3307
                USUARIO,
                PASSWORD
            );

            // Configuramos el modo de errores de PDO para que lance excepciones.
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si hay un error, detenemos la ejecución y mostramos el mensaje.
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Método público que devuelve una única conexión a la base de datos.
    public static function obtenerConexion() {
        // Si aún no se ha creado la conexión, se crea una nueva.
        if (self::$instancia == null) {
            self::$instancia = new Conexion();
        }
        // Devolvemos la conexión activa.
        return self::$instancia->conexion;
    }

    public static function conectar(){
        return self::obtenerConexion();
    }
}
?>
