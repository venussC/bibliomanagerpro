<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';
require_once 'config_email.php';

function enviarEmail($destinatario, $asunto, $mensaje_html) {
    $mail = new PHPMailer(true);
    
    try {
        
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port = SMTP_PORT;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = SMTP_DEBUG;
        
       
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        
        
        $mail->addAddress($destinatario);
        
        
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje_html;
        $mail->AltBody = strip_tags($mensaje_html);
        
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("Error al enviar email: {$mail->ErrorInfo}");
        return false;
    }
}
?>