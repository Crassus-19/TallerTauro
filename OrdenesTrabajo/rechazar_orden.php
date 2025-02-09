<?php
require "admin/registrar_log.php"; // Importar función de logs

$servername = "vehiculos.mysql.database.azure.com";
$username = "trhbkrtgaa@vehiculos";
$password = "Stanley26";  // Si no tienes, usa ""
$database = "vehiculos";

// Crear conexión
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $registro_id = $_GET["id"];

    // Cambiar el estado a "Rechazada" en la tabla registros
    $sql = "UPDATE registros SET Estado = 'Rechazada' WHERE ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $registro_id);
    
    if ($stmt->execute()) {
        // ✅ Registrar en logs: Cambio de estado en "registros"
        registrar_log("registros", "UPDATE", $registro_id, "Cambio de estado a Rechazada"); // ⬅ Usamos un valor más corto
    }

    header("Location: ordenes_trabajo.php");
    exit();
}
?>
