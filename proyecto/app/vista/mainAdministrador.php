<?php

session_start();

require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/reporteModelo.php";

$id = $_SESSION['id'];

$torneoModelo = new torneoModelo($conexion);
$reporteModelo = new reporteModelo($conexion);
$torneosCreados = $torneoModelo->obtenerTorneosCreados($id);
$cantUsers = $reporteModelo->cantidadUsuariosTotales();
$cantTorneos = $reporteModelo->cantidadTorneosTotales();


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/mainAdministrador.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
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
                <?php echo $cantTorneos['total'] ?>
            </div>

            <div class="stats__card">
                <h2 class="stats__label">Usuarios totales</h2>
                <?php echo $cantUsers['total'] ?>
            </div>

        </section>

        <!-- Mis torneos (organizador) -->
        <section class="organize">
            <h2 class="section-title">Mis torneos (organizador)</h2>

            <?php foreach ($torneosCreados as $torneo) { ?>

                <article class="tournament-row">

                    <h2><?php echo $torneo->getNombre(); ?></h2>

                    <p>Fecha: <?php echo $torneo->getFecha(); ?></p>

                    <p>Formato: <?php echo $torneo->getFormato(); ?></p>

                    <p>Disciplina: <?php echo $torneo->getDisciplina(); ?></p>

                    <p>Modo: <?php echo $torneo->getParticipacion(); ?></p>

                    <a href="PanelOrganizador.php?id=<?php echo $torneo->getId(); ?>">
                        Ver torneo
                    </a>

                </article>

            <?php } ?>

        </section>

    </main>

    <!-- Footer -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>