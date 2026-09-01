<?php
require_once "../modelo/Equipo.php";
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
}