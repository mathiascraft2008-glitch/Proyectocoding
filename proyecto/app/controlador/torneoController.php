<?php
require_once "../modelo/torneoModelo.php";
require_once "../modelo/conexion.php";
require_once "../modelo/UsuarioModelo.php";
require_once "../modelo/Torneo.php";
require_once "../modelo/Registro.php";
require_once "../modelo/registroModelo.php";
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
    $maxInscripciones = $_POST['maxInscripciones'];

    $torneoModelo = new torneoModelo($conexion);
    // Validaciones
    $formatoBD = $torneoModelo->formatoActivo($formato);

    if (!$formatoBD['ACTIVO']) {
        echo "<script>
                alert('El formato elegido está deshabilitado.');
                window.history.back();
            </script>";
        exit;
    }
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

    
    $registroModelo = new registroModelo($conexion);
    $torneo = new Torneo(null,$idOrganizador,$nombre,$fecha,$formato,$disciplina,$lugar,
                        $participacion,$contraseñaHash,$maxInscripciones);

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
        header("Location: ../vista/$rol"); 
        exit;
    } else {
        echo "<script> alert('Error al crear el torneo.');
                    window.history.back(); </script>";
        exit;
    }
}