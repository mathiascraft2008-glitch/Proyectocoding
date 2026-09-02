<?php

session_start();

require_once "../modelo/conexion.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/Inscripcion.php";
require_once "../modelo/Competidor.php";
require_once "../modelo/competidorModelo.php";

$idUsuario = $_SESSION['id'];
$idTorneo = $_POST['idTorneo'];
$password = $_POST['password'];

$torneoModelo = new torneoModelo($conexion);
$inscripcionModelo = new inscripcionModelo($conexion);
$torneo = $torneoModelo->obtenerTorneo($idTorneo);

$action = $_POST['action'];
if ($action == 'eliminarInscripcion') {
    eliminarInscripcion($conexion);
}

//inscribir normal-----------------------------------------------------:
if (!$torneo) {
    echo "<script> alert('Este torneo ya no existe.');
                    window.history.back(); </script>";
        exit;
}

if (!password_verify($password, $torneo->getContrasena())) {
    echo "<script> alert('Contraseña incorrecta.');
                    window.history.back(); </script>";
        exit;
}
$inscripcion = new Inscripcion(null,$idUsuario,$torneo->getId(),null);
$resultado = $inscripcionModelo->inscribir($inscripcion);

//NUEVO COMPETIDOR INDIVIDUAL---------------------------------------------------------------------
$competidor=new Competidor(null,$torneo->getId(),'individual',$idUsuario,null);
$competidorModelo = new CompetidorModelo($conexion);
$competidorModelo->NewCompetidorSolo($competidor);



if ($resultado) {
    if ($_SESSION['rol'] == 'administrador') {
            header("Location: ../vista/mainAdministrador.php"); exit;
        }else{
            header("Location: ../vista/mainUsuario.php"); exit;
        }   
}

function eliminarInscripcion($conexion) {
    $idInscripcion = $_POST['idInscripcion'];
    $idTorneo = $_POST['idTorneo'];
    $inscripcionModelo = new inscripcionModelo($conexion);

    $resultado = $inscripcionModelo->eliminarInscripcion($idInscripcion);
    if ($resultado) {
        header("Location: solicitudes.php?id=$idTorneo");
        exit;
    } else {
        echo "<script> alert('Error al eliminar la inscripción.');
                    window.history.back(); </script>";
        exit;
    }
}