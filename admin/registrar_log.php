<?php
$servername = "vehiculos.mysql.database.azure.com";
$username = "trhbkrtgaa@vehiculos";
$password = "Stanley26";  // Si no tienes, usa ""
$database = "vehiculos";

// Crear conexión
$connection = new mysqli($servername, $username, $password, $database);

function registrar_log($tabla, $operacion, $registro_id, $detalles = "", $usuario = "admin") {
    global $connection;

    $sql = "INSERT INTO logs (Tabla, Operacion, Registro_ID, Detalles, Usuario) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssiss", $tabla, $operacion, $registro_id, $detalles, $usuario);
    $stmt->execute();
}

?>
