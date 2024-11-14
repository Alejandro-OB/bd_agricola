<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('conexion_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_producto'])) {
    $nombre = $_POST['nombre'];
    $temporada = $_POST['temporada'];

    if (!empty($nombre) && !empty($temporada)) {
        $query = "INSERT INTO tbl_producto (nombre, temporada) VALUES ('$nombre', '$temporada')";
        if (mysqli_query($conexion, $query)) {
            $_SESSION['mensaje'] = "Producto agregado exitosamente";
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $_SESSION['mensaje'] = "Error al agregar producto";
            $_SESSION['tipo_mensaje'] = 'danger';
        }
    }
}

$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
?>

<?php include("includes/header.php"); ?>

<div class="container mt-5">
    <!-- Mensaje de operación -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?php echo $_SESSION['tipo_mensaje']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['mensaje']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); ?>
    <?php endif; ?>

    <!-- Formulario Agregar Producto -->
    <div class="card mb-4" style="background-color: #7ecd61;">
        <div class="card-body">
            <h5 class="card-title text-white">Agregar Producto</h5>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="temporada" class="form-label">Temporada:</label>
                    <input type="text" class="form-control" id="temporada" name="temporada" required>
                </div>
                <button type="submit" class="btn btn-success" name="agregar_producto">Guardar Producto</button>
            </form>
        </div>
    </div>

    <!-- Formulario Buscar Producto -->
    <div class="card mb-4" style="background-color: #7ecd61;">
        <div class="card-body">
            <h5 class="card-title text-white">Buscar Producto</h5>
            <form method="GET" action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nombre del Producto" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de Productos -->
    <div class="card" style="background-color: #7ecd61;">
        <div class="card-body">
            <h5 class="card-title text-white">Lista de Productos</h5>
            <?php
            $query = "SELECT * FROM tbl_producto WHERE nombre LIKE '%$busqueda%' OR temporada LIKE '%$busqueda%'";
            $result = mysqli_query($conexion, $query);

            if (mysqli_num_rows($result) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Temporada</th>
                            <th>Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['temporada']; ?></td>
                                <td>
                                    <a href="editar_producto.php?codigo=<?php echo $row['codigo']; ?>" class="btn btn-warning">Editar</a>
                                    <a href="eliminar_producto.php?codigo=<?php echo $row['codigo']; ?>" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No se encontraron resultados.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
