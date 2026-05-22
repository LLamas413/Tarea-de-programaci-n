<?php
require_once 'config.php';

// Validar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca = trim($_POST['marca']);
    $nombre = trim($_POST['nombre']);
    $costo = $_POST['costo'];
    $cantidad = $_POST['cantidad'];

    // Insertar en la base de datos de manera segura con PDO
    $stmt = $pdo->prepare("INSERT INTO productos (marca, nombre, costo, cantidad) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$marca, $nombre, $costo, $cantidad])) {
        header("Location: admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; padding-top: 50px; }
        .form-box { background: white; width: 350px; margin: 0 auto; padding: 30px; border-top: 6px solid #800020; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 5px; }
        h1 { color: #800020; }
        input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #800020; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; }
        button:hover { background-color: #5c0017; }
        .back-link { display: block; margin-top: 15px; color: #800020; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="form-box">
        <h1>Agregar Producto</h1>
        <form method="POST" action="agregado.php">
            <input type="text" name="marca" placeholder="Marca" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="number" step="0.01" name="costo" placeholder="Costo" required>
            <input type="number" name="cantidad" placeholder="Cantidad" required>
            
            <button type="submit">Guardar Producto</button>
        </form>
        <a href="admin.php" class="back-link">Volver al panel</a>
    </div>
</body>
</html>