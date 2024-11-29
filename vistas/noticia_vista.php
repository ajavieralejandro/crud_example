<?php
include '../conexion.php';
session_start();
$comentando = false;
if (isset($_GET['comentario_id'])) {
    $_SESSION['comentario'] = "Hola Mundo";
}
if (!isset($_SESSION['comentario']))
    $_SESSION['comentario'] = null;
$id = $_GET['id'];

$sql = "SELECT * FROM noticias WHERE id=$id";
//obtengo el id del usuario
if (!isset($_SESSION['id'])) {
    $user_id = null;
    $rol_id = null;
} else {
    $user_id = $_SESSION['id'];
    $rol_id = $_SESSION['rol_id'];
}

$result = $conn->query($sql);
$noticia = $result->fetch_assoc();

$sql2 = "SELECT comentarios.usuario_id as usuario_id, comentarios.id AS comentario_id, usuarios.nombre AS nombre, comentarios.contenido AS contenido FROM comentarios INNER JOIN usuarios ON usuario_id = usuarios.id WHERE noticia_id=9;
 ";
$result_comentarios = $conn->query($sql2);
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
                    <form method="POST" action="welcome.php" class="d-flex">
                    <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <a  href="../controlador/logout.php" class="btn btn-danger m-2">Cerrar Sesión</a>

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
                <a href="register_vista.php" class="btn btn-outline-primary m-2">Register</a>


            </div>
        </div>
    </nav>
    '
    ?>

    <main>
        <div class="row p-5">
            <h1><?php

                echo
                $noticia['titulo']
                ?></h1>
            <img class="w-50 p-3" src=<?php echo $noticia['imagen_link'] ?> alt="imagen noticia" />
            <p>
                <?php
                echo $noticia['texto']
                ?>
            </p>

        </div>

        <?php
        if ($result_comentarios->num_rows == 0)
            echo "No hay comentarios";
        else {
            while ($comentario = $result_comentarios->fetch_assoc()) {

                echo
                "
                <div class=\"container\">
                 <br />
                 <p> Usuario : " . $comentario['nombre'] . "</p>
                 <p> Comentario : " . $comentario['contenido'] . "</p>";

                if ($user_id == $comentario['usuario_id'] || $rol_id == 1)
                    echo '
                          <a class="button" href="../controlador/eliminar_comentario.php?id=' . $comentario['comentario_id'] .  '&noticia_id=' . $id . '">Eliminar comentario </a>
                          <a class="button" href="./noticia_vista.php?id=' . $id . '&comentario_id=' . $comentario['comentario_id'] . '">Editar comentario </a>
                    ';

                echo "</div>";
            }
        }
        ?>

        </div>
        <?php

        if (isset($_SESSION['username']) && $_SESSION['comentario'] == null)
            echo '
<div class="m-5">
<form method="POST" action="../controlador/agregar_comentario_controlador.php">
   <input type="hidden" id="id" name="noticia_id" value=' . $id . '>
    <div class="form-group container">
        <label for="exampleFormControlTextarea1">Comenta : </label>
        <textarea class="mb-2 form-control" name="contenido" id="exampleFormControlTextarea1" rows="3">' . $_SESSION['comentario'] . '</textarea>
                      <button type="submit" class="btn btn-primary mb-2">Agregar Comentario</button>

        </div>

</form>
</div>';

        else
            echo '
        <div class="m-5">
        <form method="POST" action="../controlador/editar_comentario_controlador.php">
           <input type="hidden" id="id" name="id" value=' . $_GET['comentario_id'] . '>
            <div class="form-group container">
                <label for="exampleFormControlTextarea1">Comenta : </label>
                <textarea class="mb-2 form-control" name="contenido" id="exampleFormControlTextarea1" rows="3">' . $_SESSION['comentario'] . '</textarea>
                              <button type="submit" class="btn btn-primary mb-2">Agregar Comentario</button>
        
                </div>
        
        </form>
        </div>';


        ?>

    </main>



</body>



</html>

<?php
$conn->close();
?>