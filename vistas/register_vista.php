<?php
include '../conexion.php';

$sql = "SELECT * FROM roles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro de Usuarios</title>
</head>

<body>
    <div>
        <div class="container">
            <h2 class="my-4">Registro</h2>
            <form method="POST" action="../controlador/register_controlador.php">
                <input type="hidden" name="rol" value="7" />
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn mt-5 btn-primary">Registrarse</button>
            </form>
        </div>
    </div>

</body>

</html>

<?php
$conn->close();
?>