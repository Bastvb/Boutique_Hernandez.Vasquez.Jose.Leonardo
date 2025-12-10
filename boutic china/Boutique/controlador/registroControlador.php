<?php
session_start();
require_once '../modelo/conexion.php'; // Aquí está tu clase Conexion::conectar()

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario   = trim($_POST['usuario'] ?? '');
    $password  = $_POST['password']  ?? '';
    $password2 = $_POST['password2'] ?? '';
    $rol       = trim($_POST['rol'] ?? '');
    $estado    = $_POST['estado']    ?? 'Activo';

    // Validaciones básicas
    if (empty($usuario) || empty($password) || empty($password2)) {
        $_SESSION['error_registro'] = "Por favor, complete todos los campos.";
        header('Location: ../vista/registro.php');
        exit();
    }

    if ($password !== $password2) {
        $_SESSION['error_registro'] = "Las contraseñas no coinciden.";
        header('Location: ../vista/registro.php');
        exit();
    }

    try {
        $conexion = Conexion::conectar();

        // Verificar si el usuario ya existe
        $query = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE nombre_usuario = :usuario LIMIT 1");
        $query->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $query->execute();

        if ($query->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['error_registro'] = "El nombre de usuario ya está registrado.";
            header('Location: ../vista/registro.php');
            exit();
        }

        // Hashear contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar nuevo usuario
        $insert = $conexion->prepare("
            INSERT INTO usuarios (nombre_usuario, contraseña, rol, estado)
            VALUES (:usuario, :password, :rol, :estado)
        ");
        $insert->bindParam(':usuario',  $usuario, PDO::PARAM_STR);
        $insert->bindParam(':password', $hash,    PDO::PARAM_STR);
        $insert->bindParam(':rol',      $rol,     PDO::PARAM_STR);
        $insert->bindParam(':estado',   $estado,  PDO::PARAM_INT);

        if ($insert->execute()) {
            $_SESSION['mensaje_registro'] = "Usuario registrado correctamente.";
            header('Location: ../vista/registro.php');
            exit();
        } else {
            $_SESSION['error_registro'] = "Error al registrar el usuario.";
            header('Location: ../vista/registro.php');
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error_registro'] = "Error de base de datos: " . $e->getMessage();
        header('Location: ../vista/registro.php');
        exit();
    }

} else {
    // Si no es POST, regreso al formulario
    header('Location: ../vista/registro.php');
    exit();
}
