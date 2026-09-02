
<!DOCTYPE html>

<html lang="es">

<head> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../html/CSS/crearTorneo.css">
<link rel="stylesheet" href="../../html/CSS/headerYfooter.css">
<link rel="stylesheet" href="../../html/fonts/fonts.css">

<title>Crear Torneo - GGchamp</title>

</head>

<body>

    <?php include 'headerAdmin.php'; ?>


<main class="main-content">

    <h1 class="title">Crear torneo</h1>
    <!-- pasos de arriba -->

    <section class="steps-container">

        <div class="step-item step-item--active">
            <div class="step-number">1</div>
            <span class="step-text">Información</span>
        </div>
        <div class="step-item">
            <div class="step-number">2</div>
            <span class="step-text">Revisión</span>
        </div>

    </section>

    <form class="form-container" action="../controlador/torneoController.php" method="post">
        <!-- indicador para el controlador -->
            <input type="hidden" name="action" value="formularioTorneo">
        <h2 class="form-title">
            Información básica
        </h2>

        <div class="form-group">

            <label for="nom">Nombre del torneo</label>

            <input type="text" id="nom" name="nom" required placeholder="Ingrese Un Nombre">

        </div>

        <div class="form-group">

            <label for="nom">Contraseña</label>

            <input type="password" id="contra" name="pass" required placeholder="Ingrese Una Contraseña para el torneo">

        </div>


        <div class="form-group">

            <label for="format">Tipo de formato</label>

            <div class="select-wrapper">

                <select id="format" name="format" required>
                    <option value="suizo">
                        Suizo
                    </option>

                    <option value="eliminacion">
                        Eliminación directa
                    </option>

                    <option value="liga">
                        Liga
                    </option>

                </select>

            </div>

        </div>


        <!-- disciplina-->
        <div class="form-group">

            <label for="disciplina">Disciplina</label>

            <div class="select-wrapper">

                <select name="disciplina" id="disciplina" required>

                    <optgroup label="Deportes">
                        <option value="futbol">Fútbol</option>
                        <option value="basquetbol">Básquetbol</option>
                        <option value="tenis">Tenis</option>
                        <option value="tenis_mesa">Tenis de mesa</option>
                        <option value="voleibol">Voleibol</option>
                    </optgroup>

                    <optgroup label="Juegos mentales y de mesa">
                        <option value="ajedrez">Ajedrez</option>
                        <option value="damas">Damas</option>
                        <option value="uno">UNO</option>
                        <option value="cartas">Juegos de cartas</option>
                    </optgroup>

                    <optgroup label="Esports">
                        <option value="fifa">EA Sports FC</option>
                        <option value="valorant">Valorant</option>
                        <option value="league_of_legends">League of Legends</option>
                        <option value="counter_strike">Counter-Strike</option>
                    </optgroup>

                </select>

            </div>

        </div>

        <!--fecha-->
        <div class="dates-row">
            <div class="form-group">
                <label for="fecha-inicio">Fecha de inicio </label>
                <input type="date" id="fecha-inicio" name="fecha-inicio" required></div>
        </div>


    <!-- lugar-->
        <div class="form-group">
            <label for="lugar">Lugar</label>
            <input type="text" id="lugar" name="lugar" required placeholder="Ingrese El Lugar">
        </div>
        

        <!-- modo individual o por equipos -->
        <div class="form-group">
            <label for="modo">Modo de juego</label>

            <div class="select-wrapper">
                <select id="modo" name="modo" required>
                    <option value="solo">solo</option>
                    <option value="equipo">equipo</option>
                </select>

            </div>
        </div>

        
            <button type="submit" class="btn-next" >
            <span>Siguiente</span>
            </button>
        
        

    </form>

</main>



<?php include 'footerAdmin.php'; ?>

</body>

</html>