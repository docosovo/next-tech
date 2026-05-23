<?php

require'../config/conexion.php';


session_start();

$nombre =$_POST['nombre'];
$contraseña =$_POST['contraseña'];

$q="SELECT COUNT(*) as contar from usuario where nombre = '$nombre' and contraseña = '$contraseña'";
$consulta = mysqli_query($conexion,$q);
$array = mysqli_fetch_array($consulta);

if ($array['contar']>0){

    $_SESSION['nombre'] = $nombre;
    echo "<script> 
    location.href = '../html/index.php';
    </script>";
}else{
    echo "<script> alert('Datos incorrectos');
    location.href = '../html/iniciosesion.html';
    </script>";
}
?>