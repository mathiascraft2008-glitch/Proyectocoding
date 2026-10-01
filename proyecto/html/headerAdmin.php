<?php

// Obtener el rol de la sesión, si existe para que no salga warning si no esta autenticado
$rolSesion=$_SESSION['rol'] ?? null;

if ($rolSesion == 'administrador'){
    $rol ="/app/vista/mainAdministrador.php";
}elseif ($rolSesion == 'usuario'){
    $rol="/app/vista/mainUsuario.php";
}else {
    $rol = "/index.php";
}


?>
<header class="header">
        <button class="menu">☰</button>
            <a href="<?php echo $rol ?>" class="link"><p class="logotipo"><span class="logotipo--GG">GG</span>champ</p></a>
            

        <div class="header__nav">
            <a href="/app/vista/AcercaDeNosotros.php" class="header__link">Acerca de nosotros</a>
            <?php if ($rolSesion==null || $rolSesion=="administrador") { ?>
                <a href="/app/vista/competenciasPublicas.php" class="header__link">Competencias</a>
            <?php }else{ ?>
                <a href="/app/vista/competencias.php" class="header__link">Competencias</a>
            <?php } ?>

            <?php if ($rolSesion==null) { ?>
                <a href="/app/vista/login.html" class="avatar__link">
                    <img class="avatar" src="/images/ui_user_profile_avatar_person_icon_208734.webp" >
                </a>
            <?php } else { ?>
                <a href="/app/vista/perfil.php" class="avatar__link">
                    <img class="avatar" src="/images/ui_user_profile_avatar_person_icon_208734.webp" >
                </a>
            <?php } ?>


        </div>
    </header>