<?php
require_once 'conexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: productos.php");
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT p.*, c.nombre AS categoria 
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        WHERE p.id = $id AND p.activo = TRUE";
$producto = $conexion->query($sql)->fetch_assoc();

if (!$producto) {
    header("Location: productos.php");
    exit;
}


$sql_imagenes = "SELECT imagen_url FROM producto_imagenes WHERE producto_id = $id ORDER BY orden";
$imagenes = $conexion->query($sql_imagenes);


$sql_caracteristicas = "SELECT nombre, valor FROM producto_caracteristicas WHERE producto_id = $id";
$caracteristicas = $conexion->query($sql_caracteristicas);


$sql_especificaciones = "SELECT clave, valor FROM producto_especificaciones WHERE producto_id = $id";
$especificaciones = $conexion->query($sql_especificaciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    
</head>
<body>
    <div class="producto-detalle">
        <div class="producto-galeria">
 
        </div>
        <div class="producto-info">
            <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
           
        </div>
    </div>
</body>
</html>