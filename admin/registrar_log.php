<?php
$connection = new mysqli("localhost", "root", "root", "vehiculos");

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

function registrar_log($tabla, $operacion, $registro_id, $detalles = "", $usuario = "admin") {
    global $connection;

    $sql = "INSERT INTO logs (Tabla, Operacion, Registro_ID, Detalles, Usuario) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssiss", $tabla, $operacion, $registro_id, $detalles, $usuario);
    $stmt->execute();
}

?>
