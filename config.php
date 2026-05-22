<?php
session_start();

$host = 'localhost';
$dbname = 'control_productos';
$user = 'root'; // Cambia esto si tu usuario de BD es distinto
$pass = '';     // Coloca tu contraseña de BD si tienes una

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>