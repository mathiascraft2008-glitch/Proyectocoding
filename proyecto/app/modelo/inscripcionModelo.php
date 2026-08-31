<?php
require_once "../modelo/inscripcion.php";
class inscripcionModelo {
    
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    function inscribir(Inscripcion $inscripcion) {
        $sql = "INSERT INTO inscripcion (IDPARTICIPANTE, IDTORNEO, IDEQUIPO) VALUES (:usuario, :torneo, NULL)";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':usuario', $inscripcion->getIdParticipante());
        $stmt->bindValue(':torneo', $inscripcion->getIdTorneo());
        return $stmt->execute();
    }



    //inscripciones para mostrar en solicitudes
    function obtenerInscripciones($idTorneo){
        $sql = "SELECT * FROM inscripcion WHERE IDTORNEO=:id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':id', $idTorneo);
        $stmt->execute();
        $datos= $stmt->fetchAll(PDO::FETCH_ASSOC);
        $inscripciones=[];
        foreach ($datos as $dato) {
            $inscripciones[] = new Inscripcion(
                $dato['ID'],
                $dato['IDPARTICIPANTE'],
                $dato['IDTORNEO'],
                $dato['IDEQUIPO']
            );
        }
        return $inscripciones;
    }

    function eliminarInscripcion($id) {
        $sql = "DELETE FROM inscripcion WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    }
}