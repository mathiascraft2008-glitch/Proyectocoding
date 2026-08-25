<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0"
    >

    <link rel="stylesheet" href="../CSS/soporte.css">
    <link rel="stylesheet" href="../CSS/headerYfooter.css">
    <link rel="stylesheet" href="../fonts/fonts.css">

    <title>GGchamp - Soporte</title>

</head>


<body>

    <!-- HEADER -->
    <?php include 'headerAdmin.php'; ?>


    <!-- Main -->
    <main class="main-content">

        <h1 class="title">
            Soporte
        </h1>

        <p class="subtitle">
            ¿En qué podemos ayudarte?
        </p>


        <!-- Botones superiores -->
        <section class="support">


            <!-- Preguntas frecuentes -->
            <a href="#01" class="support-link">

                <button class="support-card" type="button">

                    <img class="support-card__icono" src="../images/FAQ.png" alt="">
                    
                    <span class="text">
                        Preguntas frecuentes
                    </span>

                </button>

            </a>


            <!-- Reportar bug -->
            <a href="#02" class="support-link">

                <button class="support-card" type="button">

                    <img class="support-card__icono" src="../images/bug.png" alt="">

                    <span class="text">
                        Reportar bug
                    </span>

                </button>

            </a>


            <!-- Contacto -->
            <a href="#03" class="support-link">

                <button class="support-card" type="button">

                    <img class="support-card__icono" src="../images/contacto.png" alt="">

                    <span class="text">
                        Contáctanos
                    </span>

                </button>

            </a>

        </section>


        <!-- Sección Preguntas frecuentes -->
        <section class="faqs">

            <div id="01" class="section-header">
                
                <img class="square-icon" src="../images/FAQ.png" alt="">

                <h2 class="section-title">
                    Preguntas frecuentes
                </h2>

            </div>


            <details class="faqs__item" open>

                <summary>
                    ¿Cómo me uno a un torneo?
                </summary>

                <div class="faqs__content">

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip.
                    </p>

                </div>

            </details>


            <details class="faqs__item">

                <summary>
                    ¿Qué pasa si no me uno a una partida?
                </summary>

                <div class="faqs__content">

                    <p>
                        Si no te unís a tiempo, podrías quedar descalificado.
                    </p>

                </div>

            </details>


            <details class="faqs__item">

                <summary>
                    ¿Cómo creo un equipo?
                </summary>

                <div class="faqs__content">

                    <p>
                        adawdawdawdawdawd.
                    </p>

                </div>

            </details>


            <details class="faqs__item">

                <summary>
                    ¿Puedo cambiar mi nombre de usuario?
                </summary>

                <div class="faqs__content">

                    <p>
                        Sí, podés cambiarlo desde los ajustes de tu cuenta.
                    </p>

                </div>

            </details>

        </section>


        <!-- Sección Reportar Bug -->
        <section id="02" class="bug-section">

            <div class="section-header">

                <img class="square-icon" src="../images/bug.png" alt="">

                <h2 class="section-title">
                    Reportar bug
                </h2>

            </div>


            <form class="bug-form">

                <input 
                    type="text" 
                    placeholder="¿En qué página ocurrió?"
                    class="form-input"
                >


                <textarea 
                    placeholder="Describa el problema"
                    class="form-textarea"
                ></textarea>

            </form>

        </section>


        <!-- Sección Contacto -->
        <section id="03" class="contact-section">

            <div class="section-header">
                
                <img class="square-icon" src="../images/contacto.png" alt="">

                <h2 class="section-title">
                    Contacto
                </h2>

            </div>


            <p class="contact-text">
                Mándanos un mail si necesitas contactarte con nosotros
            </p>


            <a 
                href="mailto:Undefined@gmail.com" 
                class="contact-email"
            >
                Undefined@gmail.com
            </a>

        </section>

    </main>

</body>

</html>