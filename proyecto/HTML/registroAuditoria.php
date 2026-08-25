<?php

session_start();

require_once "UsuarioModelo.php";
require_once "conexion.php";

$usuarioModelo = new UsuarioModelo($conexion);

$registros = $usuarioModelo->obtenerRegistros();

?>
<!DOCTYPE html>

<html lang="es">

<head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../CSS/registroAuditoria.css">
<link rel="stylesheet" href="../fonts/fonts.css">
<link rel="stylesheet" href="../CSS/headerYfooter.css">

<title>Registro de auditoría - GGchamp</title>

</head>

<body>

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>

<!-- MAIN -->
<main class="main-content">

    <h1 class="page-title">
        Registro de auditoría
    </h1>

    <!-- Búsqueda -->
    <div class="search-box">

        <span class="search-icon">+</span>

        <input
            type="text"
            class="search-input"
            placeholder="Buscar por id"
        >

    </div>

    <!-- Registros de auditoría -->
    <div class="audit-container">


        <?php foreach ($registros as $r) { ?>

            <article class="audit-card">

                <h2>ID: <?php echo $r['IDUSUARIO']; ?></h2>

                <p><?php echo $r['ACCION']; ?></p>

                <p><?php echo $r['FECHA']; ?></p>

            </article>

        <?php } ?>


    </div>

</main>

<!-- FOOTER -->
<?php include 'footerAdmin.php'; ?>

</body>

</html>