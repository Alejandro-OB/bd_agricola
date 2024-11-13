<?php
include("conexion_db.php");

// Captura los valores que tiene el arreglo GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tbl_agricultor WHERE id_agricultor = $id"; 
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_array($resultado);
        $nombre = $fila['nombre'];
        $telefono = $fila['telefono'];
    }
}

// Captura los valores que tiene el arreglo POST
if (isset($_POST['bt_actualizar'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $query = "UPDATE tbl_agricultor SET nombre = '$nombre', telefono = '$telefono' WHERE id_agricultor = $id";
    
    mysqli_query($conn, $query);

    // Redirige a la página principal
    header("Location: index.php");
}
?>
<form action="editar_agricultor.php?id=<?php echo $_GET['id']; ?>" method="POST">
    <label for="lnombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
    <label for="ltelefono">Teléfono:</label><br>
    <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>
    <button name="bt_actualizar" type="submit">Actualizar Agricultor</button>
</form>
