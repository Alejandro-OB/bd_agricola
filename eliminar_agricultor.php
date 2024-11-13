<?php
include('conexion_db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Elimina al agricultor con el id proporcionado
    $query = "DELETE FROM tbl_agricultor WHERE id_agricultor = $id";

    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Fallo eliminando al agricultor");
    }
    header("Location: index.php");
}
?>


