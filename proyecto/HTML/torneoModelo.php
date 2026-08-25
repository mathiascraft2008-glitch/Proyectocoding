<?php
class torneoModelo{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    function crear($idOrganizador,$nombre,$fecha,$formato,$disciplina,$lugar,$participacion,$passwordHash){
        $sql = "INSERT INTO torneo (IDORGANIZADOR, NOMBRE, FECHA, FORMATO, DISCIPLINA, LUGAR, PARTICIPACION, CONTRASENA)
        VALUES (:idO, :nombre, :fecha, :formato, :disciplina, :lugar, :participacion, :contrasena)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idO', $idOrganizador);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':formato', $formato);
        $stmt->bindParam(':disciplina', $disciplina);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':participacion', $participacion);
        $stmt->bindParam(':contrasena', $passwordHash);
        return $stmt->execute();
    }


  

function obtenerTorneosCreados($idUsuario) {

    $sql = "SELECT * FROM torneo WHERE IDORGANIZADOR = :id ORDER BY FECHA DESC";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//function obtenerTorneosParticipa($idUsuario) {

    //$sql = "SELECT * FROM torneo JOIN inscripcion ON torneo.ID = inscripcion.IDTORNEO WHERE inscripcion.IDPARTICIPANTE = :id ORDER BY torneo.FECHA DESC";

    //$stmt = $this->conexion->prepare($sql);
    //$stmt->bindParam(':id', $idUsuario);
    //$stmt->execute();

   // return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

//funcion para la pagina de mostrar competencias
function obtenerTorneosDisponibles($idUsuario) {

    $sql = "SELECT * FROM torneo WHERE IDORGANIZADOR != :id ORDER BY FECHA ASC";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();
    //retornar todos los troneos
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//funcion para obtener la informacion del torneo a mostrar y verificar en detallesTorneo.php
function obtenerTorneo($id){
    $sql = "SELECT * FROM torneo WHERE ID = :id";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerTorneosParticipante($idUsuario) {
    $sql = "SELECT * FROM torneo
            JOIN inscripcion ON inscripcion.IDTORNEO = torneo.ID WHERE inscripcion.IDPARTICIPANTE = :id";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

} 