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
$correo = $_POST['correo'];
$contrasena = $_POST['password']; // Utilizando el nombre correcto del campo de contraseña

// Consulta SQL para verificar las credenciales del cliente
$sql = "SELECT * FROM cliente WHERE correo = '$correo' AND contrasena = '$contrasena'";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si se encontró un cliente con las credenciales proporcionadas
if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    echo "Inicio de sesión exitoso. ¡Bienvenido!";
} else {
    // Inicio de sesión fallido
    echo "Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.";
}


// Cerrar la conexión
$conn->close();
?>

