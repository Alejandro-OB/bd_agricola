<?php

session_start();

include("conexion_db.php");
    
    
    if (isset($_POST['bt_guardar_agricultor'])) {
        
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];

        
        $query = "INSERT INTO tbl_agricultor (nombre, telefono) VALUES ('$nombre', '$telefono')";
        
        if (mysqli_query($conn, $query)) {
            $_SESSION['mensaje'] = "Agricultor agregado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al agregar agricultor: " . mysqli_error($conn);
            $_SESSION['tipo_mensaje'] = "error";
        }
        
        header("Location: index.php");
    }
?>
