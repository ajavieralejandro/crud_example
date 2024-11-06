<?php
include '../conexion.php';
session_start();

if (!$_SESSION['username'])
    header("Location: ../vistas/login.php");
//Si sos admin te lleva a la vista admin

if ($_SESSION['rol_id'] == 4) {
    header("Location: ../vistas/index.php");
    exit;
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM noticias WHERE autor_id='$id'";

$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Noticias</title>
</head>

<body>
    <?php
    if ($_SESSION)
        echo '
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>


                </ul>
                <a href="../controlador/logout.php" class="btn btn-danger">Cerrar Sesión</a>

            </div>
        </div>
    </nav>';
    else
        echo '
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>


                </ul>
                <a href="login.php" class="btn btn-outline-primary m-2">Login</a>
                <a href="register.php" class="btn btn-outline-primary m-2">Register</a>


            </div>
        </div>
    </nav>
    '
    ?>
    <div>
        <div class="container">




            <?php
            if ($result->num_rows == 0) {
                echo '<h6>No hay noticias para mostrar</h6>';
            } else {
                echo '
                <table class="table mt-5">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                while ($noticia = $result->fetch_assoc()) {
                    echo "
                <tr>
                        <th >{$noticia['id']}</th>
                        <td>{$noticia['titulo']}</td>
                        <td>{$noticia['categoria_id']}</td>
                        <td>
                            <a href=\"../controlador/eliminar_noticia_controlador.php?id={$noticia['id']}\">
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                            </a>


                        </td>
                </tr>
                ";
                }

                echo '</tbody></table>';
            }
            ?>
            <a class="btn btn-primary" href="agregar_noticia_vista.php" role="button">Agregar Noticia</a>

        </div>


    </div>

</body>

</html>

<?php
$conn->close();
?>