<?php
    include("conexion_db.php");
    
    // Verifica si se presionó el botón guardar
    if (isset($_POST['bt_guardar_agricultor'])) {
        // Captura el nombre y el teléfono enviados por el método POST
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];

        // Realiza la inserción del nuevo dato en la tabla tbl_agricultor
        $query = "INSERT INTO tbl_agricultor (nombre, telefono) VALUES ('$nombre', '$telefono')";
        
        // Ejecuta la consulta
        mysqli_query($conn, $query);
        
        // Redirige a la página principal y muestra los datos actualizados
        header("Location: index.php");
    }
?>
