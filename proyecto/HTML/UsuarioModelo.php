<?php
class UsuarioModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($nombre, $email, $passwordHash) {
        $sql = "INSERT INTO usuario (NOMBRE, MAIL, CONTRASEÑA, ROL)
        VALUES (:nombre, :mail, :pass, 'usuario')";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':pass', $passwordHash);
        return $stmt->execute();

    }
    function BuscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuario WHERE MAIL = :mail";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':mail', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function DeleteUsuario($id, $password){

        $sql = "DELETE FROM usuario WHERE ID=:id;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();      
 
        
    }
    function editarUsuario($id, $name, $email, $password) {
        $sql = "UPDATE usuario SET NOMBRE=:name, MAIL=:mail, CONTRASEÑA=:password where ID=:id;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':mail',$email);
        $stmt->bindParam(':password',$password);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    }

    function editarPerfil($id, $name, $email) {
        if ($name == '' && $email == '') {
            return false;
        }
        if ($name != '' && $email != '') {
            $sql = "UPDATE usuario SET NOMBRE = :name, MAIL = :mail WHERE ID = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mail', $email);
            $stmt->bindParam(':id', $id);
        } elseif ($name != '') {
            $sql = "UPDATE usuario SET NOMBRE = :name WHERE ID = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $id);
        } elseif ($email != '') {
            $sql = "UPDATE usuario SET MAIL = :mail WHERE ID = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':mail', $email);
            $stmt->bindParam(':id', $id);
        } else {
            return false;
        }
        return $stmt->execute();
    }

    function editarPassword($id, $password) {
        $sql = "UPDATE usuario SET CONTRASEÑA = :password WHERE ID = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }



    
    
}