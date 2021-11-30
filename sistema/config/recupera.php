<?php 
    require '../../php/conexion.php'
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockSystem - Recuperar contraseña</title>
    <link rel="icon" href="../../img/LOGO-ICON.ico">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <?php include '../../php/scripts2.php' ?>
</head>
<body class="Stocksystemloguin">
    <section class="logo-loguin">
        <img src="../../img/LOGO2.png" alt="">
    </section>

    <section class="titulo">
        <h1> <span>s</span>tock <span>s</span>ystem</h1> 
        <img src="../../img/DESARROLLO.png" alt="">
    </section>

    <section class="recupera-contra">
        <div class="titulo-recupera">
            <h1> Recupera tu contraseña</h1>
        </div>
        <div class="content-recupera">
            <form  action="recupera.php" method="post">
                <input type="email" name="correo" id="" placeholder="Escribe tu correo">
                <button type="submit" class="btn btn-success"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                    </svg>Enviar
                </button>
            </form>
        </div>        
    </section>
    <section class="link-pag">
        <a href="../../login.php"> <b> Volver a login </b></a> 
    </section>

    
    <!-- alert -->

</body>
</html>


