<?php
session_start();
// Destruir todas las variables de sesión
session_unset();
session_destroy();

// Redirigir al inicio de sesión
header("Location: index.php");
exit;
?>