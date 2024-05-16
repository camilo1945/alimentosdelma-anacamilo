<?php
// Habilitar la visualización de errores de PHP (solo en entorno de desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
$servername = "localhost:3308";
$username_db = "root";
$password_db = "";
$dbname = "distribucionalimentos";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del cliente desde el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$direccion = $data['direccion'];
$telefono = $data['telefono'];
$correo = $data['correo'];

// Verificar que todos los campos estén completos
if (empty($nombre) || empty($direccion) || empty($telefono) || empty($correo)) {
    http_response_code(400); // Bad Request
    echo json_encode(["mensaje" => "Todos los campos son obligatorios."]);
    exit;
}

// Insertar el nuevo cliente en la base de datos
$sql = "INSERT INTO Cliente (nombre, direccion, telefono, correo) VALUES ('$nombre', '$direccion', '$telefono', '$correo')";

if ($conn->query($sql) === TRUE) {
    http_response_code(201); // Created
} else {
    http_response_code(500); // Internal Server Error
}

$conn->close();
?>
