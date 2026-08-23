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
}