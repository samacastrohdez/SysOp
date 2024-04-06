<?php
session_start();
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $tipo_usuario = $_POST['tipo_usuario']; // Obtener el tipo de usuario

    // Hash para la contraseña usando SHA-1
    $hashed_password = sha1($password);

    // Consulta SQL para insertar el registro del empleado
    $sql = "INSERT INTO empleados (nombre, telefono, correo, password, fecha_nacimiento, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros
        $stmt->bind_param("sssssi", $nombre, $telefono, $correo, $hashed_password, $fecha_nacimiento, $tipo_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Envío del correo de bienvenida
            $asunto = "Bienvenido a SysOp";
            $mensaje = "Bienvenido a SysOp. A partir de este momento formas parte de una de las empresas más grandes de marketing digital y diseño web de Monterrey.";
            $headers = "pruebasistemaSysOp@hotmail.com"; // Reemplaza con tu dirección de correo electrónico

            // Envía el correo
            mail($correo, $asunto, $mensaje, $headers);

            // Redirigir de nuevo a la página de proyectos
            header("Location: bienvenido.php");
            exit();
        } else {
            echo "Error al guardar el empleado: " . $stmt->error;
        }
    } else {
        echo "Error en la preparación de la consulta: " . $mysqli->error;
    }

    // Cerrar la conexión y la consulta preparada
    $stmt->close();
    $mysqli->close();
} else {
    echo "Acceso denegado";
}
