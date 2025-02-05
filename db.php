<?php
$servername = "vehiculos.mysql.database.azure.com";
$username = "trhbkrtgaa@vehiculos"; // Ensure '@vehiculos' is included
$password = "Stanley26";  // Replace with your actual password
$database = "vehiculos";
$port = 3306;
$ssl_cert = "DigiCertGlobalRootCA.crt.pem"; // Update this path

// ✅ Secure MySQL connection using SSL
$connection = mysqli_init();
mysqli_ssl_set($connection, NULL, NULL, $ssl_cert, NULL, NULL);
mysqli_real_connect($connection, $servername, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die("❌ Connection failed: " . mysqli_connect_error());
} else {
    echo "✅ Connected to Azure MySQL successfully!";
}
?>
