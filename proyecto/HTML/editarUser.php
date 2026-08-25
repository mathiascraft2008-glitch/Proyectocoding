<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/editarUser.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <link rel="stylesheet" href="../CSS/headerYfooter.css">
    <title>Editar Usuario - GGchamp</title>
</head>

<body>
    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

<!-- Main -->
<main class="main-content">

    <!-- Imagen de arriba -->
    
    <div class="top-avatar">
        <img class="" src="../images/usuario.svg" alt="">
    </div>

    <!-- Formulario -->
    <form class="edit-card" action="userController.php" method="POST">
        <!-- indicador para el controlador -->
            <input type="hidden" name="action" value="editUser">
        <div class="edit-card__header">
            <h1 class="edit-card__title">Editar Usuario</h1>

            <p class="edit-card__subtitle">
                La opción que no rellene quedará de la misma manera
            </p>
        </div>
        <div class="form-item">
            <label for="id">Ingrese ID del usuario a editar</label>
            <input type="text" id="id" name="id" required>
        </div>

        <div class="form-item">
            <label for="nombre">Nuevo Nombre</label>
            <input type="text" id="nombre" name="nombre">
        </div>

        <div class="form-item">
            <label for="contrasena">Nueva Contraseña</label>
            <input type="password" id="contrasena" name="contrasena">
        </div>

        <div class="form-item">
            <label for="email">Nuevo Email</label>
            <input type="email" id="email" name="email">
        </div>


        <input type="submit" class="publish" value="Modificar usuario">        

    </form>

    <!-- Formulario eliminar usuario -->
    <h2 class="section-title">Dar de baja a un usuario</h2>
    <form action="userController.php" method="post">

        <input type="hidden" name="action" value="delete">

        <label for="" class="text text-label">
                Ingrese el ID del usuario que desea dar de baja
        </label>
        <input type="number" name="idUsuario" required>
        

        <input type="submit" class="publish" value="Dar de baja">        

    </form>

    <h2 class="section-title">Dar de alta a un usuario</h2>
    <form action="userController.php" method="post">

        <input type="hidden" name="action" value="alta">

        <label for="" class="text text-label">
                Ingrese el ID del usuario que desea dar de alta
        </label>
        <input type="number" name="idUsuario" required>
        

        <input type="submit" class="publish" value="Dar de alta">        

    </form>

    

</main>

<!-- Footer -->
<?php include 'footerAdmin.php'; ?>

</body>

</html>
