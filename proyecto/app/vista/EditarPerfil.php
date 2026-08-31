<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/EditarPerfil.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <title>Editar Perfil - GGchamp</title>
</head>

<body>
    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="profile-card">
            <div class="image-preview"></div>
            
            <h1 class="title">Editar Perfil</h1>
            <p class="subtitle">Las opciones que no rellenes quedarán sin cambios</p>

            <form action="../controlador/userController.php" method="post" enctype="multipart/form-data" class="edit-form">
                <!-- indicador para el controlador -->
                    <input type="hidden" name="action" value="editProfile">
                <div class="form-group">
                    <label for="email" class="form-label">Nuevo Email</label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="correo@ejemplo.com">
                </div>

                <div class="form-group">
                    <label for="new-name" class="form-label">Nuevo nombre</label>
                    <input type="text" name="username" id="new-name" class="form-input">
                </div>

                <div class="form-group">
                    <label for="profile-picture" class="form-label">Nueva foto de perfil</label>
                    <input type="file" name="foto" id="profile-picture" class="form-input-file">
                </div>

                <button type="submit" class="btn-submit">Guardar Cambios</button>
            </form>

            <form action="../controlador/userController.php" method="post" class="seguridad-form">
                <div class="form-group">
                    <label for="new-password" class="form-label">Nueva contraseña</label>
                    <input type="password" required name="new-password" id="new-password" class="form-input">
                </div>

                <div class="form-group">
                    <label for="confirm-new-password" class="form-label">Confirmar nueva contraseña</label>
                    <input type="password" required name="confirm-new-password" id="confirm-new-password" class="form-input">
                </div>

                <input type="hidden" name="action" value="changePassword">
                <button type="submit" class="btn-submit">Cambiar Contraseña</button>
            </form>

        </div>
    </main>

    <!-- Footer -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>