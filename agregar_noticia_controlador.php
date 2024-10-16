<?php

include 'conexion.php';
//session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $image = $_POST['image'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria'];
    $autor_id =  4;

    $sql = "INSERT INTO noticias (titulo,texto,imagen_link,categoria_id,autor_id) VALUES ('$title', '$descripcion','$image', '$categoria_id','$autor_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
