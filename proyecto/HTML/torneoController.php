<?php
require_once "../HTML/torneoModelo.php";
require_once "../HTML/conexion.php";
require_once "../HTML/UsuarioModelo.php";
$action = $_POST['action'];

if ($action == 'formularioTorneo') {
    crearTorneo($conexion);
}
function crearTorneo($conexion) {

    session_start();

    $idOrganizador = $_SESSION['id'];

    $nombre = $_POST['nom'];
    $fecha = $_POST['fecha-inicio'];
    $formato = $_POST['format'];
    $disciplina = $_POST['disciplina'];
    $lugar = $_POST['lugar'];
    $participacion = $_POST['modo'];
    $contraseña = $_POST['pass'];

    // Validaciones

    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

    $torneoModelo = new torneoModelo($conexion);
    $usuarioModelo = new UsuarioModelo($conexion);

    $resultado = $torneoModelo->crear($idOrganizador,$nombre,$fecha,$formato,$disciplina,$lugar,$participacion,$contraseñaHash);

    if ($resultado) {
    $usuarioModelo->registroAuditoria(
        $_SESSION['id'],'Se creó un nuevo torneo'
    );
    header("Location: ../HTML/mainUsuario.php"); exit;
    } else {
        echo "No se pudo crear el torneo";
    }
}

