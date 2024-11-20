<?php
include('../conexion.php');
$id = $_GET['id'];
session_start();
$noticia_id = $_GET['noticia_id'];
$sql = "DELETE FROM comentarios WHERE id=$id";
$comentario = $_GET['comentario'];
$_SESSION['comentario'] = $comentario;
if ($conn->query($sql) === TRUE) {
    //Lo tengo que devolver a la vista de la noticia que estaba antes
    header("Location: ../vistas/noticia_vista.php?id='$noticia_id'");
} else {
    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
}
