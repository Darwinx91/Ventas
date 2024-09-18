<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNexus Laptops</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="es">
    <link rel="stylesheet"href="Style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - TechNexus Laptops</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
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

    <div class="container">
        <section class="contact">
            <h2>Contacto</h2>
            <p>¿Tienes alguna pregunta o necesitas asistencia? ¡Estamos aquí para ayudarte! Puedes contactarnos utilizando el siguiente formulario, o a través de nuestras líneas de atención al cliente.</p>
            
            <form action="enviar-consulta.php" method="post">
                <label for="name">Nombre Completo:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Enviar Mensaje</button>
            </form>

            <h3>Información de Contacto</h3>
            <p><strong>Correo Electrónico:</strong> soporte@technexus.com</p>
            <p><strong>Teléfono:</strong> +593 123 456 789</p>
            <p><strong>Dirección:</strong> Av. de los Shyris, Quito, Ecuador</p>

            <h3>Horario de Atención</h3>
            <p>Lunes a Viernes: 9:00 AM - 6:00 PM</p>
            <p>Sábados: 10:00 AM - 2:00 PM</p>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Tienda de Laptops. Todos los derechos reservados.</p>
        <p><a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a></p>
    </footer>
</body>
</html>

</body>
</html>