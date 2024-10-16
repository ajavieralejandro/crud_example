<?php
include 'conexion.php';

$sql = "SELECT * FROM noticias";
$sql2 = "SELECT * FROM categorias";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

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
            <?php
            if ($result2->num_rows == 0) {
                echo '<h6>No hay categorias Para mostrar</h6>';
            } else {
                echo '
                <table class="table mt-5">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Editar</th>

                            </tr>
                        </thead>
                        <tbody>
                        ';
                while ($categoria = $result2->fetch_assoc()) {
                    echo "
                <tr>
                        <td >{$categoria['id']}</td>
                        <td>{$categoria['nombre']}</td>
                        <td>
                            <a href=\"eliminar_categoria_controlador.php?id={$categoria['id']}\">
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                            </a>
                           


                        </td>
                        <td>
                              <a   href=\"update_categoria_vista.php?id={$categoria['id']}\">
                            <i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>
                            </a>
                        </td>
                </tr>
                ";
                }

                echo '</tbody></table>';
            }
            ?>
            <a class="btn btn-primary" href="agregar_categoria_vista.php" role="button">Agregar Categoria</a>


            <?php
            if ($result->num_rows == 0) {
                echo '<h6>No hay noticias para mostrar</h6>';
            } else {
                echo '
                <table class="table mt-5">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                while ($noticia = $result->fetch_assoc()) {
                    echo "
                <tr>
                        <th >{$noticia['id']}</th>
                        <td>{$noticia['titulo']}</td>
                        <td>{$noticia['categoria_id']}</td>
                        <td>
                            <a href=\"eliminar_noticia.php?id={$noticia['id']}\">
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                            </a>


                        </td>
                </tr>
                ";
                }

                echo '</tbody></table>';
            }
            ?>
            <a class="btn btn-primary" href="agregar_noticia_vista.php" role="button">Agregar Noticia</a>

        </div>


    </div>

</body>

</html>

<?php
$conn->close();
?>