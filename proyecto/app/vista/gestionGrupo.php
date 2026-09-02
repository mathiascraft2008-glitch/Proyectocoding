<?php 
$idTorneo=$_GET['id'];
require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/equipoModelo.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/Equipo.php";

$equipoModelo=new equipoModelo($conexion);
//$participante=$inscripcionModelo->obtenerParticipantes($idTorneo);
$equipos=$equipoModelo->obtenerEquipos($idTorneo);


?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/crearGrupo.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <title>Gestionar Grupo - GGchamp</title>
</head>

<body>

    <!-- HEADER -->
<?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main>
        <?php foreach ($equipos as $equipo) { ?>
            
            <article class="user-item">

                <?php echo $equipo->getNombre(); ?>
                <a href="verGrupos.php?idT=<?php echo $idTorneo ?>&idE=<?php echo $equipo->getId();?>">
                    <button type="submit">GESTIONAR</button>
                </a>
                <form action="../controlador/equipoController.php" method="post">
                    <input type="hidden" name="action" value="eliminarEq">
                    <input type="hidden" name="idE" value="<?php echo $equipo->getId();?>">
                    <input type="hidden" name="idT" value="<?php echo $idTorneo ?>">
                    <button type="submit">Eliminar</button>
                </form>

            </article>
            <br>

        <?php } ?>
    </main>

</body>

</html>