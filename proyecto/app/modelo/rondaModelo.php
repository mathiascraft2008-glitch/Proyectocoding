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
                $dato['IDTORNEO']
            );
        }

        return $rondas;
    }

    function crearRonda(Ronda $ronda) {
        $sql = "INSERT INTO ronda (NUMERO, IDTORNEO) VALUES (:numero, :idTorneo)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':numero', $ronda->getNumero());
        $stmt->bindValue(':idTorneo', $ronda->getIdTorneo());
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

    function obtenerUltimaRonda($idTorneo){
        $sql="SELECT * FROM ronda WHERE IDTORNEO = :idTorneo ORDER BY NUMERO DESC LIMIT 1;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();
        $dato = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Ronda(
            $dato['ID'],
            $dato['NUMERO'],
            $dato['IDTORNEO']
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
        $dato['IDTORNEO']
    );
}
}
?>