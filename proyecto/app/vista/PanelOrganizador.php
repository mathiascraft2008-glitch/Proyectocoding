<?php

require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";

$idTorneo = $_GET['id'];

$torneoModelo = new torneoModelo($conexion);
$torneo = $torneoModelo->obtenerTorneo($idTorneo);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/PanelOrganizador.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
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

        

            <!-- Información -->
            <div class="tournament__info">

                <h2 class="tournament__name">Nombre Torneo - <?php echo $torneo->getNombre() ?></h2>

                <p class="tournament__format">Torneo <?php echo $torneo->getFormato() ?></p>

                <div class="tournament__detail">
                    <img src="../../html/images/reloj.svg" class="detail__icon" alt="">
                    <p>Fecha inicio /<?php echo $torneo->getFecha() ?></p>
                </div>

                <div class="tournament__detail">
                    <img src="../../html/images/usuarios.svg" class="detail__icon" alt="">
                    <p>Máximo inscripciones - <?php echo $torneo->getMaxInscripciones() ?></p>
                </div>
                <?php if($torneo->getParticipacion()=='equipo'){ ?>
                <div class="tournament__detail">
                    <img src="../../html/images/usuarios.svg" class="detail__icon" alt="">
                    <p>Máximo Equipos - <?php echo $torneo->getMaxEquipos() ?></p>
                </div>
                <?php } ?>

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
            <?php if($torneo->getFormato()=='eliminacion'){ ?>
                <form action="../controlador/torneoController.php" method="post">
                    <input type="hidden" name="action" value="generarRonda">
                    <input type="hidden" name="idTorneo" value="<?php echo $idTorneo; ?>">
                    <label for="fechaInicio">Fecha y hora de inicio de la ronda:</label>

                    <input type="datetime-local" name="fechaInicio" id="fechaInicio" required>
                    
                    <button class="quick-actions__item" type="submit">
                        <span class="quick-actions__icon"></span>
                        GENERAR NUEVA RONDA
                    </button>
                </form>
            <?php }elseif ($torneo->getFormato()=='liga'){ ?>
            <form action="../controlador/torneoController.php" method="post">
                    <input type="hidden" name="action" value="generarLiga">
                    <input type="hidden" name="idTorneo" value="<?php echo $idTorneo; ?>">
                    <button class="quick-actions__item" type="submit">
                        <span class="quick-actions__icon"></span>
                        GENERAR NUEVA LIGA
                    </button>
                </form>
            <?php }elseif($torneo->getFormato()=='suizo'){ ?>
            <form action="../controlador/torneoController.php" method="post">
                    <input type="hidden" name="action" value="generarSuizo">
                    <input type="hidden" name="idTorneo" value="<?php echo $idTorneo; ?>">
                    <label for="fechaInicio">Fecha y hora de inicio de la ronda:</label>

                    <input type="datetime-local" name="fechaInicio" id="fechaInicio" required>
                    
                    <button class="quick-actions__item" type="submit">
                        <span class="quick-actions__icon"></span>
                        GENERAR NUEVA RONDA DEL TORNEO SUIZO
                    </button>
                </form>
            <?php } ?>

        </section>

        <!-- Herramientas del organizador -->
        <section class="tools">

            <h2 class="section-title">Herramientas del organizador</h2>

            <a href="solicitudes.php?id=<?php echo $idTorneo; ?>" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Ver Inscripciónes</strong>
                    <span>Gestionar inscripciónes</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>

            <?php if($torneo->getFormato()=='eliminacion'){ ?>
            <a href="TorneoEliminacionDirecta.php?id=<?php echo $idTorneo; ?>" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Rondas / Emparejamientos</strong>
                    <span>Publicar rondas y editar emparejamientos</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>
            <?php }elseif ($torneo->getFormato()=='liga'){ ?>
            <a href="TorneoModuloLiga.php?id=<?php echo $idTorneo; ?>" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Rondas / Emparejamientos</strong>
                    <span>Publicar rondas y editar emparejamientos</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>
            <?php }elseif ($torneo->getFormato()=='suizo'){ ?>
            <a href="TorneoSistemaSuizo.php?id=<?php echo $idTorneo; ?>" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Rondas / Emparejamientos</strong>
                    <span>Publicar rondas y editar emparejamientos</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>
            <?php } ?>

            <a href="crearGrupo.php?id=<?php echo $idTorneo; ?>" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Crear un nuevo grupo</strong>
                    <span></span>
                </span>
                <span class="tools__arrow">→</span>
            </a>

            <a href="gestionGrupo.php?id=<?php echo $idTorneo; ?>" class="tools__item">
                <span class="tools__icon"></span>
                <span class="tools__text">
                    <strong>Gestionar grupos</strong>
                    <span>Añada o saque a participantes de sus grupos</span>
                </span>
                <span class="tools__arrow">→</span>
            </a>

            <a href="rankings.php" class="tools__item">
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
