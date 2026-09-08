<?php 
class DobleModelo{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearDobleFactor(DobleFactor $dobleFactor) {
        $sql = "INSERT INTO dobleFactor (IDUSUARIO, CODIGO, EXPIRACION, INTENTOS) VALUES (:iduser, :idcode, :idex, :idint)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':iduser', $dobleFactor->getIdUsuario());
        $stmt->bindValue(':idcode', $dobleFactor->getCodigo());
        $stmt->bindValue(':idex', $dobleFactor->getExpiracion());
        $stmt->bindValue(':idint', $dobleFactor->getIntentos());
        return $stmt->execute();
    }

    public function buscarPorUsuario($idUsuario) {
        $sql = "SELECT * FROM dobleFactor WHERE IDUSUARIO = :iduser";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':iduser', $idUsuario);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        //por si no existe
        if (!$datos) {
            return false;
        }
        return new DobleFactor(
            $datos['ID'],
            $datos['IDUSUARIO'],
            $datos['CODIGO'],
            $datos['EXPIRACION'],
            $datos['INTENTOS']
        );
    }

    public function eliminarDobleFactor($id) {
        $sql = "DELETE FROM dobleFactor WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    //cuando el usuario inicie sesion otra vez, que ya no exista el codigo anterior
    public function reemplazarDobleFactor(DobleFactor $dobleFactor) {
        $sql = "UPDATE dobleFactor SET CODIGO = :idcode, EXPIRACION = :idex, INTENTOS = :idint WHERE IDUSUARIO = :iduser";
        $stmt = $this->conexion->prepare($sql);
    
        $stmt->bindValue(':iduser', $dobleFactor->getIdUsuario());
        $stmt->bindValue(':idcode', $dobleFactor->getCodigo());
        $stmt->bindValue(':idex', $dobleFactor->getExpiracion());
        $stmt->bindValue(':idint', $dobleFactor->getIntentos());
        return $stmt->execute();
    }

    public function aumentarIntentos($id) {
        $sql = "UPDATE dobleFactor SET INTENTOS = INTENTOS+1 WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

}
?>