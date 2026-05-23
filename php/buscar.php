<?php
require_once 'conexion.php';

$termino = isset($_GET['q']) ? $_GET['q'] : '';

if (!empty($termino)) {
    $termino = $conexion->real_escape_string($termino);
    
    $sql = "SELECT p.id, p.nombre, p.precio, c.nombre AS categoria, p.imagen_principal
            FROM productos p
            JOIN categorias c ON p.categoria_id = c.id
            WHERE (p.nombre LIKE '%$termino%' OR p.descripcion LIKE '%$termino%' OR c.nombre LIKE '%$termino%')
            AND p.activo = TRUE
            LIMIT 10";
    
    $resultado = $conexion->query($sql);
    
    $productos = array();
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($productos);
    exit;
} 