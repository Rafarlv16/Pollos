<?php

// Agrega la siguiente línea para imprimir el valor de upload_max_filesize
echo "upload_max_filesize: " . ini_get('upload_max_filesize');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $imagen = $_FILES['imagen'];

    if ($imagen['error'] === UPLOAD_ERR_OK) {
        $mime_type = mime_content_type($imagen["tmp_name"]);

        if ($mime_type === 'image/png') {
            $rutaImagen = "imagenes/" . $imagen["name"];

            if (move_uploaded_file($imagen["tmp_name"], $rutaImagen)) {
                // Aquí puedes realizar la conexión a la base de datos y la inserción del registro
                echo "Imagen subida con éxito";
            } else {
                echo "Error al mover la imagen";
            }
        } else {
            echo "Por favor, selecciona un archivo .png válido.";
        }
    } else {
        echo "Error al subir la imagen. Código de error: " . $imagen['error'];
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen de Comida</title>
</head>

<body>

    <h2>Subir Imagen de Comida</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre de la comida:</label>
        <input type="text" name="nombre" required>
        <br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required>
        <br>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" accept="image/png" required maxlength="33554432"> <!-- 32 megabytes en bytes -->
        <br>

        <input type="submit" name="submit" value="Subir Comida">
    </form>

</body>

</html>
