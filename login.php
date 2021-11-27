<?php
    
    $alert = '';
    session_start();
    if (!empty($_SESSION['active']))  
    {
        header('location:sistema/');
    }  else {        

    if (!empty($_POST))
    {
        if (empty($_POST['usuario']) || empty($_POST['contrasena'])) 
        {
            $alert ='<h5> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg> Por favor, ingrese su usuario y contraseña  
                    </h5> ';
        } else {

            require_once "php/conexion.php";

            $usuario = $_POST['usuario'];
            $contrasena = ($_POST['contrasena']);

            $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario ='$usuario'
            AND contrasena = '$contrasena'");
            $result = mysqli_num_rows ($query);

            if ($result > 0) 
            {
                $data = mysqli_fetch_array($query);
                
                $_SESSION['active'] = true;

                $SESSION ['id_usuario'] = $data ['id_usuario'];
                $SESSION ['usuario'] = $data ['usuario'];
                $SESSION ['nombre_usuario'] = $data ['nombre_usuario'];
                $SESSION ['id_rol'] = $data ['id_rol'];
                $SESSION ['correo'] = $data ['correo'];
                $SESSION ['contrasena'] = $data ['contrasena'];
                $SESSION ['estado'] = $data ['estado'];

                header('location:sistema/');
            } else {
                $alert ='<h6> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg> Los datos ingresados son incorrectos. Por favor, verifíquelos  
                        </h6> ';
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
    <title>StockSystem - Loguin</title>
    <link rel="icon" href="img/LOGO-ICON.ico">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body class="Stocksystemloguin">
    <section class="logo-loguin">
        <img src="img/LOGO2.png" alt="">
    </section>
    <section class="titulo">
        <h1> <span>s</span>tock <span>s</span>ystem</h1> 
        <img src="img/DESARROLLO.png" alt="">
    </section>
    <section id="login">
            <div class="content-1">
                <div class="tittle">
                    <h2> <b>¡Bienvenido!</b></h2>
                    <p>Este es tu espacio de trabajo</p> 
                </div>
                <div class="content-text">
                    <div>
                        <p>Debes ingresar una cuenta y contraseña válida para poder acceder al sistema. 
                            Si no recuerdas tu contraseña, puedes clickear en <i>"¿Olvidaste tu contraseña?"</i></p>
                    </div>
                </div>
            </div>
            <div class= "triangulo">
                <img src="img/TRIANGULO2.png" alt="">
            </div>
            <div class="content-2">
                <div class="form-login">
                    <form action="login.php" method="post">
                        <div class="tittle">
                            <h4><b>login</b></h4>
                        </div>
                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <input type="text" name="usuario" id="" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-unlock-alt"></i>
                            <input type="password" name="contrasena" id="" placeholder="Contraseña">
                        </div>
                        <div class="password d-flex">                            
                            <div class="recuperar">
                                <a href="sistema/config/recupera.php">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                        <div class="boton-ingresar">                                                        
                            <button type="submit" class="btn btn-success"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>Ingresar
                            </button>
                        </div>                       
                    </form>  
                </div>
            </div> 
    </section>
    <!-- alert -->
    <div class="alert">
        <?php echo isset($alert) ? $alert : ''; ?>
    </div>

    <section class="link-pag">
        <a href="index.html" target="_blank"> <b> visitar página web </b></a> 
    </section>
    <footer id="footer-login">
        <div class="footer-container">
            <div class="content">
                <p> <b>StockSystem - Aplicativo web. Todos los derechos reservados a StockSystem ©</b> </p>
            </div>
        </div>
    </footer>
</body>
</html>
