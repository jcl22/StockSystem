<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (
        empty($_POST['nombre_producto']) || empty($_POST['id_categoria']) 
        || empty($_POST['costo_producto']) || empty($_POST['precio_producto'])
    ) {
        $alert = ' <h4> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg> <b> Error! Todos los campos son obligatorios.  </b> 
                    </h4> ';
    } else {


        $nombre_producto = $_POST['nombre_producto'];
        $id_categoria = $_POST['id_categoria'];
        $costo_producto = $_POST['costo_producto'];
        $precio_producto = $_POST['precio_producto'];

        $query = mysqli_query($conn, "SELECT * FROM producto 
        WHERE  nombre_producto = '$nombre_producto' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '  <h6> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg> <b> Error! El nombre del producto ya existe. </b> 
                        </h6> ';
        } else {
            $query_insert = mysqli_query($conn, "INSERT INTO producto (nombre_producto, 
            id_categoria, costo_producto, precio_producto) VALUES ('$nombre_producto','$id_categoria','$costo_producto', '$precio_producto')");


            if ($query_insert) {
                $alert = '  <h5> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg> <b> El producto se ha creado correctamente. <br>
                                Para consultar el ID asignado, diríjase a lista de productos </b> 
                            </h5> ';
            } else {
                $alert = ' <h4 > 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg> <b> Error al crear el producto.</b> </h4> ';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario | Producto/Crear </title>
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
        <div class="titulo-section">
            <svg class= "img-aggproduct" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
            </svg>
        </div>
        <div class="container-form">
            <div class="content">
                <div class="row-">

                    <form action="" method="post">
                        <div class="form-content ">
                            <div class="col-sm-4-left">
                                <div class="form-group">
                                    <input type="text" name="nombre_producto" id="" placeholder="Producto">
                                </div> 

                                <div class="form-group select">

                                    <?php
                                    $query_categoria = mysqli_query($conn, "SELECT * FROM categoria_productos");
                                    $result_categoria = mysqli_num_rows($query_categoria);
                                    ?>

                                    <select class="select-form" name="id_categoria">
                                        <?php
                                        if ($result_categoria > 0) {
                                            while ($categoria = mysqli_fetch_array($query_categoria)) {
                                        ?>
                                                <option value="<?php echo $categoria["id_categoria"]; ?>">
                                                    <?php echo $categoria["nombre_categoria"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4-right">
                                <div class="form-group">
                                    <input type="text" name="costo_producto" id="" placeholder="Costo">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="precio_producto" id="" placeholder="Precio">
                                </div> 
                            </div>
                        </div>
                        <div class="botones">
                            <button id="button-crear"type="submit" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                                </svg>Crear
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </section>

    <section id="botones-footer">
        <div class="content">
            <div class="botones-abl-footer">
                <div class="float-left boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="1productos.php" class="boton btn btn-primary"><i
                            class="fas fa-chevron-circle-left"></i></a>
                </div>
                <div class="float-right boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="../index.php" class="boton btn btn-primary"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
    </section>

        <?php include '../generales/footer.php'?>



</body>

</html>