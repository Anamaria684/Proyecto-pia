<?php
$servidor = "localhost"; // o la dirección del servidor
$usuario = "root";
$contraseña = " ";
$base_de_datos = "casainglis";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";

$conn->close();
?>
