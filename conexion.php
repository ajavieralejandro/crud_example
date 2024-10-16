<?php
$servername = "localhost";
$username = "upso";
$password = "upso";
$dbname = "proyecto_informatico_fp";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
