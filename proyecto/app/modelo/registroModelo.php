<?php
class RegistroModelo {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registroAuditoria(Registro $registro) {
        $sql = "INSERT INTO registro (ACCION, IDUSUARIO, FECHA) VALUES (:accion, :idUsuario, NOW())";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':idUsuario', $registro->getIdUsuario());
        $stmt->bindValue(':accion', $registro->getAccion()); 
        return $stmt->execute();    
    }

    public function obtenerRegistros() {
        $sql = "SELECT * FROM registro ORDER BY FECHA DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $datos= $stmt->fetchAll(PDO::FETCH_ASSOC);
        $registros = [];

        foreach ($datos as $dato) {
                $registros[] = new Registro(
                $dato['ID'],
                $dato['ACCION'],
                $dato['IDUSUARIO'],
                $dato['FECHA']

            
            );
        }
        return $registros;
    }
}
?>