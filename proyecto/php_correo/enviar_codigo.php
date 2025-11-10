<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../php/conexion.php';
require_once '../php/enviar_email.php'; 

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = trim($_POST["usuario"]);
    
    if (!empty($usuario)) {
        
        try {
            
            $stmt = $conx->prepare("SELECT id, usuario, email FROM usuarios WHERE usuario = :usuario");
            $stmt->execute([":usuario" => $usuario]);
            $user = $stmt->fetch();
            
            if ($user) {
                
                $codigo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                
                
                $expiracion = date('Y-m-d H:i:s', strtotime('+15 minutes'));
                
                // Guardar código en la base de datos
                $stmt = $conx->prepare("UPDATE usuarios SET codigo_verificacion = :codigo, codigo_expiracion = :expiracion WHERE id = :id");
                $stmt->execute([
                    ':codigo' => $codigo,
                    ':expiracion' => $expiracion,
                    ':id' => $user['id']
                ]);
                
                
                $destinatario = $user['email'];
                $asunto = "Código de recuperación - BiblioManager Pro";
                
                $mensaje = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                        .container { max-width: 600px; margin: 20px auto; background: white; padding: 0; border-radius: 10px; overflow: hidden; }
                        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
                        .header h2 { margin: 0 0 10px 0; font-size: 28px; }
                        .header p { margin: 0; font-size: 14px; opacity: 0.9; }
                        .content { padding: 30px; }
                        .codigo { font-size: 36px; font-weight: bold; color: #667eea; text-align: center; padding: 20px; background: #f5f5f5; border-radius: 8px; margin: 30px 0; letter-spacing: 8px; border: 2px dashed #667eea; }
                        .info { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0; border-radius: 4px; }
                        .footer { text-align: center; color: #666; font-size: 12px; padding: 20px 30px; border-top: 1px solid #eee; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>📚 BiblioManager Pro</h2>
                            <p>Recuperación de Contraseña</p>
                        </div>
                        <div class='content'>
                            <p>Hola <strong>{$user['usuario']}</strong>,</p>
                            <p>Recibimos una solicitud para restablecer tu contraseña. Usa el siguiente código de verificación:</p>
                            <div class='codigo'>{$codigo}</div>
                            <div class='info'>
                                <strong>⏰ Este código expirará en 15 minutos.</strong>
                            </div>
                            <p>Si no solicitaste este cambio, puedes ignorar este correo de manera segura.</p>
                        </div>
                        <div class='footer'>
                            <p>Este es un correo automático, por favor no responder.</p>
                            <p>&copy; " . date('Y') . " BiblioManager Pro - Sistema de Gestión Bibliotecaria</p>
                        </div>
                    </div>
                </body>
                </html>
                ";
                
                
                if (enviarEmail($destinatario, $asunto, $mensaje)) {
                    
                    $_SESSION['recuperar_usuario'] = $user['usuario'];
                    $_SESSION['success_message'] = "Se ha enviado un código de verificación a tu correo.";
                    
                    
                    header('Refresh: 2; URL=../html/verificar_codigo.php');
                    exit();
                } else {
                    $error = "Error al enviar el correo. Por favor contacta al administrador.";
                }
                
            } else {
                
                $_SESSION['success_message'] = "Si el usuario existe, se ha enviado un código a tu correo.";
                header('Refresh: 2; URL=../html/verificar_codigo.php');
                exit();
            }
            
        } catch(PDOException $e) {
            $error = "Error en el sistema: " . $e->getMessage();
        }
        
    } else {
        $error = "Por favor ingresa tu nombre de usuario";
    }
}


if ($error) {
    $_SESSION['recuperar_error'] = $error;
    header('Location: ../html/solicitar_codigo.php');
    exit();
}
?>