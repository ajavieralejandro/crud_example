<?php

include '../conexion.php';
session_start();
$autor_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $image = $_POST['image'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria'];

    $sql = "INSERT INTO noticias (titulo,texto,imagen_link,categoria_id,autor_id) VALUES ('$title', '$descripcion','$image', '$categoria_id','$autor_id')";

    if ($conn->query($sql) === TRUE) {
        if ($_SESSION['rol_id'] == 4) {
            header("Location: ../vistas/index.php");
            exit;
        }

        //Si soy otro usuario lo llevo a un dashboard normal
        header("Location: ../vistas/index_usuario.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
