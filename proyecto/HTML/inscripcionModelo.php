<?php
class inscripcionModelo {
    
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    function inscribir($idUsuario, $idTorneo) {

        $sql = "INSERT INTO inscripcion (IDPARTICIPANTE, IDTORNEO, IDEQUIPO) VALUES (:usuario, :torneo, NULL)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':usuario', $idUsuario);
        $stmt->bindParam(':torneo', $idTorneo);

        return $stmt->execute();
    }
    //inscripciones para mostrar en solicitudes
    function obtenerInscripciones($idTorneo){
        $sql = "SELECT * FROM inscripcion WHERE IDTORNEO=:id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idTorneo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function eliminarInscripcion($idInscripcion) {
        $sql = "DELETE FROM inscripcion WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idInscripcion);

        return $stmt->execute();
    }
}