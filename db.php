<?php
$host = "vehiculos.mysql.database.azure.com";  // Servidor de MySQL en Azure
$usuario = "trhbkrtgaa@vehiculos";             // Usuario administrador
$contraseña = "Stanley26";                               // Dejar vacío si no tienes contraseña
$bd = "vehiculos";                             // Nombre de la base de datos

// Crear conexión
$connection = new mysqli($host, $usuario, $contraseña, $bd);

// Verificar conexión
if ($connection->connect_error) {
    die("Error de conexión a MySQL: " . $connection->connect_error);
}
?>