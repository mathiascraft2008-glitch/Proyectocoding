<?php

session_start();

require_once "../HTML/conexion.php";
require_once "../HTML/torneoModelo.php";
require_once "../HTML/inscripcionModelo.php";
require_once "../HTML/inscripcion.php";

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

//inscribir normal:
if (!$torneo) {
    echo "El torneo no existe";
    exit;
}

if (!password_verify($password, $torneo->getContrasena())) {
    echo "Contraseña incorrecta";
    exit;
}
$inscripcion = new Inscripcion(null,$idUsuario,$torneo->getId(),null);
$resultado = $inscripcionModelo->inscribir($inscripcion);

if ($resultado) {
    if ($_SESSION['rol'] == 'administrador') {
            header("Location: ../HTML/mainAdministrador.php"); exit;
        }else{
            header("Location: ../HTML/mainUsuario.php"); exit;
        }   
    exit;
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
        echo "mal hermano";
    }
}