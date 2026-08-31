<?php
require_once "../modelo/UsuarioModelo.php";
require_once "../modelo/conexion.php";
require_once "../modelo/Usuario.php";
require_once "../modelo/Registro.php";
require_once "../modelo/registroModelo.php";
$action = $_POST['action'];

if ($action == 'register') {
    registerUser($conexion);
}
if ($action == 'registerA') {
    registerUserAdmin($conexion);
}

if ($action == 'login') {
    loginUser($conexion);
}
if ($action == 'editProfile') {
    editProfile($conexion);
}
if ($action == 'delete') {
    deleteUser($conexion);
}
if ($action == 'logout') {
    logoutUser($conexion);
}
if ($action == 'editUser') {
    editUser($conexion);
}
if ($action == 'changePassword') {
    editPassword($conexion);
}
if ($action == 'alta') {
    altaUser($conexion);
}

function registerUser($conexion) {

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['confirm-password'];

    if (!validatePassword($password)) {
        echo "<script> alert('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo.');
                    window.history.back(); </script>";
        exit;
        return;
    }

    if ($password !== $passwordConfirm) {
        echo "<script> alert('Las contraseñas no coinciden');
                    window.history.back(); </script>";
        exit;
        return;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    


    $usuarioModelo = new UsuarioModelo($conexion);
    $usuario=new Usuario(null,$name,$email,$passwordHash,'usuario',true);

    $resultado = $usuarioModelo->registrarUsuario($usuario);

    if ($resultado) {
        header("Location: ../vista/login.html"); exit;
    } else {
        echo "<script> alert('Error al registrar usuario.');
                    window.history.back(); </script>";
        exit;
    }
    

    
}


function validatePassword($password) {

    if (strlen($password) < 8) {
        return false;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    if (!preg_match('/[^A-Za-z0-9]/', $password)) {
        return false;
    }

    return true;
}

function registerUserAdmin($conexion) {

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['confirm-password'];

    if (!validatePassword($password)) {
        echo "<script> alert('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo.');
                    window.history.back(); </script>";
        exit;
    }

    if ($password !== $passwordConfirm) {
        echo "<script> alert('Las contraseñas no coinciden.');
                    window.history.back(); </script>";
        exit;
        return;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $usuarioModelo = new UsuarioModelo($conexion);
    $usuario=new Usuario(null,$name,$email,$passwordHash,'administrador',true);

    $resultado = $usuarioModelo->registrarUsuarioAdmin($usuario);

    if ($resultado) {
        header("Location: ../vista/PanelAdministrador.php"); exit;
    } else {
        echo "<script>alert('Error al registrar el usuario');</script>";
    }
    
}



function loginUser($conexion) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $usuarioModelo= new UsuarioModelo($conexion);
    $registroModelo = new RegistroModelo($conexion);

    $usuario = $usuarioModelo->BuscarUsuarioPorEmail($email);
    if($usuario==false){
        echo "<script> alert('No se encontró un usuario activo con esos datos');
                    window.history.back(); </script>";
        exit;
    }
    //mandar al mainAdministrador.html o mainUsuario.html segun el rol del usuario, para eso se puede usar un if
    if($usuario->getRol() =='administrador'){
        
        if(password_verify($password, $usuario->getContrasena())){
            //usar session_start() para iniciar la sesión y guardar los datos del usuario en variables de sesión
            session_start();

            $_SESSION['id'] = $usuario->getId();
            $_SESSION['nombre'] = $usuario->getNombre();
            $_SESSION['email'] = $usuario->getMail();
            $_SESSION['rol'] = $usuario->getRol();
            // Registrar la acción en la auditoría
            
            $registro=new Registro(null,"Se inició sesión como admin ",$usuario->getId(),null);
            $registroModelo->registroAuditoria($registro);
            header("Location: ../vista/mainAdministrador.php");
            exit;
        }else{
            echo "<script> alert('Error al iniciar sesión.');
                    window.history.back(); </script>";
        exit;
        
        }
        }

    if(password_verify($password, $usuario->getContrasena())){
        //usar session_start() para iniciar la sesión y guardar los datos del usuario en variables de sesión
        session_start();

        $_SESSION['id'] = $usuario->getId();
        $_SESSION['nombre'] = $usuario->getNombre();
        $_SESSION['email'] = $usuario->getMail();
        $_SESSION['rol'] = $usuario->getRol();
        // Registrar la acción en la auditoría
        $registro=new Registro(null,"Se inició sesión ",$usuario->getId(),null);
            $registroModelo->registroAuditoria($registro);
        header("Location: ../vista/mainUsuario.php"); 
        exit;
    }else{
        echo "<script> alert('Error al iniciar sesión.');
                    window.history.back(); </script>";
        exit;
    }
    
    
}


function editUser($conexion) {
    session_start();
    if ($_SESSION['rol'] !== 'administrador') {
        echo "no sos admin";
        return;
    }
    $id = $_POST['id'];
    $name = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['contrasena'] ?? '';

    $usuarioModelo = new UsuarioModelo($conexion);
    $usuario = $usuarioModelo->obtenerUsuarioPorId($id);

    if ($name != '') {
    $usuario->setNombre($name);
    }

    if ($email != '') {
        $usuario->setMail($email);
    }
    if ($password != '') {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $usuario->setContrasena($password);
    }

    $resultado = $usuarioModelo->editarUsuario($usuario);
    // Registrar la acción en la auditoría
    $registroModelo = new RegistroModelo($conexion);
    $registro=new Registro(null,"Se editó un usuario ",$id,null);
    if ($resultado) {
        $registroModelo->registroAuditoria($registro);
    } else {
        echo "<script> alert('Error al editar el usuario.');
                    window.history.back(); </script>";
        exit;
    }
    
}

function deleteUser($conexion) {
    
    session_start();
    if ($_SESSION['rol'] !== 'administrador') {
        echo "no sos admin";
        return;
    }
    $id = $_POST['idUsuario'];
    $usuarioModelo = new UsuarioModelo($conexion);
    $registroModelo = new RegistroModelo($conexion);
    $resultado = $usuarioModelo->DeleteUsuario($id);
    $registro=new Registro(null,"se eliminó un usuario con id: $id",$_SESSION['id'],null);
    // Registrar la acción en la auditoría
    if ($resultado) {
        $registroModelo->registroAuditoria($registro);
        header("Location: ../vista/editarUser.php");
    exit;
    } else {
        echo "<script> alert('Error al eliminar al usuario.');
                    window.history.back(); </script>";
        exit;
    }
}

function altaUser($conexion) {
    
    session_start();
    if ($_SESSION['rol'] !== 'administrador') {
        echo "<script> alert('No tenés permisos de administrador.');
                    window.history.back(); </script>";
        exit;
        return;
    }
    $id = $_POST['idUsuario'];

    $usuarioModelo = new UsuarioModelo($conexion);
    $registroModelo = new RegistroModelo($conexion);
    $resultado = $usuarioModelo->AltaUsuario($id);
    $registro=new Registro(null,"se dió de alta un usuario con id: $id",$_SESSION['id'],null);
    // Registrar la acción en la auditoría
    if ($resultado) {
        $registroModelo->registroAuditoria($registro);
        header("Location: ../vista/editarUser.php");
    exit;
    } else {
        echo "<script> alert('Error al dar de alta al usuario.');
                    window.history.back(); </script>";
        exit;
    }
}



function logoutUser($conexion) {
    // eliminar la sesion y redirigirlo a la página de inicio de sesión
    session_start();
    $id = $_SESSION['id'];
    $usuarioModelo = new UsuarioModelo($conexion);
    $registroModelo = new RegistroModelo($conexion);

    $registro=new Registro(null,"logout ",$id,null);
    $registroModelo->registroAuditoria($registro);
    session_destroy();

    header("Location: ../vista/login.html");
    exit;
}

function editProfile($conexion) {
    //iniciar la sesion para saber que usaurio esta logueado y obtener su id, luego usar el modelo de usuario para editar los datos del usuario en la base de datos
    session_start();
    $id = $_SESSION['id'];
    //obtener fatos del formulario y verificar caules estan vacios,
    //si estan vacios no se modifican, si no estan vacios se modifican
    $name = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $usuarioModelo = new UsuarioModelo($conexion);
    //obtiene el objeto del return del modelo
    $usuario = $usuarioModelo->obtenerUsuarioPorId($id);

    if ($name != '') {
    $usuario->setNombre($name);
    }

    if ($email != '') {
        $usuario->setMail($email);
    }
    
    $resultado = $usuarioModelo->editarPerfil($usuario);
    $registroModelo = new RegistroModelo($conexion);
    $registro=new Registro(null,"Se editó el perfil ",$id,null);
    if ($resultado) {
        // Registrar la acción en la auditoría
        $registroModelo->registroAuditoria($registro);
    } else {
        echo "<script> alert('No se modificó ningun dato');
                    window.history.back(); </script>";
        exit;
    }
}



function editPassword($conexion) {
    session_start();
    $id = $_SESSION['id'];
    //obtener fatos del formulario y verificar caules estan vacios,
    //si estan vacios no se modifican, si no estan vacios se modifican
    $newPassword = $_POST['new-password'] ?? '';
    $confirmNewPassword = $_POST['confirm-new-password'] ?? '';

    if ($newPassword !== $confirmNewPassword) {
        //alerta de error, y volver atrás para no mostrar una pagina en blanco
        echo "<script> alert('Las contraseñas no coinciden.');
                    window.history.back(); </script>";
        exit;

    }

    if (!validatePassword($newPassword)) {
        echo "<script> alert('La nueva contraseña no cumple con tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo.');
                    window.history.back(); </script>";
        exit;

    }

    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $usuarioModelo = new UsuarioModelo($conexion);
    //obtiene el objeto del return del modelo
    $usuario = $usuarioModelo->obtenerUsuarioPorId($id);

    $usuario->setContrasena($newPasswordHash);
    $resultado = $usuarioModelo->editarPassword($usuario);
    $registroModelo = new RegistroModelo($conexion);
    $registro=new Registro(null,"Se editó la contraseña ",$id,null);

    if ($resultado) {
        // Registrar la acción en la auditoría
        $registroModelo->registroAuditoria($registro);
    } else {
        echo "<script> alert('Error al actualizar la contraseña.');
                    window.history.back(); </script>";
        exit;
    }
}