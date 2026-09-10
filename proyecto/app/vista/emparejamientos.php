<?php
require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/Partidos.php";
require_once "../modelo/Competidor.php";
require_once "../modelo/competidorModelo.php";
require_once "../modelo/rondaModelo.php";
require_once "../modelo/partidosModelo.php";
$idPartido = $_GET['partido'];
$idTorneo = $_GET['torneo'];

$competidorModelo = new CompetidorModelo($conexion);
$competidores = $competidorModelo->obtenerCompetidoresPorTorneo($idTorneo);
$torneoModelo = new torneoModelo($conexion);
$torneo = $torneoModelo->obtenerTorneo($idTorneo);

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
//para saber si en esta ronda hay que prohibir editar los competidores
$partidosModelo = new partidosModelo($conexion);
$rondaModelo = new rondaModelo($conexion);
$partido = $partidosModelo->obtenerPartidoPorId($idPartido);
$ronda = $rondaModelo->obtenerRondaPorId($partido->getIdRonda());
//$ronda->getNumero()
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/emparejamientos.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <title>Emparejamientos</title>
</head>

<body>  


    <?php include 'headerAdmin.php'; ?>


    <main>

        <h1 class="title">Emparejamientos</h1>


        <section class="round">

            <h2 class="round__title">Ronda 3</h2>

  
            <div class="matches">

                <!--enfrentamiento1-->
                
                <div class="match">
                    <div class="match__content">

                        <form class="match__form" action="../controlador/torneoController.php" method="post">
                            <input type="hidden" name="action" value="actualizarEmparejamiento">
                            <input type="hidden" name="idPartido" value="<?php echo $idPartido; ?>">
                            <input type="hidden" name="idTorneo" value="<?php echo $idTorneo; ?>">



                            <div class="match__competitor">
                                <label>Competidor 1:</label>
                                <?php if ($ronda->getNumero() == 1) { ?>
                                    <select name="competidor1" required>

                                        <?php foreach ($competidores as $competidor) { ?>
                                            <option value="<?php echo $competidor->getId(); ?>">
                                                <?php echo $nombres[$competidor->getId()]; ?>
                                            </option>
                                        <?php } ?>

                                    </select>
                                <?php } else { ?>
                                    <?php echo $nombres[$partido->getCompetidor1()]; ?>
                                <?php } ?>
                            </div>



                            <div class="match__competitor">
                                <label>Competidor 2:</label>
                                <?php if ($ronda->getNumero() == 1) { ?>
                                    <select name="competidor2" required>
                                        <?php foreach ($competidores as $competidor) { ?>
                                            <option value="<?php echo $competidor->getId(); ?>">
                                                <?php echo $nombres[$competidor->getId()]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <?php echo $nombres[$partido->getCompetidor2()]; ?>
                                <?php } ?>
                            </div>



                            <div class="match__competitor">
                                <label>Ganador:</label>
                                <?php if ($ronda->getNumero() == 1) { ?>
                                    <select name="ganador" required>
                                        
                                        <?php foreach ($competidores as $competidor) { ?>
                                            <option value="<?php echo $competidor->getId(); ?>">
                                                <?php echo $nombres[$competidor->getId()]; ?>
                                            </option>
                                        <?php } ?>
                                    
                                    </select>
                                <?php } else { ?>
                                    <select name="ganador" required>
                                        <option value="<?php echo $partido->getCompetidor1(); ?>">
                                            <?php echo $nombres[$partido->getCompetidor1()]; ?>
                                        </option>

                                        <option value="<?php echo $partido->getCompetidor2(); ?>">
                                            <?php echo $nombres[$partido->getCompetidor2()]; ?>
                                        </option>
                                    </select>
                                <?php } ?>
                            </div>
                            <br>

                            <button type="submit" class="btn btn--primary">Guardar Emparejamiento</button>
                        </form>
                    </div>
                </div>

            
            
        </section>

    </main>

</body>

</html>