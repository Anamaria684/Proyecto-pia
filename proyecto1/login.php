<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "casainglis";

// Conexión a la base de datos
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$error = ""; // Variable para el mensaje de error

// Procesamiento del formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($enlace, $_POST['correo']);
    $password = mysqli_real_escape_string($enlace, $_POST['contrasena']);

    // Consulta para verificar las credenciales
    $sql = "SELECT contrasena FROM usuarios WHERE correo='$email'";
    $resultado = mysqli_query($enlace, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        // Verificación de la contraseña
        if (password_verify($password, $fila['contrasena'])) {
            // Redirigir al usuario a la página de éxito
            header("Location: inicio.html");
            exit();
        } else {
            $error = "Contraseña incorrecta. Inténtalo de nuevo.";
        }
    } else {
        $error = "No se encontró ningún usuario con ese correo.";
    }
}

// Cierre de la conexión
mysqli_close($enlace);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="lg12.jpeg" sizes="16x16" type="image/png">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative; /* Para el logo */
        }

        form {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #c0392b; /* Rojo oscuro */
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #c0392b; /* Rojo oscuro */
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="password"]:focus {
            border-color: #e74c3c; /* Rojo brillante */
            outline: none;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #c0392b; /* Rojo oscuro */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            width: 48%;
            margin: 10px 1%;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #e74c3c; /* Rojo brillante */
            transform: scale(1.05);
        }

        input[type="reset"] {
            background-color: #e1e1e1;
            color: #333;
        }

        input[type="reset"]:hover {
            background-color: #d1d1d1;
        }

        @media (max-width: 400px) {
            form {
                width: 90%;
            }
        }

        /* Estilos para el logo */
        .logo {
            position: absolute;
            top: 20px; /* Ajusta según necesites */
            right: 20px; /* Ajusta según necesites */
            width: 120px; /* Ajusta el tamaño del logo */
            height: 120px; /* Mantiene la proporción para ser redondo */
            border: 2px solid #c0392b; /* Borde del logo */
            border-radius: 50%; /* Hace que el logo sea redondo */
            padding: 5px; /* Espaciado interno */
            background-color: white; /* Fondo blanco detrás del logo */
            object-fit: cover; /* Asegura que la imagen cubra el área */
        }

        .error-message {
            color: #c0392b; /* Rojo oscuro */
            background-color: #f8d7da; /* Fondo claro para el mensaje de error */
            border: 1px solid #f5c6cb; /* Borde rojo claro */
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
<img src="lg12.jpeg" alt="Logo" class="logo">
    <form action="" method="post">
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>

        <input type="submit" name="ingresar" value="Iniciar Sesión">
        <input type="reset" value="Limpiar">
    </form>
</body>
</html>
