
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Inventarios</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>

    <?php include '../../php/scripts2.php' ?>
    
</head>
<body>

<?php include '../generales/header2.php'?> 

    <section id="content-section" >
        <!-- <div class="container"> -->
            <div class="section-container">
                <div class="content-row">
                    <!-- <div class="icono-section col-3 header-section wow fadeInUp"> -->

                        <div class="botones-accion"> 
                            <div class="boton agregar-pro">
                                <a href="1productos.php" class="btn btn-primary">Productos</a>
                            </div>
                            <div class="boton agregar-pro">
                                <a href="2bodegas.php" class="btn btn-primary">Bodegas</a>
                            </div>
                            <div class="boton agregar-pro">
                                <a href="3inventarios.php" class="btn btn-primary">Inventarios</a>
                            </div>
                        </div>   

                    <!-- </div> -->
                </div>
                <div class="bg-icono">
                    <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-inboxes-fill" viewBox="0 0 16 16">
                        <path d="M4.98 1a.5.5 0 0 0-.39.188L1.54 5H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0A.5.5 0 0 1 10 5h4.46l-3.05-3.812A.5.5 0 0 0 11.02 1H4.98zM3.81.563A1.5 1.5 0 0 1 4.98 0h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 10H1.883A1.5 1.5 0 0 1 .394 8.686l-.39-3.124a.5.5 0 0 1 .106-.374L3.81.563zM.125 11.17A.5.5 0 0 1 .5 11H6a.5.5 0 0 1 .5.5 1.5 1.5 0 0 0 3 0 .5.5 0 0 1 .5-.5h5.5a.5.5 0 0 1 .496.562l-.39 3.124A1.5 1.5 0 0 1 14.117 16H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .121-.393z"/>
                    </svg>
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

    
</body>
</html>