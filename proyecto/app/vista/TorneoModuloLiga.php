<?php
require_once "../modelo/conexion.php";
require_once "../modelo/Competidor.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/rondaModelo.php";
require_once "../modelo/partidosModelo.php";
require_once "../modelo/competidorModelo.php";

$idTorneo = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/TorneoModuloLiga.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <link rel="stylesheet" href="../../html/images">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <title>Torneo - Módulo de liga - GGchamp</title>
</head>

<body>

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main class="main-content">
        <a href="PanelOrganizador.php?id=<?php echo $idTorneo; ?>" class="btn btn--volver" >Volver</a>
        <!-- Encabezado del torneo -->
        <section class="tournament-header">
            <h1 class="title">Torneo</h1>
            <p class="subtitle">Módulo de liga</p>
        </section>

        <section class="tournament-header">
            <h2 class="title">Sistema de puntos</h2>
            <p class="subtitle">Victoria:  3 puntos</p> 
            <p class="subtitle">Derrota:  0 puntos</p>
            <p class="subtitle">Empate:  1 puntos</p>
        </section>

        <!-- Partidos de la jornada -->
        <section class="matches">
            <h2 class="section-title">PARTIDOS - JORNADA ?</h2>

            <div class="matches-list">

                <div class="match-row">
                    <span class="match-row__name">Nombre</span>
                    <div class="match-row__result">
                        <span class="match-row__score">Empate</span>
                        <span class="match-row__status"></span>
                    </div>
                    <span class="match-row__name">Nombre</span>
                </div>

            </div>
        </section>

        <!-- Ver ranking -->
        <a href="rankings.html" class="link"><button class="btn btn--ranking" type="button">Ver ranking</button></a>

    </main>

</body>

</html>
