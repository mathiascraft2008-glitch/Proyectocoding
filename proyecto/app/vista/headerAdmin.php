<?php

//ver si la sesion ya esta abierta para que no salga un error por abrir 2 veces la sesion
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
// Obtener el rol de la sesión, si existe para que no salga warning si no esta autenticado
$rolSesion=$_SESSION['rol'] ?? null;

if ($rolSesion == 'administrador'){
    $rol ="mainAdministrador.php";
}elseif ($rolSesion == 'usuario'){
    $rol="mainUsuario.php";
}else {
    $rol = "mainPublico.php";
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
            <?php if ($rolSesion==null || $rolSesion=="administrador") { ?>
                <a href="competenciasPublicas.php" class="header__link">Competencias</a>
            <?php }else{ ?>
                <a href="competencias.php" class="header__link">Competencias</a>
            <?php } ?>

            <?php if ($rolSesion==null) { ?>
                <a href="login.html" class="avatar__link">
                    <img class="avatar" src="../../html/images/ui_user_profile_avatar_person_icon_208734.webp" >
                </a>
            <?php } else { ?>
                <a href="perfil.php" class="avatar__link">
                    <img class="avatar" src="../../html/images/ui_user_profile_avatar_person_icon_208734.webp" >
                </a>
            <?php } ?>


        </div>
    </header>