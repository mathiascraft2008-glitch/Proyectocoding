<?php
require_once "../modelo/Formato.php";
class formatoModelo{
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    function obtenerFormatos(){
        $sql="SELECT * FROM formato";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $formatos=[];

        foreach ($datos as $dato) {
            $formatos[] = new Formato(
            $dato['NOMBRE'],
            $dato['ACTIVO']
            );
        }

        return $formatos;
    }

    function deshabilitar($nombre){
        $sql="UPDATE formato SET ACTIVO=FALSE WHERE NOMBRE=:nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        return $stmt->execute();
    }

    function habilitar($nombre){
        $sql="UPDATE formato SET ACTIVO=TRUE WHERE NOMBRE=:nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        return $stmt->execute();
    }
}
?>