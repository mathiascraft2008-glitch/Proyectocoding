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


}