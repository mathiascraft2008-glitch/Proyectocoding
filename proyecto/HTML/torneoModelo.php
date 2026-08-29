<?php
require_once "../HTML/Torneo.php";
class torneoModelo{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    function crear(Torneo $torneo){
        $sql = "INSERT INTO torneo (IDORGANIZADOR, NOMBRE, FECHA, FORMATO, DISCIPLINA, LUGAR, PARTICIPACION, CONTRASENA)
        VALUES (:idO, :nombre, :fecha, :formato, :disciplina, :lugar, :participacion, :contrasena)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idO', $torneo->getIdOrganizador());
        $stmt->bindValue(':nombre', $torneo->getNombre());
        $stmt->bindValue(':fecha', $torneo->getFecha());
        $stmt->bindValue(':formato', $torneo->getFormato());
        $stmt->bindValue(':disciplina', $torneo->getDisciplina());
        $stmt->bindValue(':lugar', $torneo->getLugar());
        $stmt->bindValue(':participacion', $torneo->getParticipacion());
        $stmt->bindValue(':contrasena', $torneo->getContrasena());
        return $stmt->execute();
    }


  

function obtenerTorneosCreados($idUsuario) {

    $sql = "SELECT * FROM torneo WHERE IDORGANIZADOR = :id ORDER BY FECHA DESC";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();

    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $torneos = [];

    foreach ($datos as $dato) {
            $torneos[] = new Torneo(
            $dato['ID'],
            $dato['IDORGANIZADOR'],
            $dato['NOMBRE'],
            $dato['FECHA'],
            $dato['FORMATO'],
            $dato['DISCIPLINA'],
            $dato['LUGAR'],
            $dato['PARTICIPACION'],
            $dato['CONTRASENA']
        );
    }

    return $torneos;
}

//function obtenerTorneosParticipa($idUsuario) {

    //$sql = "SELECT * FROM torneo JOIN inscripcion ON torneo.ID = inscripcion.IDTORNEO WHERE inscripcion.IDPARTICIPANTE = :id ORDER BY torneo.FECHA DESC";

    //$stmt = $this->conexion->prepare($sql);
    //$stmt->bindParam(':id', $idUsuario);
    //$stmt->execute();

   // return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

//funcion para la pagina de mostrar competencias
function obtenerTorneosDisponibles($idUsuario) {

    $sql = "SELECT * FROM torneo WHERE IDORGANIZADOR != :id ORDER BY FECHA ASC";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();
    //retornar todos los troneos
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $torneos = [];

    foreach ($datos as $dato) {
            $torneos[] = new Torneo(
            $dato['ID'],
            $dato['IDORGANIZADOR'],
            $dato['NOMBRE'],
            $dato['FECHA'],
            $dato['FORMATO'],
            $dato['DISCIPLINA'],
            $dato['LUGAR'],
            $dato['PARTICIPACION'],
            $dato['CONTRASENA']
        );
    }

    return $torneos;
}

//funcion para obtener la informacion del torneo a mostrar y verificar en detallesTorneo.php
function obtenerTorneo($id){
    $sql = "SELECT * FROM torneo WHERE ID = :id";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $datos = $stmt->fetch(PDO::FETCH_ASSOC);

    return new Torneo(
        $datos['ID'],$datos['IDORGANIZADOR'],$datos['NOMBRE'],$datos['FECHA'],$datos['FORMATO'],
        $datos['DISCIPLINA'],
        $datos['LUGAR'],
        $datos['PARTICIPACION'],
        $datos['CONTRASENA']
    );
}

function obtenerTorneosParticipante($idUsuario) {
    $sql = "SELECT * FROM torneo
            JOIN inscripcion ON inscripcion.IDTORNEO = torneo.ID WHERE inscripcion.IDPARTICIPANTE = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();

    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $torneos = [];

    foreach ($datos as $dato) {
        $torneos[] = new Torneo(
            $dato['ID'],
            $dato['IDORGANIZADOR'],
            $dato['NOMBRE'],
            $dato['FECHA'],
            $dato['FORMATO'],
            $dato['DISCIPLINA'],
            $dato['LUGAR'],
            $dato['PARTICIPACION'],
            $dato['CONTRASENA']
        );
    }

    return $torneos;
}

} 