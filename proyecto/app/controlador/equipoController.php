<?php
require_once "../modelo/equipoModelo.php";
require_once "../modelo/conexion.php";
require_once "../modelo/Usuario.php";
require_once "../modelo/Registro.php";
require_once "../modelo/Inscripcion.php";
require_once "../modelo/inscripcionModelo.php";
require_once "../modelo/registroModelo.php";
require_once "../modelo/Competidor.php";
require_once "../modelo/competidorModelo.php";
require_once "../modelo/torneoModelo.php";
require_once "../modelo/rondaModelo.php";
$action = $_POST['action'];

if ($action == 'crearGrupo') {
    crear($conexion);
}
if ($action == 'agregar') {
    agregar($conexion);
}
if ($action == 'quitar') {
    quitar($conexion);
}

if ($action == 'eliminarEq') {
    eliminarEquipo($conexion);
}

function crear($conexion){
    $name = $_POST['nombre'];
    $idTorneo= $_POST['idTorneo'];
    $equipoModelo=new equipoModelo($conexion);
    $equipo=new Equipo(null,$name,$idTorneo);
    $torneoModelo = new torneoModelo($conexion);
    $competidorModelo = new CompetidorModelo($conexion);
    $torneo = $torneoModelo->obtenerTorneo($idTorneo);
    $cant=$competidorModelo->CantidadCompetidores($idTorneo);
    if($torneo->getMaxEquipos()==$cant['cantidad']){
        echo "<script> alert('Se alcanzó la cantidad máxima de equipos en el torneo.');
                    window.history.back(); </script>";
        exit;
    }

    $resultado=$equipoModelo->crearEquipo($equipo);
    
    if ($resultado) {
    // Solo crear COMPETIDOR si el torneo es por equipos-------------------------------------
        if ($torneo->getParticipacion() == 'equipo') {

            $idEquipo = $equipoModelo->obtenerEquipoPorIdTorneoYnombre($idTorneo,$name);
            $competidor = new Competidor(null,$idTorneo,'equipo',null,$idEquipo->getId());

            $competidorModelo->NewCompetidorEquipo($competidor);
        }

        header("Location: ../vista/PanelOrganizador.php?id=$idTorneo"); exit;
    } else {
        echo "<script> alert('Error al crear el Equipo.');
                    window.history.back(); </script>";
        exit;
    }
}

function agregar($conexion){
    $idUser=$_POST['idP'];
    $idTorneo=$_POST['idT'];
    $idEquipo=$_POST['idE'];
    $inscripcionModelo=new inscripcionModelo($conexion);
    $inscripcion=new Inscripcion(null,$idUser,$idTorneo,$idEquipo);
    $resultado=$inscripcionModelo->asignarEquipo($inscripcion);
    if($resultado){
        header("Location: ../vista/PanelOrganizador.php?id=$idTorneo"); exit;
    }else{
        echo "<script> alert('Error al asignar este usaurio al equipo.');
                    window.history.back(); </script>";
        exit;
    }
}


function quitar($conexion){
    $idUser=$_POST['idP'];
    $idTorneo=$_POST['idT'];
    $idEquipo=$_POST['idE'];
    $inscripcionModelo=new inscripcionModelo($conexion);
    $inscripcion=new Inscripcion(null,$idUser,$idTorneo,$idEquipo);

    $resultado=$inscripcionModelo->quitarDeEquipo($inscripcion);
    
    if ($resultado) {
        header("Location: ../vista/PanelOrganizador.php?id=$idTorneo"); exit;
    } else {
        echo "<script> alert('Error al crear el Equipo.');
                    window.history.back(); </script>";
        exit;
    }
}

function eliminarEquipo($conexion){
    $idE=$_POST['idE'];
    $idTorneo=$_POST['idT'];
    $equipoModelo=new equipoModelo($conexion);
    $rondaModelo=new rondaModelo($conexion);
    $cantidadRondas = $rondaModelo->cantidadRondas($idTorneo);
    if ($cantidadRondas > 0) {
        echo "<script>
                alert('No se puede eliminar el equipo porque el torneo ya comenzó.');
                window.history.back();
              </script>";
        exit;
    }
    $resultado=$equipoModelo->eliminarEquipo($idE);
    if ($resultado) {
        header("Location: ../vista/PanelOrganizador.php?id=$idTorneo"); exit;
    } else {
        echo "<script> alert('Error al eliminar este Equipo.');
                    window.history.back(); </script>";
        exit;
    }
}

?>