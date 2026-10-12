<?php
session_start();

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(16));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/register.css">
    <link rel="stylesheet" href="/fonts/fonts.css">
    <title>Crear cuenta - GGchamp</title>
</head>
<body>
    <main class="main-container">
        <div class="register-card">
            <div class="image"><img src="/images/usuario.svg" alt=""></div>
            
            <h1 class="title">Crear Cuenta</h1>
            <p class="text subtitle">Complete sus datos para empezar</p>

            <form action="../controlador/userController.php" method="post" enctype="multipart/form-data" class="login">
                <!-- indicador para el controlador -->
                <input type="hidden" name="action" value="register">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">

                <label for="username" class="text text-label">Nombre de usuario</label>
                <input type="text" name="username" id="username" class="login__input" required>
                
                <label for="email" class="text text-label">Email</label>
                <input type="email" name="email" id="email" class="login__input" required>
                
                <label for="password" class="text text-label">Contraseña</label>
                <input type="password" name="password" id="password" class="login__input" required>
                
                <label for="confirm-password" class="text text-label">Confirmar contraseña</label>
                <input type="password" name="confirm-password" id="confirm-password" class="login__input" required>
                
                <input type="submit" class="login__submit" value="Crear Cuenta">

                <!-- Pie del formulario (Links e información) -->
                <div class="form-footer">
                    <p class="text text-login">
                        ¿Ya tenés una cuenta? <a href="login.php" class="link">Iniciá sesión</a>
                    </p>

                </div>
            </form>
        </div>
    </main>

</body>

</html>
