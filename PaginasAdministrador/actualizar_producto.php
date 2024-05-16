<?php
// Recibe los datos actualizados del producto desde el frontend
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$newData = $data['newData'];

// Valida y escapa los datos actualizados para prevenir inyecciones SQL
$newNombre = $newData['nombre'];
$newDescripcion = $newData['descripcion'];
$newPrecio = $newData['precio'];
$newStock = $newData['stock'];

// Conecta a la base de datos
$servername = "localhost:3308";
$username_db = "root";
$password_db = "";
$dbname = "distribucionalimentos";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Actualiza los datos del producto en la tabla Producto
$sql_update_producto = "UPDATE Producto SET nombre='$newNombre', descripcion='$newDescripcion', precio='$newPrecio' WHERE id='$id'";
$conn->query($sql_update_producto);

// Actualiza la cantidad en el inventario para el producto
$sql_update_inventario = "UPDATE Inventario SET cantidad='$newStock' WHERE producto_id='$id'";
$conn->query($sql_update_inventario);

$conn->close();

// Envía una respuesta de éxito al frontend
http_response_code(200);
echo json_encode(array("message" => "Producto actualizado correctamente"));
?>
