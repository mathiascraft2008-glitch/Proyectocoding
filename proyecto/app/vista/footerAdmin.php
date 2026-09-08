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
                <img class="icon-box" src="../../html/images/instagram.png" alt="">
                <img class="icon-box" src="../../html/images/x.png" alt="">
                <img class="icon-box" src="../../html/images/facebook.png" alt="">
            </div>
            <p class="copyright">Copyright© todos los derechos reservados</p>
        </div>
    </footer>