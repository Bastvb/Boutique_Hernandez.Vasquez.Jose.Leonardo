<?php
require_once '../modelo/conexion.php';

try {
    $conexion = Conexion::conectar();
    // Traemos todos los roles distintos que existan en la tabla usuarios
    $stmt = $conexion->query("SELECT DISTINCT rol FROM usuarios ORDER BY rol");
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmtUsers = $conexion->query("SELECT id_usuario, nombre_usuario, rol, estado FROM usuarios ORDER BY id_usuario ASC");
    $usuarios = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $roles = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <main class="inicio">
        <h1>Registra Usuarios</h1>

       <?php  
       session_start();
       if (!empty($_SESSION['mensaje_registro'])){
        echo "<p style='color:green'>" . $_SESSION['mensaje_registro'] . "</p>";
        unset( $_SESSION['mensaje_registro']);
       }

        if (!empty($_SESSION['error_registro'])){
        echo "<p style='color:red'>" . $_SESSION['error_registro'] . "</p>";
        unset( $_SESSION['error_registro']);
       }
    
        ?>

       <form action="../controlador/registroControlador.php" method="POST" class="formulario">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <label for="password2">Repetir contraseña:</label>
                <input type="password" id="password2" name="password2" required>

                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="">-- Seleccione un rol --</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= htmlspecialchars($r['rol']) ?>">
                            <?= htmlspecialchars($r['rol']) ?> 
                        </option>
                        
                    <?php endforeach; ?>
                </select>

                <label for="estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="1" selected>Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <input type="submit" value="Registrar usuario" class="btn-submit">
       </form>
       
       <a href="../index.php">LOGIN</a>

       <h2>Usuarios registrados</h2>

       <?php if (!empty($usuarios)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['id_usuario']) ?></td>
                            <td><?= htmlspecialchars($u['nombre_usuario']) ?></td>
                            <td><?= htmlspecialchars($u['rol']) ?></td>
                            <td><?= htmlspecialchars($u['estado']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>No hay usuarios registrados</p>
            <?php endif; ?>

</main>

</body> 
</html>
