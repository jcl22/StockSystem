
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
                    <i class="fas fa-boxes"></i>
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