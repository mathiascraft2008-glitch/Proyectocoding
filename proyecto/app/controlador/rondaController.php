<?php
require_once "../modelo/torneoModelo.php";
require_once "../modelo/conexion.php";
require_once "../modelo/UsuarioModelo.php";
require_once "../modelo/Torneo.php";
require_once "../modelo/Registro.php";
require_once "../modelo/registroModelo.php";
require_once "../modelo/Ronda.php";
require_once "../modelo/rondaModelo.php";
require_once "../modelo/Partidos.php";
require_once "../modelo/partidosModelo.php";
require_once "../modelo/competidorModelo.php";
require_once "../modelo/Competidor.php";

$action = $_POST['action'];

if ($action == 'fechaLiga') {
    IngresarFecha($conexion);
}
//para el formato liga
function IngresarFecha($conexion){
    session_start();
    $idSesion = $_SESSION['id'];

    $fecha=$_POST['fecha'];
    $idRonda=$_POST['idRonda'];
    $torneoModelo = new torneoModelo($conexion);
    
    $rondaModelo = new rondaModelo($conexion);
    
    $ronda = $rondaModelo->obtenerRondaPorId($idRonda);
    $torneo = $torneoModelo->obtenerTorneo($ronda->getIdTorneo());

    if ($idSesion != $torneo->getIdOrganizador()) {
        echo "<script>
                alert('No tenés permiso para modificar la fecha de esta ronda.');
                window.history.back();
              </script>";
        exit;
    }
    $rondaModelo->actualizarFecha($fecha,$idRonda);
    echo "<script>window.history.back();</script>";
}
?>