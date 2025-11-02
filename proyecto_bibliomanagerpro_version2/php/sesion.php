<?php
session_start();
include("conexion.php");

$_SESSION ["user_id"]=$user["id"];
$_SESSION ["usuario"] = $user["usuario"];

if(!isset($$_SESSION["user_id"])){
    header("Location: login_inicio.php");
}else{
    header("Location: principal.html");
}

?>

