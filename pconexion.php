<?php
$conn = new mysqli('bd.c5bcfksvntyz.us-east-1.rds.amazonaws.com', 'admin', 'ingesoft123', 'bd');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa!";
$conn->close();
?>

