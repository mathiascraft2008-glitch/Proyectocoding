<?php
require_once 'Ronda.php';
class RondaModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    function obtenerRondasPorTorneo($idTorneo) {
        $sql = "SELECT * FROM ronda WHERE IDTORNEO = :idTorneo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rondas = [];

        foreach ($datos as $dato) {
            $rondas[] = new Ronda(
                $dato['ID'],
                $dato['NUMERO'],
                $dato['IDTORNEO'],
                $dato['FECHAINICIO']
            );
        }

        return $rondas;
    }

    function crearRonda(Ronda $ronda) {
        $sql = "INSERT INTO ronda (NUMERO, IDTORNEO, FECHAINICIO) VALUES (:numero, :idTorneo, :fechaInicio)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':numero', $ronda->getNumero());
        $stmt->bindValue(':idTorneo', $ronda->getIdTorneo());
        $stmt->bindValue(':fechaInicio', $ronda->getFechaInicio());
        return $stmt->execute();
    }

//obtener cantidad de partidos pendientes de la ronda anterior
    function rondaAnteriorTerminada($idRonda) {
        $sql = "SELECT COUNT(*) AS partidosPendientes FROM partido WHERE IDRONDA = :idRonda AND IDGANADOR IS NULL";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idRonda', $idRonda);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    //obtener cantidad de partidos pendientes de la ronda anterior para el sisteam suizo------
    function rondaSuizaTerminada($idRonda) {

    $sql = "SELECT COUNT(*) AS partidosPendientes FROM partido WHERE IDRONDA = :idRonda
            AND IDGANADOR IS NULL
            AND EMPATE IS NULL";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':idRonda', $idRonda);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    function obtenerUltimaRonda($idTorneo){
        $sql="SELECT * FROM ronda WHERE IDTORNEO = :idTorneo ORDER BY NUMERO DESC LIMIT 1;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();
        $dato = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Ronda(
            $dato['ID'],
            $dato['NUMERO'],
            $dato['IDTORNEO'],
            $dato['FECHAINICIO']
        );

    }

    function obtenerRondaPorId($idRonda) {
    $sql = "SELECT * FROM ronda WHERE ID = :idRonda";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':idRonda', $idRonda);
    $stmt->execute();

    $dato = $stmt->fetch(PDO::FETCH_ASSOC);
    return new Ronda(
        $dato['ID'],
        $dato['NUMERO'],
        $dato['IDTORNEO'],
        $dato['FECHAINICIO']
    );
}

function cantidadRondas($idTorneo){
    $sql = "SELECT COUNT(*) as cantidad FROM ronda WHERE IDTORNEO = :idTorneo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
}

function actualizarFecha($fecha,$idRonda){
    $sql = "UPDATE ronda SET FECHAINICIO=:fecha WHERE ID=:id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':fecha', $fecha);
        $stmt->bindValue(':id', $idRonda);
        $stmt->execute();
}
}
?>