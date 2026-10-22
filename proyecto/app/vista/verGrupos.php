<?php 

session_start();


$idTorneo=$_GET['idT'];
$idEquipo=$_GET['idE'];
require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/equipoModelo.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/Equipo.php";

$inscripcionModelo=new inscripcionModelo($conexion);
$participantes=$inscripcionModelo->obtenerParticipantes($idTorneo);
$participantesDentro=$inscripcionModelo->obtenerParticipantesDeUnEquipo($idTorneo,$idEquipo);

?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/crearGrupo.css">
    <link rel="stylesheet" href="/CSS/headerYfooter.css">
    <link rel="stylesheet" href="/fonts/fonts.css">
    <title>Ver Grupos - GGchamp</title>
</head>

<body>

    <!-- HEADER -->
<?php include '../../headerAdmin.php'; ?>

    <!-- Main -->
    <main>
        <section class="users-section">
        <h2>Participantes para inscribir</h2>
        <?php foreach ($participantes as $participante) { ?>
                <?php echo $participante->getNombre(); ?>
                <?php echo $participante->getId(); ?>
                <form action="../controlador/equipoController.php" method="post">
                <input type="hidden" name="action" value="agregar">
                <input type="hidden" name="idP" value="<?php echo $participante->getId(); ?>">
                <input type="hidden" name="idE" value="<?php echo $idEquipo ?>">
                <input type="hidden" name="idT" value="<?php echo $idTorneo ?>">
                <button type="submit" class="add-user">Agregar</button>
                </form>
        <?php } ?>
        
        </div>
</section>
<section class="users-section">
        <h2>Participantes inscriptos</h2>
        <div class="user-list">
            <?php foreach ($participantesDentro as $participante) { ?>
                <?php echo $participante->getNombre(); ?>
                <?php echo $participante->getId(); ?>
                <form action="../controlador/equipoController.php" method="post">
                <input type="hidden" name="action" value="quitar">
                <input type="hidden" name="idP" value="<?php echo $participante->getId(); ?>">
                <input type="hidden" name="idE" value="<?php echo $idEquipo ?>">
                <input type="hidden" name="idT" value="<?php echo $idTorneo ?>">
                <button type="submit" class="remove-user">Quitar</button>
                </form>
            <?php } ?>
        </div>
        </section>
        
    </main>

</body>

</html>