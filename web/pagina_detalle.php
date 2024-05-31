<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Elemento</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos específicos de la página de detalle */
        .detail-container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Espacio entre el cuadro de contenido y el select */
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }

        /* Estilos para el contenedor del select */
        .select-container {
            display: inline-block;
            position: relative;
            width: 100%;
        }

        /* Estilos para el select */
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            appearance: none;
        }

        /* Estilos para el ícono de flecha */
        .select-arrow {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Detalle del Elemento</h1>
        <img src="Irudiak/Logo_color.jpg" alt="Descripción de la imagen" class="header-img">
    </header>

    <main>
        <div class="detail-container">
            <?php
            // Verificar si se ha pasado el parámetro "id" por la URL
            if (isset($_GET['id'])) {
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

                // Escapar el parámetro "id" para evitar inyecciones SQL
                $id = $conn->real_escape_string($_GET['id']);

                // Consulta SQL para obtener la información del elemento con el ID proporcionado
                $sql = "SELECT * FROM makinak WHERE idmakinak = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Mostrar la información del elemento
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $izena = $row["izena"];
                    echo "<h2>" . $izena . "</h2>";
                    echo "<p>Otra información del elemento: " . $row["marka"] . "</p>";
                    // Continuar mostrando otros campos según sea necesario

                    // Ruta de la imagen basada en el nombre del elemento
                    $image_path = "Irudiak/makinak/" . $izena . ".jpg";
                    if (file_exists($image_path)) {
                        echo "<img src='" . $image_path . "' alt='Imagen de " . $izena . "'>";
                    } else {
                        echo "<p>Imagen no disponible.</p>";
                    }
                } else {
                    echo "<p>No se encontró información para el ID proporcionado.</p>";
                }

                // Cerrar la conexión
                $stmt->close();
                $conn->close();
            } else {
                echo "<p>No se ha proporcionado un ID válido.</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>
