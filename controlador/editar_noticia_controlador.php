<?php
include('../conexion.php');
$titulo = $_POST['title'];
$imagen = $_POST['image'];
$texto = $_POST['descripcion'];
$categoria_id = $_POST['categoria'];
$id = $_POST['id'];
session_start();

$sql = "UPDATE  noticias SET titulo = '$titulo', imagen_link = '$imagen' ,texto='$texto',categoria_id='$categoria_id' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../vistas/index.php");
} else {
    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
}
