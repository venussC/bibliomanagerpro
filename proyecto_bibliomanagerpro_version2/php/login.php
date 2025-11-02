<?php
session_start();
require_once 'conexion.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = trim($_POST["usuario"]);
    $password = $_POST["password"];

    if (!empty($usuario) && !empty($password)) {
        
        try {
            $stmt = $conx->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
            $stmt->execute([":usuario" => $usuario]);
            $user = $stmt->fetch();

            if ($user) {
                if (password_verify($password, $user["contrasena"])) {
            
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['usuario'] = $user['usuario'];
                    $_SESSION['email'] = $user['email'];
                    
                    
                    header('Location: ../html/index.html'); 
                    exit();
                    
                } else {
                    $error = "Usuario o contraseña incorrectos";
                }
            } else {
                $error = "Usuario o contraseña incorrectos";
            }
            
        } catch(PDOException $e) {
            $error = "Error en el sistema: " . $e->getMessage();
        }
        
    } else {
        $error = "Por favor completa todos los campos";
    }
}

if ($error) {
    $_SESSION['login_error'] = $error;
    header('Location: ../html/login_inicio.php');
    exit();
}
?>