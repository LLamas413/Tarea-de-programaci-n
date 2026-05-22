<?php
require_once 'config.php';

// Validar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Lógica para eliminar un producto
if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: admin.php");
    exit;
}

// Obtener todos los productos
$stmt = $pdo->query("SELECT * FROM productos ORDER BY id DESC");
$productos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .header { background-color: #800020; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; border-radius: 5px; }
        .btn, .header a { text-decoration: none; background-color: white; color: #800020; padding: 8px 15px; border-radius: 4px; font-weight: bold; }
        .btn { background-color: #800020; color: white; display: inline-block; margin-top: 20px; }
        .btn:hover { background-color: #5c0017; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #800020; color: white; }
        .btn-delete { color: red; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Panel de Control</h2>
        <a href="logout.php">Cerrar Sesión</a>
    </div>

    <a href="agregado.php" class="btn">+ Agregar Nuevo Producto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Cantidad</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($productos) > 0): ?>
                <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo htmlspecialchars($p['marca']); ?></td>
                    <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                    <td>$<?php echo number_format($p['costo'], 2); ?></td>
                    <td><?php echo $p['cantidad']; ?></td>
                    <td>
                        <a href="admin.php?delete_id=<?php echo $p['id']; ?>" class="btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;">No hay productos registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>