<?php
include('../conexion.php');
//Este es el id del comentario
$id = $_POST['id'];
session_start();
$contenido = $_POST['contenido'];

$sql = "UPDATE  comentarios SET contenido ='$contenido'  WHERE id=$id";


if ($conn->query($sql) === TRUE) {
    //Lo tengo que devolver a la vista de la noticia que estaba antes
    $sql = "SELECT * FROM comentarios   WHERE id=$id";
    $query = $conn->query($sql);
    $comentario = $query->fetch_assoc();
    $noticia_id = $comentario['noticia_id'];

    header("Location: ../vistas/noticia_vista.php?id='$noticia_id'");
} else {
    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
}
