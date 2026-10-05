<?php

session_start();
require_once "../modelo/UsuarioModelo.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/conexion.php";
$id = $_GET['id'];
$usuarioModelo = new UsuarioModelo($conexion);
$torneoModelo = new torneoModelo($conexion);
$inscripcionModelo = new inscripcionModelo($conexion);

$usuario = $usuarioModelo->obtenerUsuarioPorId($id);
$cantTorneos = $torneoModelo->obtenerCantidadTorneo($id);
$cantInscripciones = $inscripcionModelo->cantidadInscripcionesPerfil($id);
$cantEquipos = $inscripcionModelo->cantEquiposParticipan($id);

?>
 
<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/perfil.css">
    <link rel="stylesheet" href="/fonts/fonts.css">
    <link rel="stylesheet" href="/CSS/headerYfooter.css">
    <title>Perfil - GGchamp</title>
</head>

<body>
    <?php include '../../headerAdmin.php'; ?>
    <main>

        <section class="profile">

            <img 
                class="avatar" 
                src="/images/ui_user_profile_avatar_person_icon_208734.webp"
            >

            <div class="profile__info">

                <h2 class="profile__name">
                    <?php echo $usuario->getNombre(); ?>
                </h2>

                <p class="profile__id">
                    ID: <?php echo $usuario->getId(); ?>
                </p>

            </div>

        </section>

        <section class="stats">
            <div class="stats__item">
                <h3 class="stats__value"><?php echo $cantTorneos['cantidad'] ?></h3>
                <p class="stats__label">Torneos creados</p>
            </div>

            <div class="stats__item">
                <h3 class="stats__value"><?php echo $cantInscripciones['cantidad'] ?></h3>
                <p class="stats__label">Inscripciones</p>
            </div>

            <div class="stats__item">
                <h3 class="stats__value"><?php echo $cantEquipos['cantidad'] ?></h3>
                <p class="stats__label">Equipos</p>
            </div>
        </section>
    </main>
</body>

</html>