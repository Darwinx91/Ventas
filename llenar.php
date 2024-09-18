<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNexus Laptops</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #292a70;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        nav {
            margin: 10px 0;
        }
        nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            flex-grow: 1;
        }
        .add-product, .product-list {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .add-product h2, .product-list h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .add-product label, .product-list label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .add-product input, .add-product textarea, .product-list .product img {
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .add-product input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
        .add-product input[type="submit"]:hover {
            background-color: #218838;
        }
        .product {
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product h3 {
            margin: 0;
            color: #333;
        }
        .product p {
            margin: 10px 0;
            color: #555;
        }
        .product .price {
            font-weight: bold;
            color: #28a745;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            margin-top: 20px;
        }
        footer a {
            color: #fff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Menú de navegación -->
    <header>
        <h1>TechNexus Laptops</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="productos.php">Productos</a>
            <a href="sobrenosotros.php">Sobre Nosotros</a>
            <a href="contacto.php">Contacto</a>
            <a href="llenar.php">Llenar Datos</a>
        </nav>
    </header>

    <!-- Formulario para agregar nuevos productos -->
    <section class="container">
        <div class="add-product">
            <h2>Agregar Nuevo Producto</h2>

            <?php
            // Conectar a la base de datos
            $host = "localhost";
            $usuario = "root"; // Usuario por defecto en XAMPP
            $contraseña = "";  // Contraseña por defecto es vacía en XAMPP
            $bd = "reportes_ventas"; // Nombre de tu base de datos

            $conexion = new mysqli($host, $usuario, $contraseña);

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Crear la base de datos si no existe
            $sql = "CREATE DATABASE IF NOT EXISTS $bd";
            if ($conexion->query($sql) === TRUE) {
                // Seleccionar la base de datos
                $conexion->select_db($bd);
            } else {
                die("Error al crear la base de datos: " . $conexion->error);
            }

            // Crear la tabla productos si no existe
            $sql = "CREATE TABLE IF NOT EXISTS productos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255) NOT NULL,
                descripcion TEXT NOT NULL,
                precio DECIMAL(10,2) NOT NULL,
                imagen LONGBLOB NOT NULL
            )";

            if ($conexion->query($sql) === FALSE) {
                die("Error al crear la tabla: " . $conexion->error);
            }

            // Procesar los datos del formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Obtener los datos del formulario
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];

                // Manejar la imagen
                $imagen = $_FILES['imagen']['tmp_name'];
                $imagen_binaria = addslashes(file_get_contents($imagen)); // Convertir la imagen a binario

                // Preparar la consulta SQL
                $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";

                // Preparar el statement
                $stmt = $conexion->prepare($sql);

                if ($stmt) {
                    // Vincular parámetros
                    $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen_binaria);

                    // Ejecutar la consulta
                    if ($stmt->execute()) {
                        echo "Producto guardado con éxito.<br>";
                    } else {
                        echo "Error al guardar el producto: " . $stmt->error . "<br>";
                    }

                    // Cerrar el statement
                    $stmt->close();
                } else {
                    // Mostrar el error si falla la preparación del statement
                    echo "Error en la preparación de la consulta SQL: " . $conexion->error;
                }
            }

            // Cerrar la conexión
            $conexion->close();
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="descripcion">Descripción del Producto:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required>

                <!-- Campo para subir una imagen -->
                <label for="imagen">Subir Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>

                <input type="submit" value="Agregar Producto">
            </form>
        </div>

        <!-- Sección de productos -->
        <div class="product-list">
            <h2>Publicaciones</h2>

            <?php
            // Conectar a la base de datos
            $conexion = new mysqli($host, $usuario, $contraseña, $bd);

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Obtener los productos de la base de datos
            $sql = "SELECT * FROM productos";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                // Mostrar los productos
                while ($row = $resultado->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<h3>' . htmlspecialchars($row['nombre']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
                    echo '<p class="price">$' . number_format($row['precio'], 2) . '</p>';

                    // Mostrar la imagen
                    $imagen = base64_encode($row['imagen']);
                    echo '<img src="data:image/png;base64,' . $imagen . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay productos disponibles.</p>';
            }

            // Cerrar la conexión
            $conexion->close();
            ?>
        </div>
    </section>

    <footer>
            <p>&copy; 2024 Tienda de Laptops. Todos los derechos reservados.</p>
            <p><a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a></p>
        </footer>
</body>
</html>
