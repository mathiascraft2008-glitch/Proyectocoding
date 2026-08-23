<?php

session_start();

require_once "../HTML/conexion.php";
require_once "../HTML/torneoModelo.php";

$idTorneo = $_GET['id'];

$torneoModelo = new torneoModelo($conexion);
$torneo = $torneoModelo->obtenerTorneo($idTorneo);

?>
<!DOCTYPE html>

<html lang="es">

<head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../CSS/detallesTorneo.css">    
<link rel="stylesheet" href="../fonts/fonts.css">

<title>Detalle del Torneo - GGchamp</title>

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

            <a href="perfil.html" class="avatar__link"><img class="avatar" src="../images/ui_user_profile_avatar_person_icon_208734.webp" alt=""></a>
        </div>
    </header>

<!-- MAIN -->
<main class="main-content">

    <!-- Imagen -->
    <div class="img"></div>

    <h1 class="tournament-title">
        <?php echo $torneo['NOMBRE'];?>
    </h1>

    <div class="tournament-card">

        <h2 class="card-section-title">
            CONTRASEÑA
        </h2>

        <form action="inscripcionController.php" method="post">
            <!-- indicador para el controlador -->
                    <input type="hidden" name="action" value="passwordTorneo">
            <!-- mandar id para ver a que torneo se quiere inscribir-->
                    <input type="hidden" name="idTorneo" value="<?php echo $torneo['ID']; ?>">

            <!-- contraseña para entrar -->
            <div class="form-row">

                <div class="form-group">
                    <label>Ingrese contraseña para entrar al torneo</label>
                    <input type="password" required name="password">
                </div>


            </div>

            <br>
            
                <button type="submit" class="btn btn-ins">
                    Inscribirse
                </button>
            
        </form>


</main>

<!-- FOOTER -->
<footer class="footer">

    <a href="mainUsuario.html" class="link">
        <p class="logotipo">
            <span class="logotipo--GG">GG</span>champ
        </p>
    </a>

    <div class="footer__links">

        <a href="Terminos&Condiciones.html" class="link-footer">
            Términos
        </a>

        <a href="Terminos&Condiciones.html" class="link-footer">
            Privacidad
        </a>

        <a href="AcercaDeNosotros.html" class="link-footer">
            Acerca de
        </a>

        <a href="soporte.html" class="link-footer">
            Contacto
        </a>

    </div>

    <div class="footer__bottom">

        <div class="footer__icons">
            <img class="icon-box" src="../images/instagram.png" alt="">
            <img class="icon-box" src="../images/x.png" alt="">
            <img class="icon-box" src="../images/facebook.png" alt="">
        </div>

        <p class="copyright">
            Copyright© todos los derechos reservados
        </p>

    </div>

</footer>

</body>

</html>