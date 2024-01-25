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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $npersonas = $_POST['npersonas'];
    $nmesa = $_POST['nmesa']; 

    

    $sql = "INSERT INTO reservar (nombre, npersonas, nmesa) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("sis", $nombre, $npersonas, $nmesa);

    if (!$stmt->execute()) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }


    $stmt->close();
}
?>


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

        .parent {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px;
        }

        .parent img {
            cursor: pointer;
        }

        .formulario-container {
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
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

    <nav class="bg-red-700 py-2">
        <div class="flex justify-around">
            <a href="index.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Combos Familiar</a>
            <a href="Reservas.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Reservas</a>
            <a href="Postres.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Postres</a>
            <a href="Bebidas.php" class="text-white hover:bg-yellow-500 py-2 px4 rounded">Bebidas</a>
        </div>
    </nav>

    <main class="container mx-auto mt-4 flex">
        <section class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="parent">
                <img src="mesa-vacia.png" id="mesa1" alt="" onclick="cambiarEstadoMesa('mesa1')">
                <img src="mesa-vacia.png" id="mesa2" alt="" onclick="cambiarEstadoMesa('mesa2')">
                <img src="mesa-vacia.png" id="mesa3" alt="" onclick="cambiarEstadoMesa('mesa3')">
                <img src="mesa-vacia.png" id="mesa4" alt="" onclick="cambiarEstadoMesa('mesa4')">
                <img src="mesa-vacia.png" id="mesa5" alt="" onclick="cambiarEstadoMesa('mesa5')">
                <img src="mesa-vacia.png" id="mesa6" alt="" onclick="cambiarEstadoMesa('mesa6')">
                <img src="mesa-vacia.png" id="mesa7" alt="" onclick="cambiarEstadoMesa('mesa7')">
                <img src="mesa-vacia.png" id="mesa8" alt="" onclick="cambiarEstadoMesa('mesa8')">
                <img src="mesa-vacia.png" id="mesa9" alt="" onclick="cambiarEstadoMesa('mesa9')">
            </div>

            <div class="formulario-container ml-4">
            <h2 class="text-2xl font-bold mb-4">Reservar Mesa</h2>
            <form id="reservaForm" method="post" action="" onsubmit="mostrarMensajeReserva(); return false;">
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Ingrese su nombre"
                        class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="npersonas" class="block text-sm font-medium text-gray-700">Número de Personas</label>
                    <input type="number" id="npersonas" name="npersonas" required
                        placeholder="Número de personas" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="nmesa" class="block text-sm font-medium text-gray-700">Número de Mesa Seleccionada</label>
                    <input type="text" id="nmesa" name="nmesa" readonly class="mt-1 p-2 w-full border rounded-md">
                </div>
                <input type="submit" value="Reservar"
                    class="bg-red-700 text-white p-2 rounded-md cursor-pointer hover:bg-red-600">
            </form>
        </div>

        </section>

        <script>
            let MesaSeleccionada = null;

            function cambiarEstadoMesa(MesaId) {
            if (MesaSeleccionada) {
                document.getElementById(MesaSeleccionada).src = "mesa-vacia.png";
                document.getElementById(MesaSeleccionada).classList.remove('mesa-ocupada');
            }

            document.getElementById(MesaId).src = "mesa-ocupada.png";
            document.getElementById(MesaId).classList.add('mesa-ocupada');
            MesaSeleccionada = MesaId;

            document.getElementById('nmesa').value = MesaSeleccionada;
            mostrarFormulario();
            }

            function mostrarFormulario() {
                const formularioContainer = document.querySelector('.formulario-container');
                formularioContainer.classList.remove('hidden');
            }

            function mostrarMensajeReserva() {
            const nombre = document.getElementById('nombre').value;
            const numeroPersonas = document.getElementById('numeroPersonas').value;

            alert(`Reserva realizada:\nMesa: ${MesaSeleccionada}\nNombre: ${nombre}\nNúmero de Personas: ${numeroPersonas}`);

            document.getElementById('nmesa').value = MesaSeleccionada;

            document.getElementById(MesaSeleccionada).src = "mesa-vacia.png";
            document.getElementById(MesaSeleccionada).classList.remove('mesa-ocupada');
            MesaSeleccionada = null;
            document.getElementById('reservaForm').reset();
        }

        </script>
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