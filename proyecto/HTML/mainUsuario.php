<?php

session_start();

require_once "../HTML/conexion.php";
require_once "../HTML/torneoModelo.php";

$id = $_SESSION['id'];

$torneoModelo = new torneoModelo($conexion);

$torneosCreados = $torneoModelo->obtenerTorneosCreados($id);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/mainUsuario.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <title>Inicio - GGchamp</title>
</head>

<body>  

   
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

    <!--main -->
    <main class="main-content">

        <h1 class="title">¡Bienvenido!</h1>

        <a href="crearTorneo.html" class="link">
            <button class="btn btn--primary btn--create" type="button">Crear Torneo</button>
        </a>

        <!-- Banner explorar torneos -->
        <a href="competencias.php" class="link">
            <section class="explore-banner">
                <div class="explore-banner__icon">
                    <img src="../images/lupa.png" alt="">
                </div>
                <p class="explore-banner__text">Explorar torneos</p>
            </section>
        </a>

        <!-- Torneos en los que participo -->
        <section class="participate">
            <h2 class="section-title">Torneos en los que participo</h2>

            <div class="tournament-row">
                <div class="tournament-row__image">
                    <div class="image__placeholder"></div>
                </div>
                <div class="tournament-row__info">
                    <h3 class="tournament-row__name">Fútbol 5</h3>
                    <div class="tournament-row__detail">
                        <img src="../images/reloj.svg" class="detail__icon" alt="">
                        <p>Fecha / online</p>
                    </div>
                    <div class="tournament-row__detail">
                        <img src="../images/reloj.svg" class="detail__icon" alt="">
                        <p>Próximo partido: <span class="tournament-row__date">25/7/26</span></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mis torneos (organizador) -->
        <section class="organize">
            <h2 class="section-title">Mis torneos (organizador)</h2>

            <?php foreach ($torneosCreados as $torneo) { ?>

                <article class="torneo-card">

                    <h2><?php echo $torneo['NOMBRE']; ?></h2>

                    <p>Fecha: <?php echo $torneo['FECHA']; ?></p>

                    <p>Formato: <?php echo $torneo['FORMATO']; ?></p>

                    <p>Disciplina: <?php echo $torneo['DISCIPLINA']; ?></p>

                    <p>Modo: <?php echo $torneo['PARTICIPACION']; ?></p>

                    <a href="torneo.php?id=<?php echo $torneo['ID']; ?>">
                        Ver torneo
                    </a>

                </article>

            <?php } ?>

        </section>



    </main>

    <!-- Footer -->
    <footer class="footer">
        <a href="mainUsuario.html" class="link">
            <p class="logotipo"><span class="logotipo--GG">GG</span>champ</p>
        </a>
        <div class="footer__links">
            <a href="Terminos&Condiciones.html" class="link">Términos</a>
            <a href="Terminos&Condiciones.html" class="link">Privacidad</a>
            <a href="AcercaDeNosotros.html" class="link">Acerca de</a>
            <a href="soporte.html" class="link">Contacto</a>
        </div>
        <div class="footer__bottom">
            <div class="footer__icons">
                <img class="icon-box" src="../images/instagram.png" alt="">
                <img class="icon-box" src="../images/x.png" alt="">
                <img class="icon-box" src="../images/facebook.png" alt="">
            </div>
            <p class="copyright">Copyright© todos los derechos reservados</p>
        </div>
    </footer>

</body>

</html>