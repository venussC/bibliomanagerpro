<?php
session_start();
require_once '../php/conexion.php';

if(!isset($_SESSION['recuperar_usuario'])){
    header('Location: ../html/solicitar_codigo.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $codigo_ingresado = trim($_POST["codigo"]);
    $usuario =$_SESSION['recuperar_usuario'];

    if(!empty($codigo_ingresado)){
        try{

            $stmt= $conx->prepare("SELECT id, usuario FROM usuarios WHERE usuario = :usuario AND codigo_verificacion = : codigo AND codigo_expiracion > NOW()");
            $stmt->execute([
                ':usuario' => $usuario,
                ':codigo' => $codigo_ingresado

            ]);
            $user = $stmt->fetch();
            if ($user){
                 $_SESSION['cambiar_password_usuario'] = $user['usuario'];
                unset($_SESSION['recuperar_usuario']);
                
                header('Location: ../html/nueva_password.php');
                exit();
            }else {
                
                $_SESSION['codigo_error'] = "Código incorrecto o expirado. Solicita uno nuevo.";
                header('Location: ../html/verificar_codigo.php');
                exit();
            }

        }catch( PDOException $e){
            $_SESSION['codigo_error'] ="Error en el sistema:" . $e->getMessage();
            header('Location: ../html/verificar_codigo.php');
            exit();
        }

    }else{
      $_SESSION['codigo_error'] = "Por favor ingresa el código";
        header('Location: ../html/verificar_codigo.php');
        exit();
    }
}

?>