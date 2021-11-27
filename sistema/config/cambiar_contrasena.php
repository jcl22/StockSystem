<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
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
<body class="menu">

    <?php include '../generales/header2.php'?>

    <section id="content-section" class="modificar agrgar producto">
        <div class= "titulo-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
        </div>
        <div class="container-form">
            <div class="content">
                <div class="row-">

                    <div class="form-content ">
                        <form action="agregarusuario.php" method="post">
                            <div class="form-content ">
                                <div class="col-sm-4-left">
                                    <div class="form-group">
                                        <input type="password" name="contrasena" id="" placeholder="Contraseña actual">
                                    </div>
                                </div>
    
                                <div class="col-sm-4-right">
                                    <div class="form-group">
                                        <input type="password" name="contrasena" id="" placeholder="Nueva contraseña">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="contrasena" id="" placeholder="Repite contraseña">
                                    </div>
                                </div>
                            </div>
                        </form>                   
                    </div>
                </div>
            </div>
        </div>
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