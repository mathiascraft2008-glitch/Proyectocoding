<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

function enviarCorreo($destinatario, $asunto, $mensaje){
    $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        //cuenta para que phpmailer se autentique con esa
        $mail->Username = 'torneoggchamp@gmail.com';
        $mail->Password = 'kfzi wbaj weje rsnd';

        //conexion segura 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //este mail manda el correo
        $mail->setFrom('torneoggchamp@gmail.com', 'GGchamp');

        $mail->addAddress($destinatario);

        $mail->isHTML(false);

        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        $mail->send();

        return true;

}