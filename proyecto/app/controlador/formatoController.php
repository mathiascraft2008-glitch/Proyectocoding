<?php

session_start();

require_once "../modelo/conexion.php";
require_once "../modelo/formatoModelo.php";
require_once "../modelo/Formato.php";
$action = $_POST['action'];

if ($action == 'alta') {
    habilitar($conexion);
}
if ($action == 'baja') {
    deshabilitar($conexion);
}

function habilitar($conexion) {

    if ($_SESSION['rol'] !== 'administrador') {
        echo "<script>
                alert('No tenés permisos de administrador.');
                window.history.back();
              </script>";
        exit;
    }

    $nombre = $_POST['moduloName'];

    $formatoModelo = new formatoModelo($conexion);

    $resultado = $formatoModelo->habilitar($nombre);

    if ($resultado) {
        header("Location: ../vista/modulos.php");
        exit;
    } else {
        echo "<script>
                alert('No se pudo modificar el estado del formato.');
                window.history.back();
              </script>";
        exit;
    }
}


function deshabilitar($conexion) {

    if ($_SESSION['rol'] !== 'administrador') {
        echo "<script>
                alert('No tenés permisos de administrador.');
                window.history.back();
              </script>";
        exit;
    }

    $nombre = $_POST['moduloName'];

    $formatoModelo = new formatoModelo($conexion);

    $resultado = $formatoModelo->deshabilitar($nombre);

    if ($resultado) {
        header("Location: ../vista/modulos.php");
        exit;
    } else {
        echo "<script>
                alert('No se pudo modificar el estado del formato.');
                window.history.back();
              </script>";
        exit;
    }
}