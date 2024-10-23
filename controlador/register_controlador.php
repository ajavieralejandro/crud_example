<?php

include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    //Tengo que fijarme que el usuario que voy a insertar no exista
    $sql_usuario = "SELECT * FROM usuarios WHERE nombre = '$username'";
    //Tengo que fijarme que el mail que el usuario intenta registrar tampoco exista
    $sql_usuario_2 = "SELECT * FROM usuarios WHERE email = '$email'";

    $result = $conn->query($sql_usuario);
    $result_2 = $conn->query($sql_usuario_2);


    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger mt-3'>Usuario ya existente en la base de datos</div>";
        exit;
    }


    if ($result_2->num_rows > 0) {
        echo "<div class='alert alert-danger mt-3'>email ya existente en la base de datos</div>";
        exit;
    }

    $sql = "INSERT INTO usuarios (nombre,email, contraseña,rol_id) VALUES ('$username', '$email', '$password','$rol')";

    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['username'] = $username;
        //$_SESSION['id'] = $user['id'];
        $_SESSION['rol_id'] = $rol;
        header("Location: ../vistas/welcome.php");
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
