<?php

$server = "localhost:3308";
$user = "root";
$pass = "";
$db = "distribucionalimentos";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {

	die("Conexion fallida" . $conexion->connect_errno);
}else {

echo "conectado";
}

?>