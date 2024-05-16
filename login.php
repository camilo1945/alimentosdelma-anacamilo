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

// Inicializar el mensaje de error
$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener las credenciales ingresadas por el usuario de manera segura
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? hash('sha256', $_POST['password']) : '';

    if ($username && $password) {
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $conn->prepare("SELECT * FROM administradores WHERE username = ? AND hashed_password = ?");
        $stmt->bind_param("ss", $username, $password);

        // Ejecutar la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['loginMessage'] = "Inicio de sesión exitoso.";
            header("Location: index_admin.html");
            exit();
        } else {
            // Credenciales incorrectas, mostrar mensaje de error
            session_start();
            $_SESSION['loginMessage'] = "Nombre de usuario o contraseña incorrectos.";
            header("Location: Login_admin.html"); // Redireccionar al mismo lugar
            exit();
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        $loginMessage = "Por favor, ingrese tanto el nombre de usuario como la contraseña.";
    }
}

if (isset($_SESSION['loginMessage'])) {
    echo "<p>" . $_SESSION['loginMessage'] . "</p>";
    unset($_SESSION['loginMessage']); // Limpiar el mensaje después de mostrarlo
}

// Cerrar la conexión
$conn->close();
?>
