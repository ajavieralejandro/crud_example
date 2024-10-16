<?php
include('conexion.php');
$id = $_GET['id'];
$sql = "DELETE FROM categorias WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
}
