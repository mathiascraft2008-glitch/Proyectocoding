<?php
require_once "../modelo/Inscripcion.php";
require_once "../modelo/Usuario.php";
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

    function asignarEquipo(Inscripcion $inscripcion) {
        $sql = "UPDATE inscripcion SET IDEQUIPO = :equipo WHERE IDPARTICIPANTE = :participante
                AND IDTORNEO = :torneo";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':equipo', $inscripcion->getIdEquipo());
        $stmt->bindValue(':participante', $inscripcion->getIdParticipante());
        $stmt->bindValue(':torneo', $inscripcion->getIdTorneo());
        return $stmt->execute();
    }


    function quitarDeEquipo(Inscripcion $inscripcion) {
        $sql = "UPDATE inscripcion SET IDEQUIPO = null WHERE IDPARTICIPANTE = :participante
                AND IDTORNEO = :torneo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':participante', $inscripcion->getIdParticipante());
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

    

    //inscripciones para mostrar en cada equipo para agregar
    function obtenerParticipantes($idTorneo){
        //no pongo select * porque si no hay problemas con que id agarra la vista.
        $sql = "SELECT usuario.ID, usuario.NOMBRE, usuario.MAIL,usuario.CONTRASEÑA, usuario.ROL, usuario.ACTIVO
                FROM usuario JOIN inscripcion ON usuario.ID = inscripcion.IDPARTICIPANTE
                WHERE inscripcion.IDTORNEO = :idTorneo 
                AND usuario.ID IN 
                (SELECT IDPARTICIPANTE
                FROM inscripcion
                WHERE IDEQUIPO IS NULL);";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->execute();
        $datos= $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usuarios=[];
        foreach ($datos as $dato) {
            $usuarios[] = new Usuario(
                $dato['ID'],
                $dato['NOMBRE'],
                $dato['MAIL'],
                $dato['CONTRASEÑA'],
                $dato['ROL'],
                $dato['ACTIVO']
            );
        }
        return $usuarios;
    }

//obtener los participantes que estan en el equipo seleccionado
    function obtenerParticipantesDeUnEquipo($idTorneo,$idEquipo){
        //no pongo select * porque si no hay problemas con que id agarra la vista.
        $sql="SELECT usuario.ID, usuario.NOMBRE, usuario.MAIL,usuario.CONTRASEÑA, usuario.ROL, usuario.ACTIVO 
                FROM usuario JOIN inscripcion ON inscripcion.IDPARTICIPANTE=usuario.ID 
                WHERE inscripcion.IDTORNEO = :idTorneo 
                AND usuario.ID IN 
                (SELECT IDPARTICIPANTE
                FROM inscripcion
                WHERE IDEQUIPO = :idEquipo);";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':idTorneo', $idTorneo);
        $stmt->bindValue(':idEquipo', $idEquipo);
        $stmt->execute();
        $datos= $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usuarios=[];
        foreach ($datos as $dato) {
            $usuarios[] = new Usuario(
                $dato['ID'],
                $dato['NOMBRE'],
                $dato['MAIL'],
                $dato['CONTRASEÑA'],
                $dato['ROL'],
                $dato['ACTIVO']
            );
        }
        return $usuarios;
    }


    function eliminarInscripcion($id) {
        $sql = "DELETE FROM inscripcion WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    }
}