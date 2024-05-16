<?php
// Datos de conexión a la base de datos
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "distribucionalimentos";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
// Obtener la contraseña del formulario y encriptarla
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Verificar si los campos requeridos están vacíos
if (empty($nombre) || empty($direccion) || empty($correo) || empty($telefono) || empty($contrasena)) {
    echo "Por favor, complete todos los campos.";
} else {
    // Query para insertar datos en la tabla de clientes
    $sql = "INSERT INTO cliente (nombre, direccion, correo, telefono, contrasena) 
            VALUES ('$nombre', '$direccion', '$correo', '$telefono', '$contrasena')";

    // Ejecutar la consulta y verificar si se ha realizado con éxito
    if ($conn->query($sql) === TRUE) {
        echo "El cliente se ha registrado con éxito.";
    } else {
        echo "Error al registrar el cliente: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
