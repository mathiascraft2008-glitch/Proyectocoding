<?php

session_start();

require_once "../HTML/conexion.php";
require_once "../HTML/torneoModelo.php";
require_once "../HTML/inscripcionModelo.php";

$idUsuario = $_SESSION['id'];
$idTorneo = $_POST['idTorneo'];
$password = $_POST['password'];

$torneoModelo = new torneoModelo($conexion);
$inscripcionModelo = new inscripcionModelo($conexion);
$torneo = $torneoModelo->obtenerTorneo($idTorneo);
if (!$torneo) {
    echo "El torneo no existe";
    exit;
}

if (!password_verify($password, $torneo['CONTRASENA'])) {
    echo "Contraseña incorrecta";
    exit;
}

$resultado = $inscripcionModelo->inscribir($idUsuario, $idTorneo);

if ($resultado) {
    header("Location: ../HTML/mainUsuario.php");
    exit;
}