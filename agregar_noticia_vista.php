<?php
include 'conexion.php';

$sql = "SELECT * FROM categorias";
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
    <div>
        <div class="container">
            <form method="POST" action="agregar_noticia_controlador.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">imagen</label>
                    <input type="text" class="form-control" id="image" name="image" required>
                </div>
                <div class="form-floating">
                    <input name="descripcion" class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example">
                    <label for="floatingTextarea">Descripcion</label>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select id="categoria" name="categoria" class="form-select" aria-label="Default select example">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value={$row['id']}>{$row['nombre']}</option>
";
                            }
                        }
                        ?>

                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-5 float-end" role="button">Agregar Noticia</button>
            </form>

        </div>

    </div>

</body>

</html>

<?php
$conn->close();
?>