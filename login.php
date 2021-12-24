<?php

$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
    header('location:sistema/');
} else {

    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['contrasena'])) {
            $alert = '<div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>Por favor, ingrese su usuario y contraseña
                    </div>';
        } else {

            require_once "php/conexion.php";

            $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
            $contrasena = md5(mysqli_real_escape_string($conn, $_POST['contrasena']));

            $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario ='$usuario'
            AND contrasena = '$contrasena'");
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);

                $_SESSION['active'] = true;

                $_SESSION['id_usuario'] = $data['id_usuario'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre_usuario'] = $data['nombre_usuario'];
                $_SESSION['id_rol'] = $data['id_rol'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['contrasena'] = $data['contrasena'];
                $_SESSION['estado'] = $data['estado'];

                header('location:sistema/');
            } else {
                $alert = '<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>Los datos ingresados son incorrectos
                         </div>';
                session_destroy();
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockSystem | Loguin</title>
    <link rel="icon" href="img/StockS.ico">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300&display=swap" rel="stylesheet">
</head>

<body class="Stocksystemloguin">
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form action="login.php" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" type="text" name="usuario" id="" placeholder="Usuario">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input class="form-control" type="password" name="contrasena" id="" placeholder="Contraseña">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Recordarme
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Iniciar" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- alert -->
    <div id="alert">
        <?php echo isset($alert) ? $alert : ''; ?>
    </div>


</body>

</html>