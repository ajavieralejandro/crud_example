<?php
include 'conexion.php';

//$sql = "SELECT * FROM categorias";
//$result = $conn->query($sql);
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
            <form method="POST" action="agregar_categoria_controlador.php">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <button type="submit" class="btn btn-primary mt-5 float-end" role="button">Insertar Categoria</button>
            </form>

        </div>

    </div>

</body>

</html>

<?php
$conn->close();
?>