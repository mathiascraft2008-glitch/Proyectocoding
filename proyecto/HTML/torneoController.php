<?php
require_once "../HTML/torneoModelo.php";
require_once "../HTML/conexion.php";
require_once "../HTML/UsuarioModelo.php";
require_once "../HTML/Torneo.php";
require_once "../HTML/Registro.php";
require_once "../HTML/RegistroModelo.php";
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
    $registroModelo = new registroModelo($conexion);

    $torneo = new Torneo(null,$idOrganizador,$nombre,$fecha,$formato,$disciplina,$lugar,
                        $participacion,$contraseñaHash);

    $resultado = $torneoModelo->crear($torneo);
    $registro=new Registro(null,"Se creó un nuevo torneo, id organizador: ",$idOrganizador,null);

    if ($resultado) {
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
        $registroModelo->registroAuditoria($registro);
        header("Location: ../HTML/$rol"); 
        exit;
    } else {
        echo "No se pudo crear el torneo";
    }
}

