<?php

session_start();


require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/inscripcionModelo.php";

$torneoModelo = new torneoModelo($conexion);
$torneos = $torneoModelo->obtenerTorneos();
$inscripcionModelo = new inscripcionModelo($conexion);

?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/CSS/competencias.css">
<link rel="stylesheet" href="/CSS/headerYfooter.css">
<link rel="stylesheet" href="/fonts/fonts.css">
    <title>Competencias - GGchamp</title>
    </head>

<body>

<!-- HEADER -->
<?php include '../../headerAdmin.php'; ?>


<!-- MAIN -->
<main class="main-content">

    <!-- Título y buscador -->
    <div class="top-bar">

        <h1 class="title">Competencias</h1>


    </div>


    <!-- Layout principal -->
    <div class="layout-grid">

        <!-- Lista de torneos -->
        <section class="tournaments-section">

            <p class="subtitle">Próximas competencias</p>


            <div class="tournaments-list">

                <!-- Tarjeta 1 -->
                <?php foreach ($torneos as $torneo) { ?>
                    <article class="card">


                        <div class="card__content">

                            <div class="card__header">
                                <h3 class="card__category">
                                    <?php echo $torneo->getNombre(); ?>
                                </h3>
                            </div>

                            <div class="card__details">

                                <div class="detail-row">
                                    <img src="/images/reloj.svg" class="iconn" alt="">
                                    <span>
                                        <?php echo $torneo->getFecha(); ?>
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <img src="/images/usuarios.svg" class="iconn" alt="">
                                    <span>
                                        <?php echo $torneo->getDisciplina(); ?>
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span>
                                        <?php echo $torneo->getFormato(); ?>
                                    </span>
                                </div>

                            </div>
                            <?php if($torneo->getFormato()=='suizo'){ ?>
                            <a href="/app/vista/TorneoSistemaSuizo.php?id=<?php echo $torneo->getId(); ?>" class="btn btn-ver">
                                Ver torneo
                            </a>
                        <?php }elseif($torneo->getFormato()=='liga'){ ?>
                            <a href="/app/vista/TorneoModuloLiga.php?id=<?php echo $torneo->getId(); ?>" class="btn btn-ver">
                                Ver torneo
                            </a>
                        <?php }else{ ?>
                            <a href="/app/vista/TorneoEliminacionDirecta.php?id=<?php echo $torneo->getId(); ?>" class="btn btn-ver">
                                Ver torneo
                            </a>
                        <?php } ?>
                            
                            <?php $cantidadInscripciones = $inscripcionModelo->cantidadInscripciones($torneo->getId()); ?>
                            <?php if ($cantidadInscripciones['cantidad'] >=$torneo->getMaxInscripciones()) { ?>
                            <span class="card__status rojo">
                                Inscripción cerrada
                            </span>
                            <?php }else{ ?>
                            <span class="card__status">
                                Inscripción abierta
                            </span>
                            <?php } ?>

                        </div>
                    </article>

            <?php } ?>


        </section>
    </div>

</main>


<!-- FOOTER -->
<?php include '../../footerAdmin.php'; ?>

</body>

</html>