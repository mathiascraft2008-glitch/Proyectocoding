<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/PanelOrganizador.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <link rel="stylesheet" href="../CSS/headerYfooter.css">
    <title>Panel Organizador - GGchamp</title>
</head>

<body>

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main class="main-content">

        <h1 class="title">Panel Organizador</h1>

        <!-- Tarjeta del torneo -->
        <section class="tournament-card">

            <!-- Imagen del torneo -->
            <div class="tournament__image">
                <span class="tournament__badge">En curso</span>
                <div class="image__placeholder"></div>
            </div>

            <!-- Información -->
            <div class="tournament__info">

                <h2 class="tournament__name">Nombre Torneo - Fútbol 5</h2>

                <p class="tournament__format">Torneo Suizo Individual</p>

                <div class="tournament__detail">
                    <img src="../images/reloj.svg" class="detail__icon" alt="">
                    <p>Fecha inicio / fecha final</p>
                </div>

                <div class="tournament__detail">
                    <img src="../images/usuarios.svg" class="detail__icon" alt="">
                    <p>7 / 10</p>
                </div>

                <div class="tournament__detail">
                    <img src="../images/usuarios.svg" class="detail__icon" alt="">
                    <p>10 equipos</p>
                </div>

            </div>

        </section>

        <!-- Acciones rápidas -->
        <section class="quick-actions">

            <h2 class="section-title">Acciones rápidas</h2>

            <button class="quick-actions__item" type="button">
                <span class="quick-actions__icon"></span>
                Finalizar torneo
            </button>

            <button class="quick-actions__item" type="button">
                <span class="quick-actions__icon"></span>
                Cerrar inscripciones
            </button>

        </section>

        <!-- Herramientas del organizador -->
        <section class="tools">

            <h2 class="section-title">Herramientas del organizador</h2>

            <a href="solicitudes.html" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Solicitudes</strong>
                    <span>Ver, aprobar y gestionar solicitudes</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>

            <a href="emparejamientos.html" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Rondas / Emparejamientos</strong>
                    <span>Publicar rondas y editar emparejamientos</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>

            <a href="rankings.html" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Tabla de posiciones</strong>
                    <span>Ver tabla de posiciones actualizada</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>

        </section>

    </main>

    <!-- Footer -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>
