<?php
    session_start();
    require "conexion.php";

    $nombre = $_POST['nombre'];
    $encargado = $_POST['encargado'];
    $duracion = $_POST['duracion'];
    $cliente = $_POST['cliente'];
    $tipo_usuario = $_POST['tipo_usuario']; // Obtener el tipo de usuario

    // Consulta SQL para insertar el registro
    $sql = "INSERT INTO proyectos (nombre, encargado, duracion, cliente, tipo_usuario) VALUES ('$nombre', '$encargado', '$duracion', '$cliente', '$tipo_usuario')";

    if ($mysqli->query($sql) === TRUE) {
        // Si la inserción fue exitosa, redirige de nuevo a la página de proyectos
        header("Location: proyectos.php");
        exit();
    } else {
        echo "Error al guardar el proyecto: " . $mysqli->error;
    }

    $mysqli->close();
    
