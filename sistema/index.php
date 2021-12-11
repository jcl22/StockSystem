

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
                          <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-inboxes-fill" viewBox="0 0 16 16">
                            <path d="M4.98 1a.5.5 0 0 0-.39.188L1.54 5H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0A.5.5 0 0 1 10 5h4.46l-3.05-3.812A.5.5 0 0 0 11.02 1H4.98zM3.81.563A1.5 1.5 0 0 1 4.98 0h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 10H1.883A1.5 1.5 0 0 1 .394 8.686l-.39-3.124a.5.5 0 0 1 .106-.374L3.81.563zM.125 11.17A.5.5 0 0 1 .5 11H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0 .5.5 0 0 1 .5-.5h5.5a.5.5 0 0 1 .496.562l-.39 3.124A1.5 1.5 0 0 1 14.117 16H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .121-.393z"/>
                          </svg>
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


    <?php include 'generales/footer.php'?>
    
</body>
</html>