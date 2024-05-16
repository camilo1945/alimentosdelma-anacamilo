<?php
// Habilitar la visualización de errores de PHP (solo en entorno de desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
$servername = "localhost:3308";
$username_db = "root";
password_db = "";
$dbname = "distribucionalimentos";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del proveedor desde el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// Eliminar el proveedor de la base de datos
$sql = "DELETE FROM Proveedor WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}

$conn->close();
?>
