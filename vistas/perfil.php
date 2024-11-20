<?php
include '../conexion.php';

session_start();
$id =  $_SESSION['id'];
$sql = "SELECT * FROM usuarios WHERE id=$id";
$result = $conn->query($sql);

$sql_roles = "SELECT * FROM roles";


$result_roles = $conn->query($sql_roles);

$result_usuario = $conn->query($sql);
$value = $result_usuario->fetch_assoc();
$name = $value['nombre'];
$email = $value['email'];
$user = $value;

if (!$_SESSION['username'])
    header("Location: ../vistas/login.php");

if (isset($_SESSION['mensaje']))
    $mensajeExito = $_SESSION['mensaje'];


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
                        <a class="nav-link active" aria-current="page" href="perfil.php">Perfil</a>
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
    <div class="container rounded bg-white mt-5 mb-5">
        <form method="POST" action="../controlador/actualizar_perfil_controlador.php" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?php echo ($id); ?>">

            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <?php
                        if ($user['imagen'] != null)
                            echo '<img class="rounded-circle mt-5" width="150px" src="' . $user['imagen'] . '">';
                        else
                            echo '                        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
'
                        ?>


                        <input type="file" name="fileToUpload" id="fileToUpload">

                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" name="name" class="form-control" value=<?php echo $name ?>></div>
                            <div class="col-md-6"><label class="labels">email</label><input type="text" name="email" class="form-control" value=<?php echo $email ?>></div>
                        </div>

                        <div class="mb-3 ">
                            <label for="rol" class="form-label">Rol</label>
                            <select id="rol" name="rol_id" class="form-select" aria-label="Default select example">
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result_roles->fetch_assoc()) {
                                        if ($row['id'] == $rol_id)
                                            echo "<option selected value={$row['id']}>{$row['nombre']}</option>
    ";
                                        else
                                            echo "<option value={$row['id']}>{$row['nombre']}</option>
    ";
                                    }
                                }
                                ?>

                            </select>

                        </div>

                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="subtmit">Actualizar Perfil</button></div>


                    </div>

                </div>

            </div>
    </div>
    </div>
    </form>
    </div>

</body>

</html>

<?php
$conn->close();
?>