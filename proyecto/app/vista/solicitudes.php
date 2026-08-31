<?php

require_once "../modelo/conexion.php";
require_once "../modelo/inscripcionModelo.php";

$inscripciones = new inscripcionModelo($conexion);
$idTorneo = $_GET['id'];
$listar = $inscripciones->obtenerInscripciones($idTorneo);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GGchamp - Solicitudes</title>
    <link rel="stylesheet" href="../../html/CSS/solicitudes.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">

</head>
<body>

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

    <!-- Main -->
    <main class="main-content">

        <!-- Volver y Título -->
        <section class="back-section">
            
            <h1 class="title">Inscripciónes</h1>
        </section>


        <!-- Contenedor de Filtros y Lista -->
        

            <div class="options-list">

                <?php foreach ($listar as $lista) { ?>
                    <div class="option">

                        <div class="img"></div>
                        <div class="option__item">

                            <h3 class="name">
                                ID Usuario: <?php echo $lista->getIdParticipante(); ?>
                            </h3>

                            <form action="../controlador/inscripcionController.php" method="post">
                                <input type="hidden" name="action" value="eliminarInscripcion">
                                <input type="hidden" name="idInscripcion" value="<?php echo $lista->getId(); ?>">
                                <input type="hidden" name="idTorneo" value="<?php echo $idTorneo; ?>">
                                <button type="submit">
                                    Eliminar
                                </button>
                            </form>

                        </div>
                    </div>

                <?php } ?>

            </div>

        </section>

    </main>
</body>
</html>