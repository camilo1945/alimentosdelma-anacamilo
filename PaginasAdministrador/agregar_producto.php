<?php
// Recibe los datos del nuevo producto desde el frontend
$data = json_decode(file_get_contents("php://input"), true);

// Valida y escapa los datos recibidos para prevenir inyecciones SQL
$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$precio = $data['precio'];
$stock = $data['stock'];

// Conecta a la base de datos
$servername = "localhost:3308";
$username_db = "root";
$password_db = "";
$dbname = "distribucionalimentos";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inserta el nuevo producto en la tabla Producto
$sql_insert_producto = "INSERT INTO Producto (nombre, descripcion, precio, stock) VALUES ('$nombre', '$descripcion', '$precio', $stock)";
$conn->query($sql_insert_producto);

// Obtiene el ID del nuevo producto insertado
$id_producto = $conn->insert_id;

// Inserta la cantidad en el inventario para el nuevo producto
$sql_insert_inventario = "INSERT INTO Inventario (producto_id, cantidad) VALUES ('$id_producto', '$stock')";
$conn->query($sql_insert_inventario);

$conn->close();

// Envía una respuesta de éxito al frontend
http_response_code(200);
echo json_encode(array("message" => "Producto agregado correctamente"));
?>
