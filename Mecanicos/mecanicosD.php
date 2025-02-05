<?php
$servername = "vehiculos.mysql.database.azure.com";
$username = "trhbkrtgaa@vehiculos";
$password = "Stanley26";  // Si no tienes, usa ""
$database = "vehiculos";

// Crear conexión
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

$id = $_GET["id"] ?? null;

if ($id) {
    $sql = "DELETE FROM mecanicos WHERE ID=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: mecanicosV.php");
        exit;
    } else {
        die("Error al eliminar: " . $stmt->error);
    }
}
?>
