<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/mainAdministrador.css">
    <link rel="stylesheet" href="../CSS/headerYfooter.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <title>Panel Administrador - GGchamp</title>
</head>

<body>  

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main class="main-content">

        <h1 class="title">Bienvenido!</h1>

        <div class="main-actions">
            <a href="crearTorneo.php" class="link"><button class="btn btn--primary btn--action" type="button">Crear Torneo</button></a>
            <a href="PanelAdministrador.php" class="link"><button class="btn btn--primary btn--action" type="button">Panel Administrador</button></a>
        </div>

        <!-- Estadísticas generales -->
        <section class="stats">

            <div class="stats__card">
                <h2 class="stats__label">Torneos totales</h2>
                <p class="stats__value">224</p>
            </div>

            <div class="stats__card">
                <h2 class="stats__label">Usuarios totales</h2>
                <p class="stats__value">100</p>
            </div>

        </section>

        <!-- Mis torneos (organizador) -->
        <section class="organize">

            <h2 class="section-title">Mis torneos (organizador)</h2>

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
                        <img src="../images/usuarios.svg" class="detail__icon" alt="">
                        <p>7 / 10</p>
                    </div>
                </div>
                <a href="PanelOrganizador.html" class="link tournament-row__cta"><button class="btn btn--primary btn--small" type="button">Ver</button></a>
            </div>

            <div class="tournament-row">
                <div class="tournament-row__image">
                    <div class="image__placeholder"></div>
                </div>
                <div class="tournament-row__info">
                    <h3 class="tournament-row__name">Ajedréz</h3>
                    <div class="tournament-row__detail">
                        <img src="../images/reloj.svg" class="detail__icon" alt="">
                        <p>Fecha / online</p>
                    </div>
                    <div class="tournament-row__detail">
                        <img src="../images/usuarios.svg" class="detail__icon" alt="">
                        <p>7 / 10</p>
                    </div>
                </div>
                <a href="PanelOrganizador.html" class="link tournament-row__cta"><button class="btn btn--primary btn--small" type="button">Ver</button></a>
            </div>

        </section>

    </main>

    <!-- Footer -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>