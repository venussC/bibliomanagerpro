<?php
session_start();
require_once '../php/conexion.php';

if (!isset($_SESSION['cambiar_password_usuario'])) {
    header('Location: ../html/solicitar_codigo.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nueva_password = $_POST["nueva_password"];
    $confirmar_password = $_POST["confirmar_password"];
    $usuario = $_SESSION['cambiar_password_usuario'];
    
    if (!empty($nueva_password) && !empty($confirmar_password)) {
        
        if ($nueva_password === $confirmar_password) {
            
            if (strlen($nueva_password) >= 6) {
                
                try {
               
                    $password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);
                    
                    
                    $stmt = $conx->prepare("UPDATE usuarios SET contrasena = :password, codigo_verificacion = NULL, codigo_expiracion = NULL WHERE usuario = :usuario");
                    $stmt->execute([
                        ':password' => $password_hash,
                        ':usuario' => $usuario
                    ]);
                    
                  
                    unset($_SESSION['cambiar_password_usuario']);
                    
                   
                    $_SESSION['login_error'] = "Contraseña actualizada correctamente. Ya puedes iniciar sesión.";
                    header('Location: ../html/login_inicio.php');
                    exit();
                    
                } catch(PDOException $e) {
                    $_SESSION['password_error'] = "Error en el sistema: " . $e->getMessage();
                    header('Location: ../html/nueva_password.php');
                    exit();
                }
                
            } else {
                $_SESSION['password_error'] = "La contraseña debe tener al menos 6 caracteres";
                header('Location: ../html/nueva_password.php');
                exit();
            }
            
        } else {
            $_SESSION['password_error'] = "Las contraseñas no coinciden";
            header('Location: ../html/nueva_password.php');
            exit();
        }
        
    } else {
        $_SESSION['password_error'] = "Por favor completa todos los campos";
        header('Location: ../html/nueva_password.php');
        exit();
    }
}
?>