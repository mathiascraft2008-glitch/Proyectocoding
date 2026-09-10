<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/AcercaDeNosotros.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <title>Acerca de nosotros - GGchamp</title>
</head>

<body>  

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>
    

    <!-- Main -->
    <main class="main-content">

        <!-- Hero -->
        <section class="hero">
            <p class="hero__logo"><span class="hero__logo--GG">GG</span>champ</p>
            <p class="hero__tagline">Compite <span class="highlight">supérate</span> gana</p>
            <p class="hero__subtitle">Una plataforma modular para organizar, gestionar y seguir tus torneos.</p>
        </section>

        <!-- Banner destacado -->
        <section class="highlight-banner">
            <p class="highlight-banner__text">¿Qué nos hace especiales?</p>
            <span class="highlight-banner__pointer"></span>
        </section>

        <!-- Características -->
        <section class="features">

            <div class="feature">
                <div class="feature__heading">
                    <span class="feature__number">01</span>
                    <span class="feature__title">Una plataforma, múltiples competencias</span>
                </div>
                <p class="feature__text">
                    GGchamp permite gestionar torneos de diferentes disciplinas y formatos
                    desde una misma plataforma. Fútbol, ajedrez, tenis, videojuegos y
                    muchas otras competencias pueden organizarse sin depender de
                    herramientas diferentes para cada caso.
                </p>
            </div>

            <div class="feature feature--reverse">
                <div class="feature__heading">
                    <span class="feature__number">02</span>
                    <span class="feature__title">La competencia se genera automáticamente</span>
                </div>
                <p class="feature__text">
                    Según el formato seleccionado, GGchamp permite generar la estructura
                    de competencia correspondiente. Las rondas, enfrentamientos, llaves
                    y emparejamientos se organizan de acuerdo con las reglas del torneo,
                    reduciendo el trabajo manual del organizador.
                </p>
            </div>

            <div class="feature">
                <div class="feature__heading">
                    <span class="feature__number">03</span>
                    <span class="feature__title">Toda la información en un solo lugar</span>
                </div>
                <p class="feature__text">
                    Participantes y organizadores pueden consultar la información de la
                    competencia de forma ordenada. Calendarios, resultados, posiciones,
                    rondas y datos del torneo se mantienen centralizados, facilitando el
                    seguimiento de cada competencia.
                </p>
            </div>

        </section>

    </main>

    <!-- Footer -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>
