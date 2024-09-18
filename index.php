<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNexus Laptops - Inicio</title>
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
        .featured-product {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product {
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px; /* Ajusta el ancho según sea necesario */
            box-sizing: border-box;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .product h2 {
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

    <!-- Sección de productos -->
    <section class="container">
        <h2>Productos Destacados</h2>
        <div class="featured-product">
            <?php
            // Conectar a la base de datos
            $host = "localhost";
            $usuario = "root"; // Usuario por defecto en XAMPP
            $contraseña = "";  // Contraseña por defecto es vacía en XAMPP
            $bd = "reportes_ventas"; // Nombre de tu base de datos

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
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                    echo '<h2>' . htmlspecialchars($row['nombre']) . '</h2>';
                    echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
                    echo '<p class="price">$' . number_format($row['precio'], 2) . '</p>';
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
