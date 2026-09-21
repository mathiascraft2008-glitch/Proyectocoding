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

$competidores = $competidorModelo->obtenerCompetidoresPorTorneo($idTorneo);

$rankings=$competidorModelo->ranking($idTorneo);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/rankings.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
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
            <p class="tournament__name"><?php echo $torneo->getNombre(); ?></p>
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
                    
                    <span class="table__points">PTS</span>
                </div>
                <?php foreach($rankings as $ranking){ ?>
                    <?php
                        if ($torneo->getParticipacion() == 'solo') {
                            $res = $competidorModelo->obtenerNombreCompetidorSOLO($ranking->getId());
                        } else {
                            $res = $competidorModelo->obtenerNombreCompetidorEQUIPO($ranking->getId());
                        }
                    ?>
                    <div class="table__row">
                    <span class="table__position"><?php echo $ranking->getId(); ?></span>

                    <span class="table  __name"><?php echo $res['NOMBRE']; ?></span>
                    <span class="table__points"><?php echo $ranking->getPuntos(); ?></span>
                    </div>

                <?php } ?>                         
                

            </div>

        </section>

    </main>

</body>

</html>