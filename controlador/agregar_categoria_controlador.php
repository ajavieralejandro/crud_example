<?php
include('../conexion.php');
$nombre = $_POST['nombre'];
$sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../vistas/index.php");
} else {
    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
}
