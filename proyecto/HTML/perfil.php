<?php
session_start();
require_once "UsuarioModelo.php";
require_once "conexion.php";
$id = $_SESSION['id'];
$usuarioModelo = new UsuarioModelo($conexion);

$usuario = $usuarioModelo->obtenerUsuarioPorId($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/perfil.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <link rel="stylesheet" href="../CSS/headerYfooter.css">
    <title>Perfil - GGchamp</title>
</head>
<body> 
    
    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main>
        <section class="profile">
            <div class="profile__avatar">IMG</div>
            <div class="profile__info">
                <h2 class="profile__name"><?php echo $usuario['NOMBRE']; ?></h2>
                <p class="profile__mail"><?php echo $usuario['MAIL']; ?></p>
                <p class="profile__id">ID: <?php echo $usuario['ID']; ?></p>
            </div>
        </section>
        
        <!-- Estadísticas rápidas -->
        <section class="stats">
            <div class="stats__item">
                <h3 class="stats__value">3</h3>
                <p class="stats__label">Torneos</p>
            </div>

            <div class="stats__item">
                <h3 class="stats__value">1</h3>
                <p class="stats__label">Victorias</p>
            </div>

            <div class="stats__item">
                <h3 class="stats__value">3</h3>
                <p class="stats__label">Equipos</p>
            </div>
        </section>

        <!-- Configuración perfil -->
        <h2 class="section-title">Configuración</h2>

        <section class="settings">
            <a href="EditarPerfil.html" class="settings__item">
                <div class="settings__icon"></div>
                <p class="settings__label">Editar perfil</p>
            </a>

            <a href="notificaciones.html" class="settings__item">
                <div class="settings__icon"></div>
                <p class="settings__label">Notificaciones</p>
            </a>

            <a href="competencias.html" class="settings__item">
                <div class="settings__icon"></div>
                <p class="settings__label">Mis torneos</p>
            </a>
            <!--mandar la peticion a el controlador ejecutando la funcion logoutUser -->
        <form action="userController.php" method="post">
            <input type="hidden" name="action" value="logout">

            <button type="submit" class="settings__item">
            <div class="settings__icon"></div>
            <p class="settings__label">Cerrar sesión</p>
            </button>
        </form>
        </section>
    </main>
</body>
</html>