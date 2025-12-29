<?php

session_start();
require_once __DIR__ . '/../modelo/loginDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    
    if (empty($usuario) || empty($password)) {
        $_SESSION['error'] = "Por favor, complete todos los campos.";
        header('Location: ../index.php');
        exit();
    }

    $loginDAO = new LoginDAO();
    $usuarioDB = $loginDAO->verificarCredenciales($usuario, $password);

    if ($usuarioDB) {
        // Credenciales correctas → guardamos datos en sesión
        $_SESSION['usuario']    = $usuarioDB['nombre_usuario'];
        $_SESSION['id_usuario'] = $usuarioDB['id_usuario'];
        $_SESSION['rol']        = $usuarioDB['rol'];
        $_SESSION['estado']     = $usuarioDB['estado'];

        header('Location: ../vista/index.php');
        exit();
    } else {
        // Credenciales incorrectas
        $_SESSION['error'] = "Usuario o contraseña incorrectos.";
        header('Location: ../index.php');
        exit();
    }

} else {
    // Si no es una solicitud POST, redirigir al formulario de login
    header('Location: ../index.php');
    exit();
}
?>