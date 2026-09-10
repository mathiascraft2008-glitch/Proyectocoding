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

    function obtenerCompetidoresPorTorneo($idTorneo) {
        $sql = "SELECT * FROM competidor WHERE IDTORNEO = :idTorneo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $competidores = [];

        foreach ($datos as $dato) {
            $competidores[] = new Competidor(
                $dato['ID'],
                $dato['IDTORNEO'],
                $dato['TIPO'],
                $dato['IDINSCRIPCION'],
                $dato['IDEQUIPO']
            );
        }

        return $competidores;
    }



//cantidad de competidores para saber si se puede crear las jornadas con todos los enfrentamientos

function CantidadCompetidores($idTorneo) {
        $sql = "SELECT COUNT(*) as cantidad FROM competidor WHERE IDTORNEO = :idTorneo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }







    //obtener nombres de competidores tanto de equipo como de solo
    function obtenerNombreCompetidorEQUIPO($idCompetidor){
        $sql="SELECT NOMBRE FROM equipo JOIN competidor ON equipo.ID = competidor.IDEQUIPO WHERE competidor.ID=:idCompetidor";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idCompetidor', $idCompetidor);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function obtenerNombreCompetidorSOLO($idCompetidor){
        $sql="SELECT NOMBRE FROM usuario JOIN inscripcion ON usuario.ID=inscripcion.IDPARTICIPANTE JOIN competidor ON inscripcion.ID=competidor.IDINSCRIPCION WHERE competidor.ID=:idCompetidor";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idCompetidor', $idCompetidor);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}