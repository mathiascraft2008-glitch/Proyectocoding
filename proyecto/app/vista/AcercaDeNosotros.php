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
            <p class="hero__subtitle">una plataforma de torneos donde puedes alcanzar la gloria</p>
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
                    <span class="feature__title">título</span>
                </div>
                <p class="feature__text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in neque a nulla
                    venenatis sodales. Nunc pretium mi efficitur, hendrerit
                </p>
                <div class="feature__image">*IMG*</div> 
            </div>

            <div class="feature feature--reverse">
                <div class="feature__heading">
                    <span class="feature__number">02</span>
                    <span class="feature__title">título</span>
                </div>
                <p class="feature__text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in neque a nulla
                    venenatis sodales. Nunc pretium mi efficitur, hendrerit
                </p>
                <div class="feature__image">*IMG*</div>
            </div>

            <div class="feature">
                <div class="feature__heading">
                    <span class="feature__number">03</span>
                    <span class="feature__title">título</span>
                </div>
                <p class="feature__text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in neque a nulla
                    venenatis sodales. Nunc pretium mi efficitur, hendrerit
                </p>
                <div class="feature__image">*IMG*</div>
            </div>

        </section>

    </main>

    <!-- Footer -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>
