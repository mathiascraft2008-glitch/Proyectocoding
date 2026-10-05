<?php

session_start();

require_once "../modelo/conexion.php";
require_once "../modelo/equipoModelo.php";
    

$equipoModelo = new equipoModelo($conexion);
$equipos = $equipoModelo->obtenerTodosEquipos();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GGchamp - Equipos</title>
    <link rel="stylesheet" href="/CSS/verEquiposYUsuarios.css">
    <link rel="stylesheet" href="/CSS/headerYfooter.css">
    <link rel="stylesheet" href="/fonts/fonts.css">

</head>
<body>

    <!-- HEADER -->
    <?php include '../../headerAdmin.php'; ?>

    <!-- Main -->
    <main class="main-content">

        <!-- Volver y Título -->
        <section class="back-section">
            
            <h1 class="title">Equipos</h1>
        </section>


        <!-- Contenedor de Filtros y Lista -->
        

            <div class="options-list">

                <?php foreach ($equipos as $equipo) { ?>
                    <div class="option">
                        <div class="option__item">

                            <h3 class="name">
                                ID Equipo: <?php echo $equipo->getId(); ?>
                            </h3>
                            <h3 class="name">
                                Nombre de Equipo: <?php echo $equipo->getNombre(); ?>
                            </h3>
                            <h3 class="name">
                                ID de Torneo: <?php echo $equipo->getIdTorneo(); ?>
                            </h3>
                        <a href="equipoPublico.php?id=<?php echo $equipo->getId(); ?>">
                            Ver perfil
                        </a>
                        </div>
                    </div>
                    

                <?php } ?>

            </div>

        </section>

    </main>
</body>
</html>