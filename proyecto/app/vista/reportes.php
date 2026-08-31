<?php 
require_once "../modelo/conexion.php";
require_once "../modelo/reporteModelo.php";
require_once "../modelo/inscripcionModelo.php";
$repo=new reporteModelo($conexion);
$cantUser=$repo->cantidadUsuariosTotales();
$cantUserA=$repo->cantidadUsuariosActivos();
$cantUserB=$repo->cantidadUsuariosBajas();

$cantTorn=$repo->cantidadTorneosTotales();
$cantTornS=$repo->cantidadTorneosSuizo();
$cantTornL=$repo->cantidadTorneosLiga();
$cantTornE=$repo->cantidadTorneosEliminacion();
//$cantTornPorDisciplina=$repo->cantidadTorneosPorDisciplina();

$cantIns=$repo->cantidadInscripciones();

?>

<!DOCTYPE html>

<html lang="es">

<head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../../html/CSS/reportes.css">
<link rel="stylesheet" href="../../html/fonts/fonts.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
<title>Reportes de errores - GGchamp</title>

</head>

<body>

    <!-- HEADER -->
<?php include 'headerAdmin.php'; ?>

<!-- MAIN -->
<main class="main-content">

    <h1 class="page-title">
        Reportes de errores
    </h1>

    <div class="reports-container">

        <!-- REPORTE 2 -->
        <article class="report-card">
            <div class="report-card__header">
                <h2 class="report-card__username">
                    Cantidad de Usuarios Registrados
                </h2>
                <p class="report-card__id">
                    <?php echo $cantUser['total']; ?>
                </p>
            </div>
        </article>

        
    </div>

</main>

<!-- FOOTER -->
    <?php include 'footerAdmin.php'; ?>

</body>

</html>