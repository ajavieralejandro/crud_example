<?php
include '../conexion.php';
session_start();
$id = $_GET['id'];
if (!$_SESSION['username'])
    header("Location: ../vistas/login.php");
$sql2 = "SELECT * FROM comentarios WHERE id='$id'";
$comentario = $conn->query($sql2);
$comentario = $comentario->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Editar Comentario</title>
</head>

<body>
    <div class="m-5">
        <form method="POST" action="../controlador/editar_comentario_controlador.php">
            <input type="hidden" id="id" name="id" value=<?php echo $id ?>>
            <div class="form-group container">
                <label for="exampleFormControlTextarea1">Comentario : </label>
                <textarea class="mb-2 form-control" name="contenido" id="exampleFormControlTextarea1" rows="3">
                    <?php
                    echo $comentario['contenido'];
                    ?>
                </textarea>
                <button type="submit" class="btn btn-primary mb-2">Editar Comentario</button>

            </div>

        </form>
    </div>'

</body>

</html>

<?php
$conn->close();
?>