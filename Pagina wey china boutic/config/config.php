<?php
// Este archivo define constantes de configuración que se usan en todo el sistema.
// Dirección del servidor MySQL.
define('SERVIDOR', 'localhost');
// Usuario de la base de datos.
define('USUARIO', 'root');
// Contraseña del usuario MySQL (por defecto vacía en XAMPP).
define('PASSWORD', '');
// Nombre de la base de datos que utilizaremos.
define('BD', 'boutique_moda_urbana');

// Configuramos la zona horaria para evitar errores de tiempo en las funciones de fecha y hora.
date_default_timezone_set('America/Mexico_City');
?>