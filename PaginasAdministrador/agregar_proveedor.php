<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Verificar si todos los campos están llenos
    if (empty($nombre) || empty($direccion) || empty($telefono) || empty($correo)) {
        http_response_code(400);
        echo json_encode(array("message" => "Por favor, complete todos los campos."));
        exit();
    }

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $dbname = "nombre_de_tu_base_de_datos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar un nuevo proveedor
    $sql = "INSERT INTO Proveedor (nombre, direccion, telefono, correo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $direccion, $telefono, $correo);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(array("message" => "Proveedor agregado exitosamente."));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Error al agregar el proveedor."));
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Método no permitido."));
}
?>
