<?php

session_start();

require_once "../modelo/conexion.php";
require_once "../modelo/UsuarioModelo.php";
    

$usuarioModelo = new UsuarioModelo($conexion);
$usuarios = $usuarioModelo->obtenerUsuarios();


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GGchamp - Usuarios</title>
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
            
            <h1 class="title">Usuarios</h1>
        </section>


        <!-- Contenedor de Filtros y Lista -->
        

            <div class="options-list">

                <?php foreach ($usuarios as $usuario) { ?>
                    <div class="option">
                        <div class="option__item">

                            <h3 class="name">
                                ID Usuario: <?php echo $usuario->getId(); ?>
                            </h3>
                            <h3 class="name">
                                Nombre de Usuario: <?php echo $usuario->getNombre(); ?>
                            </h3>
                        <a href="perfilPublico.php?id=<?php echo $usuario->getId(); ?>">
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