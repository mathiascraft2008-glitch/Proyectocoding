<?php

$rol="";
//ver si la sesion ya esta abierta para que no salga un error por abrir 2 veces la sesion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['rol'] == 'administrador') {
        $rol="mainAdministrador.php";
    }else{
        $rol="mainUsuario.php";
    }

?>
<header class="header">
        <button class="menu">☰</button>

        <a href="<?php echo $rol ?>" class="link-logo">
            <p class="logotipo">
                <span class="logotipo--GG">GG</span>champ
            </p>
        </a>

        <div class="header__nav">
            <a href="AcercaDeNosotros.php" class="header__link">Acerca de nosotros</a>
            <a href="notificaciones.html" class="header__link">Notificaciones</a>
            <a href="competencias.php" class="header__link">Competencias</a>
            <a href="rankings.php" class="header__link">Rankings</a>

            <a href="perfil.php" class="avatar__link">
                <img class="avatar" src="../../html/images/ui_user_profile_avatar_person_icon_208734.webp" alt="Perfil de usuario">
            </a>
        </div>
    </header>