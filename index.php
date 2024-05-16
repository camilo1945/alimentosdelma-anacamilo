<?php
// Conectar a la base de datos
$servername = "localhost:3308";
$username_db = "root";
$password_db = "";
$dbname = "distribucionalimentos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Web App de Distribución de Alimentos</title>
    <link rel="stylesheet" href="CSS/index_php.css">
</head>
<body>
    <div class="header">
        <h1>Distribuidora de Alimentos del Mañana S.A</h1>
    </div>

    <div class="menu">
        <ul>
            <li><a href="index_cliente.html">Inicio</a></li>
            <li><a href="detallePedidos.html">Detalle de Pedidos</a></li>
            <li><a href="contacto.html">Contacto</a></li>
        </ul>
    </div>

    <div class="productos-container">
        <h2 class="productos-titulo">Nuestros Productos</h2>
        <div class="productos">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='producto'>";
                    echo "<img src='" . $row['imagen'] . "' alt='" . $row['nombre'] . "'>";
                    echo "<h3>" . $row['nombre'] . "</h3>";
                    echo "<p>" . $row['descripcion'] . "</p>";
                    echo "<p>Precio: $" . $row['precio'] . "</p>";
                    echo "<p>Stock: " . $row['stock'] . "</p>";
                    echo "<button class='agregar-carrito' data-id='" . $row['id'] . "'>Agregar al Carrito</button>";
                    echo "</div>";
                }
            } else {
                echo "No se encontraron productos.";
            }
            ?>
        </div>
    </div>

    <!-- Carrito de compras -->
    <div class="carrito">
        <h2>Carrito de Compras</h2>
        <ul class="lista-productos">
            <!-- Los productos seleccionados se agregarán aquí -->
        </ul>
        <p>Total: <span class="total">0.00</span> CLP</p>
        <button id="ver-carrito">Ver Carrito de Compras</button>
        <button class="vaciar-carrito">Vaciar Carrito</button>
    </div>

    <div class="footer">
        <p>Distribuidora de alimentos del Mañana S.A</p>
        <p>Dirección: 123 Calle Principal, Ciudad de Talca</p>
        <p>Teléfono: +56995854231</p>
        <p>Horario de Atención: Lunes a Viernes, 8:00 AM - 6:00 PM</p>
        <p>Email: info@example.com</p>
        <p>Todos los derechos reservados &copy; 2024</p>
    </div>

    <script src="JS/index_php.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
