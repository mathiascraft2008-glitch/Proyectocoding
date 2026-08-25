<?php

session_start();

require_once "../HTML/conexion.php";
require_once "../HTML/torneoModelo.php";

$idTorneo = $_GET['id'];

$torneoModelo = new torneoModelo($conexion);
$torneo = $torneoModelo->obtenerTorneo($idTorneo);

?>
<!DOCTYPE html>

<html lang="es">

<head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../CSS/detallesTorneo.css">    
<link rel="stylesheet" href="../fonts/fonts.css">
<link rel="stylesheet" href="../CSS/headerYfooter.css">

<title>Detalle del Torneo - GGchamp</title>

</head>

<body>

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

<!-- MAIN -->
<main class="main-content">

    <!-- Imagen -->
    <div class="img"></div>

    <h1 class="tournament-title">
        <?php echo $torneo['NOMBRE'];?>
    </h1>

    <div class="tournament-card">

        <h2 class="card-section-title">
            CONTRASEÑA
        </h2>

        <form action="inscripcionController.php" method="post">
            <!-- indicador para el controlador -->
                    <input type="hidden" name="action" value="passwordTorneo">
            <!-- mandar id para ver a que torneo se quiere inscribir-->
                    <input type="hidden" name="idTorneo" value="<?php echo $torneo['ID']; ?>">

            <!-- contraseña para entrar -->
            <div class="form-row">

                <div class="form-group">
                    <label>Ingrese contraseña para entrar al torneo</label>
                    <input type="password" required name="password">
                </div>


            </div>

            <br>
            
                <button type="submit" class="btn btn-ins">
                    Inscribirse
                </button>
            
        </form>


</main>

<!-- FOOTER -->
<?php include 'footerAdmin.php'; ?>

</body>

</html>