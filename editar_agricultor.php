<?php
session_start();

include("conexion_db.php");


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


if (isset($_POST['bt_actualizar'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $query = "UPDATE tbl_agricultor SET nombre = '$nombre', telefono = '$telefono' WHERE id_agricultor = $id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['mensaje'] = "Agricultor actualizado exitosamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar agricultor: " . mysqli_error($conn);
        $_SESSION['tipo_mensaje'] = "error";
    }

    header("Location: index.php");
    exit();
}
?>

<?php include("includes/header.php"); ?>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-white text-center" style="background-color: #56bd31;">
                    <h2>Editar Agricultor</h2>
                </div>
                <div class="card-body" style="background-color: #f0ffe0;">
                    <form action="editar_agricultor.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group">
                            <label for="lnombre" class="form-label">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ltelefono" class="form-label">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $telefono; ?>" required>
                        </div>
                        <button name="bt_actualizar" type="submit" class="btn text-white w-100" style="background-color: #328a12;">Actualizar Agricultor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
