<?php

session_start();


include('conexion_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    
    $query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        
        $_SESSION['username'] = $username;
        setcookie('prueba_cookie',$username,time() + (86400 * 30));
        header("Location: index.php"); 
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
} 

if(isset($_COOKIE['prueba_cookie'])){
    $_COOKIE['prueba_cookie'];
}
?>

<?php include ("includes/header.php")?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-white text-center" style="background-color: #56bd31;">
                    <h2>Iniciar Sesión</h2>
                </div>
                <div class="card-body" style="background-color: #f0ffe0;">
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="username">Usuario:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn text-white w-100" style="background-color: #328a12;">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ("includes/footer.php") ?>