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
<section class="tournament-header">
        <h2 class="title">Advertencias:</h2>
        <p class="subtitle">Las cantidades de tiempos se definen en base a segundos.</p> 
        <p class="subtitle">La cantidad de intentos máximos involucra el login y el código de doble autenticación.</p> 
    </section>
    <br>
    <br>
<!-- Main -->
<main class="main-content">

    
    <!-- Formulario eliminar usuario -->
    <h2 class="section-title">Definir Intentos Máximos</h2>
    <form action="../controlador/userController.php" method="post">

        <input type="hidden" name="action" value="intentosMaximos">

        <label for="" class="text text-label">
                Ingrese intentos máximos
        </label>
        <input type="number" name="valor" min="1" required class="altabaja">
        

        <input type="submit" class="publish" >        

    </form>
    <br>
    <br>


    <h2 class="section-title">Definir tiempo de bloqueo de login</h2>
    <form action="../controlador/userController.php" method="post">

        <input type="hidden" name="action" value="tiempoBloqueo">

        <label for="" class="text text-label">
                Ingrese la cantidad en segundos
        </label>
        <input type="number" name="valor" min="1" required class="altabaja">
        

        <input type="submit" class="publish" >        

    </form>

<br>
    <br>
    <h2 class="section-title">Definir tiempo de expiración del doble factor</h2>
    <form action="../controlador/userController.php" method="post">

        <input type="hidden" name="action" value="tiempoExpiracion">

        <label for="" class="text text-label">
                Ingrese la cantidad en segundos
        </label>
        <input type="number" name="valor" min="1" required class="altabaja">
        

        <input type="submit" class="publish" >        

    </form>

    

</main>

<!-- Footer -->
<?php include 'footerAdmin.php'; ?>

</body>

</html>
