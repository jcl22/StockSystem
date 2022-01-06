<?php
include "../../php/conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Productos | Editar producto </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/StockS.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>


</head>
<?php
include "../../php/conexion.php";
if (!empty($_POST)) {

    $alert = '';
    if (
        empty($_POST['id_proveedor']) || empty($_POST['id_categoria']) ||  
        empty($_POST['nombre_producto']) || empty($_POST['precio']) || empty($_POST['id']) 
        || empty($_POST['foto_actual']) || empty($_POST['foto_remove'])) {
        $alert = '<div id="alert" class="alert alert-warning d-flex align-items-center"  role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi                bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"             aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.              889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1               0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg><b> Error! Todos los campos son obligatorios.  </b> 
    </div> ';
    } else {

        $id = $_POST['id'];
        $id_proveedor = $_POST['id_proveedor'];
        $id_categoria = $_POST['id_categoria'];
        $nombre_producto = $_POST['nombre_producto'];
        $precio = $_POST['precio'];
        $imgProducto = $_POST['foto_actual'];
        $imgRemove = $_POST['foto_remove'];

        $foto = $_FILES['foto'];
        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $upd = '';

        if ($nombre_foto != '') {
            $destino = 'img_productos/uploads/';
            $img_nombre = 'img_' . md5(date('d-m-Y H:m:s'));
            $imgProducto = $img_nombre . 'jpg';
            $src = $destino . $imgProducto;
        } else {
            if($_POST['foto_actual'] != $_POST['foto_remove']) {
                $imgProducto = 'img_producto.png';
            }
        }


        $query_update = mysqli_query($conn, "UPDATE  producto
        SET nombre_producto = '$nombre_producto', id_proveedor =  $id_proveedor, 
        precio = $precio, id_categoria = $id_categoria, foto = '$imgProducto'
        WHERE id_producto = $id");

        if ($query_update) {

            if (($nombre_foto != '' && ($_POST['foto_actual'] !='img_producto.png')) 
            ||($_POST['foto_actual'] != $_POST['foto_remove'])) {                                            
                unlink('img_productos/uploads/'.$_POST['foto_actual']);
            }
            if ($nombre_foto != '') {
                move_uploaded_file($url_temp, $src);
            }
            $alert = '<div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg><b> El producto se actualizado correctamente  </b> 
                    </div>';
        } else {
            $alert = '<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg><b> Error al actualizar el producto  </b> 
                    </div>';
        }
    }
}
// validar producto
if (empty($_REQUEST['id'])) {

    header('location:listaproductos.php');
} else {
    $id_producto = $_REQUEST['id'];
    if (!is_numeric($id_producto)) {
        header('location:listaproductos.php');
    }

    $query_poducto = mysqli_query($conn, "SELECT p.id_producto, p.nombre_producto, p.precio, p.existencia, p.foto, pr.id_proveedor, pr.nombre_proveedor, c.id_categoria, c.nombre_categoria FROM producto p INNER JOIN proveedor pr ON p.id_proveedor = pr.id_proveedor INNER JOIN categoria_productos c ON p.id_categoria = c.id_categoria WHERE p.id_producto = '$id_producto' AND p.estado=1;");

    $result_producto = mysqli_num_rows($query_poducto);
    $foto = '';
    $classRemove = 'notBlok';


    if ($result_producto > 0) {
        $data_producto = mysqli_fetch_assoc($query_poducto);

        if ($data_producto['foto'] != 'img_producto.png') {
            $classRemove = '';
            $foto = '<img id="img" src="img_productos/uploads/' . $data_producto['foto'] . '" alt="producto">';
        }

        // print_r($data_producto);
    } else {
        header('location:listaproductos.php');
    }
}

?>

<body>
    <header>
        <?php include '../generales/headerapp.php' ?>

        <?php if ($tipo_rol == 'Administrador') { ?>
    </header>
    <section>
        <div class="tittle-producto">
            <h2>Editar producto</h2> <br>
        </div>
        <form id="formulario-producto" action="" method="post" enctype="multipart/form-data">

            <div class="form-product">
                <div class="formulario">
                    <!-- inputs hidden -->
                    <input type="hidden" name="id" value="<?php echo $data_producto['id_producto']; ?>">
                    <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto']; ?>">
                    <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto']; ?>">

                    <!-- form-cont1 -->
                    <div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Nombre</label>
                            <input type="text" class="form-control" id="" name="nombre_producto" value="<?php echo $data_producto['nombre_producto']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Proveedor</label>

                            <?php
                            $query_proveedor = mysqli_query($conn, "SELECT * FROM proveedor WHERE estado=1");
                            $result_proveedor = mysqli_num_rows($query_proveedor);
                            ?>
                            <select class="form-control" aria-label="Default select example" name="id_proveedor" id="notItemOne">
                                <option value="<?php echo $data_producto['id_proveedor']; ?>">
                                    <?php echo $data_producto['nombre_proveedor']; ?>
                                </option>

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

                    </div>
                    <!-- form-cont2 -->
                    <div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Precio</label>
                            <input type="number" class="form-control" id="" name="precio" min=1 value="<?php echo $data_producto['precio']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Categoría</label>
                            <?php
                            $query_categoria = mysqli_query($conn, "SELECT * FROM categoria_productos");
                            $result_categoria = mysqli_num_rows($query_categoria);
                            ?>
                            <select class="form-control" aria-label="Default select example" name="id_categoria" id="notItemOne">
                                <option value="<?php echo $data_producto['id_categoria']; ?>">
                                    <?php echo $data_producto['nombre_categoria']; ?>
                                </option>
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

                        <div class="form-group">
                            <!-- <label for="formGroupExampleInput2">Usuario que crea</label>
                            <input type="text" value="<?php echo $_SESSION['nombre_usuario']; ?>" class="form-control" id="" name="id_usuario" disabled> -->
                            <?php
                            ?>
                        </div>
                    </div>
                </div>
                <!-- foto -->
                <div class="photo">
                    <label for="foto">Foto</label>
                    <div class="prevPhoto">
                        <span class="delPhoto <?php echo $classRemove; ?>">X</span>
                        <label for="foto"></label>
                        <?php echo $foto; ?>
                    </div>
                    <div class="upimg">
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                </div>
                <div class="button">
                    <input id="login" type="submit" value="Actualizar" class="btn float-right login_btn">
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

<script src="../generales/funciones.js"></script>