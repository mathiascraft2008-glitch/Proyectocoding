<?php

session_start();


require_once "../modelo/torneoModelo.php";
require_once "../modelo/equipoModelo.php";
require_once "../modelo/rondaModelo.php";
require_once "../modelo/UsuarioModelo.php";
require_once "../modelo/competidorModelo.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/partidosModelo.php";
require_once "../modelo/conexion.php";
$idTorneo=$_GET['id'];
$id=$_SESSION['id'];

$torneoModelo = new torneoModelo($conexion);
$rondaModelo = new rondaModelo($conexion);
$equipoModelo=new equipoModelo($conexion);
$competidorModelo = new CompetidorModelo($conexion);
$inscripcionModelo = new inscripcionModelo($conexion);
$PartidosModelo = new PartidosModelo($conexion);
$torneo=$torneoModelo->obtenerTorneo($id);
$cantinscripciones=$inscripcionModelo->cantidadInscripciones($idTorneo);
$cantequipos=$equipoModelo->cantEquipos($idTorneo);
$cantrondas=$rondaModelo->cantidadRondas($idTorneo);
$cantpartidos=$PartidosModelo->cantidadPartidosTorneo($idTorneo);
?>  
<!DOCTYPE html>

<html lang="es">

<head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="/CSS/registroAuditoria.css">
<link rel="stylesheet" href="/fonts/fonts.css">
<link rel="stylesheet" href="/CSS/headerYfooter.css">

<title>Reportes del torneo - GGchamp</title>

</head>

<body>
    <!-- HEADER -->
    <?php include '../../headerAdmin.php'; ?>

<!-- MAIN -->
<main class="main-content">

    <h1 class="page-title">
        Reportes del torneo
    </h1>
<?php ?>

    <!-- Registros de auditoría -->
    <div class="audit-container">
        <h2>Información general</h2>
        <p>Formato: <?php echo $torneo->getFormato() ?></p>
        <p>Modo: <?php echo $torneo->getParticipacion() ?></p>
        <p>Disciplina: <?php echo $torneo->getDisciplina() ?></p>
        <p>Fecha: <?php echo $torneo->getFecha() ?></p>
    </div>

    <br>
    <div class="audit-container">
        <h2>Competidores</h2>
        <p>Inscripciones: <?php echo $cantinscripciones['cantidad'] ?> </p>
        <p>Equipos: <?php echo $cantequipos['cantidad'] ?> </p>
        
    </div>

    <br>
    <div class="audit-container">
        <h2>Competencia </h2>
        <p>Rondas: <?php echo $cantrondas['cantidad'] ?> </p>
        <p>Partidos: <?php echo $cantpartidos['cantidad'] ?> </p>

    </div>
</main>

<!-- FOOTER -->
<?php include '../../footerAdmin.php'; ?>

</body>

</html>