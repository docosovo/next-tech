<?php
    include_once('../config/conexion.php');

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fnacimiento = $_POST['fnacimiento'];
    $contraseña = $_POST['contraseña'];

    $sql ="INSERT INTO usuario(nombre,apellido,fnacimiento,contraseña)VALUES('$nombre','$apellido','$fnacimiento','$contraseña')";

    $query = mysqli_query($conexion,$sql);

    if ($query === TRUE) {
        header("location: ../html/index.php");
    }
    
?>

