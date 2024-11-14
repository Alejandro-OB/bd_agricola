<?php
include('conexion_db.php'); // Incluye el archivo de conexión a la base de datos
include("includes/header.php");
?>

<?php
// Consulta: Cliente, Producto
$sql = "SELECT c.nombre AS Cliente, p.nombre AS Producto 
        FROM tbl_cliente c, tbl_producto_cliente pc, tbl_producto p 
        WHERE c.cedula = pc.cedula 
        AND pc.codigo = p.codigo";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path_to_your_css.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm mb-4">
            <div class="card-header text-white" style="background-color: #56bd31;">
                <h3 class="text-center mb-0">Resultado de la Consulta</h3>
            </div>
            <div class="card-body" style="background-color: #f0ffe0;">
                <table class="table table-striped table-hover table-bordered">
                    <thead style="background-color: #CFFF33;">
                        <tr>
                            <th>Cliente</th>
                            <th>Producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['Cliente']; ?></td>
                                <td><?php echo $row['Producto']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
