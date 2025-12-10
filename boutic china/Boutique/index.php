<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Boutic Moda Urbana</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    
</head>
<body>
    <main class="inicio">
        <h1> Inicia Secion </h1>


        <form action="controlador/loginControlador.php" method="POST" class="formulario">
            
            <div class="contenedor-inputs">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required> 

            </div>

            <input type="submit" value="Iniciar sesión" class="btn-submit">
        </form>
        <p>¿No tienes una cuenta? <a href="vista/registro.php">Regístrate aquí</a></p>
    </main>

</body>
</html>