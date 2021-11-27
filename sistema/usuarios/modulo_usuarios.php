
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo usuarios</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Main Stylesheet File -->
    <link href="../../css/style_app.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/input_on.css">
    
</head>
<body>

<?php include '../generales/header2.php'?> 

    <section id="content-section" class="modulo-usuarios modulo">
        <!-- <div class="container"> -->
            <div class="section-container">
                <div class="content-row">
                    <!-- <div class="icono-section col-3 header-section wow fadeInUp"> -->
                        <div class="botones-accion"> 
                            <div class="boton agregar-pro">
                                <a href="agregarusuario.php" class="btn btn-primary">Agregar nuevo usuario</a>
                            </div>
                            <div class="boton agregar-pro">
                                <a href="buscarusuario.php" class="btn btn-primary">Buscar usuarios</a>
                            </div>
                            <div class="boton modificar-pro">
                                <a href="configurarusuario.php" class="btn btn-primary">Configurar usuarios</a>
                            </div>
                            <div class="boton info-pro">
                                <a href="eliminarusuario.php" class="btn btn-primary">Eliminar usuarios</a>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="bg-icono">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        <!-- </div> -->
    </section>


    <section id="botones-footer">
        <div class="content">
            <div class="botones-abl-footer">
                <div class="float-right boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="../index.php" class="boton btn btn-primary"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
    </section>

    <?php include '../generales/footer.php'?>

    <!-- lib -->
    <link rel="stylesheet" href="lib/animate/animate.min.css">

    <!-- scrip lib -->
    <script src="lib/wow/wow.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/jquery/jquery.min.js"></script>

    <!-- scrip main -->
    <script src="js/main.js"></script>
    
</body>
</html>