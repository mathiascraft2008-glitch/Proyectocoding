<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../html/CSS/login.css">
    <link rel="stylesheet" href="../../html/fonts/fonts.css">
    <title>verificar</title>
</head>
<body>
    <?php
session_start();
?>

<p>Código de prueba: <?php echo $_SESSION['codigoPrueba']; ?></p>
    <main>
        <div class="main">
            <div class="image">
                <img src="../../html/images/usuario.svg" alt="">
            </div>
            <div class="background_form">
                <h1 class="title">Verificación</h1>
                <p class="text text-nomargin">Te enviamos un código a tu correo</p>
                <br><br>
                <form action="../controlador/userController.php" method="post" enctype="multipart/form-data" class="login">
                    <!-- indicador para el controlador -->
                    <input type="hidden" name="action" value="verificar2p">
                    <input type="text" name="codigo" class="login__input" maxlength="6" required placeholder="000-000">
                    <input type="submit" class="login__submit">
                </form>
            </div>
        </div>
    </main>
</body>
</html>