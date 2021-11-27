<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Agregar Usuario </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Main Stylesheet File -->
    <link href="../../css/style_app.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/input_on.css">
    
</head>

<body>

    <?php require '../generales/header2.php'?>

    <section id="content-section" class="prefil">
        <div class= "titulo-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              </svg>
        </div>
        <div class="container-form">
            <div class="content">
                <div class="row-">
                    <!-- <div class="icono-section header-section wow fadeInUp">
                        <div class="icono-bg">
                            <div class="icono">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="tittle-section">
                            <h2>Agregar nuevo usuario</h2>
                        </div>
                    </div> -->
                    <form action="agregarusuario.php" method="post">
                        <div class="form-content ">
                            <div class="col-sm-4-left">
                                <div class="form-group">
                                    <input type="text" name="id_usuario" id="" placeholder="ID usuario">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="usuario" id="" placeholder="Usuario">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="nombre_usuario" id="" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="correo" id="" placeholder="Correo">
                                </div>
                            </div>

                            <div class="col-sm-4-right">
                                <div class="form-group">
                                    <input type="password" name="contrasena" id="" placeholder="Contraseña">
                                </div>
                                <!-- <div class="form-group">
                                    <input type="password" name="confirm_contrasena" id="" placeholder="Confirmar contraseña">
                                </div> -->
                                <div class="form-group select">
                                </div>
                                <select name="estado" id="">
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
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

    <?php require '../generales/footer.php'?>


        <!-- lib -->
        <link rel="stylesheet" href="../lib/animate/animate.min.css">
        <link rel="stylesheet" href="../lib/animate/animate.css">
    
        <!-- script lib -->
        <script src="../lib/wow/wow.js"></script>
        <script src="../lib/wow/wow.min.js"></script>
        <script src="../lib/jquery/jquery-migrate.min.js"></script>
        <script src="../lib/jquery/jquery.min.js"></script>
    
        <!-- scrip main -->
        <script src="../js/main.js"></script>
        <script src="../js/funciones.js"></script>

</body>

</html>