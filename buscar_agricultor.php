<?php
session_start();

// Incluir la conexión a la base de datos
include('conexion_db.php');

// Verificar si se recibió un nombre en el parámetro GET
if (isset($_GET['nombre'])) {
    $nombre = mysqli_real_escape_string($conn, $_GET['nombre']);

    // Crear la consulta para buscar agricultores por nombre
    $query = "SELECT * FROM tbl_agricultor WHERE nombre LIKE '%$nombre%'";
    $resultado = mysqli_query($conn, $query);
    ?>
    
    <?php include("includes/header.php"); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-white" style="background-color: #56bd31;">
                        <h3 class="text-center mb-0">Resultados de la Búsqueda para "<?php echo $nombre; ?>"</h3>
                    </div>
                    <div class="card-body" style="background-color: #f0ffe0;">
                        <?php
                        // Comprobar si se encontraron resultados
                        if (mysqli_num_rows($resultado) > 0) {
                            echo "<table class='table table-striped table-hover'>";
                            echo "<thead style='background-color: #CFFF33;'><tr><th>Nombre</th><th>Teléfono</th><th>Opciones</th></tr></thead><tbody>";

                            // Mostrar los resultados de la búsqueda
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $fila['nombre'] . "</td>";
                                echo "<td>" . $fila['telefono'] . "</td>";
                                echo "<td>";
                                echo "<a href='editar_agricultor.php?id=" . $fila['id_agricultor'] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                                echo "<a href='eliminar_agricultor.php?id=" . $fila['id_agricultor'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }

                            echo "</tbody></table>";
                        } else {
                            echo "<p class='text-center text-danger'>No se encontraron agricultores con el nombre '$nombre'.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    echo "<div class='container mt-5'><p class='text-center text-danger'>Por favor, ingrese un nombre para buscar.</p></div>";
}
?>
<?php include("includes/footer.php"); ?>


