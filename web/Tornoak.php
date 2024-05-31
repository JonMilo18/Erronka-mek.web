<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tornoak</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #007BFF; /* Azul */
            color: #fff;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header h1 {
            margin: 0;
        }

        .header-img {
            height: 50px;
            width: auto;
        }

        main {
            padding: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px; /* Agregar margen superior */
        }

        ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        ul li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Tornoak</h1>
        <img src="Irudiak/Logo_color.jpg" alt="Descripción de la imagen" class="header-img">
    </header>

    <main>
        <ul>
            <?php
            // Establecer la conexión a la base de datos (usando la misma conexión que en las páginas anteriores)
            $servername = "localhost";
            $username = "root";
            $password = "1WMG2023";
            $database = "erronkamek";

            $conn = new mysqli($servername, $username, $password, $database);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("La conexión ha fallado: " . $conn->connect_error);
            }

            // Consulta SQL para obtener los elementos cuyo campo "izena" comienza con la letra "t" de la tabla "makinak"
            $sql = "SELECT * FROM makinak WHERE izena LIKE 'T%'";
            $result = $conn->query($sql);

            // Mostrar los elementos en una lista
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row["izena"] . "</li>";
                }
            } else {
                echo "<li>No hay elementos en la tabla que comiencen con la letra 't'.</li>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </ul>
    </main>
</body>
</html>
