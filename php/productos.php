<?php
// Incluir configuración de la base de datos
require_once 'conexion.php';

// Consulta SQL para obtener productos
$sql = "SELECT p.id, p.sku, p.nombre, p.descripcion, p.precio, p.imagen_principal, 
               c.nombre AS categoria 
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        WHERE p.activo = TRUE
        ORDER BY p.creado_en DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .product-img {
            height: 200px;
            overflow: hidden;
        }
        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-info {
            padding: 15px;
        }
        .product-price {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.2rem;
            margin: 10px 0;
        }
        .product-category {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin: 20px 0;">Nuestros Productos</h1>
    
    <div class="product-grid">
        <?php if ($resultado->num_rows > 0): ?>
            <?php while($producto = $resultado->fetch_assoc()): ?>
                <div class="product-card">
                    <div class="product-img">
                        <img src="<?php echo htmlspecialchars($producto['imagen_principal']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                        <div class="product-category"><?php echo htmlspecialchars($producto['categoria']); ?></div>
                        <div class="product-price">$<?php echo number_format($producto['precio'], 2); ?></div>
                        <p><?php echo htmlspecialchars(substr($producto['descripcion'], 0, 100)); ?>...</p>
                        <button>Ver Detalles</button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>

    <?php
    // Cerrar conexión
    $conexion->close();
    ?>
</body>
</html>