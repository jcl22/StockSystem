<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Configurar Usuario</title>
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
    
    <!-- <link rel="stylesheet" href="css/input_on.css"> -->
</head>

<body>

    <?php require '../generales/header2.php'?>

    <section id="content-section" class="modificar agrgar producto">
        <div class= "titulo-section">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-clipboard-minus" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5.5 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
</svg>
        </div>
        <div class="buscar">
            <div class="form-buscar">
                <input type="text" name="" id="" placeholder="ID usuario">
            </div>
            <button class="button-buscar" onclick="buscarUsuario();" href=""> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg> 
            </button>
        </div>
        <div class="container-search" id="search">
            <div class="content">
                <div class="row-">
                    <div class="form-content">
                        <form action="agregarusuario.php" method="post">
                            <div class="form-content ">
                                <div class="col-sm-4-left">
                                    <div class="form-group">
                                        <input type="text" name="id_usuario" id="" placeholder="Usuario">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="usuario" id="" placeholder="Nombre">
                                    </div>                                    
                                </div>

                                <div class="col-sm-4-right">
                                    <div class="form-group">
                                        <input type="text" name="correo" id="" placeholder="Correo">
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
                <div class="float-left boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="modulo_usuarios.php" class="boton btn btn-primary"><i
                            class="fas fa-chevron-circle-left"></i></a>
                </div>
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
    
        <!-- scrip lib -->
        <script src="../lib/wow/wow.js"></script>
        <script src="../lib/wow/wow.min.js"></script>
        <script src="../lib/jquery/jquery-migrate.min.js"></script>
        <script src="../lib/jquery/jquery.min.js"></script>
    
        <!-- scrip main -->
        <script src="../js/main.js"></script>
        <script src="../../js/funciones.js"></script>
</body>

</html>