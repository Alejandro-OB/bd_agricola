<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "bd_agricola";

// Crear la conexión
$conn = mysqli_connect($host, $user, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
