<?php
include 'conexion.php';
$id = $_GET['id'];
$sql = "SELECT * FROM categorias WHERE id=$id";
$result = $conn->query($sql);
$value = $result->fetch_assoc();
$nombre = $value['nombre'];
$id = $value['id'];

echo $id;
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
            <form method="POST" action="actualizar_categoria_controlador.php">
                <input type="hidden" id="id" name="id" value="<?php echo ($id); ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" name="nombre" required>
                </div>

                <button type="submit" class="btn btn-primary mt-5 float-end" role="button">Actualizar Categoria</button>
            </form>

        </div>

    </div>

</body>

</html>

<?php
$conn->close();
?>