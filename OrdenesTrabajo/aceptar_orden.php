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

    // ✅ Insertar en la tabla ordenes
    $sql_insert = "INSERT INTO ordenes (Unidad_ID, Descripcion, Estado) 
                   SELECT Unidad_ID, Comentarios, 'Pendiente' FROM registros WHERE ID = ?";
    $stmt_insert = $connection->prepare($sql_insert);
    $stmt_insert->bind_param("i", $registro_id);

    if ($stmt_insert->execute()) {
        // ✅ Registrar en logs: Inserción en "ordenes"
        registrar_log("ordenes", "INSERT", $registro_id, "Se agregó una nueva orden desde registros");

        // ✅ Actualizar el estado a "Aceptada" en la tabla registros
        $sql_update = "UPDATE registros SET Estado = 'Aceptada' WHERE ID = ?";
        $stmt_update = $connection->prepare($sql_update);
        $stmt_update->bind_param("i", $registro_id);
        $stmt_update->execute();

        // ✅ Registrar en logs: Cambio de estado en "registros"
        registrar_log("registros", "UPDATE", $registro_id, "Estado cambiado a 'Aceptada'");
    }

    header("Location: ordenes_trabajo.php");
    exit();
}
?>

