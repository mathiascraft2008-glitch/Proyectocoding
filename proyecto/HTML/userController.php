<?php
require_once "../HTML/UsuarioModelo.php";
require_once "../HTML/conexion.php";
require_once "../HTML/Usuario.php";
require_once "../HTML/Registro.php";
require_once "../HTML/RegistroModelo.php";
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
        echo "La contraseña no cumple con la política de seguridad";
        return;
    }

    if ($password !== $passwordConfirm) {
        echo "Las contraseñas no coinciden";
        return;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    


    $usuarioModelo = new UsuarioModelo($conexion);
    $usuario=new Usuario(null,$name,$email,$passwordHash,'usuario',true);

    $resultado = $usuarioModelo->registrarUsuario($usuario);

    if ($resultado) {
        header("Location: ../HTML/login.html"); exit;
    } else {
        echo "<script>alert('Error al registrar el usuari');</script>";
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
        echo "La contraseña no cumple con la política de seguridad";
        return;
    }

    if ($password !== $passwordConfirm) {
        echo "Las contraseñas no coinciden";
        return;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $usuarioModelo = new UsuarioModelo($conexion);
    $usuario=new Usuario(null,$name,$email,$passwordHash,'administrador',true);

    $resultado = $usuarioModelo->registrarUsuarioAdmin($usuario);

    if ($resultado) {
        header("Location: ../HTML/PanelAdministrador.php"); exit;
    } else {
        echo "<script>alert('Error al registrar el usuari');</script>";
    }
    
}



function loginUser($conexion) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $usuarioModelo= new UsuarioModelo($conexion);
    $registroModelo = new RegistroModelo($conexion);

    $usuario = $usuarioModelo->BuscarUsuarioPorEmail($email);
    if($usuario==false){
        echo "No se encontró el usuario o la contraseña es incorrecta o el usuario está de baja";   
        return;
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
            header("Location: ../HTML/mainAdministrador.php");
            exit;
        }else{
            echo "No se pudo iniciar sesión";
        
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
        header("Location: ../HTML/mainUsuario.php"); 
        exit;
    }else{
        echo "No se pudo iniciar sesión";
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
    $registro=new Registro(null,"Se editó un usuario con id: ",$id,null);
    if ($resultado) {
        $registroModelo->registroAuditoria($registro);
        echo "Usuario editado correctamente";
    } else {
        echo "No se pudo editar el usuario";
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
    $registro=new Registro(null,"se eliminó un usuario con id: ",$id,null);
    // Registrar la acción en la auditoría
    if ($resultado) {
        $registroModelo->registroAuditoria($registro);
    } else {
        echo "No se pudo eliminar el usuario";
    }
}

function altaUser($conexion) {
    
    session_start();
    if ($_SESSION['rol'] !== 'administrador') {
        echo "no sos admin";
        return;
    }
    $id = $_POST['idUsuario'];

    $usuarioModelo = new UsuarioModelo($conexion);
    $registroModelo = new RegistroModelo($conexion);
    $resultado = $usuarioModelo->AltaUsuario($id);
    $registro=new Registro(null,"se dió de alta un usuario con id: ",$id,null);
    // Registrar la acción en la auditoría
    if ($resultado) {
        $registroModelo->registroAuditoria($registro);
    } else {
        echo "No se pudo dar de alta el usuario";
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

    header("Location: ../HTML/login.html");
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
        echo "Perfil actualizado correctamente";
    } else {
        echo "No se modificó ningún dato";
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
        echo "<script> alert('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo.');
                    window.history.back(); </script>";
        exit;
        return;
    }

    if (!validatePassword($newPassword)) {
        echo "La nueva contraseña no cumple con la política de seguridad";
        return;
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
        echo "Contraseña actualizada correctamente";
    } else {
        echo "No se pudo actualizar la contraseña";
    }
}
