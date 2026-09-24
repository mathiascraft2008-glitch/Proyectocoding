<?php

require_once "../modelo/conexion.php";
require_once "../modelo/Competidor.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/rondaModelo.php";
require_once "../modelo/partidosModelo.php";
require_once "../modelo/competidorModelo.php";

$idTorneo = $_GET['id'];

$torneoModelo = new torneoModelo($conexion);
$rondaModelo = new rondaModelo($conexion);
$partidosModelo = new partidosModelo($conexion);
$competidorModelo = new CompetidorModelo($conexion);


$torneo = $torneoModelo->obtenerTorneo($idTorneo);
$rondas = $rondaModelo->obtenerRondasPorTorneo($idTorneo);
$ultimaRonda = $rondaModelo->obtenerUltimaRonda($idTorneo);

$competidores = $competidorModelo->obtenerCompetidoresPorTorneo($idTorneo);
$nombres= [];
foreach ($competidores as $competidor) {
    if ($torneo->getParticipacion() == 'solo') {
        $res = $competidorModelo->obtenerNombreCompetidorSOLO($competidor->getId());

    } else {

        $res = $competidorModelo->obtenerNombreCompetidorEQUIPO($competidor->getId());
    }
//guardar en el array nombres con la clave como id del competidor, con su valor que sea el nombre de ese id
    $nombres[$competidor->getId()] = $res['NOMBRE'];
}

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
    <title>Torneo - Sistema suizo - GGchamp</title>
</head>

<body>  

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main class="main-content">
        <?php if (isset($_SESSION['id']) && $_SESSION['id']==$torneo->getIdOrganizador()) { ?>
            <a href="PanelOrganizador.php?id=<?php echo $idTorneo; ?>" class="btn btn--volver" >Volver</a>
        <?php } ?>

        <!-- Encabezado del torneo -->
        <section class="tournament-header">
            <h1 class="title"><?php echo $torneo->getNombre(); ?></h1>
            <p class="subtitle">Sistema Suizo</p>
        </section>

        <section class="tournament-header">
            <h2 class="title">Sistema de puntos</h2>
            <p class="subtitle">Victoria:  3 puntos</p> 
            <p class="subtitle">Derrota:  0 puntos</p>
            <p class="subtitle">Empate:  1 puntos</p>
        </section>

    <?php foreach ($rondas as $ronda){ ?>

    <section class="matches">

        <h2 class="section-title">PARTIDOS - RONDA <?php echo $ronda->getNumero(); ?></h2>
        <p>fecha de inicio:<?php echo $ronda->getFechaInicio() ?></p>
        <br>
        <div class="matches-list">

            <?php
            $partidos = $partidosModelo->obtenerPartidosPorRonda($ronda->getId());
            ?>

            <?php foreach ($partidos as $partido){ ?>

                        <div class="match-card">
                            <div class="match-card__header"><h2>Partido <?php echo $partido->getNumero(); ?></h2></div>
                            <div class="match-card__body">
                                <div class="match-card__row">
                                    <span class="match-card__label">Competidor 1: </span>
                                    <!-- mostrar el nombre e id del competidor1 de este partido, verificando que si no se eligió todavia, no te amnde a la pagina en blanco -->
                                        <?php if ($partido->getCompetidor1() !== null) { ?>
                                            <strong>
                                                <?php echo $nombres[$partido->getCompetidor1()]; ?>
                                            </strong>
                                            <small>
                                                ID: __<?php echo $partido->getCompetidor1(); ?>
                                            </small>
                                        <?php } else { ?>
                                            <span class="match-pendiente">Pendiente</span>
                                        <?php } ?>
                                    
                                    
                                </div>
                                <div class="match-card__row">
                                    <span class="match-card__label">Competidor 2: </span>
                                    <?php if ($partido->getCompetidor2() !== null) { ?>
                                        <strong>
                                            <?php echo $nombres[$partido->getCompetidor2()]; ?>
                                        </strong>
                                        <small>
                                            ID: __<?php echo $partido->getCompetidor2(); ?>
                                        </small>
                                    <?php } else { ?>
                                        <span class="match-pendiente">Pendiente</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="match-card__row">
                                <span class="match-card__label">Ganador:</span>
                                <?php if ($partido->getIdGanador() !== null){ ?>
                                    <strong class="ganadorr">
                                        <?php echo $nombres[$partido->getIdGanador()]; ?>
                                    </strong>
                                    <small>
                                        ID: __<?php echo $partido->getIdGanador(); ?>
                                    </small>
                                <?php } elseif ($partido->getEmpate() == 1) { ?>
                                    <span class="match-card__pending">Empate</span>
                                <?php } else { ?>
                                    <span class="match-pendiente">Pendiente</span>
                                <?php } ?>
    
                                
                            </div>
                            <br>
                            <div class="match-card__row">
                                <?php if ($ronda->getId() == $ultimaRonda->getId() && isset($_SESSION['id']) && $_SESSION['id']==$torneo->getIdOrganizador()) { ?>
                                <a href="emparejamientos.php?partido=<?php echo $partido->getId() ?>&torneo=<?php echo $idTorneo ?>" class="btn">Editar</a>
                                <?php } ?>
                            </div>
                            
                            
                        </div>

            <?php } ?>

        </div>
<br>
<br>
<hr>
<br>
<br>
    </section>

<?php } ?>
<br>
<br>
        <!-- Ver ranking -->
        <a href="rankings.php?id=<?php echo $idTorneo ?>" class="link"><button class="btn btn--ranking" type="button">Ver ranking</button></a>

    </main>

</body>

</html>
