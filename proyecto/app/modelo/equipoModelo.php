<?php
require_once "Equipo.php";
class equipoModelo {
    
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    function crearEquipo(Equipo $equipo) {
        $sql = "INSERT INTO equipo (ID, NOMBRE, IDTORNEO) VALUES (NULL, :nombre, :torneo)";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':nombre', $equipo->getNombre());
        $stmt->bindValue(':torneo', $equipo->getIdTorneo());
        return $stmt->execute();
    }

    function obtenerEquipos($idTorneo){
        $sql = "SELECT * FROM equipo WHERE IDTORNEO=:id";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':id', $idTorneo);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $equipos = [];

        foreach ($datos as $dato) {
                $equipos[] = new Equipo(
                $dato['ID'],
                $dato['NOMBRE'],
                $dato['IDTORNEO']
            );
        }

        return $equipos;

    }


    function eliminarEquipo($id){
        $sql = "DELETE FROM equipo WHERE ID=:id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }


    function obtenerEquipoPorIdTorneoYnombre($idTorneo, $nombre) {
        $sql = "SELECT * FROM equipo WHERE IDTORNEO = :idTorneo AND NOMBRE = :nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->execute();
        $dato = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Equipo(
            $dato['ID'],
            $dato['NOMBRE'],
            $dato['IDTORNEO']
        );
    }

    function cantEquipos($idTorneo){
        $sql = "SELECT COUNT(*) as cantidad FROM equipo WHERE IDTORNEO = :idTorneo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    function obtenerTodosEquipos(){
        $sql = "SELECT * FROM equipo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $equipos = [];

        foreach ($datos as $dato) {
                $equipos[] = new Equipo(
                $dato['ID'],
                $dato['NOMBRE'],
                $dato['IDTORNEO']
            );
        }

        return $equipos;

    }

    function obtenerEquipo($id){
        $sql = "SELECT * FROM equipo WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $dato = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Equipo(
            $dato['ID'],
            $dato['NOMBRE'],
            $dato['IDTORNEO']
        );
    }
}