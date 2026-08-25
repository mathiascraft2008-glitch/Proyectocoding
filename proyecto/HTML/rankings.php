<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/rankings.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <link rel="stylesheet" href="../CSS/headerYfooter.css">
    <title>Rankings - GGchamp</title>
</head>

<body>  

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main>

        <!-- Título -->
        <h1 class="title">Rankings</h1>

        <!-- Nombre del torneo -->
        <div class="tournament">
            <p class="tournament__name">Nombre torneo</p>
        </div>

        <!-- Selector de participantes o equipos -->
        <div class="ranking-selector">
            <button class="ranking-selector__item active" type="button">Participantes</button>
            <button class="ranking-selector__item" type="button">Equipos</button>
        </div>

        <!-- Ranking -->
        <section class="ranking">

            <h2 class="section-title">TOP PARTICIPANTES</h2>

            <section class="podium">
                <!-- Segundo -->
                <div class="podium__item podium__item-second">
                    <span class="podium__position">2</span>
                    <div class="podium__block"></div>
                </div>

                <!-- Primero -->
                <div class="podium__item podium__item-first">
                    <span class="podium__position">1</span>
                    <div class="podium__block"></div>
                </div>

                <!-- Tercero -->
                <div class="podium__item podium__item-third">
                    <span class="podium__position">3</span>
                    <div class="podium__block"></div>
                </div>
            </section>

            <!-- Tabla -->
            <div class="table">

                <!-- Encabezado -->
                <div class="table__row table__row--header">
                    <span class="table__position">#</span>
                    <span class="table__name">Participante</span>
                    <span class="table__stat">W</span>
                    <span class="table__stat">L</span>
                    <span class="table__points">PTS</span>
                </div>

                <!-- Participante 1 -->
                <div class="table__row">
                    <span class="table__position">1</span>
                    <span class="table__name">Nombre</span>
                    <span class="table__stat wins">8</span>
                    <span class="table__stat">1</span>
                    <span class="table__points">2000</span>
                </div>

                <!-- Participante 2 -->
                <div class="table__row">
                    <span class="table__position">2</span>
                    <span class="table__name">Nombre</span>
                    <span class="table__stat wins">8</span>
                    <span class="table__stat">2</span>
                    <span class="table__points">1900</span>
                </div>

                <!-- Participante 3 -->
                <div class="table__row">
                    <span class="table__position">3</span>
                    <span class="table__name">Nombre</span>
                    <span class="table__stat wins">7</span>
                    <span class="table__stat">4</span>
                    <span class="table__points">1700</span>
                </div>

                <!-- Participante 4 -->
                <div class="table__row">
                    <span class="table__position">4</span>
                    <span class="table__name">Nombre</span>
                    <span class="table__stat wins">5</span>
                    <span class="table__stat">5</span>
                    <span class="table__points">1600</span>
                </div>

                <!-- Participante 5 -->
                <div class="table__row">
                    <span class="table__position">5</span>
                    <span class="table__name">Nombre</span>
                    <span class="table__stat wins">5</span>
                    <span class="table__stat">6</span>
                    <span class="table__points">1550</span>
                </div>

            </div>

        </section>

    </main>

</body>

</html>