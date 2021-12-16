<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (
        empty($_POST['id_categoria']) || empty($_POST['nombre_producto'])
        || empty($_POST['costo_producto']) || empty($_POST['precio_producto'])
    ) {
        $alert = '<div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg><b> Error! Todos los campos son obligatorios.  </b> 
                </div> ';
    } else {

        $id_Producto = $_POST['id_producto'];
        $nombre_producto = $_POST['nombre_producto'];
        $costo_producto = $_POST['costo_producto'];
        $precio_producto = ($_POST['precio_producto']);
        $id_categoria = $_POST['id_categoria'];
        $estado = 1;

        $query = mysqli_query($conn, "SELECT * FROM producto
         WHERE  (nombre_producto = '$nombre_producto' AND id_producto != $id_Producto) ");

        $result = mysqli_fetch_array($query);


        if ($result > 0) {
            $alert = '<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg><b> Error! El producto ya existe.  </b> 
                    </div>';
        } else {



            $sql_update = mysqli_query($conn, "UPDATE producto SET nombre_producto = '$nombre_producto', 
                costo_producto = '$costo_producto', precio_producto = '$precio_producto', id_categoria = '$id_categoria',
                estado = '$estado'
                WHERE id_producto = $id_Producto");


            if ($sql_update) {
                $alert = '<div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> El producto se ha actualizado correctamente  </b> 
                        </div>';
            } else {
                $alert = '<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> Error al actualizar el producto.  </b> 
                        </div>';
            }
        }
    }
}

// mostrar datos

if (empty($_GET['id'])) {
    header('location:listaproductos.php');
}
$id_Producto =  $_GET['id'];

$sql = mysqli_query($conn, "SELECT p.id_producto, p.nombre_producto, p.costo_producto, p.precio_producto, p.estado, 
(p.id_categoria) as id_categoria, (c.nombre_categoria) as nombre_categoria FROM producto p INNER JOIN categoria_productos c ON p.id_categoria = c.id_categoria WHERE id_producto=$id_Producto");

$result_edit = mysqli_num_rows($sql);

if ($result_edit == 0) {
    header('location:listaproductos.php');
} else {

    $option_categoria = '';
    while ($data = mysqli_fetch_array($sql)) {
        $id_Producto = $data['id_producto'];
        $nombre_producto = $data['nombre_producto'];
        $costo_producto = $data['costo_producto'];
        $precio_producto = $data['precio_producto'];
        $estado = 1;
        $id_categoria = $data['id_categoria'];
        $nombre_categoria = $data['nombre_categoria'];

        // option-rol
        if ($id_categoria == 1) {
            $option_categoria = '<option value= "' . $id_categoria . '"select>' . $nombre_categoria . ' </option>';
        } else if ($id_categoria == 2) {
            $option_categoria = '<option value= "' . $id_categoria . '"select>' . $nombre_categoria . ' </option>';
        } else if ($id_categoria == 3) {
            $option_categoria = '<option value= "' . $id_categoria . '"select>' . $nombre_categoria . ' </option>';
        } else if ($id_categoria == 4) {
            $option_categoria = '<option value= "' . $id_categoria . '"select>' . $nombre_categoria . ' </option>';
        } else if ($id_categoria == 5) {
            $option_categoria = '<option value= "' . $id_categoria . '"select>' . $nombre_categoria . ' </option>';
        }

        // option-estado
        // if($estado=='Activo') {
        //     $option_est ='<option value= "'.$estado.'"select>' .$nombre_rol. ' </option>';
        // } else if ($id_rol=='Inactivo') {
        //     $option_est ='<option value= "'.$id_rol.'"select>' .$nombre_rol. ' </option>';
        // }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios | Producto/Editar</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>


</head>

<body>
    <header>
        <?php include '../generales/headerapp.php' ?>
    </header>

    <section>
        <div class="tittle">
            <h2>Editar producto </h2> <br>
        </div>
        <form action="" method="post">
            <div class="formulario">
                <div>
                    <input type="hidden" name="id_producto" id="" value=" <?php echo $id_Producto; ?> ">
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Nombre</label>
                        <input type="text" class="form-control" id="" name="nombre_producto" value="<?php echo $nombre_producto; ?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Categoría</label>
                        <?php
                        $query_categoria = mysqli_query($conn, "SELECT * FROM categoria_productos");
                        $result_categoria = mysqli_num_rows($query_categoria);
                        ?>
                        <select class="form-control" aria-label="Default select example" name="id_categoria">
                            <?php
                            echo $option_categoria;

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
                        <label for="formGroupExampleInput2">Costo</label>
                        <input type="text" class="form-control" id="" name="costo_producto" value="<?php echo $costo_producto; ?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Precio</label>
                        <input type="text" class="form-control" id="" name="precio_producto" value="<?php echo $precio_producto; ?>">
                    </div>
                </div>
            </div>
            <div class="button">
                <input id="login" type="submit" value="Actualizar" class="btn float-right login_btn">
            </div>
        </form>
        <?php echo isset($alert) ? $alert : ''; ?>
    </section>

</body>

</html>