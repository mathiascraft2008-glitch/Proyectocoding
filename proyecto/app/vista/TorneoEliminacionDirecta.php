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
if($torneo->getParticipacion() == 'solo'){
    foreach ($competidores as $competidor) {
        //res guarda $res=['NOMBRE' ->'nombre competidor'], y para acceder al nombre del competidor se hace $res['NOMBRE']
        $res = $competidorModelo->obtenerNombreCompetidorSOLO($competidor->getId());
        //guardar el nombre del competidor en un array con la id del competidor como clave por ejemplo $nombres[1] = "Competidor 1"
        $nombres[$competidor->getId()] = $res['NOMBRE'];
    }
}else{ 
    foreach ($competidores as $competidor) {
        //res guarda $res=['NOMBRE' ->'nombre equipo'], y para acceder al nombre del equipo se hace $res['NOMBRE']
        $res = $competidorModelo->obtenerNombreCompetidorEQUIPO($competidor->getId());
        //guardar el nombre del equipo en un array con la id del competidor como clave, por ejemplo $nombres[1] = "Equipo 1"
        $nombres[$competidor->getId()] = $res['NOMBRE'];
    }
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
        <a href="PanelOrganizador.php?id=<?php echo $idTorneo; ?>">Volver</a>
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
                                    <?php if ($partido->getCompetidor1() !== null){
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
                            <?php if ($ronda->getId() == $ultimaRonda->getId()) { ?>
                                <a href="emparejamientos.php?partido=<?php echo $partido->getId() ?>&torneo=<?php echo $idTorneo ?>">Editar</a>
                            <?php } ?>
                            
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

        <!-- Ver ranking -->
        <a href="rankings.html" class="link"><button class="btn btn--ranking" type="button">Ver ranking</button></a>

    </main>

</body>

</html>
