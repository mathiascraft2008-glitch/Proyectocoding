<?php 
$idTorneo=$_GET['id'];
require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/equipoModelo.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/Equipo.php";

$inscripcionModelo=new inscripcionModelo($conexion);
//$participante=$inscripcionModelo->obtenerParticipantes($idTorneo);


?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/crearGrupo.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <title>Crear Grupo - GGchamp</title>
</head>

<body>

    <!-- HEADER -->
<?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main>
        <form class="group-form" action="../controlador/equipoController.php" method="POST">
            <input type="hidden" name="action" value="crearGrupo">
            <input type="hidden" name="idTorneo" value="<?php echo $idTorneo; ?>">
            <!-- Título -->
            <div class="page-title">
                <h1>Crear grupo</h1>
            </div>

            <!-- Información del grupo -->
            <section class="group-info">
                <div class="group-image"></div>
                <div class="group-data">
                    <div class="form__item">
                        <label for="nombre-grupo">Nombre Del Grupo</label>
                        <input type="text" id="nombre-grupo" name="nombre" required>
                    </div>
                </div>
            </section>

            <!-- Crear grupo -->
            <button class="create-group" type="submit">Crear grupo</button>

        </form>
    </main>

</body>

</html>