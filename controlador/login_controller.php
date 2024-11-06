<?php
include('../conexion.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE nombre = '$username'";

    $result = $conn->query($sql);
    //Verifico que me este trayendo un usuario
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
        if (password_verify($password, $user['contraseña'])) {

            //Estoy asignando un usuario a la sesion
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $user['id'];
            $_SESSION['rol_id'] = $user['rol_id'];
            //Si soy administrador lo llevo al dashboard de admin
            if ($_SESSION['rol_id'] == 4) {
                header("Location: ../vistas/index.php");
                exit;
            }

            //Si soy otro usuario lo llevo a un dashboard normal
            header("Location: ../vistas/index_usuario.php");
            exit;
        } else {
            echo "<div class='alert alert-danger mt-3'>Contraseña incorrecta</div>";
        }
    } else {
        echo "<div class='alert alert-danger mt-3'>Usuario no encontrado</div>";
    }
}
