<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockSystem - Menú principal</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Main Stylesheet File -->
    <link href="../css/style_menu.css" rel="stylesheet">
    <link href="../css/input_on.css" rel="stylesheet">
    
    
</head>
<body class="menu">

<?php include 'generales/header.php' ?>

    <section id="inicio-secciones" class="inicio-secciones">
        <div class="container">
            <div class="content">
                <div class="iconos-inicio row">
                  <div class="icono-solo col-sm-12">
                    <div class="icono icono-usuario">
                      <a href="usuarios/modulo_usuarios.php">
                        <div class="bg-icono">
                          <i class="fas fa-users"></i>
                        </div>
                        <h4>Usuario</h4>
                      </a>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="icono icono-compras">
                      <a href="compras/modulo_compras.php">
                        <div class="bg-icono">
                          <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4>Compras</h4>
                      </a>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="icono icono-inventario">
                      <a href="inventario/modulo_inventario.php">
                        <div class="bg-icono">
                          <i class="fas fa-boxes"></i>

                        </div>
                        <h4>Inventario</h4>
                      </a>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="icono icono-ventas">
                      <a href="ventas/modulo_ventas.php">
                        <div class="bg-icono">
                          <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Ventas</h4>
                      </a>
                    </div>
                  </div>

                </div>
            </div>
        </div>
    </section>


    <?php include '/generales/footer.php'?>
    <!-- lib -->
    <link rel="stylesheet" href="../lib/animate/animate.min.css">

    <!-- scrip lib -->
    <script src="../lib/wow/wow.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/jquery/jquery-migrate.min.js"></script>
    <script src="../lib/jquery/jquery.min.js"></script>

    <!-- scrip main -->
    <script src="../js/main.js"></script>
    
</body>
</html>