<?php
require_once "../HTML/UsuarioModelo.php";
require_once "../HTML/conexion.php";
$action = $_POST['action'];

if ($action == 'register') {
    registerUser($conexion);
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

    $resultado = $usuarioModelo->registrarUsuario($name,$email,$passwordHash);

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
function loginUser($conexion) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $usuarioModelo= new UsuarioModelo($conexion);
    $usuario = $usuarioModelo->BuscarUsuarioPorEmail($email);
    if($usuario==false){
        echo "Usuario no encontrado";   
        return;
    }
    //mandar al mainAdministrador.html o mainUsuario.html segun el rol del usuario, para eso se puede usar un if
    if($usuario['ROL']=='administrador'){
        
        if(password_verify($password, $usuario['CONTRASEÑA'])){
            //usar session_start() para iniciar la sesión y guardar los datos del usuario en variables de sesión
            session_start();

            $_SESSION['id'] = $usuario['ID'];
            $_SESSION['nombre'] = $usuario['NOMBRE'];
            $_SESSION['email'] = $usuario['MAIL'];
            $_SESSION['rol'] = $usuario['ROL'];
            // Registrar la acción en la auditoría
            $usuarioModelo->registroAuditoria($_SESSION['id'], 'Se inició sesión como administrador');
            header("Location: ../HTML/mainAdministrador.html"); exit;
        }else{
            echo "No se pudo iniciar sesión";
        
        }
        }

    if(password_verify($password, $usuario['CONTRASEÑA'])){
        //usar session_start() para iniciar la sesión y guardar los datos del usuario en variables de sesión
        session_start();

        $_SESSION['id'] = $usuario['ID'];
        $_SESSION['nombre'] = $usuario['NOMBRE'];
        $_SESSION['email'] = $usuario['MAIL'];
        $_SESSION['rol'] = $usuario['ROL'];
        // Registrar la acción en la auditoría
        $usuarioModelo->registroAuditoria($_SESSION['id'], 'Se inició sesión');
        header("Location: ../HTML/mainUsuario.html"); exit;
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
    $resultado = $usuarioModelo->editarUsuario($id, $name, $email, $password);

    // Registrar la acción en la auditoría
    if ($resultado) {
        $usuarioModelo->registroAuditoria($_SESSION['id'], 'Se editó un usuario con ID: ' . $id);
        echo "Usuario editado correctamente";
    } else {
        echo "No se pudo editar el usuario";
    }
    
}

function deleteUser($conexion) {

    // Verificar mail y contraseña o directamente ID del usuario en la bdd, posiblemente mejor solo ID 
    echo "La cuenta feu sido eliminada";
}

function logoutUser($conexion) {
    // eliminar la sesion y redirigirlo a la página de inicio de sesión
    session_start();
    session_destroy();
    // Registrar la acción en la auditoría
    $usuarioModelo = new UsuarioModelo($conexion);
    $usuarioModelo->registroAuditoria($_SESSION['id'], 'Se cerró sesión');
    header("Location: ../HTML/login.html"); exit;
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
    $resultado = $usuarioModelo->editarPerfil($id,$name,$email);
    
    if ($resultado) {
        // Registrar la acción en la auditoría
        $usuarioModelo->registroAuditoria($_SESSION['id'], 'Se actualizó el perfil');
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
        echo "Las nuevas contraseñas no coinciden";
        return;
    }

    if (!validatePassword($newPassword)) {
        echo "La nueva contraseña no cumple con la política de seguridad";
        return;
    }

    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $usuarioModelo = new UsuarioModelo($conexion);
    $resultado = $usuarioModelo->editarPassword($id, $newPasswordHash);

    if ($resultado) {
        // Registrar la acción en la auditoría
        $usuarioModelo = new UsuarioModelo($conexion);
        $usuarioModelo->registroAuditoria($_SESSION['id'], 'Se actualizó la contraseña');
        echo "Contraseña actualizada correctamente";
    } else {
        echo "No se pudo actualizar la contraseña";
    }
}
