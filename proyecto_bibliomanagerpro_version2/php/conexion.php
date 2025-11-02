<?php
$host = "localhost";
$db = "bibliomanagerpro";
$user = "root";
$password = "";

try {
   
    $conx = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
    
    $conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Hay conexión";
    
} catch(PDOException $e) {
    die("El error que ves: " . $e->getMessage());
}
?>