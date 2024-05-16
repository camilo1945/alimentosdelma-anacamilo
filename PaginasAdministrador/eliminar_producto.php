<?php
// Recibe el ID del producto a eliminar desde el frontend
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

// Conecta a la base de datos
$servername = "localhost:3308";
$username_db = "root";
$password_db = "";
$dbname = "distribucionalimentos";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Elimina el producto y su entrada correspondiente en la tabla Inventario
$sql_delete_producto = "DELETE FROM Producto WHERE id='$id'";
$conn->query($sql_delete_producto);

$sql_delete_inventario = "DELETE FROM Inventario WHERE producto_id='$id'";
$conn->query($sql_delete_inventario);

$conn->close();

// Envía una respuesta de éxito al frontend
http_response_code(200);
echo json_encode(array("message" => "Producto eliminado correctamente"));
?>
