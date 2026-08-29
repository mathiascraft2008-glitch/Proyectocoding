<?php

session_start();

require_once "../HTML/conexion.php";
require_once "../HTML/torneoModelo.php";

$idUsuario = $_SESSION['id'];

$torneoModelo = new torneoModelo($conexion);
$torneos = $torneoModelo->obtenerTorneosDisponibles($idUsuario);

?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/competencias.css">
    <link rel="stylesheet" href="../CSS/headerYfooter.css">
    <link rel="stylesheet" href="../fonts/fonts.css"> 
    <title>Competencias - GGchamp</title>
    </head>

<body>

<!-- HEADER -->
<?php include 'headerAdmin.php'; ?>


<!-- MAIN -->
<main class="main-content">

    <!-- Título y buscador -->
    <div class="top-bar">

        <h1 class="title">Competencias</h1>

        <div class="search-container">
            <input
                class="search-input"
                type="text"
                placeholder="Buscar competencias"
            >

            <button class="filter-toggle-btn">
                <span class="icon-square"></span>
                Filtros
            </button>
        </div>

    </div>


    <!-- Layout principal -->
    <div class="layout-grid">

        <!-- Lista de torneos -->
        <section class="tournaments-section">

            <!-- Filtros rápidos en móvil -->
            <div class="filter-chips">
                <button class="chip chip--active">Todos</button>
                <button class="chip">eSport</button>
                <button class="chip">Deporte</button>
                <button class="chip">Mesa</button>
            </div>


            <p class="subtitle">Próximas competencias</p>


            <div class="tournaments-list">

                <!-- Tarjeta 1 -->
                <?php foreach ($torneos as $torneo) { ?>

                <a class="link" href="detallesTorneo.php?id=<?php echo $torneo->getId(); ?>">

                    <article class="card">

                        <div class="card__img-placeholder">
                            <span class="img-icon">📷</span>
                        </div>

                        <div class="card__content">

                            <div class="card__header">
                                <h3 class="card__category">
                                    <?php echo $torneo->getNombre(); ?>
                                </h3>
                            </div>

                            <div class="card__details">

                                <div class="detail-row">
                                    <img src="../images/reloj.svg" class="iconn" alt="">
                                    <span>
                                        <?php echo $torneo->getFecha(); ?>
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <img src="../images/usuarios.svg" class="iconn" alt="">
                                    <span>
                                        <?php echo $torneo->getDisciplina(); ?>
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span>
                                        <?php echo $torneo->getFormato(); ?>
                                    </span>
                                </div>

                            </div>

                            <span class="card__status">
                                Inscripción abierta
                            </span>

                        </div>

                    </article>

                </a>

            <?php } ?>


        </section>


        <!-- Filtros lateral en desktop -->
        <aside class="filters-sidebar">

            <div class="sidebar__header">
                <span class="menu-icon">☰</span>
                <h2>Filtros</h2>
            </div>

            <div class="sidebar__options">

                <button class="sidebar__btn sidebar__btn--active">
                    Todos
                </button>

                <button class="sidebar__btn">
                    Mesa
                </button>

                <button class="sidebar__btn">
                    Deporte
                </button>

                <button class="sidebar__btn">
                    eSport
                </button>

            </div>

        </aside>

    </div>

</main>


<!-- FOOTER -->
<?php include 'footerAdmin.php'; ?>

</body>

</html>