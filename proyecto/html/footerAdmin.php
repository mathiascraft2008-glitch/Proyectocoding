<?php
// Obtener el rol de la sesión, si existe para que no salga warning si no esta autenticado
$rolSesion=$_SESSION['rol'] ?? null;

if ($rolSesion == 'administrador'){
    $rol ="mainAdministrador.php";
}elseif ($rolSesion == 'usuario'){
    $rol="mainUsuario.php";
}else {
    $rol = "index.php";
}

?>
<footer class="footer">
            <?php if ($rolSesion == 'administrador' || $rolSesion == 'usuario'){ ?>
            <a href="/app/vista/<?php echo $rol ?>" class="link"><p class="logotipo"><span class="logotipo--GG">GG</span>champ</p></a>
            <?php }else{ ?>
            <a href="<?php echo $rol ?>" class="link"><p class="logotipo"><span class="logotipo--GG">GG</span>champ</p></a>
            <?php } ?>
        <div class="footer__links">
            <a href="/app/vista/Terms.php" class="link-footer">Términos</a>
            <a href="/app/vista/Politica.php" class="link-footer">Privacidad</a>
            <a href="/app/vista/AcercaDeNosotros.php" class="link-footer">Acerca de</a>
            <a href="/app/vista/soporte.php" class="link-footer">Contacto</a>
        </div>
        <div class="footer__bottom">
            <div class="footer__icons">
                <img class="icon-box" src="/images/instagram.png" alt="">
                <img class="icon-box" src="/images/x.png" alt="">
                <img class="icon-box" src="/images/facebook.png" alt="">
            </div>
            <p class="copyright">Copyright© todos los derechos reservados</p>
        </div>
    </footer>