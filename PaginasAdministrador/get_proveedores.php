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

// Consultar la tabla de proveedores
$sql = "SELECT id, nombre, direccion, telefono, correo FROM Proveedor";
$result = $conn->query($sql);

$proveedores = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $proveedores[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($proveedores);
?>
