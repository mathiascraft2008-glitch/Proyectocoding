<?php
require_once "../modelo/Usuario.php";
class UsuarioModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario(Usuario $usuario) {
        $sql = "INSERT INTO usuario (NOMBRE, MAIL, CONTRASEÑA, ROL)
        VALUES (:nombre, :mail, :pass, 'usuario')";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':nombre', $usuario->getNombre());
        $stmt->bindValue(':mail', $usuario->getMail());
        $stmt->bindValue(':pass', $usuario->getContrasena());

        return $stmt->execute();

    }

    public function registrarUsuarioAdmin(Usuario $usuario) {
        $sql = "INSERT INTO usuario (NOMBRE, MAIL, CONTRASEÑA, ROL)
        VALUES (:nombre, :mail, :pass, 'administrador')";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':nombre', $usuario->getNombre());
        $stmt->bindValue(':mail', $usuario->getMail());
        $stmt->bindValue(':pass', $usuario->getContrasena());

        return $stmt->execute();

    }

    function BuscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuario WHERE MAIL = :mail AND ACTIVO = TRUE";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':mail', $email);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$datos) {
            return null;
        }

        return new Usuario(
            $datos['ID'],
            $datos['NOMBRE'],
            $datos['MAIL'],
            $datos['CONTRASEÑA'],
            $datos['ROL'],
            $datos['ACTIVO']
        );
    }

    function DeleteUsuario($id){
    
        $sql = "UPDATE usuario SET ACTIVO = FALSE WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();      

    }
    
    function AltaUsuario($id){
    
        $sql = "UPDATE usuario SET ACTIVO = TRUE WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();      

    }


    function editarUsuario(Usuario $usuario) {
    $sql = "UPDATE usuario SET NOMBRE = :nombre,MAIL = :mail,CONTRASEÑA = :password
            WHERE ID = :id";

    $stmt = $this->conexion->prepare($sql);
    $stmt->bindValue(':nombre', $usuario->getNombre());
    $stmt->bindValue(':mail', $usuario->getMail());
    $stmt->bindValue(':password', $usuario->getContrasena());
    $stmt->bindValue(':id', $usuario->getId());
    return $stmt->execute();
}




    function editarPerfil(Usuario $usuario) {

    $sql = "UPDATE usuario SET NOMBRE = :nombre, MAIL = :mail WHERE ID = :id";

    $stmt = $this->conexion->prepare($sql);

    $stmt->bindValue(':nombre', $usuario->getNombre());
    $stmt->bindValue(':mail', $usuario->getMail());
    $stmt->bindValue(':id', $usuario->getId());

    return $stmt->execute();
}



    function editarPassword(Usuario $usuario) {

    $sql = "UPDATE usuario SET CONTRASEÑA = :password WHERE ID = :id";
    
    $stmt = $this->conexion->prepare($sql);

    $stmt->bindValue(':password', $usuario->getContrasena());
    $stmt->bindValue(':id', $usuario->getId());

    return $stmt->execute();
}



    function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM usuario WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Usuario(
            $datos['ID'],
            $datos['NOMBRE'],
            $datos['MAIL'],
            $datos['CONTRASEÑA'],
            $datos['ROL'],
            $datos['ACTIVO']
        );
    }


    
    
}