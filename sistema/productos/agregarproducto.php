<?php
include "../../php/conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Productos | Crear producto </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/StockS.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>


</head>

<body>
    <header>
        <?php include '../generales/headerapp.php' ?>

        <?php if ($tipo_rol == 'Administrador') { ?>
    </header>
    <section>
        <div class="tittle-producto">
            <h2>Crear producto</h2> <br>
        </div>
        <form id="formulario-producto" action="" method="post" enctype="multipart/form-data">
            <div class="form-product">
                <div class="formulario">
                    <div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Nombre</label>
                            <input type="text" class="form-control" id="" name="nombre_producto">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Proveedor</label>
                            <?php
                            $query_proveedor = mysqli_query($conn, "SELECT * FROM proveedor WHERE estado=1");
                            $result_proveedor = mysqli_num_rows($query_proveedor);
                            ?>
                            <select class="form-control" aria-label="Default select example" name="id_proveedor">
                                <?php
                                if ($result_proveedor > 0) {
                                    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                                ?>
                                        <option value="<?php echo $proveedor["id_proveedor"]; ?>">
                                            <?php echo $proveedor["nombre_proveedor"] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Categoría</label>
                            <?php
                            $query_categoria = mysqli_query($conn, "SELECT * FROM categoria_productos");
                            $result_categoria = mysqli_num_rows($query_categoria);
                            ?>
                            <select class="form-control" aria-label="Default select example" name="id_categoria">
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
                    <div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Precio</label>
                            <input type="number" class="form-control" id="" name="precio" min=1>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Existencias</label>
                            <input type="number" class="form-control" id="" name="existencia" min=1>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Usuario que crea</label>
                            <input type="text" value="<?php echo $_SESSION['nombre_usuario']; ?>" class="form-control" id="" name="id_usuario" disabled>
                            <?php

                            if (!empty($_POST)) {


                                $alert = '';
                                if (
                                    empty($_POST['id_proveedor']) || empty($_POST['id_categoria']) ||  empty($_POST['nombre_producto'])
                                    || empty($_POST['precio']) || empty($_POST['existencia'])
                                ) {
                                    $alert = '<div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg><b> Error! Todos los campos son obligatorios.  </b> 
                </div> ';
                                } else {

                                    $id_proveedor = $_POST['id_proveedor'];
                                    $id_categoria = $_POST['id_categoria'];
                                    $nombre_producto = $_POST['nombre_producto'];
                                    $precio = $_POST['precio'];
                                    $existencia = $_POST['existencia'];
                                    $id_usuario = $_SESSION['id_usuario'];

                                    $foto = $_FILES['foto'];
                                    $nombre_foto = $foto['name'];
                                    $type = $foto['type'];
                                    $url_temp = $foto['tmp_name'];

                                    $imgProducto = 'img_producto.png';

                                    if ($nombre_foto != '') {
                                        $destino = 'img_productos/uploads/';
                                        $img_nombre = 'img_' . md5(date('d-m-Y H:m:s'));
                                        $imgProducto = $img_nombre . 'jpg';
                                        $src = $destino . $imgProducto;
                                    }


                                    $query_insert = mysqli_query($conn, "INSERT INTO producto (id_proveedor, id_categoria, nombre_producto, precio, existencia, id_usuario, foto)VALUES ('$id_proveedor','$id_categoria','$nombre_producto','$precio','$existencia', '$id_usuario','$imgProducto')");

                                    if ($query_insert) {
                                        if ($nombre_foto != '') {
                                            move_uploaded_file($url_temp, $src);
                                        }
                                        $alert = '<div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg><b> El producto se ha creado correctamente  </b> 
                                                </div>';
                                    } else {
                                        $alert = '<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg><b> Error al crear el producto  </b> 
                                                </div>';
                                    }
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <!-- foto -->
                <div class="photo">
                    <label for="foto">Foto</label>
                    <div class="prevPhoto">
                        <span class="delPhoto notBlock">X</span>
                        <label for="foto"></label>
                    </div>
                    <div class="upimg">
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                </div>
                <div class="button">
                    <input id="login" type="submit" value="Crear" class="btn float-right login_btn">
                </div>
            </div>
        </form>
        <?php echo isset($alert) ? $alert : ''; ?>
    </section>

</body>

</html>
<?php } else { ?>
    <div id="alert-error" class="alert alert-danger d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </svg><b> Error! Página no disponible para este usuario. </b>
    </div>
<?php } ?>