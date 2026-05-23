<?php
include_once('../config/conexion.php');


if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    
    
    $id = $_REQUEST['id'];
    
    if (!is_numeric($id)) {
        die("Error: ID no válido");
    }
    
    
    $sql = "DELETE FROM usuario WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        
        $query = mysqli_stmt_execute($stmt);
        
        if ($query) {
            
            header('location: ../html/editaryeliminardato.php');
            exit(); 
        } else {
            echo "Error al eliminar el registro: " . mysqli_error($conexion);
        }
        
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta";
    }
    
} else {
    echo "Error: ID no proporcionado";
}


mysqli_close($conexion);
?>