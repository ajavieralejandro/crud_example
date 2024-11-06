<?php
include('../conexion.php');
$nombre = $_POST['nombre'];
$id = $_POST['id'];
$rol_id = $_POST['rol_id'];
$sql = "UPDATE  usuarios SET nombre = '$nombre', rol_id='$rol_id' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../vistas/index.php");
} else {
    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
}
