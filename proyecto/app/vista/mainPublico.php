<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/mainPublico.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <title>GGchamp - Viví la competencia</title>
</head>

<body>

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main class="main-content">

        <!-- Hero -->
        <section class="hero">

            <div class="hero__text">
                <h1 class="hero__title">VIVÍ LA COMPETENCIA.</h1>
                <p class="hero__subtitle">Regístrate para disfrutar de participar y crear tus propios torneos</p>

                <div class="hero__actions">
                    <a href="register.html" class="link"><button class="btn btn--primary" type="button">Acceder</button></a>
                    <a href="competencias.php" class="link"><button class="btn btn--primary" type="button">Explorar Competencias</button></a>
                </div>
            </div>

            <div class="hero__image">
                <div class="image__placeholder"></div>
            </div>

        </section>

        <!-- Torneos destacados -->
        <section class="featured">

            <h2 class="section-title">Torneos destacados</h2>

            <div class="tournament-card">

                <div class="tournament__image">
                    <div class="image__placeholder"></div>
                </div>

                <div class="tournament__info">

                    <h3 class="tournament__name">Nombre Torneo - Fútbol 5</h3>
                    <p class="tournament__format">Torneo Suizo Individual</p>

                    <div class="tournament__detail">
                        <img src="../../html/images/reloj.svg" class="detail__icon" alt="">
                        <p>Fecha inicio / fecha final</p>
                    </div>

                    <div class="tournament__detail">
                        <img src="../../html/images/usuarios.svg" class="detail__icon" alt="">
                        <p>10 equipos</p>
                    </div>

                    <a href="register.html" class="link"><button class="btn btn--primary btn--small" type="button">Ver</button></a>

                </div>

            </div>

        </section>

        <!-- Qué es GGchamp -->
        <section class="about">
            <h2 class="section-title">Qué es <span class="highlight">GGchamp</span>?</h2>
            <p class="about__text">
                GGChamp es una plataforma de gestión de torneos y competencias que permite organizar,
                administrar y participar en diferentes tipos de torneos. Los organizadores pueden crear y
                gestionar sus torneos, mientras que los participantes pueden inscribirse, consultar
                resultados y seguir el desarrollo de las competencias de forma sencilla y organizada.
            </p>
        </section>

        <!-- Pasos -->
        <section class="steps">

            <div class="step">
                <span class="step__number">01:</span>
                <p class="step__text">Creá una cuenta</p>
            </div>

            <div class="step">
                <span class="step__number">02:</span>
                <p class="step__text">Explora torneos de múltiples categorías y formatos</p>
            </div>

            <div class="step">
                <span class="step__number">03:</span>
                <p class="step__text">Participa, crea y gestiona torneos</p>
            </div>

        </section>

    </main>

    <!-- Footer -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>