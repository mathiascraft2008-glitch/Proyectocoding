<?php
class CompetidorModelo {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function NewCompetidorSolo(Competidor $competidor) {
        $sql = "INSERT INTO competidor (IDTORNEO, TIPO, IDINSCRIPCION, IDEQUIPO) VALUES (:idtorneo, :tipo, :iinscripcion, NULL)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idtorneo', $competidor->getIdTorneo());
        $stmt->bindValue(':tipo', $competidor->getTipo()); 
        $stmt->bindValue(':iinscripcion', $competidor->getIdInscripcion());  
        return $stmt->execute();    
    }

    public function NewCompetidorEquipo(Competidor $competidor) {
        $sql = "INSERT INTO competidor (IDTORNEO, TIPO, IDINSCRIPCION, IDEQUIPO) VALUES (:idtorneo, :tipo, NULL, :idequipo)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idtorneo', $competidor->getIdTorneo());
        $stmt->bindValue(':tipo', $competidor->getTipo()); 
        $stmt->bindValue(':idequipo', $competidor->getIdEquipo());  
        return $stmt->execute();    
    }
}
?>