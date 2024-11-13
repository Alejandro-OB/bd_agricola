<?php

session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$_COOKIE['prueba_cookie'];

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $tipo_mensaje = $_SESSION['tipo_mensaje'];
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipo_mensaje']);
} else {
    $mensaje = "";
    $tipo_mensaje = "";
}

include('conexion_db.php');
?>

<?php include ("includes/header.php")?>

<?php if ($mensaje): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast align-items-center text-white bg-<?php echo ($tipo_mensaje == 'success') ? 'success' : 'danger'; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $mensaje; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm" style="background-color: #e9f7df;">
                <div class="card-body text-center">
                    <h2 class="text-success fw-bold; background-color: #328a12">¡Bienvenido <?php echo $_SESSION['username']; ?>!</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header text-white" style="background-color: #56bd31;">
                    <h3>Agregar Agricultor</h3>
                </div>
                <div class="card-body" style="background-color: #f0ffe0;">
                    <form action="guardar_agricultor.php" method="POST">
                        <div class="mb-3">
                            <label for="lnombre" class="form-label">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ltelefono" class="form-label">Teléfono:</label>
                            <input type="number" id="telefono" name="telefono" class="form-control" required>
                        </div>
                        <button name="bt_guardar_agricultor" type="submit" class="btn text-white" style="background-color: #328a12;">Guardar Agricultor</button>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #56bd31;">
                    <h3>Buscar Agricultor</h3>
                </div>
                <div class="card-body" style="background-color: #f0ffe0;">
                    <form action="buscar_agricultor.php" method="GET">
                        <div class="mb-3">
                            <label for="buscar_nombre" class="form-label">Nombre del Agricultor:</label>
                            <input type="text" id="buscar_nombre" name="nombre" class="form-control" required>
                        </div>
                        <button type="submit" class="btn text-white" style="background-color: #328a12;">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #56bd31;">
                    <h3>Lista de Agricultores</h3>
                </div>
                <div class="card-body" style="background-color: #f0ffe0;">
                    <table class="table table-striped table-hover">
                        <thead style="background-color: #CFFF33;">
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query = "SELECT * FROM tbl_agricultor";
                            $resultado = mysqli_query($conn, $query);
                            
                            while ($fila = mysqli_fetch_array($resultado)) { ?>
                                <tr>
                                    <td><?php echo $fila['nombre']; ?></td>
                                    <td><?php echo $fila['telefono']; ?></td>
                                    <td>
                                        <a href="editar_agricultor.php?id=<?php echo $fila['id_agricultor']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                        <a href="eliminar_agricultor.php?id=<?php echo $fila['id_agricultor']; ?>" class="btn btn-sm btn-danger">Eliminar</a>
                                    </td>
                                </tr>               
                            <?php } ?>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ("includes/footer.php")?>

<script>
    $(document).ready(function(){
        var toastElement = document.getElementById('liveToast');
        if (toastElement) {
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
    });
</script>
