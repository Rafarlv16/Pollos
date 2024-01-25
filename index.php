

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los Pollos</title>
    <script src="https://cdn.tailwindcss.com/3.4.1"></script>

    <style>
        .fondoArticulos {
            border-radius: 5px;
            background-repeat: none;
            padding: 10px;
        }

        .fondoBanner {
            background-image: url(b1.jpg);
            border-radius: 5px;
            padding: 10px;
            background-repeat: none;
            width: 100%;
        }
    </style>
</head>

<body class="bg-gray-300 font-sans">

    <header class="bg-gray-800 text-white text-center py-4">
        <div class="fondoBanner">
            <h1 class="text-3xl font-bold">Los Pollos</h1>
            <br>
            <img src="./Logo-Centro.png" style="border-radius: 25px; margin-left: 35%; width: 30%;">
        </div>
    </header>

    <nav class="bg-red-700  py-2">
        <div class="flex justify-around">
            <a href="index.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Combos Familiar</a>
            <a href="Reservas.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Reservas</a>
            <a href="Postres.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Postres</a>
            <a href="Bebidas.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Bebidas</a>
        </div>
    </nav>

    <main class="container mx-auto mt-4">
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "lospollos";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para obtener datos de los artículos desde la base de datos
        $sql = "SELECT nombre, precio, imagen FROM comida";
        $result = $conn->query($sql);

        // Verificar si la consulta fue exitosa
        if ($result->num_rows > 0) {
            // Obtener los datos de los artículos en un array
            $articulos = $result->fetch_all(MYSQLI_ASSOC);

            // Recorrer el array de artículos y mostrarlos en el div
            foreach ($articulos as $comida) {
                echo '<div class="bg-white p-4 rounded-md shadow-md">';
                echo '<div class="fondocomidas text-black">';
                echo '<h2 class="text-xl font-semibold mb-2">' . $comida['nombre'] . '</h2>';
                echo '<div class="flex">';
                // Mostrar la foto del artículo
                echo '<img src="' . $comida['imagen'] . '.png"  alt="">';
                echo '</div>';
                echo '<p>Precio: </p>';
                echo '<p>' . $comida['precio'] . '</p>';
                echo '<button class="mt-2 bg-blue-300 text-blue py-1 px-2 rounded hover:bg-blue-600">Pedir</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No se encontraron resultados para los artículos.";
        }

        // Cerrar la conexión al finalizar
        $conn->close();
        ?>
    </section>
</main>


    <footer class="bg-gray-800 text-white text-center py-2">
        <center>
            <img src="./Anuncio-Abajo.jpg" alt="" srcset="">
        </center>
        <br>
        <p>&copy; 2024 Venta de Pollo Frito</p>
    </footer>

</body>

</html>
