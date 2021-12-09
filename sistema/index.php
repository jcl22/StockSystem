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
    
    <?php include '../php/scripts.php' ?>
    
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
                        <h4>Usuarios</h4>
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
                      <a href="inventarios/modulo_inventarios.php">
                        <div class="bg-icono">
                          <i class="fas fa-boxes"></i>

                        </div>
                        <h4>Inventarios</h4>
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
    
</body>
</html>