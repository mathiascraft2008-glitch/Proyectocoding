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
    <link rel="stylesheet" href="../../html/CSS/TorneoEliminacionDirecta.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <link rel="stylesheet" href="../../html/images">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <title>Torneo - Eliminación directa - GGchamp</title>
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
            <p class="subtitle">Eliminación directa</p>
        </section>
        <!-- Partidos de la ronda -->
        <?php foreach ($rondas as $ronda) { ?>
<br>
            <section class="round">

                <h2 class="section-title">
                    RONDA <?php echo $ronda->getNumero(); ?>
                </h2>
                <p>fecha de inicio:<?php echo $ronda->getFechaInicio() ?></p>
                <br>
                <?php $partidos = $partidosModelo->obtenerPartidosPorRonda($ronda->getId());?>
                <div class="matches-grid">

                    <?php foreach ($partidos as $partido) { ?>

                        <div class="match-card">
                            <div class="match-card__header"><h2>Partido <?php echo $partido->getNumero(); ?></h2></div>
                            <div class="match-card__body">
                                <div class="match-card__row">
                                    <span>Competidor 1</span>
                                    <!-- mostrar el nombre e id del competidor1 de este partido, verificando que si no se eligió todavia, no te amnde a la pagina en blanco -->
                                    <?php if ($partido->getCompetidor1() !== null){
                                            echo $nombres[$partido->getCompetidor1()];
                                            echo ", id:" . $partido->getCompetidor1();
                                        } else {
                                            echo "Pendiente"; } ?>
                                </div>
                                <div class="match-card__row">
                                    <span>Competidor 2</span>
                                    <?php if ($partido->getCompetidor2() !== null){
                                            echo $nombres[$partido->getCompetidor2()];
                                            echo ", id:" . $partido->getCompetidor2();
                                        } else {
                                            echo "Pendiente"; } ?>
                                </div>
                            </div>
                            <div class="match-card__row">
                                <span>Ganador:</span>
                                <?php if ($partido->getIdGanador() !== null){
                                            echo $nombres[$partido->getIdGanador()];
                                            echo ", id:" . $partido->getIdGanador();
                                        } else {
                                            echo "Pendiente"; } ?>
                                
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

            </section>

        <?php } ?>
<br>
<br>

        <!-- Avisos -->
        <section class="notices">

            <div class="info-box">
                <img class="info-box__icon" src="../../html/images/bulbo.png" alt="">
                <p class="info-box__text">Los ganadores avanzarán hacia la siguiente ronda</p>
            </div>

            <div class="info-box">
                <img class="info-box__icon" src="../../html/images/bulbo.png" alt="">
                <div class="info-box__text">
                    <strong>Información</strong>
                    <p>En caso de empate, se aplicará el criterio de desempate establecido en el reglamento del torneo</p>
                </div>
            </div>

        </section>

    </main>

</body>

</html>
