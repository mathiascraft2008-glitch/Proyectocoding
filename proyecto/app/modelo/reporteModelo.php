<?php
class reporteModelo{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    //USUARIOS--------------------------
    function cantidadUsuariosTotales(){
        $sql="SELECT COUNT(ID) AS total FROM usuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function cantidadUsuariosActivos(){
        $sql="SELECT COUNT(ID) AS total FROM usuario WHERE ACTIVO=TRUE";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function cantidadUsuariosBajas(){
        $sql="SELECT COUNT(ID) AS total FROM usuario WHERE ACTIVO=FALSE";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //TORNEOS------------------------------
    function cantidadTorneosTotales(){
        $sql="SELECT COUNT(ID) AS total FROM torneo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function cantidadTorneosSuizo(){
        $sql="SELECT COUNT(ID) AS total FROM torneo WHERE FORMATO='suizo'";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function cantidadTorneosLiga(){
        $sql="SELECT COUNT(ID) AS total FROM torneo WHERE FORMATO='liga'";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function cantidadTorneosEliminacion(){
        $sql="SELECT COUNT(ID) AS total FROM torneo WHERE FORMATO='eliminacion'";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function cantidadTorneosPorDisciplina($disciplina){
        $sql="SELECT COUNT(ID) AS total FROM torneo WHERE DISCIPLINA=:disciplina";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':disciplina', $disciplina);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //INSCRIPCIONES-----------------------
    function cantidadInscripciones(){
        $sql="SELECT COUNT(ID) AS total FROM inscripcion";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


?>