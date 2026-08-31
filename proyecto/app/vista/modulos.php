<?php
require_once "../modelo/conexion.php";
require_once "../modelo/formatoModelo.php";


$formatoModelo = new formatoModelo($conexion);

$formatos = $formatoModelo->obtenerFormatos();


?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/editarUser.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
    <title>Editar Usuario - GGchamp</title>
</head>

<body>
    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

<!-- Main -->
<main class="main-content">

    <?php foreach ($formatos as $formato) { ?>

            <article class="tournament-row">
                <p>nombre: <?php echo $formato->getNombre(); ?></p>
                <p>activo: <?php echo $formato->getActivo(); ?></p>

            </article>  
            <br>

    <?php } ?>
    <br>
    <br>
    

    <!-- Formulario eliminar usuario -->
    <h2 class="section-title">Deshabilitar módulos</h2>
    <form action="../controlador/formatoController.php" method="post">

        <input type="hidden" name="action" value="baja">

        <label for="" class="text text-label">
                Seleccione el módulo a deshabilitar
        </label>
        <select name="moduloName" id="" required>
            <option value="suizo">Suizo</option>
            <option value="liga">Liga</option>
            <option value="eliminacion">Eliminación</option>
        </select>
        

        <input type="submit" class="publish">        

    </form>
    <br>
    <br>


    <h2 class="section-title">Habilitar módulos</h2>
    <form action="../controlador/formatoController.php" method="post">

        <input type="hidden" name="action" value="alta">

        <label for="" class="text text-label">
                Seleccione el módulo a habilitar
        </label>
        <select name="moduloName" id="" required>
            <option value="suizo">Suizo</option>
            <option value="liga">Liga</option>
            <option value="eliminacion">Eliminación</option>
        </select>
        

        <input type="submit" class="publish">        

    </form>

    

</main>

<!-- Footer -->
<?php include 'footerAdmin.php'; ?>

</body>

</html>
