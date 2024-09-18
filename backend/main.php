<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "reportes_ventas";

try {
    // Crear nueva conexión a MySQLi
    $conexion = new mysqli($server, $user, $pass, $db);

    // Comprobar si hubo un error en la conexión
    if ($conexion->connect_error) {
        // Lanza una excepción si la conexión falla
        throw new Exception("Error en la conexión: " . $conexion->connect_error);
    }

    echo "Conexión exitosa";

} catch (Exception $e) {
    // Manejar la excepción y mostrar el mensaje de error
    echo "Excepción capturada: " . $e->getMessage();
}
?>
