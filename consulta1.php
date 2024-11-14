<?php
include('conexion_db.php'); // Incluye el archivo de conexión a la base de datos
include("includes/header.php");
// Cierra la etiqueta PHP aquí
?>


<?php

$sql = "SELECT a.nombre AS Agricultor, p.nombre AS Producto, p.temporada AS Temporada 
        FROM tbl_agricultor a, tbl_agricultor_producto ap, tbl_producto p 
        WHERE a.id_agricultor = ap.id_agricultor 
        AND ap.codigo = p.codigo 
        AND (p.temporada = 'Verano' OR p.temporada = 'Invierno') 
        AND a.nombre LIKE 'J%'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta 1</title>
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
                            <th>Agricultor</th>
                            <th>Producto</th>
                            <th>Temporada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['Agricultor']; ?></td>
                                <td><?php echo $row['Producto']; ?></td>
                                <td><?php echo $row['Temporada']; ?></td>
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
