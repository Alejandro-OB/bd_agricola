<?php
// Iniciar la sesión para almacenar mensajes de éxito o error
session_start();

// Incluir la conexión a la base de datos
include('conexion_db.php');

// Verificar si se recibió un ID por URL
if (isset($_GET['id'])) {
    // Obtener el ID del agricultor a eliminar
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Primero, eliminar registros dependientes en `tbl_agricultor_cliente`
    $delete_dependents_query = "DELETE FROM tbl_agricultor_cliente WHERE id_agricultor = '$id'";
    $resultado_dependents = mysqli_query($conn, $delete_dependents_query);

    $delete_dependents_query = "DELETE FROM tbl_agricultor_producto WHERE id_agricultor = '$id'";
    $resultado_dependents = mysqli_query($conn, $delete_dependents_query);
    // Verificar si la eliminación de dependientes fue exitosa
    if ($resultado_dependents) {
        // Luego, eliminar el agricultor en `tbl_agricultor`
        $delete_query = "DELETE FROM tbl_agricultor WHERE id_agricultor = '$id'";
        $resultado = mysqli_query($conn, $delete_query);

        // Verificar si la eliminación del agricultor fue exitosa
        if ($resultado) {
            $_SESSION['mensaje'] = "Agricultor eliminado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar agricultor: " . mysqli_error($conn);
            $_SESSION['tipo_mensaje'] = "error";
        }
    } else {
        $_SESSION['mensaje'] = "Error al eliminar registros dependientes: " . mysqli_error($conn);
        $_SESSION['tipo_mensaje'] = "error";
    }

    // Redirigir a index.php
    header("Location: index.php");
    exit();
} else {
    $_SESSION['mensaje'] = "ID de agricultor no proporcionado.";
    $_SESSION['tipo_mensaje'] = "error";
    header("Location: index.php");
    exit();
}
?>



