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
<footer class="footer">
        <a href="<?php echo $rol ?>" class="link"><p class="logotipo"><span class="logotipo--GG">GG</span>champ</p></a>
        <div class="footer__links">
            <a href="Terminos&Condiciones.php" class="link-footer">Términos</a>
            <a href="Terminos&Condiciones.php" class="link-footer">Privacidad</a>
            <a href="AcercaDeNosotros.php" class="link-footer">Acerca de</a>
            <a href="soporte.php" class="link-footer">Contacto</a>
        </div>
        <div class="footer__bottom">
            <div class="footer__icons">
                <img class="icon-box" src="../images/instagram.png" alt="">
                <img class="icon-box" src="../images/x.png" alt="">
                <img class="icon-box" src="../images/facebook.png" alt="">
            </div>
            <p class="copyright">Copyright© todos los derechos reservados</p>
        </div>
    </footer>