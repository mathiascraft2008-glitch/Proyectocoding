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
    <title>Perfil - GGchamp</title>
</head>
<body> 
    
    <!-- HEADER -->
    <header class="header">
        <button class="menu">☰</button>

        <a href="mainUsuario.html" class="link">
            <p class="logotipo">
                <span class="logotipo--GG">GG</span>champ
            </p>
        </a>

        <div class="header__nav">
            <a href="AcercaDeNosotros.html" class="header__link">Acerca de nosotros</a>
            <a href="notificaciones.html" class="header__link">Notificaciones</a>
            <a href="competencias.html" class="header__link">Competencias</a>
            <a href="rankings.html" class="header__link">rankings</a>

            <a href="perfil.php" class="avatar__link"><img class="avatar" src="../images/ui_user_profile_avatar_person_icon_208734.webp" alt=""></a>
        </div>
    </header>

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