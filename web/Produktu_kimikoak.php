<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktu Kimikoak</title>
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
        }

        ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        ul li:last-child {
            border-bottom: none;
        }

        .pdf-link {
            margin-left: 10px;
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Produktu Kimikoak</h1>
        <img src="Irudiak/Logo_color.jpg" alt="Descripción de la imagen" class="header-img">
    </header>

    <main>
        <ul>
            <?php
            // Establecer la conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "1WMG2023";
            $database = "erronkamek";

            $conn = new mysqli($servername, $username, $password, $database);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("La conexión ha fallado: " . $conn->connect_error);
            }

            // Consulta SQL para obtener los productos químicos de la tabla
            $sql = "SELECT * FROM produktukimikoak";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $pdf_name = $row["izena"] . ".pdf";
                    $pdf_path_motzak = "Irudiak/PDF/motzak/" . $pdf_name;
                    $pdf_path_luzeak = "Irudiak/PDF/luzeak/" . $pdf_name;
                    echo "<li><span>" . $row["izena"] . "</span> <a href='" . $pdf_path_motzak . "' class='pdf-link'>PDF-motzak</a><a href='" . $pdf_path_luzeak . "' class='pdf-link'>PDF-luzeak</a></li>";
                }
            } else {
                echo "<li>No hay productos químicos en la tabla.</li>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </ul>
    </main>
</body>
</html>
