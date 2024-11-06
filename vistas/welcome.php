<?php
include '../conexion.php';
session_start();
$sql = "SELECT titulo,nombre,texto,imagen_link,noticias.id FROM `noticias` INNER JOIN categorias ON noticias.categoria_id = categorias.id";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    //convierto lo que leo en minusculas
    $search = strtolower($search);
    //$sql = "SELECT * FROM noticias WHERE LOWER(titulo) LIKE '%$search%' ";SELECT * FROM noticias LEFT JOIN categorias ON noticias.categoria_id = categorias.id  WHERE LOWER(titulo) LIKE '%$search% 
    $sql = " SELECT * FROM noticias INNER JOIN categorias ON noticias.categoria_id = categorias.id
     WHERE LOWER(noticias.titulo) LIKE '%$search%' 
     OR 
            LOWER(categorias.nombre) LIKE '%$search%'
      ";
}
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./welcome.css" />
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
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicadores de cada slide -->
                <ol class="carousel-indicators">
                    <li data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#newsCarousel" data-bs-slide-to="1"></li>
                    <li data-bs-target="#newsCarousel" data-bs-slide-to="2"></li>
                </ol>

                <?php
                $cont = 0;
                $noticia = $result->fetch_assoc();
                while ($noticia != null && $cont < 3) {
                    if ($cont == 0) {
                        echo '
                            
                        <div class="carousel-item active">
                            <img src="' . $noticia['imagen_link'] . '" class="d-block w-100" alt="Imagen de noticia 1">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>' . $noticia['titulo'] . '</h5>
                                <p>' . $noticia['texto'] . '</p>
                            </div>
                        </div>
        
        
        
                            ';
                    } else {
                        echo '
                            
                <div class="carousel-item ">
                    <img src="' . $noticia['imagen_link'] . '" class="d-block w-100" alt="Imagen de noticia 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>' . $noticia['titulo'] . '</h5>
                        <p>' . $noticia['texto'] . '</p>
                    </div>
                </div>



                    ';
                    }
                    $cont = $cont + 1;
                    $noticia = $result->fetch_assoc();
                }

                ?>



                <!-- Controles del carrusel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>




            <?php
            if ($result->num_rows == 0) {
                echo '<h6>No hay noticias para mostrar</h6>';
            } else {
                while ($noticia = $result->fetch_assoc()) {
                    echo "
        <div class=\"col-sm-12 col-md-4 p-4\">
    <div class=\"card\" style=\"width: 18rem;\">
        <img src=\"{$noticia['imagen_link']}\" class=\"card-img-top\" alt=\"...\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">{$noticia['titulo']}</h5>
                            <p class=\"card-text\">{$noticia['texto']}</p>
                            <a href=\"noticia_vista.php?id={$noticia['id']}\" class=\"btn btn-primary\">{$noticia['nombre']}</a>
                        </div>
    </div>
    </div>
    ";
                }
            }
            ?>
        </div>

        </div>
    </main>

    <!-- JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>



</html>

<?php
$conn->close();
?>