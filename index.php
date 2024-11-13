<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
include('conexion_db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Agricultores</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Cerrar sesión</a>

    <h3>Agregar Agricultor</h3>
    <form action="guardar_agricultor.php" method="POST">
        <label for="lnombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="ltelefono">Teléfono:</label><br>
        <input type="number" id="telefono" name="telefono" required><br>
        <button name="bt_guardar_agricultor" type="submit" value="Guardar Agricultor">Guardar Agricultor</button>
    </form>

    <h3>Lista de Agricultores</h3>
    <table border="1" cellpadding="2">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Opción</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Consulta para obtener todos los agricultores
                $query = "SELECT * FROM tbl_agricultor";
                $resultado = mysqli_query($conn, $query);
                
                // Bucle para mostrar cada agricultor
                while ($fila = mysqli_fetch_array($resultado)) { ?>
                <tr>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td>
                        <a href="editar_agricultor.php?id=<?php echo $fila['id_agricultor']; ?>">Editar</a>
                        <a href="eliminar_agricultor.php?id=<?php echo $fila['id_agricultor']; ?>">Eliminar</a>
                    </td>
                </tr>               
            <?php } ?>  
        </tbody>
    </table>
</body>
</html>
