<?php
include '../conexion.php';
$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id=$id";
$sql_roles = "SELECT * FROM roles";
$result = $conn->query($sql);
$value = $result->fetch_assoc();
$nombre = $value['nombre'];
$rol_id = $value['rol_id'];
$id = $value['id'];
$result_roles = $conn->query($sql_roles);

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
            <form method="POST" action="../controlador/actualizar_usuario_controlador.php">
                <input type="hidden" id="id" name="id" value="<?php echo ($id); ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" name="nombre" required>
                </div>

                <div class"mb-3">
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

                <button type="submit" class="btn btn-primary mt-5 float-end" role="button">Actualizar Usuario</button>
            </form>

        </div>

    </div>

</body>

</html>

<?php
$conn->close();
?>