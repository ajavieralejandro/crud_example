<?php
include '../conexion.php';
session_start();
$id = $_GET['id'];
if (!$_SESSION['username'])
    header("Location: ../vistas/login.php");
$sql = "SELECT * FROM categorias";
$sql2 = "SELECT * FROM noticias WHERE id='$id'";
$result = $conn->query($sql);
$noticia = $conn->query($sql2);
$noticia = $noticia->fetch_assoc();


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
    <div>
        <div class="container">
            <form method="POST" action="../controlador/editar_noticia_controlador.php">
                <input type="hidden" id="id" name="id" value="<?php echo ($id); ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php
                                                                                            echo $noticia['titulo'];
                                                                                            ?>" required>
                </div>
                <div class=" mb-3">
                    <label for="image" class="form-label">imagen</label>
                    <input type="text" class="form-control" id="image" name="image" value="<?php
                                                                                            echo $noticia['imagen_link'];
                                                                                            ?>" required>
                </div>
                <div class="form-floating">
                    <input name="descripcion" class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example"
                        value="<?php
                                echo $noticia['texto'];
                                ?>">
                    <label for="floatingTextarea">Descripcion</label>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select id="categoria" name="categoria" class="form-select" aria-label="Default select example">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row['id'] == $noticia['categoria_id'])
                                    echo "<option selected value={$row['id']}>{$row['nombre']}</option>";
                                else
                                    echo "<option  value={$row['id']}>{$row['nombre']}</option>";
                            }
                        }
                        ?>

                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-5 float-end" role="button">Actualizar Noticia</button>
            </form>

        </div>

    </div>

</body>

</html>

<?php
$conn->close();
?>