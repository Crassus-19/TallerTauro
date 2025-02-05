<?php
$host = "vehiculos.mysql.database.azure.com";
$port = 3306;
$username = "trhbkrtgaa";
$password = "your-password"; // Replace with your actual password
$database = "vehiculos";

$connection = new mysqli($host, $username, $password, $database, $port);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>