<?php
session_start();

require_once "../modelo/conexion.php";
require_once "../modelo/equipoModelo.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/inscripcionModelo.php";

$equipoModelo = new equipoModelo($conexion);
$torneoModelo = new torneoModelo($conexion);
$inscripcionModelo = new inscripcionModelo($conexion);

$id = $_GET['id'];

$equipo = $equipoModelo->obtenerEquipo($id);


$torneo = $torneoModelo->obtenerTorneo($equipo->getIdTorneo());
$participantes = $inscripcionModelo->obtenerParticipantesDeUnEquipo( $torneo->getId(), $id );
?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/perfil.css">
    <link rel="stylesheet" href="/fonts/fonts.css">
    <link rel="stylesheet" href="/CSS/headerYfooter.css">
    <title>Equipo - GGchamp</title>

</head>

<body>

    <?php include '../../headerAdmin.php'; ?>


    <main>


        <section class="profile">


            <div class="profile__info">

                <h2 class="profile__name">
                    Nombre: <?php echo $equipo->getNombre(); ?>
                </h2>

                <p class="profile__id">
                    ID: <?php echo $equipo->getId(); ?>
                </p>

            </div>

        </section>

        <h2 class="section-title">
            Torneo
        </h2>

        <section class="stats">

            <div class="stats__item">

                <h3 class="stats__value">
                    <?php echo $torneo->getNombre(); ?>
                </h3>

                <p class="stats__label">
                    Nombre del torneo
                </p>

            </div>


            <div class="stats__item">

                <h3 class="stats__value">
                    <?php echo $torneo->getId(); ?>
                </h3>

                <p class="stats__label">
                    ID del torneo
                </p>

            </div>

        </section>


            <h2 class="section-title"> Participantes </h2> 
            <section class="settings"> 
                <?php foreach ($participantes as $participante) { ?> 
                <div class="settings__item"> 
                    <p class="settings__label"> <?php echo $participante->getNombre(); ?> </p> 
                    <a href="perfilPublico.php?id=<?php echo $participante->getId(); ?>" > Ver perfil </a> 
                </div> <?php } ?> 
            </section>


    </main>

</body>

</html>
