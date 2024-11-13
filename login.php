<?php
// Iniciar la sesión
session_start();

// Incluir la conexión a la base de datos
include('conexion_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Consulta para verificar las credenciales
    $query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        // Almacenar el nombre de usuario en la sesión
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirigir al index
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form method="POST" action="login.php">
        <label for="username">Usuario:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
